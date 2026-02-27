<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminUserController extends Controller
{
    /**
     * Search OPD for autocomplete (AJAX) - Optimized.
     */
    public function searchOpd(Request $request)
    {
        $query = $request->get('q', '');
        
        $cacheKey = 'admin_opd_search_' . md5($query);
        
        $opds = cache()->remember($cacheKey, 60, function () use ($query) {
            $q = \App\Models\Opd::select(['id', 'nama_opd']);
            
            if (!empty($query)) {
                $q->where('nama_opd', 'like', "%{$query}%");
            }
            
            return $q->orderBy('nama_opd')
                ->limit(50)
                ->get();
        });
        
        return response()->json($opds);
    }

    /**
     * Display a listing of users.
     */
    public function index(Request $request)
    {
        $query = User::with(['opd'])->where('role', 'user');

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
            'email' => 'required|email|unique:pengguna,email',
            'opd' => 'required|string|max:255',
            'password_type' => 'required|in:random,custom',
            'custom_password' => 'required_if:password_type,custom|nullable|min:8',
        ], [
            'email.unique' => 'Email sudah terdaftar di sistem.',
            'opd.required' => 'Pilih atau tambahkan OPD.',
        ]);

        // Handle OPD: normalize and check for duplicates
        $opdId = $this->getOrCreateOpd($request->opd);

        // Generate password
        if ($request->password_type === 'custom') {
            $password = $request->custom_password;
        } else {
            $password = Str::random(8);
        }

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'opd_id' => $opdId,
            'role' => 'user',
            'password' => Hash::make($password),
            'email_verified_at' => now(),
        ]);

        // Store password in session for PDF export
        session(['user_password_' . $user->id => $password]);

        // Audit log: user_created
        \App\Models\ActivityLog::create([
            'user_id' => $user->id,
            'admin_id' => auth()->id(),
            'action' => 'user_created',
            'new_value' => json_encode([
                'name' => $user->name,
                'email' => $user->email,
                'opd' => $user->opd->nama_opd ?? 'N/A',
            ]),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

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
        $user->load(['opd']);
        return view('admin.users.created', compact('user'));
    }

    /**
     * Export user credentials to PDF.
     */
    public function exportPdf(User $user)
    {
        $user->load(['opd']);
        
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
        $user->load(['opd']);
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

        // Audit log: password_reset
        \App\Models\ActivityLog::create([
            'user_id' => $user->id,
            'admin_id' => auth()->id(),
            'action' => 'password_reset',
            'new_value' => json_encode([
                'type' => $request->password_type,
            ]),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
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
            'new_email' => 'required|email|unique:pengguna,email,' . $user->id,
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

    /**
     * Soft delete user with audit trail.
     */
    public function destroy(Request $request, User $user)
    {
        // Prevent deleting admin users
        if ($user->isAdmin()) {
            return back()->with('error', 'Tidak dapat menghapus akun admin.');
        }

        // Prevent self-deletion
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Tidak dapat menghapus akun sendiri.');
        }

        $request->validate([
            'deleted_reason' => 'required|string|max:500',
        ], [
            'deleted_reason.required' => 'Alasan penghapusan wajib diisi.',
        ]);

        $deletedBy = auth()->id();
        $reason = $request->deleted_reason;

        // Create audit log before soft delete
        \App\Models\ActivityLog::create([
            'user_id' => $user->id,
            'admin_id' => $deletedBy,
            'action' => 'user_deleted',
            'old_value' => json_encode([
                'name' => $user->name,
                'email' => $user->email,
                'opd' => $user->opd?->nama_opd,
                'status' => 'active',
            ]),
            'new_value' => json_encode([
                'status' => 'deleted',
                'reason' => $reason,
                'deleted_at' => now()->toDateTimeString(),
            ]),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        // Perform soft delete with metadata
        $user->deleted_by = $deletedBy;
        $user->deleted_reason = $reason;
        $user->save();
        $user->delete(); // This sets deleted_at

        return back()->with('success', "User {$user->name} berhasil dihapus.");
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
            $existingOpd = \App\Models\Opd::find($opdInput);
            if ($existingOpd) {
                return $existingOpd->id;
            }
        }
        
        // Check for duplicate with case-insensitive comparison
        $existingOpd = \App\Models\Opd::whereRaw('LOWER(TRIM(nama_opd)) = ?', [strtolower(trim($opdInput))])->first();
        
        if ($existingOpd) {
            return $existingOpd->id;
        }
        
        // Create new OPD with normalized name
        $newOpd = \App\Models\Opd::create(['nama_opd' => $normalizedName]);
        
        // Clear OPD search cache
        cache()->forget('admin_opd_search_' . md5(''));
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
}
