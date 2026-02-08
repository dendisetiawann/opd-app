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

        // Search filter (name, email, or OPD name)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhereHas('opd', function($opdQuery) use ($search) {
                      $opdQuery->where('nama_opd', 'like', "%{$search}%");
                  });
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
     * Store a newly created user.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'opd_id' => 'required_without:new_opd|nullable|exists:opds,id',
            'new_opd' => 'required_without:opd_id|nullable|string|max:255',
            'password_type' => 'required|in:random,custom',
            'custom_password' => 'required_if:password_type,custom|nullable|min:8',
        ], [
            'email.unique' => 'Email sudah terdaftar di sistem.',
        ]);

        // Handle OPD: create new or use existing
        if ($request->filled('new_opd')) {
            $opd = \App\Models\Opd::create([
                'nama_opd' => $request->new_opd,
            ]);
            $opdId = $opd->id;
        } else {
            $opdId = $request->opd_id;
        }

        // Generate password
        if ($request->password_type === 'custom') {
            $password = $request->custom_password;
        } else {
            $password = Str::random(8);
        }

        // Get user role
        $userRole = Role::where('name', 'user')->first();

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'opd_id' => $opdId,
            'role_id' => $userRole->id,
            'password' => Hash::make($password),
            'email_verified_at' => now(),
        ]);

        // Store password in session for PDF export
        session(['user_password_' . $user->id => $password]);

        // Return to same page with success modal data
        return back()->with([
            'user_created' => true,
            'created_user_id' => $user->id,
            'created_user_name' => $user->name,
            'created_user_email' => $user->email,
            'created_user_opd' => $user->opd->nama_opd ?? 'N/A',
            'generated_password' => $password,
        ]);
    }

    /**
     * Show user creation success page.
     */
    public function created(User $user)
    {
        $user->load(['role', 'opd']);
        return view('admin.users.created', compact('user'));
    }

    /**
     * Export user credentials to PDF.
     */
    public function exportPdf(User $user)
    {
        $user->load(['role', 'opd']);
        
        // Get password from session if available
        $password = session('user_password_' . $user->id);
        
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.users.pdf', [
            'user' => $user,
            'password' => $password,
        ]);
        
        return $pdf->download('kredensial-' . Str::slug($user->name) . '.pdf');
    }

    /**
     * Display user details.
     */
    public function show(User $user)
    {
        $user->load(['role', 'opd']);
        // Hitung total aplikasi berdasarkan OPD user (jika user punya OPD)
        $totalApps = $user->opd ? $user->opd->webApps()->count() : 0;
        
        // Get the latest web app created by this user's OPD
        $lastAppInput = $user->opd ? $user->opd->webApps()->latest()->first() : null;
        
        return view('admin.users.show', compact('user', 'totalApps', 'lastAppInput'));
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

    /**
     * Update user email with audit trail logging.
     */
    public function updateEmail(Request $request, User $user)
    {
        $request->validate([
            'new_email' => 'required|email|unique:users,email,' . $user->id,
        ], [
            'new_email.required' => 'Email baru wajib diisi.',
            'new_email.email' => 'Format email tidak valid.',
            'new_email.unique' => 'Email sudah terdaftar di sistem.',
        ]);

        $oldEmail = $user->email;
        $newEmail = $request->new_email;

        // Update email
        $user->update([
            'email' => $newEmail,
        ]);

        // Create audit log
        \App\Models\ActivityLog::create([
            'user_id' => $user->id,
            'admin_id' => auth()->id(),
            'action' => 'email_updated',
            'old_value' => $oldEmail,
            'new_value' => $newEmail,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return back()->with('success', "Email untuk {$user->name} berhasil diubah dari {$oldEmail} menjadi {$newEmail}.");
    }
}
