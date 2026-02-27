<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\RegistrationOtpMail;
use App\Models\Opd;
use App\Models\RegistrationOtp;
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
        // OPD tidak perlu di-load semua, akan di-search via AJAX
        return view('auth.register');
    }

    /**
     * Search OPD for autocomplete (AJAX) - Optimized.
     */
    public function searchOpd(Request $request)
    {
        $query = $request->get('q', '');
        
        // Cache key untuk query ini
        $cacheKey = 'opd_search_' . md5($query);
        
        $opds = cache()->remember($cacheKey, 60, function () use ($query) {
            $q = Opd::select(['id', 'nama_opd']);
            
            if (!empty($query)) {
                $q->where('nama_opd', 'like', "%{$query}%");
            }
            
            return $q->orderBy('nama_opd')
                ->limit(50) // Lebih banyak untuk preload, client akan filter
                ->get();
        });
        
        return response()->json($opds);
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
            'opd' => ['required', 'string', 'max:255'],
        ], [
            'email.unique' => 'Email sudah terdaftar di sistem.',
            'opd.required' => 'Pilih atau tambahkan OPD.',
        ]);

        // Handle OPD: normalize and check for duplicates
        $opdId = $this->getOrCreateOpd($request->opd);

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

        // Create user
        $user = User::create([
            'name' => $registrationOtp->name,
            'email' => $registrationOtp->email,
            'password' => $registrationOtp->password,
            'role' => 'user',
            'opd_id' => $registrationOtp->opd_id,
        ]);

        // Clean up
        $registrationOtp->delete();

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }

    /**
     * Get existing OPD or create new one with normalization.
     */
    private function getOrCreateOpd(string $opdInput): int
    {
        // Normalize: trim, remove extra spaces, convert to Title Case
        $normalizedName = $this->normalizeOpdName($opdInput);
        
        // Check if input is numeric (existing OPD ID from autocomplete)
        if (is_numeric($opdInput)) {
            $existingOpd = Opd::find($opdInput);
            if ($existingOpd) {
                return $existingOpd->id;
            }
        }
        
        // Check for duplicate with case-insensitive comparison
        $existingOpd = Opd::whereRaw('LOWER(TRIM(nama_opd)) = ?', [strtolower(trim($opdInput))])->first();
        
        if ($existingOpd) {
            return $existingOpd->id;
        }
        
        // Create new OPD with normalized name
        $newOpd = Opd::create(['nama_opd' => $normalizedName]);
        
        // Clear OPD search cache
        cache()->forget('opd_search_' . md5(''));
        
        return $newOpd->id;
    }

    /**
     * Normalize OPD name to Title Case.
     */
    private function normalizeOpdName(string $name): string
    {
        // Trim whitespace
        $name = trim($name);
        
        // Remove extra spaces (multiple spaces become single space)
        $name = preg_replace('/\s+/', ' ', $name);
        
        // Convert to lowercase first, then Title Case
        $name = ucwords(strtolower($name));
        
        return $name;
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
