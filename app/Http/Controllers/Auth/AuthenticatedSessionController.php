<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(Request $request): View
    {
        // Generate captcha numbers on page load
        $num1 = rand(1, 9);
        $num2 = rand(1, 9);
        session(['captcha_num1' => $num1, 'captcha_num2' => $num2]);
        
        return view('auth.login', compact('num1', 'num2'));
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Validate CAPTCHA first
        $num1 = session('captcha_num1', 0);
        $num2 = session('captcha_num2', 0);
        $captchaAnswer = (int) $request->input('captcha');
        
        if ($captchaAnswer !== ($num1 + $num2)) {
            // Regenerate captcha for next attempt
            session(['captcha_num1' => rand(1, 9), 'captcha_num2' => rand(1, 9)]);
            
            return back()
                ->withInput($request->only('email', 'remember'))
                ->withErrors(['captcha' => 'Jawaban verifikasi keamanan salah. Silakan coba lagi.']);
        }

        $request->authenticate();

        $request->session()->regenerate();

        // Update last login timestamp
        $user = $request->user();
        $user->update(['last_login_at' => now()]);
        
        if ($user->isAdmin()) {
            return redirect()->intended(route('admin.dashboard', absolute: false));
        }

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
