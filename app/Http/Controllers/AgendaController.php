<?php

namespace App\Http\Controllers;

use App\Models\Agenda; // <-- IMPORT MODEL
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    /**
     * Menampilkan daftar semua agenda.
     */
    public function index()
    {
        // Ambil semua agenda, diurutkan dari yang terbaru
        $agendas = Agenda::orderBy('start_time', 'desc')->get();

        // Tampilkan view 'admin.agendas.index'
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
        ]);

        // 2. Simpan data ke database
        Agenda::create([
            'title' => $request->input('title'),
            'category' => $request->input('category'),
            'location' => $request->input('location'),
            'start_time' => $request->input('start_time'),
            'end_time' => $request->input('end_time'),
            'description' => $request->input('description'),
        ]);

        // 3. Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('admin.agendas.index')->with('success', 'Agenda berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Agenda $agenda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agenda $agenda)
    {
        // $agenda otomatis diambil Laravel berdasarkan ID di URL
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
        ]);

        // 2. Update data di database
        $agenda->update([
            'title' => $request->input('title'),
            'category' => $request->input('category'),
            'location' => $request->input('location'),
            'start_time' => $request->input('start_time'),
            'end_time' => $request->input('end_time'),
            'description' => $request->input('description'),
        ]);

        // 3. Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('admin.agendas.index')->with('success', 'Agenda berhasil diperbarui.');
    }

    /**
     * Menghapus agenda dari database.
     */
    public function destroy(Agenda $agenda){
        // 1. Hapus data record dari database
        $agenda->delete();

        // 2. Redirect kembali dengan pesan sukses
        return redirect()->route('admin.agendas.index')->with('success', 'Agenda berhasil dihapus.');
    }
}
