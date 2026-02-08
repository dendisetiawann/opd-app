<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\RegistrationOtpMail;
use App\Models\Opd;
use App\Models\RegistrationOtp;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $opds = Opd::orderBy('nama_opd')->get();
        return view('auth.register', compact('opds'));
    }

    /**
     * Handle an incoming registration request - Step 1: Send OTP
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'opd_id' => ['required_without:new_opd'],
            'new_opd' => ['required_without:opd_id', 'nullable', 'string', 'max:255'],
        ], [
            'email.unique' => 'Email sudah terdaftar di sistem.',
            'opd_id.required_without' => 'Pilih OPD atau tambahkan OPD baru.',
            'new_opd.required_without' => 'Pilih OPD atau tambahkan OPD baru.',
        ]);

        // Handle OPD: create new or use existing
        $opdId = $request->opd_id;
        
        if ($request->filled('new_opd')) {
            $existingOpd = Opd::where('nama_opd', $request->new_opd)->first();
            
            if ($existingOpd) {
                $opdId = $existingOpd->id;
            } else {
                $newOpd = Opd::create(['nama_opd' => $request->new_opd]);
                $opdId = $newOpd->id;
            }
        }

        // Generate 4-digit OTP
        $otp = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);

        // Delete existing OTP for this email
        RegistrationOtp::where('email', $request->email)->delete();

        // Store OTP with registration data
        $registrationOtp = RegistrationOtp::create([
            'email' => $request->email,
            'otp' => $otp,
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'opd_id' => $opdId,
            'expires_at' => now()->addMinutes(2),
            'last_sent_at' => now(),
        ]);

        // Send OTP email
        Mail::to($request->email)->send(new RegistrationOtpMail($otp, $request->name));

        // Redirect with pending status
        return redirect()->route('register')
            ->with('otp_pending', true)
            ->with('otp_email', $request->email)
            ->with('otp_name', $request->name)
            ->with('otp_expires_at', $registrationOtp->expires_at->timestamp);
    }

    /**
     * Verify OTP and complete registration
     */
    public function verifyOtp(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
            'otp' => ['required', 'string', 'size:4'],
        ]);

        $registrationOtp = RegistrationOtp::where('email', $request->email)->first();

        if (!$registrationOtp) {
            return redirect()->route('register')
                ->withErrors(['otp' => 'Sesi pendaftaran tidak ditemukan. Silakan daftar ulang.']);
        }

        if ($registrationOtp->isExpired()) {
            $registrationOtp->delete();
            return redirect()->route('register')
                ->withErrors(['otp' => 'Kode OTP sudah kedaluwarsa. Silakan daftar ulang.']);
        }

        if ($registrationOtp->otp !== $request->otp) {
            return redirect()->route('register')
                ->with('otp_pending', true)
                ->with('otp_email', $request->email)
                ->with('otp_name', $registrationOtp->name)
                ->with('otp_expires_at', $registrationOtp->expires_at->timestamp)
                ->withErrors(['otp' => 'Kode OTP tidak valid.']);
        }

        // Get 'user' role
        $userRole = Role::where('name', 'user')->first();

        // Create user
        $user = User::create([
            'name' => $registrationOtp->name,
            'email' => $registrationOtp->email,
            'password' => $registrationOtp->password,
            'role_id' => $userRole->id,
            'opd_id' => $registrationOtp->opd_id,
        ]);

        // Clean up
        $registrationOtp->delete();

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }

    /**
     * Resend OTP
     */
    public function resendOtp(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $registrationOtp = RegistrationOtp::where('email', $request->email)->first();

        if (!$registrationOtp) {
            return redirect()->route('register')
                ->withErrors(['otp' => 'Sesi pendaftaran tidak ditemukan. Silakan daftar ulang.']);
        }

        if (!$registrationOtp->canResend()) {
            $seconds = $registrationOtp->secondsUntilResend();
            return redirect()->route('register')
                ->with('otp_pending', true)
                ->with('otp_email', $request->email)
                ->with('otp_name', $registrationOtp->name)
                ->with('otp_expires_at', $registrationOtp->expires_at->timestamp)
                ->withErrors(['otp' => "Tunggu {$seconds} detik sebelum kirim ulang."]);
        }

        // Generate new OTP
        $otp = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);

        // Update OTP data
        $registrationOtp->update([
            'otp' => $otp,
            'expires_at' => now()->addMinutes(2),
            'last_sent_at' => now(),
        ]);

        // Send new OTP email
        Mail::to($request->email)->send(new RegistrationOtpMail($otp, $registrationOtp->name));

        return redirect()->route('register')
            ->with('otp_pending', true)
            ->with('otp_email', $request->email)
            ->with('otp_name', $registrationOtp->name)
            ->with('otp_expires_at', $registrationOtp->expires_at->timestamp)
            ->with('otp_resent', true);
    }
}
