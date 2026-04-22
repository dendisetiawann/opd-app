<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/[A-Z]/',      // minimal 1 huruf besar
                'regex:/[@$!%*?&#]/', // minimal 1 karakter spesial
            ],
        ], [
            'password.min' => 'Password minimal 8 karakter.',
            'password.regex' => 'Password harus mengandung minimal 1 huruf besar dan 1 karakter spesial (@$!%*?&#).',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }
}
