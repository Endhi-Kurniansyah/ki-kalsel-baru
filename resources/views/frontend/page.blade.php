<x-frontend-layout :page_title="$page->title">

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 md:p-12 text-gray-900">

            {{-- Header Judul dengan Garis Bawah --}}
            <div class="border-b-2 border-red-500 pb-2 mb-8 inline-block">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-800">{{ $page->title }}</h1>
            </div>

            {{--
                PROSE: Ini kelas ajaib Tailwind untuk merapikan teks artikel.
                'prose-lg' = ukuran font lebih besar
                'prose-red' = link/aksen berwarna merah
                'max-w-none' = agar lebar teks menyesuaikan kontainer
            --}}
            <div class="prose prose-lg prose-red max-w-none text-gray-700 leading-relaxed">
                {!! $page->content !!}
            </div>

        </div>
    </div>

</x-frontend-layout>
