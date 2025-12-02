<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola Galeri</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">{{ session('success') }}</div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{-- HEADER KONTEN: JUDUL & TOMBOL TAMBAH --}}
                <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                    <h3 class="text-lg font-medium text-gray-900">Daftar Galeri Kegiatan</h3>

                    <a href="{{ route('admin.galleries.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 flex items-center gap-2 shadow-sm transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Tambah Foto
                    </a>
                </div>

                {{-- GRID GALERI --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @forelse ($galleries as $gallery)
                        <div class="border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition bg-gray-50 relative group">
                            <img src="{{ Storage::url($gallery->image_path) }}" alt="{{ $gallery->title }}" class="w-full h-48 object-cover">

                            <div class="p-4">
                                <h3 class="font-bold text-gray-800 truncate">{{ $gallery->title }}</h3>
                                <p class="text-xs text-gray-500 mt-1">{{ $gallery->created_at->format('d M Y') }}</p>
                            </div>

                            {{-- Tombol Aksi (Edit & Hapus) --}}
                            <div class="absolute top-2 right-2 flex space-x-2 opacity-0 group-hover:opacity-100 transition">
                                <a href="{{ route('admin.galleries.edit', $gallery) }}" class="bg-yellow-400 text-white p-2 rounded-full hover:bg-yellow-500 shadow">
                                    ✏️
                                </a>
                                <form action="{{ route('admin.galleries.destroy', $gallery) }}" method="POST" onsubmit="return confirm('Hapus foto ini?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white p-2 rounded-full hover:bg-red-600 shadow">🗑️</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-10 text-gray-500 border-2 border-dashed border-gray-300 rounded-lg">
                            <p>Belum ada foto di galeri.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
