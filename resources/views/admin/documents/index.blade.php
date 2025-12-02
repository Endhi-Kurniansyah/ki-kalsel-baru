<x-app-layout>
    <x-slot name="header">
        {{-- Judul Halaman Dinamis Sesuai Filter (Hanya Teks) --}}
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if(request('type') == 'laporan')
                Kelola Dokumen Laporan
            @elseif(request('type') == 'regulasi')
                Kelola Dokumen Regulasi
            @elseif(request('type') == 'informasi-publik')
                Kelola Informasi Publik
            @else
                Kelola Semua Dokumen
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{-- HEADER KONTEN: SEARCH & TOMBOL TAMBAH --}}
                <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">

                    {{-- Form Pencarian --}}
                    <form action="{{ route('admin.documents.index') }}" method="GET" class="flex items-center w-full md:w-auto">
                        @if(request('type'))
                            <input type="hidden" name="type" value="{{ request('type') }}">
                        @endif
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari dokumen..." class="border-gray-300 rounded-l-md text-sm w-full md:w-64 focus:ring-indigo-500 focus:border-indigo-500">
                        <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-r-md hover:bg-gray-700 text-sm border border-gray-800">Cari</button>
                        @if(request('search'))
                            <a href="{{ route('admin.documents.index', ['type' => request('type')]) }}" class="ml-2 text-sm text-gray-600 underline">Reset</a>
                        @endif
                    </form>

                    {{-- Tombol Tambah (Mengirim parameter type agar form inputnya sesuai) --}}
                    <a href="{{ route('admin.documents.create', ['type' => request('type')]) }}" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 shadow-sm flex items-center gap-2 text-sm font-semibold whitespace-nowrap">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Tambah Dokumen
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 border">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Judul Dokumen</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Kategori</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">File</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($documents as $doc)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $doc->title }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">{{ str_replace('-', ' ', $doc->category) }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        <a href="{{ Storage::url($doc->file_path) }}" target="_blank" class="text-indigo-600 hover:underline flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                                            Lihat
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 text-right text-sm font-medium">
                                        <div class="flex justify-center gap-3">
                                            <a href="{{ route('admin.documents.edit', $doc) }}" class="text-indigo-600 hover:text-indigo-900 font-semibold">Edit</a>
                                            <form action="{{ route('admin.documents.destroy', $doc) }}" method="POST" onsubmit="return confirm('Hapus dokumen ini?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 font-semibold">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="px-6 py-10 text-center text-gray-500">Belum ada dokumen.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
