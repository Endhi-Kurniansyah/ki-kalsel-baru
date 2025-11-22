<x-frontend-layout :page_title="$news->title">

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        {{-- Gambar Utama (Full Width) --}}
        @if($news->image_path)
            <div class="w-full h-96 bg-gray-200">
                <img src="{{ Storage::url($news->image_path) }}" alt="{{ $news->title }}" class="w-full h-full object-cover">
            </div>
        @endif

        <div class="p-6 md:p-12 text-gray-900 max-w-4xl mx-auto">

            {{-- Kategori & Tanggal --}}
            <div class="flex items-center space-x-4 text-sm text-gray-500 mb-4">
                <span class="bg-red-100 text-red-800 px-2 py-1 rounded font-bold uppercase text-xs">
                    {{ $news->category }}
                </span>
                <span>{{ $news->created_at->format('d F Y, H:i') }} WIB</span>
            </div>

            {{-- Judul Berita --}}
            <h1 class="text-3xl md:text-5xl font-bold mb-8 text-gray-900 leading-tight">
                {{ $news->title }}
            </h1>

            {{-- Isi Berita (Render HTML dari CKEditor) --}}
            <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                {!! $news->content !!}
            </div>

            {{-- Tombol Kembali --}}
            <div class="mt-12 pt-8 border-t">
                <a href="{{ route('beranda') }}" class="text-indigo-600 hover:text-indigo-800 font-semibold">
                    &larr; Kembali ke Beranda
                </a>
            </div>

        </div>
    </div>

</x-frontend-layout>
