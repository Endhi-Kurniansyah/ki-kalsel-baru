<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Untuk membuat slug
use Illuminate\Support\Facades\Storage; // Untuk hapus foto

class NewsController extends Controller
{
    /**
     * Menampilkan daftar berita.
     */
    public function index(Request $request) // <-- Tambahkan Request $request
    {
        $query = News::orderBy('created_at', 'desc');

        // Logika Pencarian
        if ($request->has('search') && $request->search != null) {
            $keyword = $request->search;
            $query->where(function($q) use ($keyword) {
                $q->where('title', 'LIKE', "%$keyword%")
                  ->orWhere('category', 'LIKE', "%$keyword%");
            });
        }

        $news = $query->get();

        return view('admin.news.index', compact('news'));
    }

    /**
     * Menampilkan form tambah berita.
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Menyimpan berita baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // 2. Upload Gambar
        $imagePath = $request->file('image')->store('news_images', 'public');

        // 3. Buat Slug
        $slug = Str::slug($request->input('title'));

        // 4. Simpan ke Database
        // PERBAIKAN: Menggunakan input('content') agar tidak error protected property
        News::create([
            'title' => $request->input('title'),
            'slug' => $slug,
            'content' => $request->input('content'), // <--- INI PERBAIKANNYA
            'category' => $request->input('category'),
            'image_path' => $imagePath,
        ]);

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil diterbitkan!');
    }

    /**
     * Menampilkan form edit berita.
     */
    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    /**
     * Update berita.
     */
    public function update(Request $request, News $news)
    {
        // 1. Validasi
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // 2. Siapkan data update
        // PERBAIKAN: Menggunakan input('content') di sini juga
        $dataToUpdate = [
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title')),
            'content' => $request->input('content'), // <--- INI PERBAIKANNYA
            'category' => $request->input('category'),
        ];

        // 3. Cek ganti gambar
        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if ($news->image_path) {
                Storage::disk('public')->delete($news->image_path);
            }
            // Upload baru
            $dataToUpdate['image_path'] = $request->file('image')->store('news_images', 'public');
        }

        // 4. Update Database
        $news->update($dataToUpdate);

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil diperbarui!');
    }

    /**
     * Hapus berita.
     */
    public function destroy(News $news)
    {
        // Hapus gambar fisik
        if ($news->image_path) {
            Storage::disk('public')->delete($news->image_path);
        }

        // Hapus data
        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil dihapus.');
    }
}
