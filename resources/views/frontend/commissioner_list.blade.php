<x-frontend-layout :page_title="$page_title">

    {{-- Tambahkan x-data untuk mengelola state Modal Gambar (Alpine.js) --}}
    <div x-data="{ showModal: false, activeImage: '' }" class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 md:p-12 text-gray-900">

            {{-- Header Halaman --}}
            <div class="border-b border-gray-200 pb-4 mb-8">
                <h1 class="text-3xl font-bold text-gray-800">{{ $page_title }}</h1>
            </div>

            {{-- Intro Text --}}
            @if(isset($page) && $page->content)
                <div class="prose max-w-none mb-10 text-gray-600 bg-gray-50 p-6 rounded-lg border border-gray-100">
                    {!! $page->content !!}
                </div>
            @endif

            {{--
               LAYOUT FULL WIDTH (1 Kolom ke bawah)
            --}}
            <div class="space-y-8">
                @forelse ($commissioners as $commissioner)
                    <div class="flex flex-col md:flex-row bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md transition-shadow overflow-hidden w-full">

                        {{--
                            BAGIAN FOTO (Poster)
                            - Klik untuk memperbesar
                            - Cursor pointer
                        --}}
                        <div class="md:w-1/4 lg:w-1/5 bg-gray-100 relative group flex-shrink-0 cursor-pointer"
                             @click="showModal = true; activeImage = '{{ Storage::url($commissioner->photo_path) }}'">

                            {{-- Container gambar dengan tinggi tetap di HP, full di Desktop --}}
                            <div class="h-96 md:h-full w-full relative">
                                <img src="{{ Storage::url($commissioner->photo_path) }}"
                                     alt="{{ $commissioner->name }}"
                                     class="absolute inset-0 w-full h-full object-cover object-top transition-transform duration-500 group-hover:scale-105 group-hover:opacity-90">

                                {{-- Overlay icon kaca pembesar saat hover --}}
                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 flex items-center justify-center">
                                    <span class="opacity-0 group-hover:opacity-100 bg-white text-gray-800 text-xs font-bold px-3 py-1 rounded-full shadow-lg transform translate-y-4 group-hover:translate-y-0 transition-all duration-300">
                                        🔍 Klik untuk perbesar
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- BAGIAN INFORMASI --}}
                        <div class="p-6 md:p-8 md:w-3/4 lg:w-4/5 flex flex-col">
                            <div class="mb-3">
                                <span class="inline-block py-1 px-3 rounded-md bg-red-600 text-white text-xs font-bold tracking-wider uppercase shadow-sm">
                                    Pejabat KI
                                </span>
                            </div>

                            <h3 class="text-3xl font-bold text-gray-900 mb-2 leading-tight">
                                {{ $commissioner->name }}
                            </h3>

                            <p class="text-xl font-medium text-red-600 mb-6 border-b border-gray-100 pb-4">
                                {{ $commissioner->position }}
                            </p>

                            @if ($commissioner->bio)
                                <div class="text-gray-700 leading-relaxed text-base">
                                    {{-- Menampilkan bio dengan format paragraf yang rapi --}}
                                    {!! nl2br(e($commissioner->bio)) !!}
                                </div>
                            @else
                                <p class="text-sm text-gray-400 italic">Tidak ada deskripsi tambahan.</p>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12 bg-gray-50 rounded-lg border border-dashed border-gray-300">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        <p class="mt-2 text-gray-500 font-medium">Belum ada data komisioner yang diinput.</p>
                    </div>
                @endforelse
            </div>

        </div>

        {{--
            MODAL POPUP GAMBAR (ALPINE.JS)
            Ini akan muncul saat gambar diklik
        --}}
        <div x-show="showModal"
             style="display: none;"
             class="fixed inset-0 z-[9999] flex items-center justify-center bg-black bg-opacity-90 p-4 backdrop-blur-sm"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">

            {{-- Tombol Close --}}
            <button @click="showModal = false" class="absolute top-4 right-4 text-white hover:text-red-500 z-50">
                <svg class="w-10 h-10 drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            {{-- Gambar Full --}}
            <div class="relative w-full h-full flex items-center justify-center" @click.away="showModal = false">
                <img :src="activeImage"
                     class="max-w-full max-h-full object-contain rounded shadow-2xl"
                     alt="Preview">
            </div>
        </div>

    </div>

</x-frontend-layout>
