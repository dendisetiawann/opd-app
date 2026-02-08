<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request): View
    {
        // Check IP security before showing reset form
        $email = $request->email;
        $token = $request->route('token');
        
        $resetRecord = DB::table('password_reset_tokens')
            ->where('email', $email)
            ->first();
        
        $ipMismatch = false;
        $storedIp = null;
        $currentIp = $request->ip();
        
        if ($resetRecord && $resetRecord->ip_address) {
            $storedIp = $resetRecord->ip_address;
            $ipMismatch = ($storedIp !== $currentIp);
        }
        
        return view('auth.reset-password', [
            'request' => $request,
            'ipMismatch' => $ipMismatch,
            'storedIp' => $storedIp,
            'currentIp' => $currentIp,
        ]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Check IP address security
        $resetRecord = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();
        
        if ($resetRecord && $resetRecord->ip_address) {
            if ($resetRecord->ip_address !== $request->ip()) {
                // IP mismatch - reject the request
                return back()
                    ->withInput($request->only('email'))
                    ->withErrors([
                        'security' => 'Permintaan reset password ditolak karena alamat IP tidak cocok. Demi keamanan, silakan minta link reset password baru dari perangkat ini.',
                    ]);
            }
        }

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $status == Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', 'Password berhasil direset! Silakan login dengan password baru.')
                    : back()->withInput($request->only('email'))
                        ->withErrors(['email' => __($status)]);
    }
}
