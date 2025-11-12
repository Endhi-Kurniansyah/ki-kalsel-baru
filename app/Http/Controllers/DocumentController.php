<?php

namespace App\Http\Controllers;

use App\Models\Document; // <-- IMPORT MODEL
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // <-- IMPORT Storage

class DocumentController extends Controller
{
    /**
     * Menampilkan daftar semua dokumen.
     */
    public function index()
    {
        // Ambil semua dokumen, diurutkan dari yang terbaru
        $documents = Document::orderBy('created_at', 'desc')->get();

        // Tampilkan view 'admin.documents.index' dan kirim data '$documents'
        return view('admin.documents.index', compact('documents'));
    }

    /**
     * Menampilkan form untuk membuat dokumen baru.
     */
    public function create()
    {
        // Cukup tampilkan view-nya
        return view('admin.documents.create');
    }

    /**
     * Menyimpan dokumen baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
        'title' => 'required|string|max:255',
        'category' => 'required|string',
        'description' => 'nullable|string',
        'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,jpg,png|max:10240', // Max 10MB
        ]);

        // 2. Simpan file yang di-upload
        // File akan disimpan di 'storage/app/public/documents'
        $filePath = $request->file('file')->store('documents', 'public');

        // 3. Simpan data ke database
        Document::create([
            'title' => $request->input('title'),
            'category' => $request->input('category'),
            'description' => $request->input('description'),
            'file_path' => $filePath, // Simpan path-nya
        ]);

        // 4. Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('admin.documents.index')->with('success', 'Dokumen berhasil di-upload.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Document $document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document $document)
    {
        // $document otomatis diambil Laravel berdasarkan ID di URL
        return view('admin.documents.edit', compact('document'));
    }

        /**
     * Menyimpan perubahan dari form edit.
     */
    public function update(Request $request, Document $document)
    {
        // 1. Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'description' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,png|max:10240', // File sekarang 'nullable' (opsional)
        ]);

        // 2. Siapkan data untuk di-update
        $dataToUpdate = [
            'title' => $request->input('title'),
            'category' => $request->input('category'),
            'description' => $request->input('description'),
        ];

        // 3. Cek apakah admin meng-upload file baru
        if ($request->hasFile('file')) {
            // 3a. Hapus file lama
            Storage::disk('public')->delete($document->file_path);

            // 3b. Simpan file baru
            $filePath = $request->file('file')->store('documents', 'public');

            // 3c. Tambahkan path file baru ke data
            $dataToUpdate['file_path'] = $filePath;
        }

        // 4. Update data di database
        $document->update($dataToUpdate);

        // 5. Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('admin.documents.index')->with('success', 'Dokumen berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document)
    {
        // 1. Hapus file fisik dari storage
        // Kita gunakan Storage::delete() dengan path dari database
        Storage::disk('public')->delete($document->file_path);

        // 2. Hapus data record dari database
        $document->delete();

        // 3. Redirect kembali dengan pesan sukses
        return redirect()->route('admin.documents.index')->with('success', 'Dokumen berhasil dihapus.');
    }
}
