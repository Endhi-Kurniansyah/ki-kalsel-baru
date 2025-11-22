<x-frontend-layout :page_title="'Hasil Pencarian: ' . $keyword">

    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 md:p-12">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Hasil Pencarian</h1>
            <p class="text-gray-600 mb-8">Menampilkan hasil untuk kata kunci: <span class="font-bold text-red-600">"{{ $keyword }}"</span></p>

            {{-- Cek jika tidak ada hasil sama sekali --}}
            @if($newsResults->isEmpty() && $docResults->isEmpty() && $pageResults->isEmpty())
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-yellow-700">
                                Maaf, tidak ditemukan data yang cocok dengan kata kunci tersebut.
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="space-y-12">

                {{-- HASIL 1: BERITA --}}
                @if($newsResults->isNotEmpty())
                    <section>
                        <h2 class="text-xl font-bold text-gray-800 border-b pb-2 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                            Berita Ditemukan ({{ $newsResults->count() }})
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($newsResults as $news)
                                <div class="flex bg-gray-50 rounded-lg p-4 hover:shadow-md transition">
                                    @if($news->image_path)
                                        <img src="{{ Storage::url($news->image_path) }}" class="w-24 h-24 object-cover rounded mr-4 flex-shrink-0">
                                    @endif
                                    <div>
                                        <a href="{{ route('berita.detail', $news->slug) }}" class="text-lg font-bold text-indigo-700 hover:underline">
                                            {{ $news->title }}
                                        </a>
                                        <p class="text-xs text-gray-500 mt-1">{{ $news->created_at->format('d M Y') }}</p>
                                        <p class="text-sm text-gray-600 mt-2 line-clamp-2">
                                            {{ strip_tags($news->content) }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>
                @endif

                {{-- HASIL 2: DOKUMEN --}}
                @if($docResults->isNotEmpty())
                    <section>
                        <h2 class="text-xl font-bold text-gray-800 border-b pb-2 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            Dokumen Ditemukan ({{ $docResults->count() }})
                        </h2>
                        <ul class="space-y-3">
                            @foreach($docResults as $doc)
                                <li class="flex items-start">
                                    <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded mr-3 mt-0.5">PDF</span>
                                    <div>
                                        <a href="{{ Storage::url($doc->file_path) }}" target="_blank" class="font-medium text-indigo-700 hover:underline block">
                                            {{ $doc->title }}
                                        </a>
                                        <span class="text-xs text-gray-500">Kategori: {{ $doc->category }}</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </section>
                @endif

                {{-- HASIL 3: HALAMAN --}}
                @if($pageResults->isNotEmpty())
                    <section>
                        <h2 class="text-xl font-bold text-gray-800 border-b pb-2 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Halaman Profil/Info ({{ $pageResults->count() }})
                        </h2>
                        <ul class="list-disc list-inside space-y-2 text-gray-700">
                            @foreach($pageResults as $page)
                                <li>
                                    {{-- Kita perlu trik sedikit untuk link halaman statis karena rutenya beda-beda --}}
                                    <a href="{{ url('/profil/' . $page->slug) }}" class="font-medium text-indigo-700 hover:underline">
                                        {{ $page->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </section>
                @endif

            </div>
        </div>
    </div>

</x-frontend-layout>
