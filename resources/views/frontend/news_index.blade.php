<x-frontend-layout :page_title="$page_title">

    <div class="max-w-7xl mx-auto">

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 md:p-12">

            <h1 class="text-3xl font-bold text-gray-800 mb-8 border-b pb-4">{{ $page_title }}</h1>

            {{-- FORM FILTER --}}
            <div class="bg-gray-50 p-4 rounded-lg mb-8 border border-gray-200">
                <form action="{{ route('berita.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">

                    {{-- Search Keyword --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Cari Judul</label>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Kata kunci..."
                               class="w-full border-gray-300 rounded-md text-sm focus:ring-red-500 focus:border-red-500">
                    </div>

                    {{-- Filter Kategori --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                        <select name="kategori" class="w-full border-gray-300 rounded-md text-sm focus:ring-red-500 focus:border-red-500">
                            <option value="">Semua Kategori</option>
                            <option value="kegiatan" {{ request('kategori') == 'kegiatan' ? 'selected' : '' }}>Berita Kegiatan</option>
                            <option value="sidang" {{ request('kategori') == 'sidang' ? 'selected' : '' }}>Berita Sidang</option>
                            <option value="umum" {{ request('kategori') == 'umum' ? 'selected' : '' }}>Berita Umum</option>
                        </select>
                    </div>

                    {{-- Filter Tahun --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tahun</label>
                        <select name="tahun" class="w-full border-gray-300 rounded-md text-sm focus:ring-red-500 focus:border-red-500">
                            <option value="">Semua Tahun</option>
                            @for($i = date('Y'); $i >= 2020; $i--)
                                <option value="{{ $i }}" {{ request('tahun') == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    {{-- Tombol Filter --}}
                    <div class="flex items-end">
                        <button type="submit" class="w-full bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700 transition font-semibold text-sm">
                            Filter Berita
                        </button>
                    </div>
                </form>
            </div>

            {{-- LIST BERITA --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($allNews as $news)
                    <div class="bg-white rounded-lg shadow-sm border hover:shadow-md transition group flex flex-col h-full">
                        {{-- Gambar --}}
                        <div class="relative h-48 overflow-hidden rounded-t-lg bg-gray-100">
                            @if($news->image_path)
                                <img src="{{ Storage::url($news->image_path) }}" alt="{{ $news->title }}"
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                            <div class="absolute top-2 left-2">
                                <span class="bg-red-600 text-white text-xs font-bold px-2 py-1 rounded uppercase shadow-sm">
                                    {{ $news->category }}
                                </span>
                            </div>
                        </div>

                        {{-- Konten --}}
                        <div class="p-5 flex flex-col flex-grow">
                            <div class="text-xs text-gray-500 mb-2 flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{ $news->created_at->format('d M Y') }}
                            </div>

                            <h3 class="text-lg font-bold text-gray-800 mb-2 line-clamp-2 group-hover:text-red-600 transition">
                                <a href="{{ route('berita.detail', $news->slug) }}">
                                    {{ $news->title }}
                                </a>
                            </h3>

                            <div class="text-gray-600 text-sm line-clamp-3 mb-4 flex-grow">
                                {{ Str::limit(strip_tags($news->content), 100) }}
                            </div>

                            <a href="{{ route('berita.detail', $news->slug) }}" class="text-red-600 text-sm font-semibold hover:underline mt-auto inline-flex items-center">
                                Baca Selengkapnya
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12 bg-gray-50 rounded-lg border border-dashed border-gray-300">
                        <p class="text-gray-500 text-lg">Tidak ada berita ditemukan.</p>
                        <a href="{{ route('berita.index') }}" class="text-indigo-600 hover:underline mt-2 inline-block text-sm">Reset Filter</a>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="mt-8">
                {{ $allNews->withQueryString()->links() }}
            </div>

        </div>
    </div>

</x-frontend-layout>
