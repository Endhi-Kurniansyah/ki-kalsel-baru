<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page; // <-- PENTING: Impor model Page
use Illuminate\Support\Facades\DB; // <-- PENTING: Impor DB

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kita pakai DB::table() agar bisa set timestamp
        DB::table('pages')->insert([
            [
                'title' => 'Tentang',
                'slug' => 'tentang',
                'content' => '<p>Silakan isi konten "Tentang" di sini melalui admin panel.</p>',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Visi & Misi',
                'slug' => 'visi-misi',
                'content' => '<h1>Visi</h1><p>Isi Visi...</p><h1>Misi</h1><p>Isi Misi...</p>',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Struktur Sekretariat KI Kalsel',
                'slug' => 'struktur-sekretariat',
                'content' => '<p>Silakan upload gambar atau embed PDF struktur sekretariat di sini.</p>',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Profil Komisioner KI Kalsel',
                'slug' => 'profil-komisioner',
                'content' => '<p>Konten untuk halaman ini akan diambil dari tabel Commissioners.</p>',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Struktur Komisioner KI Kalsel',
                'slug' => 'struktur-komisioner',
                'content' => '<p>Konten untuk halaman ini akan diambil dari tabel Commissioners.</p>',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Selamat Datang', // Judul Hero
                'slug' => 'beranda',         // SLUG KHUSUS
                'content' => 'Di Komisi Informasi Provinsi Kalimantan Selatan', // Subjudul Hero
                'hero_image' => null, // Nanti diisi admin
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
