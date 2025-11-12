{{-- Kita gunakan layout frontend yang sudah ada --}}
<x-frontend-layout page_title="Beranda - Komisi Informasi Prov. Kalsel">

    {{-- 1. Hero Section (Seperti di screenshot Anda) --}}
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
        {{-- Ganti URL gambar ini dengan gambar Anda sendiri --}}
        <div class="p-6 md:p-12 text-gray-900 relative h-96 bg-cover bg-center" style="background-image: url('https://diskominfo.kalselprov.go.id/wp-content/uploads/2021/08/Gedung-DPRD-Prov-Kalsel-1-1024x576.jpg');">
            {{-- Overlay gelap agar teks terbaca --}}
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

    {{-- 2. Link Cepat (Seperti di screenshot Anda) --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
        <a href="#" class="block bg-blue-600 text-white p-6 rounded-lg shadow-md hover:bg-blue-700 transition">
            <h3 class="text-2xl font-bold mb-2">E-PPID</h3>
            <p>Kunjungi &rarr;</p>
        </a>
        <a href="#" class="block bg-blue-600 text-white p-6 rounded-lg shadow-md hover:bg-blue-700 transition">
            <h3 class="text-2xl font-bold mb-2">SIPSI</h3>
            <p>Kunjungi &rarr;</p>
        </a>
        <a href="#" class="block bg-blue-600 text-white p-6 rounded-lg shadow-md hover:bg-blue-700 transition">
            <h3 class="text-2xl font-bold mb-2">JDIH</h3>
            <p>Kunjungi &rarr;</p>
        </a>
        <a href="#" class="block bg-blue-600 text-white p-6 rounded-lg shadow-md hover:bg-blue-700 transition">
            <h3 class="text-2xl font-bold mb-2">E-MONEV</h3>
            <p>Kunjungi &rarr;</p>
        </a>
    </div>

    {{-- 3. Konten Dinamis (Agenda & Dokumen Terbaru) --}}
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
