<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database (opsional, Laravel otomatis menebak 'news',
     * tapi kita tulis biar eksplisit).
     */
    protected $table = 'news';

    /**
     * Kolom-kolom yang boleh diisi secara massal (Mass Assignment).
     * INI WAJIB ADA agar form 'Create' dan 'Update' berhasil menyimpan data.
     */
    protected $fillable = [
        'title',        // Judul Berita
        'slug',         // URL cantik (contoh: judul-berita-hari-ini)
        'content',      // Isi berita (dari CKEditor)
        'category',     // Kategori: 'kegiatan', 'sidang', 'terbaru'
        'image_path',   // Path/lokasi file gambar thumbnail
    ];

    /**
     * (Opsional) Agar saat dipanggil di URL, dia pakai 'slug' bukan 'id'.
     * Contoh: /berita/judul-berita-keren (Bukan /berita/1)
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
