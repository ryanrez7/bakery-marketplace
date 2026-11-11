<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $akun = [
            ['name' => 'Admin Bakery', 'email' => 'admin@bakery.test', 'role' => 'admin'],
            ['name' => 'Outlet Demo', 'email' => 'outlet@bakery.test', 'role' => 'outlet'],
        ];

        foreach ($akun as $row) {
            // forceFill: kolom role/status tidak ada di $fillable, jadi diisi paksa
            User::firstOrNew(['email' => $row['email']])
                ->forceFill([
                    'name' => $row['name'],
                    'role' => $row['role'],
                    'status' => 'active',
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                ])
                ->save();
        }
    }
}