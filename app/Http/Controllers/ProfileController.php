<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        // Automatically clear OTP session if user navigates away and comes back,
        // UNLESS they just got redirected here from an update/resend action or have validation errors.
        if ($request->session()->has('email_update_pending')) {
            if (!$request->session()->has('errors') && 
                !in_array(session('status'), ['profile-updated-otp-sent', 'otp-resent'])) {
                $request->session()->forget([
                    'email_update_pending', 
                    'email_update_new_email', 
                    'email_update_otp', 
                    'email_update_expires_at', 
                    'email_update_last_sent'
                ]);
            }
        }

        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $oldValues = [
            'name' => $user->name,
            'email' => $user->email,
        ];

        // Store current email to check if it changed
        $currentEmail = $user->email;
        
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            // Restore original email for now, we'll update it after OTP verification
            $newEmail = $user->email;
            $user->email = $currentEmail;
            
            // Generate OTP
            $otp = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);
            
            // Save to session
            $request->session()->put('email_update_pending', true);
            $request->session()->put('email_update_new_email', $newEmail);
            $request->session()->put('email_update_otp', $otp);
            $request->session()->put('email_update_expires_at', now()->addMinutes(2)->timestamp);
            $request->session()->put('email_update_last_sent', now()->timestamp);
            
            // Send OTP to NEW email
            \Illuminate\Support\Facades\Mail::to($newEmail)->send(new \App\Mail\EmailUpdateOtpMail($otp, $user->name));
        }

        // Only log and save if something actually changed (other than email which is handled later)
        if ($user->isDirty()) {
            $user->save();

            \App\Models\ActivityLog::create([
                'user_id' => $user->id,
                'action' => 'profile_updated',
                'old_value' => json_encode($oldValues),
                'new_value' => json_encode([
                    'name' => $user->name,
                    'email' => $user->email, // still old email if email was updated
                ]),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);
        } else {
            $user->save();
        }

        if ($request->session()->has('email_update_pending')) {
            return Redirect::route('profile.edit')->with('status', 'profile-updated-otp-sent');
        }

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Verify OTP for email update
     */
    public function verifyEmailUpdate(Request $request): RedirectResponse
    {
        $request->validate([
            'otp' => ['required', 'string', 'size:4'],
        ]);

        if (!$request->session()->has('email_update_pending')) {
            return Redirect::route('profile.edit')->withErrors(['otp' => 'Sesi update email tidak ditemukan.']);
        }

        $expiresAt = $request->session()->get('email_update_expires_at');
        if (now()->timestamp > $expiresAt) {
            $request->session()->forget(['email_update_pending', 'email_update_new_email', 'email_update_otp', 'email_update_expires_at', 'email_update_last_sent']);
            return Redirect::route('profile.edit')->withErrors(['otp' => 'Kode OTP sudah kedaluwarsa. Silakan ajukan ulang perubahan email.']);
        }

        if ($request->session()->get('email_update_otp') !== $request->otp) {
            return Redirect::route('profile.edit')->withErrors(['otp' => 'Kode OTP tidak valid.']);
        }

        // Success! Update the email
        $user = $request->user();
        $oldValues = [
            'name' => $user->name,
            'email' => $user->email,
        ];

        $newEmail = $request->session()->get('email_update_new_email');
        
        $user->email = $newEmail;
        $user->email_verified_at = null; // optionally mark as unverified again if you use mustVerifyEmail
        $user->save();

        \App\Models\ActivityLog::create([
            'user_id' => $user->id,
            'action' => 'profile_email_updated',
            'old_value' => json_encode($oldValues),
            'new_value' => json_encode([
                'name' => $user->name,
                'email' => $user->email,
            ]),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        // Clean up session
        $request->session()->forget(['email_update_pending', 'email_update_new_email', 'email_update_otp', 'email_update_expires_at', 'email_update_last_sent']);

        return Redirect::route('profile.edit')->with('status', 'email-updated');
    }

    /**
     * Resend OTP for email update
     */
    public function resendEmailOtp(Request $request): RedirectResponse
    {
        if (!$request->session()->has('email_update_pending')) {
            return Redirect::route('profile.edit')->withErrors(['otp' => 'Sesi update email tidak ditemukan.']);
        }

        $lastSent = $request->session()->get('email_update_last_sent');
        if (now()->timestamp - $lastSent < 30) {
            $seconds = 30 - (now()->timestamp - $lastSent);
            return Redirect::route('profile.edit')->withErrors(['otp' => "Tunggu {$seconds} detik sebelum kirim ulang."]);
        }

        $newEmail = $request->session()->get('email_update_new_email');
        $otp = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);

        $request->session()->put('email_update_otp', $otp);
        $request->session()->put('email_update_expires_at', now()->addMinutes(2)->timestamp);
        $request->session()->put('email_update_last_sent', now()->timestamp);

        \Illuminate\Support\Facades\Mail::to($newEmail)->send(new \App\Mail\EmailUpdateOtpMail($otp, $request->user()->name));

        return Redirect::route('profile.edit')->with('status', 'otp-resent');
    }

    /**
     * Cancel email update and clear OTP session
     */
    public function cancelEmailUpdate(Request $request): RedirectResponse
    {
        $request->session()->forget([
            'email_update_pending', 
            'email_update_new_email', 
            'email_update_otp', 
            'email_update_expires_at', 
            'email_update_last_sent'
        ]);

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Update the user's profile photo.
     */
    public function updatePhoto(Request $request): RedirectResponse
    {
        $request->validate([
            'photo' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
        ]);

        $user = $request->user();

        // Capture old photo path for audit log
        $oldPhoto = $user->profile_photo;

        // Delete old photo if exists
        if ($user->profile_photo && file_exists(public_path('storage/' . $user->profile_photo))) {
            unlink(public_path('storage/' . $user->profile_photo));
        }

        // Store new photo
        $path = $request->file('photo')->store('profile-photos', 'public');
        
        $user->update([
            'profile_photo' => $path,
        ]);

        // Audit log: profile_photo_updated
        \App\Models\ActivityLog::create([
            'user_id' => $user->id,
            'action' => 'profile_photo_updated',
            'old_value' => $oldPhoto ? $oldPhoto : null,
            'new_value' => $path,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return Redirect::route('profile.edit')->with('status', 'photo-updated');
    }

    /**
     * Remove the user's profile photo.
     */
    public function removePhoto(Request $request): RedirectResponse
    {
        $user = $request->user();

        if ($user->profile_photo && file_exists(public_path('storage/' . $user->profile_photo))) {
            unlink(public_path('storage/' . $user->profile_photo));
        }

        $user->update([
            'profile_photo' => null,
        ]);

        return Redirect::route('profile.edit')->with('status', 'photo-removed');
    }
}
