{{-- Kita gunakan layout frontend yang sudah ada --}}
<x-frontend-layout page_title="Beranda - Komisi Informasi Prov. Kalsel">

    {{-- ====================================================================== --}}
    {{-- JALUR PINTAS: AMBIL DATA LANGSUNG DI VIEW (AGAR TIDAK UBAH CONTROLLER) --}}
    {{-- ====================================================================== --}}
    @php
        // Ambil semua berita terbaru (Limit 6)
        $beritaTerbaruFix = \App\Models\News::latest()->take(6)->get();

        // Ambil berita yang kategorinya mengandung kata 'kegiatan' (Tidak peduli huruf besar/kecil)
        $beritaKegiatanFix = \App\Models\News::where('category', 'LIKE', '%kegiatan%')
                                ->latest()
                                ->take(6)
                                ->get();

        // Ambil berita yang kategorinya mengandung kata 'sidang' (Tidak peduli huruf besar/kecil)
        $beritaSidangFix = \App\Models\News::where('category', 'LIKE', '%sidang%')
                                ->latest()
                                ->take(6)
                                ->get();
    @endphp
    {{-- ====================================================================== --}}


    {{-- 1. Hero Section --}}
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
        <div class="p-6 md:p-12 text-gray-900 relative h-96 bg-cover bg-center" style="background-image: url('https://diskominfo.kalselprov.go.id/wp-content/uploads/2021/08/Gedung-DPRD-Prov-Kalsel-1-1024x576.jpg');">
            <div class="absolute inset-0 bg-black bg-opacity-50 sm:rounded-lg"></div>
            <div class="relative z-10 h-full flex flex-col justify-center">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
                    Selamat Datang
                </h1>
                <p class="text-xl md:text-2xl text-white">
                    Di Komisi Informasi Provinsi Kalimantan Selatan
                </p>
            </div>
        </div>
    </div>

    {{-- 2. Link Cepat --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
        <a href="https://ppidutama.kalselprov.go.id/" class="block bg-red-600 text-white p-6 rounded-lg shadow-md hover:bg-blue-700 transition">
            <h3 class="text-2xl font-bold mb-2">E-PPID</h3>
            <p>Kunjungi &rarr;</p>
        </a>
        <a href="#" class="block bg-red-600 text-white p-6 rounded-lg shadow-md hover:bg-blue-700 transition">
            <h3 class="text-2xl font-bold mb-2">SIPSI</h3>
            <p>Kunjungi &rarr;</p>
        </a>
        <a href="#" class="block bg-red-600 text-white p-6 rounded-lg shadow-md hover:bg-blue-700 transition">
            <h3 class="text-2xl font-bold mb-2">JDIH</h3>
            <p>Kunjungi &rarr;</p>
        </a>
        <a href="#" class="block bg-red-600 text-white p-6 rounded-lg shadow-md hover:bg-blue-700 transition">
            <h3 class="text-2xl font-bold mb-2">E-MONEV</h3>
            <p>Kunjungi &rarr;</p>
        </a>
    </div>

    {{-- 3. BAGIAN BERITA (SUDAH DIPERBAIKI) --}}
    <section class="container py-12 mx-auto px-4 sm:px-6 lg:px-8">
        <div x-data="{ activeTab: 'terbaru' }">

            {{-- Tombol Tab --}}
            <div class="flex flex-wrap gap-2 mb-8 justify-center">
                <button @click="activeTab = 'terbaru'"
                    :class="{'bg-red-600 text-white': activeTab === 'terbaru', 'bg-gray-200 text-gray-700 hover:bg-red-100': activeTab !== 'terbaru'}"
                    class="px-5 py-2 rounded-full font-semibold transition duration-150 ease-in-out">
                    Berita Terbaru
                </button>
                <button @click="activeTab = 'kegiatan'"
                    :class="{'bg-red-600 text-white': activeTab === 'kegiatan', 'bg-gray-200 text-gray-700 hover:bg-red-100': activeTab !== 'kegiatan'}"
                class="px-5 py-2 rounded-full font-semibold transition duration-150 ease-in-out">
                    Berita Kegiatan
                </button>
                <button @click="activeTab = 'sidang'"
                    :class="{'bg-red-600 text-white': activeTab === 'sidang', 'bg-gray-200 text-gray-700 hover:bg-red-100': activeTab !== 'sidang'}"
                    class="px-5 py-2 rounded-full font-semibold transition duration-150 ease-in-out">
                    Berita Sidang
                </button>
            </div>

            <div class="news-content">

                {{-- TAB 1: BERITA TERBARU --}}
                <div x-show="activeTab === 'terbaru'" x-transition.opacity>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        {{-- Menggunakan variabel $beritaTerbaruFix --}}
                        @forelse($beritaTerbaruFix as $news)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                                <img src="{{ Storage::url($news->image_path) }}" alt="{{ $news->title }}" class="w-full h-48 object-cover">
                                <div class="p-4">
                                    <span class="text-xs font-bold text-red-600 uppercase">{{ $news->category }}</span>
                                    <h3 class="text-lg font-bold mt-1 text-gray-900 line-clamp-2">{{ $news->title }}</h3>
                                    <p class="text-gray-500 text-xs mt-2">{{ $news->created_at->format('d M Y') }}</p>
                                    <a href="{{ route('berita.detail', $news->slug) }}" class="inline-block mt-3 text-red-600 text-sm font-semibold hover:underline">Baca Selengkapnya &rarr;</a>
                                </div>
                            </div>
                        @empty
                            <p class="col-span-3 text-center text-gray-500">Belum ada berita terbaru.</p>
                        @endforelse
                    </div>
                </div>

                {{-- TAB 2: BERITA KEGIATAN --}}
                <div x-show="activeTab === 'kegiatan'" x-transition.opacity style="display: none;">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        {{-- Menggunakan variabel $beritaKegiatanFix --}}
                        @forelse($beritaKegiatanFix as $news)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                                <img src="{{ Storage::url($news->image_path) }}" alt="{{ $news->title }}" class="w-full h-48 object-cover">
                                <div class="p-4">
                                    <span class="text-xs font-bold text-red-600 uppercase">{{ $news->category }}</span>
                                    <h3 class="text-lg font-bold mt-1 text-gray-900 line-clamp-2">{{ $news->title }}</h3>
                                    <p class="text-gray-500 text-xs mt-2">{{ $news->created_at->format('d M Y') }}</p>
                                    <a href="{{ route('berita.detail', $news->slug) }}" class="inline-block mt-3 text-red-600 text-sm font-semibold hover:underline">Baca Selengkapnya &rarr;</a>
                                </div>
                            </div>
                        @empty
                            <p class="col-span-3 text-center text-gray-500">Belum ada berita kegiatan.</p>
                        @endforelse
                    </div>
                </div>

                {{-- TAB 3: BERITA SIDANG --}}
                <div x-show="activeTab === 'sidang'" x-transition.opacity style="display: none;">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        {{-- Menggunakan variabel $beritaSidangFix --}}
                        @forelse($beritaSidangFix as $news)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                                <img src="{{ Storage::url($news->image_path) }}" alt="{{ $news->title }}" class="w-full h-48 object-cover">
                                <div class="p-4">
                                    <span class="text-xs font-bold text-red-600 uppercase">{{ $news->category }}</span>
                                    <h3 class="text-lg font-bold mt-1 text-gray-900 line-clamp-2">{{ $news->title }}</h3>
                                    <p class="text-gray-500 text-xs mt-2">{{ $news->created_at->format('d M Y') }}</p>
                                    <a href="{{ route('berita.detail', $news->slug) }}" class="inline-block mt-3 text-red-600 text-sm font-semibold hover:underline">Baca Selengkapnya &rarr;</a>
                                </div>
                            </div>
                        @empty
                            <p class="col-span-3 text-center text-gray-500">Belum ada berita sidang.</p>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- 4. Konten Dinamis (Agenda & Dokumen Terbaru) --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        {{-- Kolom Agenda Terkini --}}
        <div>
            <h2 class="text-3xl font-bold mb-6 text-gray-800">Agenda Terkini</h2>
            <div class="space-y-4">
                @forelse ($latestAgendas as $agenda)
                    <div class="bg-white p-4 rounded-lg shadow-sm border">
                        <h4 class="font-semibold text-lg text-indigo-700">{{ $agenda->title }}</h4>
                        <p class="text-sm text-gray-500">{{ $agenda->start_time->format('d M Y, H:i') }}</p>
                        <p class="text-sm text-gray-500">{{ $agenda->location }}</p>
                    </div>
                @empty
                    <div class="bg-white p-4 rounded-lg shadow-sm border">
                        <p class="text-gray-500">Belum ada agenda terkini.</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Kolom Dokumen Terbaru --}}
        <div>
            <h2 class="text-3xl font-bold mb-6 text-gray-800">Dokumen Terbaru</h2>
            <div class="space-y-4">
                @forelse ($latestDocuments as $doc)
                    <div class="bg-white p-4 rounded-lg shadow-sm border">
                        <a href="{{ Storage::url($doc->file_path) }}" target="_blank" class="font-semibold text-lg text-indigo-700 hover:underline">{{ $doc->title }}</a>
                        {{-- Tampilkan kategori --}}
                        <p class="text-sm text-gray-500 bg-gray-100 px-2 py-0.5 rounded-full inline-block mt-1">{{ $doc->category }}</p>
                    </div>
                @empty
                    <div class="bg-white p-4 rounded-lg shadow-sm border">
                        <p class="text-gray-500">Belum ada dokumen terbaru.</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>

</x-frontend-layout>
