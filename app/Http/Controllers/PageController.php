<?php

namespace App\Http\Controllers;

use App\Models\Page; // <-- PENTING: Impor model Page
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Menampilkan daftar semua halaman. (Read)
     */
    /**
 * Menampilkan daftar semua halaman. (Read)
 */
    public function index()
    {
        // 1. Ambil semua data 'Page' dari database
        $pages = Page::all();

        // 2. Kirim data ke view 'admin.pages.index'
        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Menampilkan form untuk membuat halaman baru. (Create)
     * KITA TIDAK PAKAI INI. Halaman sudah 'ditanam' via Seeder.
     */
    public function create()
    {
        return redirect()->route('admin.pages.index')->with('error', 'Halaman tidak bisa ditambah, hanya bisa diedit.');
    }

    /**
     * Menyimpan halaman baru. (Create)
     * KITA TIDAK PAKAI INI.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Menampilkan satu halaman (tidak dipakai).
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Menampilkan form untuk mengedit halaman. (Update)
     */
    /**
 * Menampilkan form untuk mengedit halaman. (Update)
 */
    public function edit(Page $page)
    {
        // $page otomatis diambil Laravel berdasarkan ID di URL
        // Kirim data 'page' ke view 'admin.pages.edit'
        return view('admin.pages.edit', compact('page'));
    }
    /**
     * Menyimpan perubahan dari form edit. (Update)
     */
    /**
 * Menyimpan perubahan dari form edit. (Update)
 */
    /**
     * Menyimpan perubahan dari form edit. (Update)
     */
    public function update(Request $request, Page $page)
    {
        // 1. Validasi
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string', // Content jadi nullable jaga-jaga kalau cuma mau ganti foto
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // Validasi foto
        ]);

        $dataToUpdate = [
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ];

        // 2. Cek apakah ada file hero_image baru di-upload
        if ($request->hasFile('hero_image')) {
            // Hapus file lama jika ada
            if ($page->hero_image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($page->hero_image);
            }
            // Upload file baru ke folder 'hero_images'
            $dataToUpdate['hero_image'] = $request->file('hero_image')->store('hero_images', 'public');
        }

        // 3. Update data
        $page->update($dataToUpdate);

        return redirect()->route('admin.pages.index')->with('success', 'Halaman berhasil diperbarui.');
    }

    /**
     * Menghapus halaman. (Delete)
     * KITA TIDAK PAKAI INI. Halaman statis tidak boleh dihapus.
     */
    public function destroy(Page $page)
    {
        return redirect()->route('admin.pages.index')->with('error', 'Halaman tidak bisa dihapus.');
    }
}
