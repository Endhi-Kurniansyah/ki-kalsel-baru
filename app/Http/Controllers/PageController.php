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
        // 1. Validasi data
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // 2. Update data di database
        //    GANTI $request->title MENJADI $request->input('title')
        $page->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        // 3. Redirect kembali ke halaman index dengan pesan sukses
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
