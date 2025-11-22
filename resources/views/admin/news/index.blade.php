<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola Berita</h2>
            <a href="{{ route('admin.news.create') }}" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">+ Tulis Berita</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">{{ session('success') }}</div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{-- Pencarian --}}
                <div class="mb-4">
                    <form action="{{ route('admin.news.index') }}" method="GET">
                        <div class="flex items-center">
                            <input type="text" name="search"
                                   value="{{ request('search') }}"
                                   placeholder="Cari judul berita atau kategori..."
                                   class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-64 mr-2">

                            <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-gray-700 transition">
                                Cari
                            </button>

                            {{-- Tombol Reset --}}
                            @if(request('search'))
                                <a href="{{ route('admin.news.index') }}" class="ml-2 text-gray-600 hover:text-gray-900 underline">
                                    Reset
                                </a>
                            @endif
                        </div>
                    </form>
                </div>

                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Gambar</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Judul</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($news as $item)
                            <tr>
                                <td class="px-6 py-4">
                                    @if($item->image_path)
                                        <img src="{{ Storage::url($item->image_path) }}" class="w-16 h-16 object-cover rounded">
                                    @else
                                        <span class="text-xs text-gray-400">No Image</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 font-medium">{{ $item->title }}</td>
                                <td class="px-6 py-4"><span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">{{ $item->category }}</span></td>
                                <td class="px-6 py-4 flex space-x-2">
                                    <a href="{{ route('admin.news.edit', $item) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    <form action="{{ route('admin.news.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus berita ini?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="px-6 py-4 text-center text-gray-500">Belum ada berita.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
