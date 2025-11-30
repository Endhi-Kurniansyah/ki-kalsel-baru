<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // <-- PENTING: Jangan lupa import Storage

class AgendaController extends Controller
{
    /**
     * Menampilkan daftar semua agenda.
     */
    public function index()
    {
        $agendas = Agenda::orderBy('start_time', 'desc')->get();
        return view('admin.agendas.index', compact('agendas'));
    }

    /**
     * Menampilkan form untuk membuat agenda baru.
     */
    public function create()
    {
        return view('admin.agendas.create');
    }

    /**
     * Menyimpan agenda baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'location' => 'required|string|max:255',
            'start_time' => 'required|date',
            'end_time' => 'nullable|date|after_or_equal:start_time',
            'description' => 'nullable|string',
            // Validasi File: Boleh kosong, harus PDF/Gambar, Max 5MB
            'file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        // Siapkan data untuk disimpan
        $data = [
            'title' => $request->input('title'),
            'category' => $request->input('category'),
            'location' => $request->input('location'),
            'start_time' => $request->input('start_time'),
            'end_time' => $request->input('end_time'),
            'description' => $request->input('description'),
        ];

        // 2. Cek apakah ada file di-upload
        if ($request->hasFile('file')) {
            // Simpan file ke storage/app/public/agendas
            $filePath = $request->file('file')->store('agendas', 'public');
            // Masukkan path file ke array data
            $data['file_path'] = $filePath;
        }

        // 3. Simpan ke database
        Agenda::create($data);

        return redirect()->route('admin.agendas.index')->with('success', 'Agenda berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit.
     */
    public function edit(Agenda $agenda)
    {
        return view('admin.agendas.edit', compact('agenda'));
    }

    /**
     * Menyimpan perubahan dari form edit.
     */
    public function update(Request $request, Agenda $agenda)
    {
        // 1. Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'location' => 'required|string|max:255',
            'start_time' => 'required|date',
            'end_time' => 'nullable|date|after_or_equal:start_time',
            'description' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        // Siapkan data dasar
        $data = [
            'title' => $request->input('title'),
            'category' => $request->input('category'),
            'location' => $request->input('location'),
            'start_time' => $request->input('start_time'),
            'end_time' => $request->input('end_time'),
            'description' => $request->input('description'),
        ];

        // 2. Cek apakah ada file BARU di-upload
        if ($request->hasFile('file')) {
            // Hapus file LAMA jika ada
            if ($agenda->file_path) {
                Storage::disk('public')->delete($agenda->file_path);
            }

            // Upload file BARU
            $filePath = $request->file('file')->store('agendas', 'public');
            $data['file_path'] = $filePath;
        }

        // 3. Update database
        $agenda->update($data);

        return redirect()->route('admin.agendas.index')->with('success', 'Agenda berhasil diperbarui.');
    }

    /**
     * Menghapus agenda dari database.
     */
    public function destroy(Agenda $agenda)
    {
        // 1. Hapus file fisik dari storage jika ada
        if ($agenda->file_path) {
            Storage::disk('public')->delete($agenda->file_path);
        }

        // 2. Hapus data record dari database
        $agenda->delete();

        return redirect()->route('admin.agendas.index')->with('success', 'Agenda berhasil dihapus.');
    }
}
