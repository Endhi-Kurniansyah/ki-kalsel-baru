<?php

namespace App\Http\Controllers;

use App\Models\Commissioner; // <-- IMPORT MODEL
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // <-- IMPORT Storage

class CommissionerController extends Controller
{
    /**
     * Menampilkan daftar semua komisioner.
     */
    public function index()
    {
        // Ambil semua komisioner, diurutkan berdasarkan 'order'
        $commissioners = Commissioner::orderBy('order', 'asc')->get();

        // Tampilkan view 'admin.commissioners.index'
        return view('admin.commissioners.index', compact('commissioners'));
    }

    /**
     * Menampilkan form untuk membuat komisioner baru.
     */
    public function create()
    {
        // TODO: Kita akan buat ini di langkah berikutnya
        return view('admin.commissioners.create');
    }

    /**
     * Menyimpan komisioner baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'order' => 'required|integer|min:0',
            'bio' => 'nullable|string',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Max 2MB, file gambar
        ]);

        // 2. Simpan file foto yang di-upload
        // File akan disimpan di 'storage/app/public/commissioners'
        $photoPath = $request->file('photo')->store('commissioners', 'public');

        // 3. Simpan data ke database
        Commissioner::create([
            'name' => $request->input('name'),
            'position' => $request->input('position'),
            'order' => $request->input('order'),
            'bio' => $request->input('bio'),
            'photo_path' => $photoPath, // Simpan path fotonya
        ]);

        // 4. Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('admin.commissioners.index')->with('success', 'Data Komisioner berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Commissioner $commissioner)
    {
        //
    }

    /**
     * Menampilkan form untuk mengedit komisioner.
     */
    public function edit(Commissioner $commissioner)
    {
        // $commissioner otomatis diambil Laravel berdasarkan ID di URL
        return view('admin.commissioners.edit', compact('commissioner'));
    }

    /**
     * Menyimpan perubahan dari form edit.
     */
    public function update(Request $request, Commissioner $commissioner)
    {
        // 1. Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'order' => 'required|integer|min:0',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Foto sekarang 'nullable'
        ]);

        // 2. Siapkan data untuk di-update
        $dataToUpdate = [
            'name' => $request->input('name'),
            'position' => $request->input('position'),
            'order' => $request->input('order'),
            'bio' => $request->input('bio'),
        ];

        // 3. Cek apakah admin meng-upload foto baru
        if ($request->hasFile('photo')) {
            // 3a. Hapus foto lama
            Storage::disk('public')->delete($commissioner->photo_path);

            // 3b. Simpan foto baru
            $photoPath = $request->file('photo')->store('commissioners', 'public');

            // 3c. Tambahkan path foto baru ke data
            $dataToUpdate['photo_path'] = $photoPath;
        }

        // 4. Update data di database
        $commissioner->update($dataToUpdate);

        // 5. Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('admin.commissioners.index')->with('success', 'Data Komisioner berhasil diperbarui.');
    }

    /**
     * Menghapus komisioner dari database dan storage.
     */
    public function destroy(Commissioner $commissioner)
    {
        // 1. Hapus file foto fisik dari storage
        Storage::disk('public')->delete($commissioner->photo_path);

        // 2. Hapus data record dari database
        $commissioner->delete();

        // 3. Redirect kembali dengan pesan sukses
        return redirect()->route('admin.commissioners.index')->with('success', 'Data Komisioner berhasil dihapus.');
    }
}
