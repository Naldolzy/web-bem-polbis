<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Super Admin
        User::updateOrCreate(
            ['email' => 'superadmin@bem-polbis.ac.id'],
            [
                'name'           => 'Super Admin BEM',
                'email'          => 'superadmin@bem-polbis.ac.id',
                'password'       => Hash::make('superadmin2025'),
                'plain_password' => Crypt::encryptString('superadmin2025'),
                'role'           => 'superadmin',
                'email_verified_at' => now(),
            ]
        );

        // 2. Admin Biasa
        User::updateOrCreate(
            ['email' => 'admin@bem-polbis.ac.id'],
            [
                'name'           => 'Admin BEM Polbis',
                'email'          => 'admin@bem-polbis.ac.id',
                'password'       => Hash::make('bempolbis2025'),
                'plain_password' => Crypt::encryptString('bempolbis2025'),
                'role'           => 'admin',
                'email_verified_at' => now(),
            ]
        );
    }
}
