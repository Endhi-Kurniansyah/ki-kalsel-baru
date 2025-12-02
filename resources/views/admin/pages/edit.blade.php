<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- Tampilkan judul halaman yang sedang diedit --}}
            Edit Halaman: {{ $page->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- Tampilkan error validasi jika ada --}}
                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Oops!</strong>
                            <span class="block sm:inline">Ada masalah dengan data yang Anda masukkan.</span>
                            <ul class="mt-3 list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Form Edit --}}
                    {{-- Ini akan mengirim data ke method 'update' di PageController --}}
                    {{-- JANGAN LUPA: enctype --}}
                    <form action="{{ route('admin.pages.update', $page) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') {{-- Method HTTP untuk Update --}}

                        {{-- Judul --}}
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">Judul Halaman</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $page->title) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm">
                        </div>

                        {{-- ========================================== --}}
                        {{-- BAGIAN BARU: INPUT HERO IMAGE (GAMBAR UTAMA) --}}
                        {{-- HANYA MUNCUL JIKA SLUG HALAMAN ADALAH 'beranda' --}}
                        {{-- ========================================== --}}
                        @if($page->slug == 'beranda')
                            <div class="mb-6 p-4 bg-gray-50 border rounded-lg">
                                <label for="hero_image" class="block text-sm font-medium text-gray-700 mb-2">Gambar Utama (Hero Image)</label>

                                {{-- Tampilkan gambar lama jika ada --}}
                                @if($page->hero_image)
                                    <div class="mb-3">
                                        <p class="text-xs text-gray-500 mb-1">Gambar saat ini:</p>
                                        <img src="{{ Storage::url($page->hero_image) }}" alt="Hero Image" class="w-64 h-auto rounded border shadow-sm">
                                    </div>
                                @endif

                                <input type="file" name="hero_image" id="hero_image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                                <p class="text-xs text-gray-500 mt-1">Opsional. Digunakan untuk background banner di halaman beranda atau header halaman. Max: 5MB.</p>
                            </div>
                        @endif
                        {{-- ========================================== --}}

                        {{-- Konten (CKEditor) --}}
                        <div class="mb-4">
                            <label for="content" class="block text-sm font-medium text-gray-700">Konten</label>
                            {{--
                                !PERHATIAN!
                                Ini masih <textarea> biasa.
                                Di langkah berikutnya, kita akan ganti ini dengan Rich Text Editor (seperti CKEditor)
                                agar admin bisa bold, italic, upload gambar, dll.
                            --}}
                            <textarea name="content" id="content" rows="10"
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('content', $page->content) }}</textarea>
                        </div>

                        {{-- Tombol Simpan --}}
                        <div class="mt-6">
                            <button type="submit"
                                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Simpan Perubahan
                            </button>
                            <a href="{{ route('admin.pages.index') }}" class="ml-4 text-sm text-gray-600">Batal</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
