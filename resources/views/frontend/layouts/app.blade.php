<!DOCTYPE html>
{{-- Kita tambahkan 'x-data' untuk Alpine.js --}}
<html lang="id" x-data="{ openMenu: false }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $page_title ?? 'Komisi Informasi Prov. Kalsel' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">

    {{-- =================================== --}}
    {{-- === BAGIAN HEADER & NAVBAR === --}}
    {{-- =================================== --}}
    <header class="bg-red-700 shadow-md sticky top-0 z-50">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">

                {{-- 1. LOGO --}}
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('beranda') }}" class="flex items-center space-x-2">
                        {{-- Ganti src ini dengan {{ asset('img/logo.png') }} jika sudah ada file lokal --}}
                        <img class="h-10 w-auto" src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a2/Lambang_Provinsi_Kalimantan_Selatan.svg/1200px-Lambang_Provinsi_Kalimantan_Selatan.svg.png" alt="Logo KI Kalsel">
                        <span class="font-bold text-white text-sm md:text-base leading-tight hidden md:block">
                            KOMISI INFORMASI<br>Prov. Kalsel
                        </span>
                    </a>
                </div>

                {{-- 2. MENU DESKTOP (Hidden on Mobile) --}}
                <div class="hidden lg:flex lg:space-x-6 items-center">
                    <a href="{{ route('beranda') }}" class="px-3 py-2 text-sm font-medium text-white hover:text-red-200 transition">BERANDA</a>

                    {{-- Dropdown PROFIL --}}
                    <div class="relative" x-data="{ open: false }">
                        <button @mouseover="open = true" @mouseleave="open = false" class="px-3 py-2 text-sm font-medium text-white hover:text-red-200 flex items-center transition">
                            PROFIL <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="open" @mouseover="open = true" @mouseleave="open = false" x-transition class="absolute mt-0 w-56 bg-white border shadow-lg rounded-md z-50 py-1">
                            <a href="{{ route('profil.profil-komisioner') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-red-700">Profil Komisioner</a>
                            <a href="{{ route('profil.struktur-komisioner') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-red-700">Struktur Komisioner</a>
                            <a href="{{ route('profil.tentang') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-red-700">Tentang</a>
                            <a href="{{ route('profil.visi-misi') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-red-700">Visi Misi</a>
                            <a href="{{ route('profil.struktur-sekretariat') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-red-700">Struktur Sekretariat</a>
                        </div>
                    </div>

                    {{-- Dropdown AGENDA --}}
                    <div class="relative" x-data="{ open: false }">
                        <button @mouseover="open = true" @mouseleave="open = false" class="px-3 py-2 text-sm font-medium text-white hover:text-red-200 flex items-center transition">
                            AGENDA <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="open" @mouseover="open = true" @mouseleave="open = false" x-transition class="absolute mt-0 w-56 bg-white border shadow-lg rounded-md z-50 py-1">
                            <a href="{{ route('agenda.agenda-komisioner') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-red-700">Agenda Komisioner</a>
                            <a href="{{ route('agenda.jadwal-sidang') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-red-700">Jadwal Sidang</a>
                        </div>
                    </div>

                    {{-- Dropdown LAPORAN --}}
                    <div class="relative" x-data="{ open: false }">
                        <button @mouseover="open = true" @mouseleave="open = false" class="px-3 py-2 text-sm font-medium text-white hover:text-red-200 flex items-center transition">
                            LAPORAN <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="open" @mouseover="open = true" @mouseleave="open = false" x-transition class="absolute mt-0 w-64 bg-white border shadow-lg rounded-md z-50 py-1">
                            <a href="{{ route('laporan.laporan-kinerja') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-red-700">Laporan Perkembangan Kinerja</a>
                            <a href="{{ route('laporan.laporan-evaluasi-KIP') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-red-700">Laporan Hasil Evaluasi KIP</a>
                            <a href="{{ route('laporan.laporan-KIP') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-red-700">Laporan KIP</a>
                        </div>
                    </div>

                    {{-- Dropdown REGULASI --}}
                    <div class="relative" x-data="{ open: false }">
                        <button @mouseover="open = true" @mouseleave="open = false" class="px-3 py-2 text-sm font-medium text-white hover:text-red-200 flex items-center transition">
                            REGULASI <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="open" @mouseover="open = true" @mouseleave="open = false" x-transition class="absolute mt-0 w-64 bg-white border shadow-lg rounded-md z-50 py-1">
                            <a href="{{ route('regulasi.undang-undang') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-red-700">Undang-Undang</a>
                            <a href="{{ route('regulasi.peraturan-pemerintahan') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-red-700">Peraturan Pemerintah</a>
                            <a href="{{ route('regulasi.peraturan-daerah') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-red-700">Peraturan Daerah</a>
                            {{-- Tambahkan link lainnya sesuai kebutuhan --}}
                        </div>
                    </div>

                    {{-- Dropdown INFORMASI PUBLIK --}}
                    <div class="relative" x-data="{ open: false }">
                        <button @mouseover="open = true" @mouseleave="open = false" class="px-3 py-2 text-sm font-medium text-white hover:text-red-200 flex items-center transition">
                            INFORMASI PUBLIK <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="open" @mouseover="open = true" @mouseleave="open = false" x-transition class="absolute right-0 mt-0 w-64 bg-white border shadow-lg rounded-md z-50 py-1">
                            <a href="{{ route('informasi-publik.putusan') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-red-700">Putusan</a>
                            <a href="{{ route('informasi-publik.informasi-berkala') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-red-700">Informasi Berkala</a>
                            <a href="{{ route('informasi-publik.dipa') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-red-700">DIPA</a>
                        </div>
                    </div>

                    {{-- 3. SEARCH BAR DESKTOP --}}
                    <div class="flex items-center ml-4">
                        <form action="{{ route('pencarian') }}" method="GET" class="relative">
                            <input type="text" name="q" placeholder="Cari..." class="border border-red-500 rounded-full py-1 px-4 pr-8 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-red-300 w-40 transition-all focus:w-56">
                            <button type="submit" class="absolute right-2 top-1.5 text-gray-400 hover:text-red-600">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </button>
                        </form>
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
            <div x-show="openMenu" x-transition class="lg:hidden bg-white border-t border-gray-200 pb-4 shadow-lg absolute w-full left-0 z-50">

                {{-- Mobile Search --}}
                <div class="p-4 border-b border-gray-100 bg-gray-50">
                    <form action="{{ route('pencarian') }}" method="GET" class="relative flex">
                        <input type="text" name="q" placeholder="Cari informasi..." class="w-full border border-gray-300 rounded-l-md py-2 px-4 text-sm focus:outline-none focus:ring-1 focus:ring-red-500">
                        <button type="submit" class="bg-red-600 text-white px-4 rounded-r-md hover:bg-red-700">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </button>
                    </form>
                </div>

                {{-- Mobile Links --}}
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <a href="{{ route('beranda') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-red-700 hover:bg-gray-50">BERANDA</a>

                    {{-- Mobile Dropdown: PROFIL --}}
                    <div x-data="{ subOpen: false }">
                        <button @click="subOpen = !subOpen" class="w-full flex justify-between items-center px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-red-700 hover:bg-gray-50 focus:outline-none">
                            <span>PROFIL</span>
                            <svg :class="{'rotate-180': subOpen}" class="h-4 w-4 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="subOpen" class="pl-6 space-y-1 bg-gray-50">
                            <a href="{{ route('profil.profil-komisioner') }}" class="block px-3 py-2 text-sm text-gray-600 hover:text-red-700">Profil Komisioner</a>
                            <a href="{{ route('profil.struktur-komisioner') }}" class="block px-3 py-2 text-sm text-gray-600 hover:text-red-700">Struktur Komisioner</a>
                            <a href="{{ route('profil.tentang') }}" class="block px-3 py-2 text-sm text-gray-600 hover:text-red-700">Tentang</a>
                            <a href="{{ route('profil.visi-misi') }}" class="block px-3 py-2 text-sm text-gray-600 hover:text-red-700">Visi Misi</a>
                            <a href="{{ route('profil.struktur-sekretariat') }}" class="block px-3 py-2 text-sm text-gray-600 hover:text-red-700">Struktur Sekretariat</a>
                        </div>
                    </div>

                    {{-- Mobile Dropdown: AGENDA --}}
                    <div x-data="{ subOpen: false }">
                        <button @click="subOpen = !subOpen" class="w-full flex justify-between items-center px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-red-700 hover:bg-gray-50 focus:outline-none">
                            <span>AGENDA</span>
                            <svg :class="{'rotate-180': subOpen}" class="h-4 w-4 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="subOpen" class="pl-6 space-y-1 bg-gray-50">
                            <a href="{{ route('agenda.agenda-komisioner') }}" class="block px-3 py-2 text-sm text-gray-600 hover:text-red-700">Agenda Komisioner</a>
                            <a href="{{ route('agenda.jadwal-sidang') }}" class="block px-3 py-2 text-sm text-gray-600 hover:text-red-700">Jadwal Sidang</a>
                        </div>
                    </div>

                    {{-- Mobile Dropdown: LAPORAN --}}
                    <div x-data="{ subOpen: false }">
                        <button @click="subOpen = !subOpen" class="w-full flex justify-between items-center px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-red-700 hover:bg-gray-50 focus:outline-none">
                            <span>LAPORAN</span>
                            <svg :class="{'rotate-180': subOpen}" class="h-4 w-4 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="subOpen" class="pl-6 space-y-1 bg-gray-50">
                            <a href="{{ route('laporan.laporan-kinerja') }}" class="block px-3 py-2 text-sm text-gray-600 hover:text-red-700">Laporan Kinerja</a>
                            <a href="{{ route('laporan.laporan-evaluasi-KIP') }}" class="block px-3 py-2 text-sm text-gray-600 hover:text-red-700">Laporan Evaluasi KIP</a>
                            <a href="{{ route('laporan.laporan-KIP') }}" class="block px-3 py-2 text-sm text-gray-600 hover:text-red-700">Laporan KIP</a>
                        </div>
                    </div>

                    {{-- Mobile Dropdown: REGULASI --}}
                    <div x-data="{ subOpen: false }">
                        <button @click="subOpen = !subOpen" class="w-full flex justify-between items-center px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-red-700 hover:bg-gray-50 focus:outline-none">
                            <span>REGULASI</span>
                            <svg :class="{'rotate-180': subOpen}" class="h-4 w-4 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="subOpen" class="pl-6 space-y-1 bg-gray-50">
                            <a href="{{ route('regulasi.undang-undang') }}" class="block px-3 py-2 text-sm text-gray-600 hover:text-red-700">Undang-Undang</a>
                            <a href="{{ route('regulasi.peraturan-pemerintahan') }}" class="block px-3 py-2 text-sm text-gray-600 hover:text-red-700">Peraturan Pemerintah</a>
                            <a href="{{ route('regulasi.peraturan-daerah') }}" class="block px-3 py-2 text-sm text-gray-600 hover:text-red-700">Peraturan Daerah</a>
                        </div>
                    </div>

                    {{-- Mobile Dropdown: INFORMASI PUBLIK --}}
                    <div x-data="{ subOpen: false }">
                        <button @click="subOpen = !subOpen" class="w-full flex justify-between items-center px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-red-700 hover:bg-gray-50 focus:outline-none">
                            <span>INFORMASI PUBLIK</span>
                            <svg :class="{'rotate-180': subOpen}" class="h-4 w-4 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="subOpen" class="pl-6 space-y-1 bg-gray-50">
                            <a href="{{ route('informasi-publik.putusan') }}" class="block px-3 py-2 text-sm text-gray-600 hover:text-red-700">Putusan</a>
                            <a href="{{ route('informasi-publik.informasi-berkala') }}" class="block px-3 py-2 text-sm text-gray-600 hover:text-red-700">Informasi Berkala</a>
                            <a href="{{ route('informasi-publik.dipa') }}" class="block px-3 py-2 text-sm text-gray-600 hover:text-red-700">DIPA</a>
                        </div>
                    </div>

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
