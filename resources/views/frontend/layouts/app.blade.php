<!DOCTYPE html>
{{-- Kita tambahkan 'x-data' untuk Alpine.js --}}
<html lang="id" x-data="{ openMenu: false }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $page_title ?? 'Komisi Informasi Prov. Kalsel' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Font Tambahan (Inter) --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="font-sans antialiased bg-gray-100">

    {{-- =================================== --}}
    {{-- === BAGIAN HEADER & NAVBAR === --}}
    {{-- =================================== --}}
    <header class="bg-red-700 shadow-md sticky top-0 z-50">
        <nav class="max-w-7xl mx-auto px-2 sm:px-4 lg:px-8">
            <div class="flex justify-between items-center h-16 relative">

                {{-- 1. LOGO --}}
                <div class="flex-shrink-0 flex items-center mr-2 lg:mr-4">
                    <a href="{{ route('beranda') }}" class="flex items-center gap-2">
                        {{-- Ganti src ini dengan {{ asset('img/logo.png') }} jika sudah ada file lokal --}}
                        <img class="h-8 w-auto md:h-10" src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a2/Lambang_Provinsi_Kalimantan_Selatan.svg/1200px-Lambang_Provinsi_Kalimantan_Selatan.svg.png" alt="Logo KI Kalsel">
                        <div class="flex flex-col">
                            <span class="font-bold text-white text-xs md:text-sm leading-tight">
                                KOMISI INFORMASI
                            </span>
                            <span class="font-medium text-white text-[10px] md:text-xs leading-tight">
                                Prov. Kalimantan Selatan
                            </span>
                        </div>
                    </a>
                </div>

                {{-- 2. MENU DESKTOP --}}
                <div class="hidden lg:flex lg:items-center lg:space-x-1 xl:space-x-2">

                    <a href="{{ route('beranda') }}" class="px-2 py-2 text-xs font-bold text-white uppercase hover:text-red-200 transition tracking-wide">BERANDA</a>

                    {{-- Dropdown PROFIL --}}
                    <div class="relative" x-data="{ open: false }">
                        <button @mouseover="open = true" @mouseleave="open = false" class="px-2 py-2 text-xs font-bold text-white uppercase hover:text-red-200 flex items-center transition tracking-wide">
                            PROFIL <svg class="ml-1 h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="open" @mouseover="open = true" @mouseleave="open = false" x-transition class="absolute mt-0 w-48 bg-white border shadow-lg rounded-md z-50 py-1">
                            <a href="{{ route('profil.profil-komisioner') }}" class="block px-4 py-2 text-xs text-gray-700 hover:bg-gray-100 hover:text-red-700">Profil Komisioner</a>
                            <a href="{{ route('profil.struktur-komisioner') }}" class="block px-4 py-2 text-xs text-gray-700 hover:bg-gray-100 hover:text-red-700">Struktur Komisioner</a>
                            <a href="{{ route('profil.tentang') }}" class="block px-4 py-2 text-xs text-gray-700 hover:bg-gray-100 hover:text-red-700">Tentang</a>
                            <a href="{{ route('profil.visi-misi') }}" class="block px-4 py-2 text-xs text-gray-700 hover:bg-gray-100 hover:text-red-700">Visi Misi</a>
                            <a href="{{ route('profil.struktur-sekretariat') }}" class="block px-4 py-2 text-xs text-gray-700 hover:bg-gray-100 hover:text-red-700">Struktur Sekretariat</a>
                        </div>
                    </div>

                    {{-- Dropdown AGENDA --}}
                    <div class="relative" x-data="{ open: false }">
                        <button @mouseover="open = true" @mouseleave="open = false" class="px-2 py-2 text-xs font-bold text-white uppercase hover:text-red-200 flex items-center transition tracking-wide">
                            AGENDA <svg class="ml-1 h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="open" @mouseover="open = true" @mouseleave="open = false" x-transition class="absolute mt-0 w-48 bg-white border shadow-lg rounded-md z-50 py-1">
                            <a href="{{ route('agenda.agenda-komisioner') }}" class="block px-4 py-2 text-xs text-gray-700 hover:bg-gray-100 hover:text-red-700">Agenda Komisioner</a>
                            <a href="{{ route('agenda.jadwal-sidang') }}" class="block px-4 py-2 text-xs text-gray-700 hover:bg-gray-100 hover:text-red-700">Jadwal Sidang</a>
                        </div>
                    </div>

                    {{-- MENU BERITA (DIUBAH JADI LINK BIASA) --}}
                    <a href="{{ route('berita.index') }}" class="px-2 py-2 text-xs font-bold text-white uppercase hover:text-red-200 transition tracking-wide">BERITA</a>

                    {{-- Dropdown LAPORAN --}}
                    <div class="relative" x-data="{ open: false }">
                        <button @mouseover="open = true" @mouseleave="open = false" class="px-2 py-2 text-xs font-bold text-white uppercase hover:text-red-200 flex items-center transition tracking-wide">
                            LAPORAN <svg class="ml-1 h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="open" @mouseover="open = true" @mouseleave="open = false" x-transition class="absolute mt-0 w-56 bg-white border shadow-lg rounded-md z-50 py-1">
                            <a href="{{ route('laporan.laporan-kinerja') }}" class="block px-4 py-2 text-xs text-gray-700 hover:bg-gray-100 hover:text-red-700">Laporan Kinerja</a>
                            <a href="{{ route('laporan.laporan-evaluasi-KIP') }}" class="block px-4 py-2 text-xs text-gray-700 hover:bg-gray-100 hover:text-red-700">Laporan Evaluasi KIP</a>
                            <a href="{{ route('laporan.laporan-KIP') }}" class="block px-4 py-2 text-xs text-gray-700 hover:bg-gray-100 hover:text-red-700">Laporan KIP</a>
                        </div>
                    </div>

                    {{-- Dropdown REGULASI --}}
                    <div class="relative" x-data="{ open: false }">
                        <button @mouseover="open = true" @mouseleave="open = false" class="px-2 py-2 text-xs font-bold text-white uppercase hover:text-red-200 flex items-center transition tracking-wide">
                            REGULASI <svg class="ml-1 h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="open" @mouseover="open = true" @mouseleave="open = false" x-transition class="absolute mt-0 w-56 bg-white border shadow-lg rounded-md z-50 py-1">
                            <a href="{{ route('regulasi.undang-undang') }}" class="block px-4 py-2 text-xs text-gray-700 hover:bg-gray-100 hover:text-red-700">Undang-Undang</a>
                            <a href="{{ route('regulasi.peraturan-pemerintahan') }}" class="block px-4 py-2 text-xs text-gray-700 hover:bg-gray-100 hover:text-red-700">Peraturan Pemerintah</a>
                            <a href="{{ route('regulasi.peraturan-daerah') }}" class="block px-4 py-2 text-xs text-gray-700 hover:bg-gray-100 hover:text-red-700">Peraturan Daerah</a>
                        </div>
                    </div>

                    {{-- Dropdown INFORMASI PUBLIK --}}
                    <div class="relative" x-data="{ open: false }">
                        <button @mouseover="open = true" @mouseleave="open = false" class="px-2 py-2 text-xs font-bold text-white uppercase hover:text-red-200 flex items-center transition tracking-wide">
                            INFO PUBLIK <svg class="ml-1 h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="open" @mouseover="open = true" @mouseleave="open = false" x-transition class="absolute right-0 mt-0 w-56 bg-white border shadow-lg rounded-md z-50 py-1">
                            <a href="{{ route('informasi-publik.putusan') }}" class="block px-4 py-2 text-xs text-gray-700 hover:bg-gray-100 hover:text-red-700">Putusan</a>
                            <a href="{{ route('informasi-publik.informasi-berkala') }}" class="block px-4 py-2 text-xs text-gray-700 hover:bg-gray-100 hover:text-red-700">Informasi Berkala</a>
                            <a href="{{ route('informasi-publik.dipa') }}" class="block px-4 py-2 text-xs text-gray-700 hover:bg-gray-100 hover:text-red-700">DIPA</a>
                        </div>
                    </div>

                    {{-- MENU GALERI --}}
                    <a href="{{ route('galeri.index') }}" class="px-2 py-2 text-xs font-bold text-white uppercase hover:text-red-200 transition tracking-wide">GALERI</a>

                    {{-- SEARCH ICON & POP-DOWN --}}
                    <div class="relative ml-2" x-data="{ showSearch: false }">
                        <button @click="showSearch = !showSearch" class="text-white hover:text-red-200 p-2 focus:outline-none transition">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                        <div x-show="showSearch" @click.away="showSearch = false" x-transition class="absolute right-0 mt-2 z-50" style="display: none;">
                            <div class="bg-white rounded-md shadow-xl p-2 border border-gray-200">
                                <form action="{{ route('pencarian') }}" method="GET" class="flex items-center">
                                    <input type="text" name="q" placeholder="Cari..." class="h-9 w-48 rounded-l border border-gray-300 bg-white px-3 text-xs text-gray-700 focus:outline-none focus:ring-1 focus:ring-red-500 focus:border-red-500" autofocus>
                                    <button type="submit" class="h-9 bg-gray-400 hover:bg-gray-500 text-white text-[10px] font-bold px-4 rounded-r border border-l-0 border-gray-300 flex items-center justify-center transition-colors tracking-wider uppercase">SEARCH</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- 4. TOMBOL HAMBURGER MOBILE --}}
                <div class="flex lg:hidden items-center">
                    <button @click="openMenu = !openMenu" class="text-white hover:text-red-200 focus:outline-none">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                    </button>
                </div>
            </div>

            {{-- =================================== --}}
            {{-- === 5. MENU MOBILE (RESPONSIF) === --}}
            {{-- =================================== --}}
            <div x-show="openMenu" x-transition class="lg:hidden bg-white border-t border-gray-200 pb-4 shadow-lg absolute w-full left-0 z-50 max-h-screen overflow-y-auto">

                {{-- Mobile Search --}}
                <div class="p-4 border-b border-gray-100 bg-gray-50">
                    <form action="{{ route('pencarian') }}" method="GET" class="relative flex">
                        <input type="text" name="q" placeholder="Cari informasi..." class="w-full border border-gray-300 rounded-l-md py-2 px-4 text-sm focus:outline-none focus:ring-1 focus:ring-red-500">
                        <button type="submit" class="bg-gray-500 text-white px-4 rounded-r-md hover:bg-gray-600 text-xs font-bold uppercase">SEARCH</button>
                    </form>
                </div>

                <div class="px-2 pt-2 pb-3 space-y-1">
                    <a href="{{ route('beranda') }}" class="block px-3 py-2 rounded-md text-sm font-bold text-gray-700 hover:text-red-700 hover:bg-gray-50">BERANDA</a>

                    {{-- Mobile Dropdown: PROFIL --}}
                    <div x-data="{ subOpen: false }">
                        <button @click="subOpen = !subOpen" class="w-full flex justify-between items-center px-3 py-2 rounded-md text-sm font-bold text-gray-700 hover:text-red-700 hover:bg-gray-50 focus:outline-none">
                            <span>PROFIL</span>
                            <svg :class="{'rotate-180': subOpen}" class="h-4 w-4 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="subOpen" class="pl-6 space-y-1 bg-gray-50">
                            <a href="{{ route('profil.profil-komisioner') }}" class="block px-3 py-2 text-xs text-gray-600 hover:text-red-700">Profil Komisioner</a>
                            <a href="{{ route('profil.struktur-komisioner') }}" class="block px-3 py-2 text-xs text-gray-600 hover:text-red-700">Struktur Komisioner</a>
                            <a href="{{ route('profil.tentang') }}" class="block px-3 py-2 text-xs text-gray-600 hover:text-red-700">Tentang</a>
                            <a href="{{ route('profil.visi-misi') }}" class="block px-3 py-2 text-xs text-gray-600 hover:text-red-700">Visi Misi</a>
                            <a href="{{ route('profil.struktur-sekretariat') }}" class="block px-3 py-2 text-xs text-gray-600 hover:text-red-700">Struktur Sekretariat</a>
                        </div>
                    </div>

                    {{-- Mobile Dropdown: AGENDA --}}
                    <div x-data="{ subOpen: false }">
                        <button @click="subOpen = !subOpen" class="w-full flex justify-between items-center px-3 py-2 rounded-md text-sm font-bold text-gray-700 hover:text-red-700 hover:bg-gray-50 focus:outline-none">
                            <span>AGENDA</span>
                            <svg :class="{'rotate-180': subOpen}" class="h-4 w-4 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="subOpen" class="pl-6 space-y-1 bg-gray-50">
                            <a href="{{ route('agenda.agenda-komisioner') }}" class="block px-3 py-2 text-xs text-gray-600 hover:text-red-700">Agenda Komisioner</a>
                            <a href="{{ route('agenda.jadwal-sidang') }}" class="block px-3 py-2 text-xs text-gray-600 hover:text-red-700">Jadwal Sidang</a>
                        </div>
                    </div>

                    {{-- MENU BERITA (MOBILE LINK BIASA) --}}
                    <a href="{{ route('berita.index') }}" class="block px-3 py-2 rounded-md text-sm font-bold text-gray-700 hover:text-red-700 hover:bg-gray-50">BERITA</a>

                    {{-- Mobile Dropdown: LAPORAN --}}
                    <div x-data="{ subOpen: false }">
                        <button @click="subOpen = !subOpen" class="w-full flex justify-between items-center px-3 py-2 rounded-md text-sm font-bold text-gray-700 hover:text-red-700 hover:bg-gray-50 focus:outline-none">
                            <span>LAPORAN</span>
                            <svg :class="{'rotate-180': subOpen}" class="h-4 w-4 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="subOpen" class="pl-6 space-y-1 bg-gray-50">
                            <a href="{{ route('laporan.laporan-kinerja') }}" class="block px-3 py-2 text-xs text-gray-600 hover:text-red-700">Laporan Kinerja</a>
                            <a href="{{ route('laporan.laporan-evaluasi-KIP') }}" class="block px-3 py-2 text-xs text-gray-600 hover:text-red-700">Laporan Evaluasi KIP</a>
                            <a href="{{ route('laporan.laporan-KIP') }}" class="block px-3 py-2 text-xs text-gray-600 hover:text-red-700">Laporan KIP</a>
                        </div>
                    </div>

                    {{-- Mobile Dropdown: REGULASI --}}
                    <div x-data="{ subOpen: false }">
                        <button @click="subOpen = !subOpen" class="w-full flex justify-between items-center px-3 py-2 rounded-md text-sm font-bold text-gray-700 hover:text-red-700 hover:bg-gray-50 focus:outline-none">
                            <span>REGULASI</span>
                            <svg :class="{'rotate-180': subOpen}" class="h-4 w-4 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="subOpen" class="pl-6 space-y-1 bg-gray-50">
                            <a href="{{ route('regulasi.undang-undang') }}" class="block px-3 py-2 text-xs text-gray-600 hover:text-red-700">Undang-Undang</a>
                            <a href="{{ route('regulasi.peraturan-pemerintahan') }}" class="block px-3 py-2 text-xs text-gray-600 hover:text-red-700">Peraturan Pemerintah</a>
                            <a href="{{ route('regulasi.peraturan-daerah') }}" class="block px-3 py-2 text-xs text-gray-600 hover:text-red-700">Peraturan Daerah</a>
                        </div>
                    </div>

                    {{-- Mobile Dropdown: INFORMASI PUBLIK --}}
                    <div x-data="{ subOpen: false }">
                        <button @click="subOpen = !subOpen" class="w-full flex justify-between items-center px-3 py-2 rounded-md text-sm font-bold text-gray-700 hover:text-red-700 hover:bg-gray-50 focus:outline-none">
                            <span>INFO PUBLIK</span>
                            <svg :class="{'rotate-180': subOpen}" class="h-4 w-4 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="subOpen" class="pl-6 space-y-1 bg-gray-50">
                            <a href="{{ route('informasi-publik.putusan') }}" class="block px-3 py-2 text-xs text-gray-600 hover:text-red-700">Putusan</a>
                            <a href="{{ route('informasi-publik.informasi-berkala') }}" class="block px-3 py-2 text-xs text-gray-600 hover:text-red-700">Informasi Berkala</a>
                            <a href="{{ route('informasi-publik.dipa') }}" class="block px-3 py-2 text-xs text-gray-600 hover:text-red-700">DIPA</a>
                        </div>
                    </div>

                    {{-- Mobile Link: GALERI --}}
                    <a href="{{ route('galeri.index') }}" class="block px-3 py-2 rounded-md text-sm font-bold text-gray-700 hover:text-red-700 hover:bg-gray-50">GALERI</a>

                </div>
            </div>
        </nav>
    </header>

    {{-- =================================== --}}
    {{-- === BAGIAN KONTEN UTAMA === --}}
    {{-- =================================== --}}
    <main class="max-w-7xl mx-auto py-12 sm:px-6 lg:px-8">
        {{-- Konten disuntikkan di sini --}}
        {{ $slot }}
    </main>

    {{-- =================================== --}}
    {{-- === BAGIAN FOOTER === --}}
    {{-- =================================== --}}
    <footer class="bg-gray-800 text-white mt-12">
        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 text-center">
            <p>&copy; {{ date('Y') }} Komisi Informasi Provinsi Kalimantan Selatan. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
