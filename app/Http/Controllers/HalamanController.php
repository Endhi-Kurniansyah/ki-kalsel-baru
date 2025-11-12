<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;         // Untuk halaman statis (Visi Misi, Tentang)
use App\Models\Document;     // Untuk semua file (Laporan, Regulasi, Putusan)
use App\Models\Agenda;       // Untuk Agenda & Jadwal Sidang
use App\Models\Commissioner; // Untuk Profil Komisioner

class HalamanController extends Controller
{
    // =================================================================
    // === METHOD "PINTAR" (PRIVATE) ===
    // =================================================================

    /**
     * Method untuk menampilkan halaman statis (dari tabel 'pages')
     */
    private function showPage(string $slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();
        return view('frontend.page', compact('page'));
    }

    /**
     * Method untuk menampilkan daftar dokumen (dari tabel 'documents')
     */
    private function showDocumentList(string $category, string $title)
    {
        $documents = Document::where('category', $category)
                             ->orderBy('created_at', 'desc')
                             ->get();

        return view('frontend.document_list', [
            'documents' => $documents,
            'page_title' => $title,
        ]);
    }

    // =================================================================
    // === METHOD PUBLIK (UNTUK RUTE) ===
    // =================================================================

    /**
     * Menampilkan Halaman Beranda
     */
    public function beranda()
    {
        // 1. Ambil 3 agenda terbaru (berdasarkan waktu mulai)
        $latestAgendas = Agenda::orderBy('start_time', 'desc')->take(3)->get();

        // 2. Ambil 3 dokumen terbaru (berdasarkan waktu upload)
        $latestDocuments = Document::orderBy('created_at', 'desc')->take(3)->get();

        // 3. Tampilkan view 'frontend.beranda' dan kirimkan datanya
        return view('frontend.beranda', [
            'latestAgendas' => $latestAgendas,
            'latestDocuments' => $latestDocuments,
            'page_title' => 'Beranda' // (Opsional) Untuk judul tab browser
        ]);
    }

    // ===================================
    // === GRUP RUTE PROFIL ===
    // ===================================

    public function tentang()
    {
        return $this->showPage('tentang');
    }

    public function visiMisi()
    {
        return $this->showPage('visi-misi');
    }

    public function strukturSekretariat()
    {
        return $this->showPage('struktur-sekretariat');
    }

    public function tugasFungsi()
    {
        return $this->showPage('tugas-fungsi');
    }

    public function daftarPejabat()
    {
        return $this->showPage('daftar-pejabat');
    }

    // ===================================
    // === GRUP RUTE PROFIL (Komisioner) ===
    // ===================================

    public function profilKomisioner()
    {
        // 1. Ambil data dari tabel 'commissioners'
        $commissioners = Commissioner::orderBy('order', 'asc')->get();

        // 2. Tampilkan view 'frontend.commissioner_list'
        return view('frontend.commissioner_list', [
            'commissioners' => $commissioners,
            'page_title' => 'Profil Komisioner',
        ]);
    }

    public function strukturKomisioner()
    {
        // 1. Ambil data dari tabel 'commissioners'
        $commissioners = Commissioner::orderBy('order', 'asc')->get();

        // 2. Tampilkan view 'frontend.commissioner_list'
        //    (Kita bisa pakai view yang sama, hanya beda judul)
        return view('frontend.commissioner_list', [
            'commissioners' => $commissioners,
            'page_title' => 'Struktur Komisioner',
        ]);
    }

    // ===================================
    // === GRUP RUTE AGENDA ===
    // ===================================

    public function agendaKomisioner()
    {
        // 1. Ambil data dari tabel 'agendas'
        $agendas = Agenda::where('category', 'Agenda Komisioner')
                         ->orderBy('start_time', 'desc')
                         ->get();

        // 2. Tampilkan view 'frontend.agenda_list'
        return view('frontend.agenda_list', [
            'agendas' => $agendas,
            'page_title' => 'Agenda Komisioner',
        ]);
    }

    public function jadwalSidang()
    {
        // 1. Ambil data dari tabel 'agendas'
        $agendas = Agenda::where('category', 'Jadwal Sidang')
                         ->orderBy('start_time', 'desc')
                         ->get();

        // 2. Tampilkan view 'frontend.agenda_list'
        return view('frontend.agenda_list', [
            'agendas' => $agendas,
            'page_title' => 'Jadwal Sidang',
        ]);
    }

    // ===================================
    // === GRUP RUTE LAPORAN ===
    // ===================================

    public function laporanKinerja()
    {
        return $this->showDocumentList('laporan-kinerja', 'Laporan Perkembangan Kinerja');
    }

    public function laporanEvaluasiKIP()
    {
        return $this->showDocumentList('laporan-evaluasi-kip', 'Laporan Hasil Evaluasi KIP');
    }

    public function laporanKIP()
    {
        return $this->showDocumentList('laporan-kip', 'Laporan KIP');
    }

    // ===================================
    // === GRUP RUTE REGULASI ===
    // ===================================

    public function undangUndang()
    {
        return $this->showDocumentList('undang-undang', 'Undang-Undang');
    }

    public function peraturanPemerintahan()
    {
        return $this->showDocumentList('peraturan-pemerintah', 'Peraturan Pemerintah');
    }

    public function peraturanDaerah()
    {
        return $this->showDocumentList('peraturan-daerah', 'Peraturan Daerah');
    }

    public function peraturanPresiden()
    {
        return $this->showDocumentList('peraturan-presiden', 'Peraturan Presiden');
    }

    public function peraturanMA()
    {
        return $this->showDocumentList('peraturan-mahkamah-agung', 'Peraturan Mahkamah Agung');
    }

    public function peraturanMenteri()
    {
        return $this->showDocumentList('peraturan-menteri', 'Peraturan Menteri');
    }

    public function pengaturanKI()
    {
        return $this->showDocumentList('pengaturan-komisi-informasi', 'Pengaturan Komisi Informasi');
    }

    public function suratKeputusan()
    {
        return $this->showDocumentList('surat-keputusan', 'Surat Keputusan');
    }

    public function suratEdaran()
    {
        return $this->showDocumentList('surat-edaran', 'Surat Edaran');
    }

    public function mou()
    {
        return $this->showDocumentList('mou', 'MOU');
    }

    // ===================================
    // === GRUP RUTE INFORMASI PUBLIK ===
    // ===================================

    public function putusan()
    {
        return $this->showDocumentList('putusan', 'Putusan');
    }

    public function informasiBerkala()
    {
        return $this->showDocumentList('informasi-berkala', 'Informasi Berkala');
    }

    public function informasiSetiapSaat()
    {
        return $this->showDocumentList('informasi-setiap-saat', 'Informasi Setiap Saat');
    }

    public function informasiSertaMerta()
    {
        return $this->showDocumentList('informasi-serta-merta', 'Informasi Serta Merta');
    }

    public function dipa()
    {
        return $this->showDocumentList('dipa', 'DIPA');
    }

    public function formPermohonanPsi()
    {
        return $this->showDocumentList('form-permohonan-psi', 'Form Permohonan PSI');
    }
}
