<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; // <-- IMPORT User
use Illuminate\Support\Facades\Hash; // <-- IMPORT Hash

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat User Admin
        // Kita pakai create() agar lebih aman
        User::create([
            'name' => 'Admin KI Kalsel',
            'email' => 'admin@kalsel.com',
            'password' => Hash::make('password123') // Gunakan Hash::make
        ]);

        // 2. Panggil Seeder Halaman
        $this->call([
            PageSeeder::class,
        ]);
    }
}
