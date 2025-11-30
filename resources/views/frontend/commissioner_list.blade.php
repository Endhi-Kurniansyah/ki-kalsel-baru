<x-frontend-layout :page_title="$page_title">

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 md:p-12 text-gray-900">

            <h1 class="text-4xl font-bold mb-8 text-gray-800">{{ $page_title }}</h1>
            {{-- Tampilkan Intro dari Kelola Halaman (Jika ada) --}}
            @if(isset($page) && $page->content)
                <div class="prose max-w-none mb-10 text-gray-600">
                    {!! $page->content !!}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($commissioners as $commissioner)
                    <div class="border rounded-lg bg-white shadow-md overflow-hidden">
                        <img src="{{ Storage::url($commissioner->photo_path) }}" alt="{{ $commissioner->name }}" class="w-full h-56 object-cover">
                        <div class="p-6">
                            <h3 class="text-2xl font-semibold text-gray-900">{{ $commissioner->name }}</h3>
                            <p class="text-md font-medium text-indigo-600 mt-1">{{ $commissioner->position }}</p>
                            @if ($commissioner->bio)
                                <p class="mt-4 text-sm text-gray-600">{{ $commissioner->bio }}</p>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-1 md:col-span-3 text-center">
                        <p class="text-gray-500">Belum ada data komisioner.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>

</x-frontend-layout>
