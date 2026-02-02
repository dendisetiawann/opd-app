<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Opd;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $opds = Opd::orderBy('nama_opd')->get();
        return view('auth.register', compact('opds'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'opd_id' => ['required_without:new_opd'],
            'new_opd' => ['required_without:opd_id', 'nullable', 'string', 'max:255'],
        ], [
            'opd_id.required_without' => 'Pilih OPD atau tambahkan OPD baru.',
            'new_opd.required_without' => 'Pilih OPD atau tambahkan OPD baru.',
        ]);

        // Handle OPD: create new or use existing
        $opdId = $request->opd_id;
        
        if ($request->filled('new_opd')) {
            // Check if OPD already exists
            $existingOpd = Opd::where('nama_opd', $request->new_opd)->first();
            
            if ($existingOpd) {
                $opdId = $existingOpd->id;
            } else {
                $newOpd = Opd::create(['nama_opd' => $request->new_opd]);
                $opdId = $newOpd->id;
            }
        }

        // Get 'user' role
        $userRole = Role::where('name', 'user')->first();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $userRole->id,
            'opd_id' => $opdId,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
