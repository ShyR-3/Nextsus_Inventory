<?php

namespace Database\Seeders;  // ← WAJIB: namespace ini

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder  // ← WAJIB: nama class harus UserSeeder
{
    public function run(): void
    {
        // Hapus data lama (opsional, untuk development)
        // User::truncate();

        // Admin
        User::create([
            'name' => 'Admin Nexus',
            'email' => 'admin@nexus.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'phone' => '081234567890',
            'address' => 'Koto Tangah, Padang, Sumatera Barat',
            'remember_token' => Str::random(10),
        ]);

        // User Biasa
        User::create([
            'name' => 'John Doe',
            'email' => 'user@nexus.com',
            'email_verified_at' => now(),
            'password' => Hash::make('user123'),
            'role' => 'user',
            'phone' => '081234567891',
            'address' => 'Jl. Contoh No. 123, Padang',
            'remember_token' => Str::random(10),
        ]);

        $this->command->info('✅ Seeders berhasil dijalankan!');
        $this->command->table(['Role', 'Email', 'Password'], [
            ['Admin', 'admin@nexus.com', 'admin123'],
            ['User', 'user@nexus.com', 'user123'],
        ]);
    }
}