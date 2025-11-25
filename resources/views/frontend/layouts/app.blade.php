<!DOCTYPE html>
{{-- Kita tambahkan 'x-data' untuk Alpine.js --}}
<html lang="id" x-data="{ openMenu: false, openDropdown: null }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $page_title ?? 'Komisi Informasi Prov. Kalsel' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-200">

    {{-- =================================== --}}
        {{-- === BAGIAN HEADER & NAVBAR (SUDAH DIPERBAIKI) === --}}
        {{-- =================================== --}}
        <header class="bg-red-600 shadow-md sticky top-0 z-50">
            <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    {{-- Logo --}}
                    <div class="flex-shrink-0 **mr-6 lg:mr-10**">
                        <a href="{{ route('beranda') }}" class="flex items-center space-x-2">
                            {{-- Ganti dengan logo Anda --}}
                            <img class="h-10 w-auto" src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a2/Lambang_Provinsi_Kalimantan_Selatan.svg/1200px-Lambang_Provinsi_Kalimantan_Selatan.svg.png" alt="Logo KI Kalsel">
                            <span class="font-bold text-white hidden md:block">
                                KOMISI INFORMASI<br>Provinsi. Kalsel
                            </span>
                        </a>
                    </div>

                    {{-- Menu Desktop --}}
                    <div class="hidden md:flex **md:space-x-6 lg:space-x-8**">
                        <a href="{{ route('beranda') }}" class="px-3 py-2 text-sm font-medium text-white hover:text-black">BERANDA</a>

                        {{-- Dropdown Profil (PERBAIKAN DI SINI) --}}
                        <div class="relative" x-data="{ open: false }">
                            <button @mouseover="open = true" @mouseleave="open = false" class="px-3 py-2 text-sm font-medium text-white hover:text-black flex items-center">
                                PROFIL <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="open" @mouseover="open = true" @mouseleave="open = false" x-transition class="absolute mt-0 w-60 bg-white border shadow-lg rounded-md z-50">
                                <a href="{{ route('profil.profil-komisioner') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-400">Profil Komisioner</a>
                                <a href="{{ route('profil.struktur-komisioner') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-400">Struktur Komisioner</a>
                                <a href="{{ route('profil.tentang') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-400">Tentang</a>
                                <a href="{{ route('profil.visi-misi') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-400">Visi Misi</a>
                                <a href="{{ route('profil.struktur-sekretariat') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-400">Struktur Sekretariat</a>
                            </div>
                        </div>

                        {{-- Dropdown Agenda (PERBAIKAN DI SINI) --}}
                        <div class="relative" x-data="{ open: false }">
                            <button @mouseover="open = true" @mouseleave="open = false" class="px-3 py-2 text-sm font-medium text-white hover:text-black flex items-center">
                                AGENDA <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="open" @mouseover="open = true" @mouseleave="open = false" x-transition class="absolute mt-0 w-60 bg-white border shadow-lg rounded-md z-50">
                                <a href="{{ route('agenda.agenda-komisioner') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-400">Agenda Komisioner</a>
                                <a href="{{ route('agenda.jadwal-sidang') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-400">Jadwal Sidang</a>
                            </div>
                        </div>

                        {{-- Dropdown Laporan (PERBAIKAN DI SINI) --}}
                        <div class="relative" x-data="{ open: false }">
                            <button @mouseover="open = true" @mouseleave="open = false" class="px-3 py-2 text-sm font-medium text-white hover:text-black flex items-center">
                                LAPORAN <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="open" @mouseover="open = true" @mouseleave="open = false" x-transition class="absolute mt-0 w-60 bg-white border shadow-lg rounded-md z-50">
                                <a href="{{ route('laporan.laporan-kinerja') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-400">Laporan Perkembangan Kinerja</a>
                                <a href="{{ route('laporan.laporan-evaluasi-KIP') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-400">Laporan Hasil Evaluasi KIP</a>
                                <a href="{{ route('laporan.laporan-KIP') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-400">Laporan KIP</a>
                            </div>
                        </div>

                        {{-- Dropdown Regulasi (PERBAIKAN DI SINI) --}}
                        <div class="relative" x-data="{ open: false }">
                            <button @mouseover="open = true" @mouseleave="open = false" class="px-3 py-2 text-sm font-medium text-white hover:text-black flex items-center">
                                REGULASI <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="open" @mouseover="open = true" @mouseleave="open = false" x-transition class="absolute mt-0 w-64 bg-white border shadow-lg rounded-md z-50">
                                <a href="{{ route('regulasi.undang-undang') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-400">Undang-Undang</a>
                                <a href="{{ route('regulasi.peraturan-pemerintahan') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-400">Peraturan Pemerintah</a>
                                <a href="{{ route('regulasi.peraturan-daerah') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-400">Peraturan Daerah</a>
                                {{-- (Lengkapi link regulasi lainnya di sini jika perlu) --}}
                            </div>
                        </div>

                        {{-- Dropdown Informasi Publik (PERBAIKAN DI SINI) --}}
                        <div class="relative" x-data="{ open: false }">
                            <button @mouseover="open = true" @mouseleave="open = false" class="px-3 py-2 text-sm font-medium text-white hover:text-black flex items-center">
                                INFORMASI PUBLIK <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="open" @mouseover="open = true" @mouseleave="open = false" x-transition class="absolute right-0 mt-0 w-64 bg-white border shadow-lg rounded-md z-50">
                                <a href="{{ route('informasi-publik.putusan') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-400">Putusan</a>
                                <a href="{{ route('informasi-publik.informasi-berkala') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-400">Informasi Berkala</a>
                                <a href="{{ route('informasi-publik.dipa') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-400">DIPA</a>
                                {{-- (Lengkapi link info publik lainnya di sini jika perlu) --}}
                            </div>
                        </div>
                    </div>
                    <div class="hidden md:flex items-center ml-4">
                    <form action="{{ route('pencarian') }}" method="GET" class="relative">
                        <input type="text" name="q" placeholder="Cari..." class="border border-gray-300 rounded-full py-1 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-red-500">
                        <button type="submit" class="absolute right-2 top-1.5 text-gray-500 hover:text-red-600">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </button>
                    </form>
                </div>

                    {{-- Tombol Hamburger Menu (Mobile) --}}
                    <div class="md:hidden flex items-center">
                        <button @click="openMenu = !openMenu" class="text-gray-700 hover:text-indigo-600">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                        </button>
                    </div>
                </div>

                {{-- Menu Mobile (Muncul saat 'openMenu' true) --}}
                <div x-show="openMenu" x-transition class="md:hidden bg-white border-t">
                    <a href="{{ route('beranda') }}" class="block px-4 py-2 text-base font-medium text-gray-700 hover:bg-gray-100">BERANDA</a>
                    {{-- TODO: Buat dropdown mobile --}}
                    <span class="block px-4 py-2 text-base font-medium text-gray-500">(Menu mobile belum selesai)</span>
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
