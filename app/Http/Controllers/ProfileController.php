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

        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Only log if something actually changed
        if ($user->isDirty()) {
            $user->save();

            \App\Models\ActivityLog::create([
                'user_id' => $user->id,
                'action' => 'profile_updated',
                'old_value' => json_encode($oldValues),
                'new_value' => json_encode([
                    'name' => $user->name,
                    'email' => $user->email,
                ]),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);
        } else {
            $user->save();
        }

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
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
