<x-frontend-layout :page_title="$page_title">

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 md:p-12 text-gray-900">

            <h1 class="text-4xl font-bold mb-6 text-gray-800">{{ $page_title }}</h1>

            <div class="space-y-6">
                @forelse ($agendas as $agenda)
                    <div class="border rounded-lg p-6 bg-white shadow-sm hover:shadow-md transition">
                        <h3 class="text-2xl font-semibold text-indigo-700">{{ $agenda->title }}</h3>

                        <div class="text-sm text-gray-500 mt-2 flex flex-col sm:flex-row sm:space-x-6">
                            <div class="flex items-center mb-1 sm:mb-0">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <span class="font-medium mr-1">Waktu:</span>
                                {{ $agenda->start_time->format('d M Y, H:i') }}
                                @if ($agenda->end_time)
                                    - {{ $agenda->end_time->format('d M Y, H:i') }}
                                @endif
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <span class="font-medium mr-1">Lokasi:</span>
                                {{ $agenda->location }}
                            </div>
                        </div>

                        @if ($agenda->description)
                            <p class="mt-4 text-gray-700 leading-relaxed">{{ $agenda->description }}</p>
                        @endif

                        {{-- 👇 INI YANG KITA TAMBAHKAN: TOMBOL DOWNLOAD LAMPIRAN 👇 --}}
                        @if ($agenda->file_path)
                            <div class="mt-5 pt-4 border-t border-gray-100">
                                <a href="{{ Storage::url($agenda->file_path) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-red-50 text-red-700 text-sm font-semibold rounded hover:bg-red-100 transition">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    Download Undangan / Lampiran
                                </a>
                            </div>
                        @endif

                    </div>
                @empty
                    <div class="border rounded-lg p-8 bg-white shadow-sm text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <p class="mt-2 text-gray-500 font-medium">Belum ada agenda untuk kategori ini.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>

</x-frontend-layout>
