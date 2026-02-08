<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Opd;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();
        $diskominfo = Opd::where('nama_opd', 'like', '%Komunikasi dan Informatika%')->first();

        User::create([
            'name' => 'Admin Diskominfo',
            'email' => 'diskominfopku@gmail.com',
            'password' => Hash::make('kominfo'),
            'role_id' => $adminRole->id,
            'opd_id' => $diskominfo->id,
            'email_verified_at' => now(),
        ]);
    }
}
