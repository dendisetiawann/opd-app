<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // Store IP address and user agent for security verification
        if ($status == Password::RESET_LINK_SENT) {
            DB::table('password_reset_tokens')
                ->where('email', $request->email)
                ->update([
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                ]);
        }

        // Translate status messages
        $statusMessages = [
            'passwords.sent' => 'Link reset password telah dikirim ke email Anda.',
            'passwords.user' => 'Email tidak ditemukan dalam sistem kami.',
            'passwords.throttled' => 'Harap tunggu sebelum mencoba lagi.',
        ];

        return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', $statusMessages['passwords.sent'])
                    : back()->withInput($request->only('email'))
                        ->withErrors(['email' => $statusMessages[$status] ?? 'Terjadi kesalahan. Silakan coba lagi.']);
    }
}
