<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Kelola Dokumen (Laporan, Regulasi, dll.)') }}
            </h2>

            {{-- Tombol 'Tambah Dokumen Baru' --}}
            <a href="{{ route('admin.documents.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
                + Tambah Dokumen Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Tampilkan pesan sukses jika ada --}}
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="p-6 text-gray-900">

                    {{-- === FORM PENCARIAN DOKUMEN === --}}
                    <div class="mb-4">
                        <form action="{{ route('admin.documents.index') }}" method="GET">
                            <div class="flex items-center">
                                <input type="text" name="search"
                                       value="{{ request('search') }}"
                                       placeholder="Cari judul dokumen atau kategori..."
                                       class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-64 mr-2">

                                <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-gray-700 transition">
                                    Cari
                                </button>

                                {{-- Tombol Reset (muncul jika sedang mencari) --}}
                                @if(request('search'))
                                    <a href="{{ route('admin.documents.index') }}" class="ml-2 text-gray-600 hover:text-gray-900 underline">
                                        Reset
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                    {{-- ============================== --}}

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul Dokumen</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">File</th>
                                <th class="relative px-6 py-3"><span class="sr-only">Aksi</span></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($documents as $doc)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $doc->title }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $doc->category }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <a href="{{ Storage::url($doc->file_path) }}" target="_blank" class="text-indigo-600 hover:text-indigo-900">Lihat File</a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('admin.documents.edit', $doc) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                        {{-- ... (tombol Edit masih ada) ... --}}
                                        {{-- FORM UNTUK DELETE --}}
                                        <form action="{{ route('admin.documents.destroy', $doc) }}" method="POST" class="inline-block ml-4">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="text-red-600 hover:text-red-900"
                                                    onclick="return confirm('Anda yakin ingin menghapus dokumen ini?')">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                        Belum ada dokumen yang di-upload.
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
