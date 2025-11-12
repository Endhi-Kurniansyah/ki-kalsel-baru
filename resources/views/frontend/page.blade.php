{{-- Gunakan layout 'frontend.layouts.app' --}}
<x-frontend-layout :page_title="$page->title">

    {{-- Konten ini akan "disuntikkan" ke dalam '{{ $slot }}' di layout --}}
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 md:p-12 text-gray-900">

            <h1 class="text-4xl font-bold mb-6 text-gray-800">{{ $page->title }}</h1>

            <div class="prose prose-lg max-w-none">
                {!! $page->content !!}
            </div>

        </div>
    </div>

</x-frontend-layout>
