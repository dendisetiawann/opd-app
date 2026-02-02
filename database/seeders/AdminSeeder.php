<?php

namespace Database\Seeders;

use App\Models\Opd;
use App\Models\Role;
use App\Models\User;
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
        $opd = Opd::first();

        User::create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'role_id' => $adminRole->id,
            'opd_id' => $opd->id,
        ]);
    }
}
