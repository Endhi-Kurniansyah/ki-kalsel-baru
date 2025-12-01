<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ganti Banner: {{ $page->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- Tombol Kembali --}}
                    <a href="{{ route('admin.pages.index') }}" class="inline-flex items-center mb-6 text-indigo-600 hover:text-indigo-900">
                        &larr; Kembali ke Daftar
                    </a>

                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                            <strong class="font-bold">Oops!</strong>
                            <span class="block sm:inline">{{ $errors->first() }}</span>
                        </div>
                    @endif

                    <form action="{{ route('admin.pages.hero.update', $page) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Banner Saat Ini</label>
                            @if($page->hero_image)
                                <img src="{{ Storage::url($page->hero_image) }}" class="w-full h-auto rounded-lg border shadow-sm object-cover max-h-64">
                            @else
                                <div class="w-full h-32 bg-gray-100 rounded-lg border-2 border-dashed border-gray-300 flex items-center justify-center text-gray-400">
                                    Belum ada banner
                                </div>
                            @endif
                        </div>

                        <div class="mb-6">
                            <label for="hero_image" class="block text-sm font-medium text-gray-700 mb-2">Upload Banner Baru</label>
                            <input type="file" name="hero_image" id="hero_image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" required>
                            <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG. Max: 5MB. Disarankan gambar landscape lebar.</p>
                        </div>

                        <button type="submit" class="w-full justify-center inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Simpan Banner Baru
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
