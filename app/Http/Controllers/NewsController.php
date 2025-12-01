<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Gallery; // <-- IMPORT MODEL GALLERY
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::orderBy('created_at', 'desc')->get();
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // 1. Upload Gambar Berita
        $imagePath = $request->file('image')->store('news_images', 'public');

        $slug = Str::slug($request->input('title'));

        // 2. Simpan Berita
        News::create([
            'title' => $request->input('title'),
            'slug' => $slug,
            'content' => $request->input('content'),
            'category' => $request->input('category'),
            'image_path' => $imagePath,
        ]);

        // ========================================================
        // FITUR BARU: OTOMATIS MASUK KE GALERI
        // ========================================================
        // Kita salin file gambar agar jika berita dihapus, galeri tetap aman
        $galleryFilename = 'copy_' . basename($imagePath);
        $galleryPath = 'galleries/' . $galleryFilename;

        // Copy file fisik
        Storage::disk('public')->copy($imagePath, $galleryPath);

        // Buat data di tabel galleries
        Gallery::create([
            'title' => $request->input('title'), // Judul sama dengan berita
            'description' => 'Dokumentasi dari Berita: ' . $request->input('title'),
            'image_path' => $galleryPath,
        ]);
        // ========================================================

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil diterbitkan dan masuk Galeri!');
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $dataToUpdate = [
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title')),
            'content' => $request->input('content'),
            'category' => $request->input('category'),
        ];

        if ($request->hasFile('image')) {
            if ($news->image_path) {
                Storage::disk('public')->delete($news->image_path);
            }
            $dataToUpdate['image_path'] = $request->file('image')->store('news_images', 'public');

            // OPSIONAL: Kalau mau update galeri juga saat edit gambar berita,
            // logikanya bisa ditambahkan di sini, tapi biasanya cukup saat create saja.
        }

        $news->update($dataToUpdate);

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy(News $news)
    {
        if ($news->image_path) {
            Storage::disk('public')->delete($news->image_path);
        }
        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil dihapus.');
    }
}
