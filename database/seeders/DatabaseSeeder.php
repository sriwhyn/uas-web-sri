<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat satu user admin
        User::factory()->create([
            'name' => 'Admin Sistem',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => bcrypt('password') // default password
        ]);

        // Buat 10 user mahasiswa
        User::factory()->count(10)->create([
            'role' => 'mahasiswa',
        ]);
    }
}
