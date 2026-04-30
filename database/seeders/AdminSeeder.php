<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@bem-polbis.ac.id'],
            [
                'name' => 'Admin BEM Polbis',
                'email' => 'admin@bem-polbis.ac.id',
                'password' => Hash::make('bempolbis2025'),
                'role' => 'superadmin',
                'email_verified_at' => now(),
            ]
        );
    }
}
