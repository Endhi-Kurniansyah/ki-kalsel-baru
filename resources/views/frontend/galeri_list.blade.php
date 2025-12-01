<x-frontend-layout :page_title="$page_title">

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" x-data="{ showModal: false, activeMedia: '', activeType: '', activeTitle: '' }">
        <div class="p-6 md:p-12 text-gray-900">

            <div class="border-b border-gray-200 pb-4 mb-8 flex justify-between items-center">
                <h1 class="text-3xl font-bold text-gray-800">{{ $page_title }}</h1>
            </div>

            {{-- Grid Galeri --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @forelse ($galleries as $gallery)
                    @php
                        // Cek apakah file adalah video berdasarkan ekstensi
                        $extension = pathinfo($gallery->image_path, PATHINFO_EXTENSION);
                        $isVideo = in_array(strtolower($extension), ['mp4', 'webm', 'ogg']);
                    @endphp

                    <div class="relative group cursor-pointer overflow-hidden rounded-lg shadow-sm hover:shadow-lg transition-all duration-300 bg-gray-100 aspect-square"
                         @click="showModal = true; activeMedia = '{{ Storage::url($gallery->image_path) }}'; activeType = '{{ $isVideo ? 'video' : 'image' }}'; activeTitle = '{{ $gallery->title }}'">

                        @if($isVideo)
                            {{-- Tampilan Thumbnail Video --}}
                            <div class="w-full h-full flex items-center justify-center bg-gray-800">
                                <video class="object-cover w-full h-full opacity-80" muted>
                                    <source src="{{ Storage::url($gallery->image_path) }}" type="video/{{ $extension }}">
                                </video>
                                {{-- Icon Play di tengah --}}
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <svg class="w-12 h-12 text-white opacity-80" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path></svg>
                                </div>
                            </div>
                        @else
                            {{-- Tampilan Foto Biasa --}}
                            <img src="{{ Storage::url($gallery->image_path) }}"
                                 alt="{{ $gallery->title }}"
                                 class="object-cover w-full h-full transform transition-transform duration-500 group-hover:scale-110">
                        @endif

                        {{-- Overlay Info --}}
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 flex items-end">
                            <div class="p-4 w-full translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                                <p class="text-white font-bold text-sm truncate">{{ $gallery->title }}</p>
                                <p class="text-gray-200 text-xs">{{ $isVideo ? 'Video' : 'Foto' }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 bg-gray-50 rounded-lg border border-dashed border-gray-300">
                        <p class="text-gray-500">Belum ada foto atau video di galeri.</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- MODAL LIGHTBOX (POP-UP) --}}
        <div x-show="showModal"
             style="display: none;"
             class="fixed inset-0 z-[9999] flex items-center justify-center bg-black bg-opacity-95 p-4 backdrop-blur-sm"
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

            {{-- Container Media --}}
            <div class="relative max-w-5xl w-full max-h-full flex flex-col items-center justify-center" @click.away="showModal = false">

                {{-- Jika VIDEO --}}
                <template x-if="activeType === 'video'">
                    <video :src="activeMedia" controls autoplay class="max-w-full max-h-[80vh] rounded shadow-lg outline-none bg-black"></video>
                </template>

                {{-- Jika FOTO --}}
                <template x-if="activeType === 'image'">
                    <img :src="activeMedia" class="max-w-full max-h-[80vh] object-contain rounded shadow-lg bg-white" alt="Preview">
                </template>

                <p class="text-white mt-4 text-lg font-semibold text-center" x-text="activeTitle"></p>
            </div>
        </div>
    </div>

</x-frontend-layout>
