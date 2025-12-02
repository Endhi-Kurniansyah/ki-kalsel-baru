<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Document;
use App\Models\Agenda;
use App\Models\Commissioner;
use App\Models\News;
use App\Models\Gallery;

class HalamanController extends Controller
{
    // --- METHOD PENDUKUNG ---
    private function showPage(string $slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();
        return view('frontend.page', compact('page'));
    }

    private function showDocumentList(string $category, string $title)
    {
        $documents = Document::where('category', $category)->orderBy('created_at', 'desc')->get();
        return view('frontend.document_list', ['documents' => $documents, 'page_title' => $title]);
    }

    // --- METHOD UTAMA ---

    public function beranda()
    {
        $heroPage = Page::where('slug', 'beranda')->first();
        $latestAgendas = Agenda::orderBy('start_time', 'desc')->take(3)->get();
        $latestDocuments = Document::orderBy('created_at', 'desc')->take(3)->get();

        $allNews = News::latest()->take(6)->get();
        $kegiatanNews = News::where('category', 'LIKE', '%kegiatan%')->latest()->take(6)->get();
        $sidangNews = News::where('category', 'LIKE', '%sidang%')->latest()->take(6)->get();

        return view('frontend.beranda', [
            'heroPage' => $heroPage,
            'latestAgendas' => $latestAgendas,
            'latestDocuments' => $latestDocuments,
            'allNews' => $allNews,
            'kegiatanNews' => $kegiatanNews,
            'sidangNews' => $sidangNews,
            'page_title' => 'Beranda'
        ]);
    }

    public function beritaIndex(Request $request)
    {
        $query = News::latest();
        if ($request->has('kategori') && $request->kategori != '') $query->where('category', 'LIKE', '%' . $request->kategori . '%');
        if ($request->has('tahun') && $request->tahun != '') $query->whereYear('created_at', $request->tahun);
        if ($request->has('search') && $request->search != '') $query->where('title', 'LIKE', '%' . $request->search . '%');
        $allNews = $query->paginate(9);

        return view('frontend.news_index', ['allNews' => $allNews, 'page_title' => 'Berita & Kegiatan']);
    }

    public function detailBerita($slug)
    {
        $news = News::where('slug', $slug)->firstOrFail();
        return view('frontend.news_detail', ['news' => $news, 'page_title' => $news->title]);
    }

    public function pencarian(Request $request)
    {
        $keyword = $request->input('q');
        if (!$keyword) return redirect()->route('beranda');

        $newsResults = News::where('title', 'LIKE', "%{$keyword}%")->orWhere('content', 'LIKE', "%{$keyword}%")->latest()->get();
        $docResults = Document::where('title', 'LIKE', "%{$keyword}%")->latest()->get();
        $pageResults = Page::where('title', 'LIKE', "%{$keyword}%")->orWhere('content', 'LIKE', "%{$keyword}%")->get();

        return view('frontend.search_results', [
            'keyword' => $keyword,
            'newsResults' => $newsResults,
            'docResults' => $docResults,
            'pageResults' => $pageResults,
            'page_title' => 'Hasil Pencarian: ' . $keyword
        ]);
    }

    public function galeri()
    {
        $galleries = Gallery::latest()->get();
        return view('frontend.galeri_list', ['galleries' => $galleries, 'page_title' => 'Galeri Kegiatan']);
    }

    // === PROFIL ===

    public function tentang() { return $this->showPage('tentang'); }
    public function visiMisi() { return $this->showPage('visi-misi'); }
    public function strukturSekretariat() { return $this->showPage('struktur-sekretariat'); }
    public function tugasFungsi() { return $this->showPage('tugas-fungsi'); }
    public function daftarPejabat() { return $this->showPage('daftar-pejabat'); }

    // PERBAIKAN: Profil Komisioner (Hanya ambil dari Kelola Komisioner)
    public function profilKomisioner()
    {
        // Kita tidak lagi mengambil 'Page', langsung ambil data orangnya saja
        $commissioners = Commissioner::orderBy('order', 'asc')->get();

        return view('frontend.commissioner_list', [
            'commissioners' => $commissioners,
            'page_title' => 'Profil Komisioner', // Judul langsung di sini
        ]);
    }

    public function strukturKomisioner()
    {
        // Struktur Komisioner tetap mengambil dari Page (karena biasanya berisi gambar bagan)
        return $this->showPage('struktur-komisioner');
    }

    // === AGENDA ===
    public function agendaKomisioner()
    {
        $agendas = Agenda::where('category', 'Agenda Komisioner')->orderBy('start_time', 'asc')->get();
        return view('frontend.agenda_komisioner', ['agendas' => $agendas, 'page_title' => 'Agenda Komisioner']);
    }

    public function jadwalSidang()
    {
        return $this->showPage('jadwal-sidang');
    }

    // === LAPORAN & REGULASI & INFO PUBLIK ===
    public function laporanKinerja() { return $this->showDocumentList('laporan-kinerja', 'Laporan Perkembangan Kinerja'); }
    public function laporanEvaluasiKIP() { return $this->showDocumentList('laporan-evaluasi-kip', 'Laporan Hasil Evaluasi KIP'); }
    public function laporanKIP() { return $this->showDocumentList('laporan-kip', 'Laporan KIP'); }
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
    public function putusan() { return $this->showDocumentList('putusan', 'Putusan'); }
    public function informasiBerkala() { return $this->showDocumentList('informasi-berkala', 'Informasi Berkala'); }
    public function informasiSetiapSaat() { return $this->showDocumentList('informasi-setiap-saat', 'Informasi Setiap Saat'); }
    public function informasiSertaMerta() { return $this->showDocumentList('informasi-serta-merta', 'Informasi Serta Merta'); }
    public function dipa() { return $this->showDocumentList('dipa', 'DIPA'); }
    public function formPermohonanPsi() { return $this->showDocumentList('form-permohonan-psi', 'Form Permohonan PSI'); }
}
