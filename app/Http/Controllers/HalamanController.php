<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;         // Untuk halaman statis
use App\Models\Document;     // Untuk dokumen
use App\Models\Agenda;       // Untuk agenda
use App\Models\Commissioner; // Untuk komisioner
use App\Models\News;         // Untuk berita

class HalamanController extends Controller
{
    // =================================================================
    // === METHOD PENDUKUNG (PRIVATE) ===
    // =================================================================

    private function showPage(string $slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();
        return view('frontend.page', compact('page'));
    }

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
    // === METHOD UTAMA ===
    // =================================================================

    public function beranda()
    {
        // 1. Data Agenda & Dokumen
        $latestAgendas = Agenda::orderBy('start_time', 'desc')->take(3)->get();
        $latestDocuments = Document::orderBy('created_at', 'desc')->take(3)->get();

        // 2. DATA BERITA
        // Ambil 6 berita terbaru (campur)
        $allNews = News::latest()->take(6)->get();

        // PERBAIKAN: Gunakan LIKE agar 'Kegiatan', 'kegiatan', 'Berita Kegiatan' semua masuk
        $kegiatanNews = News::where('category', 'LIKE', '%kegiatan%')
                            ->latest()
                            ->take(6)
                            ->get();

        // PERBAIKAN: Gunakan LIKE agar 'Sidang', 'sidang', 'Berita Sidang' semua masuk
        $sidangNews = News::where('category', 'LIKE', '%sidang%')
                          ->latest()
                          ->take(6)
                          ->get();

        // 3. Kirim semua ke view
        return view('frontend.beranda', [
            'latestAgendas' => $latestAgendas,
            'latestDocuments' => $latestDocuments,
            'allNews' => $allNews,
            'kegiatanNews' => $kegiatanNews,
            'sidangNews' => $sidangNews,
            'page_title' => 'Beranda'
        ]);
    }

    public function detailBerita($slug)
    {
        $news = News::where('slug', $slug)->firstOrFail();
        return view('frontend.news_detail', [
            'news' => $news,
            'page_title' => $news->title
        ]);
    }

    public function pencarian(Request $request)
    {
        $keyword = $request->input('q');
        if (!$keyword) return redirect()->route('beranda');

        // Pencarian Global (Berita, Dokumen, Halaman)
        $newsResults = News::where('title', 'LIKE', "%{$keyword}%")
                            ->orWhere('content', 'LIKE', "%{$keyword}%")
                            ->latest()
                            ->get();

        $docResults = Document::where('title', 'LIKE', "%{$keyword}%")
                              ->latest()
                              ->get();

        $pageResults = Page::where('title', 'LIKE', "%{$keyword}%")
                           ->orWhere('content', 'LIKE', "%{$keyword}%")
                           ->get();

        return view('frontend.search_results', [
            'keyword' => $keyword,
            'newsResults' => $newsResults,
            'docResults' => $docResults,
            'pageResults' => $pageResults,
            'page_title' => 'Hasil Pencarian: ' . $keyword
        ]);
    }

    // === PROFIL ===

    public function tentang() { return $this->showPage('tentang'); }
    public function visiMisi() { return $this->showPage('visi-misi'); }
    public function strukturSekretariat() { return $this->showPage('struktur-sekretariat'); }
    public function tugasFungsi() { return $this->showPage('tugas-fungsi'); }
    public function daftarPejabat() { return $this->showPage('daftar-pejabat'); }

    public function profilKomisioner()
    {
        // 1. Ambil Teks Intro dari Tabel Page (Kelola Halaman)
        // Kita pakai 'first()' saja, jangan 'firstOrFail' jaga-jaga kalau admin menghapusnya
        $page = Page::where('slug', 'profil-komisioner')->first();

        // 2. Ambil Data Orang dari Tabel Commissioner (Kelola Komisioner)
        $commissioners = Commissioner::orderBy('order', 'asc')->get();

        return view('frontend.commissioner_list', [
            'commissioners' => $commissioners,
            'page' => $page, // Kirim data halaman juga untuk ditampilkan judul/kontennya
            'page_title' => $page ? $page->title : 'Profil Komisioner',
        ]);
    }

    public function strukturKomisioner()
    {
        // Sama seperti di atas, kita ambil intro text jika ada
        $page = Page::where('slug', 'struktur-komisioner')->first();
        $commissioners = Commissioner::orderBy('order', 'asc')->get();

        return view('frontend.commissioner_list', [
            'commissioners' => $commissioners,
            'page' => $page,
            'page_title' => $page ? $page->title : 'Struktur Komisioner',
        ]);
    }

    // === AGENDA ===
    public function agendaKomisioner()
    {
        $agendas = Agenda::where('category', 'Agenda Komisioner')->orderBy('start_time', 'desc')->get();
        return view('frontend.agenda_list', ['agendas' => $agendas, 'page_title' => 'Agenda Komisioner']);
    }

    public function jadwalSidang()
    {
        $agendas = Agenda::where('category', 'Jadwal Sidang')->orderBy('start_time', 'desc')->get();
        return view('frontend.agenda_list', ['agendas' => $agendas, 'page_title' => 'Jadwal Sidang']);
    }

    // === LAPORAN ===
    public function laporanKinerja() { return $this->showDocumentList('laporan-kinerja', 'Laporan Perkembangan Kinerja'); }
    public function laporanEvaluasiKIP() { return $this->showDocumentList('laporan-evaluasi-kip', 'Laporan Hasil Evaluasi KIP'); }
    public function laporanKIP() { return $this->showDocumentList('laporan-kip', 'Laporan KIP'); }

    // === REGULASI ===
    public function undangUndang() { return $this->showDocumentList('undang-undang', 'Undang-Undang'); }
    public function peraturanPemerintahan() { return $this->showDocumentList('peraturan-pemerintah', 'Peraturan Pemerintah'); }
    public function peraturanDaerah() { return $this->showDocumentList('peraturan-daerah', 'Peraturan Daerah'); }
    public function peraturanPresiden() { return $this->showDocumentList('peraturan-presiden', 'Peraturan Presiden'); }
    public function peraturanMA() { return $this->showDocumentList('peraturan-mahkamah-agung', 'Peraturan Mahkamah Agung'); }
    public function peraturanMenteri() { return $this->showDocumentList('peraturan-menteri', 'Peraturan Menteri'); }
    public function pengaturanKI() { return $this->showDocumentList('pengaturan-komisi-informasi', 'Pengaturan Komisi Informasi'); }
    public function suratKeputusan() { return $this->showDocumentList('surat-keputusan', 'Surat Keputusan'); }
    public function suratEdaran() { return $this->showDocumentList('surat-edaran', 'Surat Edaran'); }
    public function mou() { return $this->showDocumentList('mou', 'MOU'); }

    // === INFORMASI PUBLIK ===
    public function putusan() { return $this->showDocumentList('putusan', 'Putusan'); }
    public function informasiBerkala() { return $this->showDocumentList('informasi-berkala', 'Informasi Berkala'); }
    public function informasiSetiapSaat() { return $this->showDocumentList('informasi-setiap-saat', 'Informasi Setiap Saat'); }
    public function informasiSertaMerta() { return $this->showDocumentList('informasi-serta-merta', 'Informasi Serta Merta'); }
    public function dipa() { return $this->showDocumentList('dipa', 'DIPA'); }
    public function formPermohonanPsi() { return $this->showDocumentList('form-permohonan-psi', 'Form Permohonan PSI'); }
}
