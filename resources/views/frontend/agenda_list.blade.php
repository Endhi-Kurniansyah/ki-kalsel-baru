<x-frontend-layout :page_title="$page_title">

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 md:p-12 text-gray-900">

            <h1 class="text-4xl font-bold mb-6 text-gray-800">{{ $page_title }}</h1>

            <div class="space-y-6">
                @forelse ($agendas as $agenda)
                    <div class="border rounded-lg p-6 bg-white shadow-sm">
                        <h3 class="text-2xl font-semibold text-indigo-700">{{ $agenda->title }}</h3>
                        <div class="text-sm text-gray-500 mt-2">
                            <span class="font-medium">Waktu:</span>
                            {{ $agenda->start_time->format('d M Y, H:i') }}
                            @if ($agenda->end_time)
                                - {{ $agenda->end_time->format('d M Y, H:i') }}
                            @endif
                        </div>
                        <div class="text-sm text-gray-500 mt-1">
                            <span class="font-medium">Lokasi:</span>
                            {{ $agenda->location }}
                        </div>
                        @if ($agenda->description)
                            <p class="mt-4 text-gray-700">{{ $agenda->description }}</p>
                        @endif
                    </div>
                @empty
                    <div class="border rounded-lg p-6 bg-white shadow-sm text-center">
                        <p class="text-gray-500">Belum ada agenda untuk kategori ini.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>

</x-frontend-layout>
