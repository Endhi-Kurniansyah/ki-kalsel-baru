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
    public function index(Request $request)
    {
        $query = Document::orderBy('created_at', 'desc');

        // Filter Pencarian Global
        if ($request->has('search') && $request->search != null) {
            $keyword = $request->search;
            $query->where(function($q) use ($keyword) {
                $q->where('title', 'LIKE', "%$keyword%")
                  ->orWhere('category', 'LIKE', "%$keyword%");
            });
        }

        // FILTER DARI SIDEBAR (Type)
        if ($request->has('type') && $request->type != null) {
            $type = $request->type;

            if ($type == 'laporan') {
                $query->where('category', 'LIKE', '%laporan%');
            } elseif ($type == 'regulasi') {
                // Semua kategori yang masuk regulasi
                $query->whereIn('category', [
                    'undang-undang', 'peraturan-pemerintah', 'peraturan-daerah',
                    'peraturan-presiden', 'peraturan-mahkamah-agung', 'peraturan-menteri',
                    'pengaturan-komisi-informasi', 'surat-keputusan', 'surat-edaran', 'mou'
                ]);
            } elseif ($type == 'informasi-publik') {
                $query->whereIn('category', [
                    'putusan', 'informasi-berkala', 'informasi-setiap-saat',
                    'informasi-serta-merta', 'dipa', 'form-permohonan-psi'
                ]);
            }
        }

        $documents = $query->get();

        return view('admin.documents.index', compact('documents'));
    }

    public function create(Request $request)
    {
        // Kirim parameter 'type' ke view create agar dropdown kategori bisa difilter otomatis
        return view('admin.documents.create', ['type' => $request->type]);
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
