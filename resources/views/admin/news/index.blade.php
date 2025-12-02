<x-app-layout>
    <x-slot name="header">
        {{-- Judul Halaman Saja --}}
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Berita') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Pesan Sukses --}}
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{--
                    HEADER TABEL: PENCARIAN (KIRI) & TOMBOL TAMBAH (KANAN)
                    Kita gunakan 'flex justify-between' untuk memisahkan kiri dan kanan.
                --}}
                <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6">

                    {{-- KIRI: Form Pencarian --}}
                    <form action="{{ route('admin.news.index') }}" method="GET" class="flex items-center w-full md:w-auto">
                        <input type="text" name="search"
                               value="{{ request('search') }}"
                               placeholder="Cari judul berita..."
                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-l-md shadow-sm w-full md:w-64 text-sm">

                        <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-r-md hover:bg-gray-700 transition text-sm font-semibold border border-gray-800">
                            Cari
                        </button>

                        @if(request('search'))
                            <a href="{{ route('admin.news.index') }}" class="ml-3 text-indigo-600 hover:text-indigo-900 underline text-sm">
                                Reset
                            </a>
                        @endif
                    </form>

                    {{-- KANAN: Tombol Tambah Berita --}}
                    <a href="{{ route('admin.news.create') }}" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 shadow-sm transition duration-150 ease-in-out flex items-center text-sm font-semibold">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Tulis Berita Baru
                    </a>

                </div>

                {{-- TABEL --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 border">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider w-24">
                                    Gambar
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                    Judul
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider w-32">
                                    Kategori
                                </th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider w-32">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($news as $item)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap align-middle">
                                        @if($item->image_path)
                                            <img src="{{ Storage::url($item->image_path) }}" class="w-16 h-12 object-cover rounded border border-gray-200">
                                        @else
                                            <div class="w-16 h-12 bg-gray-100 rounded border border-gray-200 flex items-center justify-center text-xs text-gray-400">No img</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 align-middle">
                                        <div class="text-sm font-medium text-gray-900 line-clamp-2">{{ $item->title }}</div>
                                        <div class="text-xs text-gray-500 mt-1">{{ $item->created_at->format('d M Y') }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap align-middle">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 capitalize">
                                            {{ $item->category }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium align-middle">
                                        <div class="flex justify-center items-center space-x-3">
                                            <a href="{{ route('admin.news.edit', $item) }}" class="text-indigo-600 hover:text-indigo-900 font-semibold">Edit</a>
                                            <form action="{{ route('admin.news.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus berita ini?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 font-semibold">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-10 text-center text-gray-500">
                                        <svg class="mx-auto h-12 w-12 text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9"></path></svg>
                                        <p class="text-sm">Belum ada berita yang ditambahkan.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
