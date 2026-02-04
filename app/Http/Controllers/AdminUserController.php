<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminUserController extends Controller
{
    /**
     * Display a listing of users.
     */
    public function index(Request $request)
    {
        $query = User::with(['role', 'opd'])->whereHas('role', function($q) {
            $q->where('name', 'user');
        });

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // OPD filter
        if ($request->filled('opd_id')) {
            $query->where('opd_id', $request->opd_id);
        }

        $users = $query->latest()->paginate(15);
        $opds = \App\Models\Opd::orderBy('nama_opd')->get();

        return view('admin.users.index', compact('users', 'opds'));
    }

    /**
     * Display user details.
     */
    public function show(User $user)
    {
        $user->load(['role', 'opd', 'webApps']);
        $totalApps = $user->webApps()->count();
        
        return view('admin.users.show', compact('user', 'totalApps'));
    }

    /**
     * Reset user password (custom or random).
     */
    public function resetPassword(Request $request, User $user)
    {
        $request->validate([
            'password_type' => 'required|in:random,custom',
            'custom_password' => 'required_if:password_type,custom|nullable|min:8',
        ]);

        if ($request->password_type === 'custom') {
            $newPassword = $request->custom_password;
        } else {
            $newPassword = Str::random(8);
        }
        
        $user->update([
            'password' => Hash::make($newPassword),
        ]);

        $message = $request->password_type === 'custom' 
            ? "Password untuk {$user->name} berhasil diubah."
            : "Password untuk {$user->name} berhasil direset menjadi: {$newPassword}";

        return back()->with('success', $message);
    }
}
