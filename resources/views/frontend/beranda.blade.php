{{-- Kita gunakan layout frontend yang sudah ada --}}
<x-frontend-layout page_title="Beranda - Komisi Informasi Prov. Kalsel">

    {{-- ====================================================================== --}}
    {{-- LOGIKA PHP: UNTUK MENGAMBIL DATA BERITA & GAMBAR HERO --}}
    {{-- ====================================================================== --}}
    @php
        // 1. Logika untuk Gambar Hero (Banner)
        $bgImage = 'https://diskominfo.kalselprov.go.id/wp-content/uploads/2021/08/Gedung-DPRD-Prov-Kalsel-1-1024x576.jpg'; // Gambar Default
        $heroTitle = 'Selamat Datang';
        $heroContent = 'Di Komisi Informasi Provinsi Kalimantan Selatan';

        // Cek apakah data heroPage dikirim dari Controller
        if(isset($heroPage)) {
            $heroTitle = $heroPage->title; // Ambil Judul dari Database
            $heroContent = $heroPage->content; // Ambil Konten dari Database

            // Cek apakah ada gambar yang diupload admin
            if ($heroPage->hero_image) {
                $bgImage = Storage::url($heroPage->hero_image);
            }
        }

        // 2. Logika untuk Berita (Safe Fallback)
        $beritaTerbaruFix = isset($allNews) ? $allNews : collect([]);
        $beritaKegiatanFix = isset($kegiatanNews) ? $kegiatanNews : collect([]);
        $beritaSidangFix = isset($sidangNews) ? $sidangNews : collect([]);
    @endphp
    {{-- ====================================================================== --}}

    {{-- Tambahkan x-data untuk Modal Gambar di level atas agar bisa dipakai di mana saja --}}
    <div x-data="{ showModal: false, activeImage: '' }">

        {{-- 1. Hero Section (SUDAH DIPERBESAR) --}}
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
            {{--
                PERUBAHAN: Menggunakan h-[600px] agar banner tinggi
            --}}
            <div class="p-6 md:p-12 text-gray-900 relative h-[600px] bg-cover bg-center" style="background-image: url('{{ $bgImage }}');">
                {{-- Overlay gelap agar teks terbaca --}}
                <div class="absolute inset-0 bg-black bg-opacity-50 sm:rounded-lg"></div>

                <div class="relative z-10 h-full flex flex-col justify-center items-center text-center">
                    <h1 class="text-5xl md:text-6xl font-bold text-white mb-6 drop-shadow-lg tracking-wide">
                        {{ $heroTitle }}
                    </h1>
                    <div class="text-2xl md:text-3xl text-white drop-shadow-md prose prose-invert max-w-3xl mx-auto leading-relaxed">
                        {!! $heroContent !!}
                    </div>
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

        {{-- 3. BAGIAN BERITA --}}
        <section class="container py-12 mx-auto px-4 sm:px-6 lg:px-8">
            <div x-data="{ activeTab: 'terbaru' }">

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
                            @forelse($beritaTerbaruFix as $news)
                                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition group cursor-pointer">
                                    <div class="relative overflow-hidden h-48">
                                        @if($news->image_path)
                                            {{-- PERBAIKAN: Tambahkan Storage::url() dan fitur klik untuk modal --}}
                                            <img src="{{ Storage::url($news->image_path) }}"
                                                 alt="{{ $news->title }}"
                                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                                 @click="showModal = true; activeImage = '{{ Storage::url($news->image_path) }}'">
                                        @else
                                            <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-500">No Image</div>
                                        @endif
                                    </div>
                                    <div class="p-4">
                                        <span class="text-xs font-bold text-red-600 uppercase">{{ $news->category }}</span>
                                        <h3 class="text-lg font-bold mt-1 text-gray-900 line-clamp-2 hover:text-red-600 transition">
                                            <a href="{{ route('berita.detail', $news->slug) }}">{{ $news->title }}</a>
                                        </h3>
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
                             @forelse($beritaKegiatanFix as $news)
                                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition group cursor-pointer">
                                    <div class="relative overflow-hidden h-48">
                                        @if($news->image_path)
                                            <img src="{{ Storage::url($news->image_path) }}"
                                                 alt="{{ $news->title }}"
                                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                                 @click="showModal = true; activeImage = '{{ Storage::url($news->image_path) }}'">
                                        @else
                                            <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-500">No Image</div>
                                        @endif
                                    </div>
                                    <div class="p-4">
                                        <h3 class="text-lg font-bold mt-1 text-gray-900 line-clamp-2 hover:text-red-600 transition">
                                            <a href="{{ route('berita.detail', $news->slug) }}">{{ $news->title }}</a>
                                        </h3>
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
                             @forelse($beritaSidangFix as $news)
                                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition group cursor-pointer">
                                    <div class="relative overflow-hidden h-48">
                                        @if($news->image_path)
                                            <img src="{{ Storage::url($news->image_path) }}"
                                                 alt="{{ $news->title }}"
                                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                                 @click="showModal = true; activeImage = '{{ Storage::url($news->image_path) }}'">
                                        @else
                                            <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-500">No Image</div>
                                        @endif
                                    </div>
                                    <div class="p-4">
                                        <h3 class="text-lg font-bold mt-1 text-gray-900 line-clamp-2 hover:text-red-600 transition">
                                            <a href="{{ route('berita.detail', $news->slug) }}">{{ $news->title }}</a>
                                        </h3>
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
                        <div class="bg-white p-4 rounded-lg shadow-sm border hover:shadow-md transition">
                            <h4 class="font-semibold text-lg text-indigo-700">{{ $agenda->title }}</h4>
                            <p class="text-sm text-gray-500 mt-1">
                                <span class="font-medium">Waktu:</span> {{ $agenda->start_time->format('d M Y, H:i') }}
                            </p>
                            <p class="text-sm text-gray-500">
                                <span class="font-medium">Lokasi:</span> {{ $agenda->location }}
                            </p>

                            {{-- Link Download Undangan Agenda --}}
                            @if ($agenda->file_path)
                                <div class="mt-2 pt-2 border-t border-gray-100">
                                    <a href="{{ Storage::url($agenda->file_path) }}" target="_blank" class="text-xs font-semibold text-red-600 hover:text-red-800 inline-flex items-center">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                        Download Undangan
                                    </a>
                                </div>
                            @endif
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
                        <div class="bg-white p-4 rounded-lg shadow-sm border hover:shadow-md transition">
                            <a href="{{ Storage::url($doc->file_path) }}" target="_blank" class="font-semibold text-lg text-indigo-700 hover:underline">{{ $doc->title }}</a>
                            {{-- Tampilkan kategori --}}
                            <div class="mt-1">
                                <span class="text-xs font-medium text-gray-500 bg-gray-100 px-2 py-0.5 rounded-full">{{ $doc->category }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white p-4 rounded-lg shadow-sm border">
                            <p class="text-gray-500">Belum ada dokumen terbaru.</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>

        {{--
            MODAL POPUP GAMBAR (ALPINE.JS)
            Ini akan muncul saat gambar diklik
        --}}
        <div x-show="showModal"
             style="display: none;"
             class="fixed inset-0 z-[9999] flex items-center justify-center bg-black bg-opacity-90 p-4 backdrop-blur-sm"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">

            {{-- Tombol Close --}}
            <button @click="showModal = false" class="absolute top-4 right-4 text-white hover:text-red-500 z-50">
                <svg class="w-10 h-10 drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            {{-- Gambar Full --}}
            <div class="relative w-full h-full flex items-center justify-center" @click.away="showModal = false">
                <img :src="activeImage"
                     class="max-w-full max-h-full object-contain rounded shadow-2xl"
                     alt="Preview">
            </div>
        </div>

    </div>

</x-frontend-layout>
