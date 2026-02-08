<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,     // 2 Roles (admin, user)
            OpdSeeder::class,      // 45 OPD Kota Pekanbaru
            AdminSeeder::class,    // 1 Admin (diskominfopku@gmail.com)
            UserSeeder::class,     // 90 Users (2 per OPD)
            WebAppSeeder::class,   // 225 Web/Apps (5 per OPD)
        ]);
    }
}
