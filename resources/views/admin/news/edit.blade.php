<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Berita</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Tampilkan Error Validasi --}}
            @if ($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    <strong class="font-bold">Oops!</strong>
                    <ul class="mt-2 list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.news.update', $news) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') {{-- WAJIB UNTUK EDIT --}}

                    {{-- Judul --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Judul Berita</label>
                        <input type="text" name="title" value="{{ old('title', $news->title) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>

                    {{-- Kategori --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Kategori</label>
                        <select name="category" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            {{-- Logika 'selected' untuk memilih opsi yang sedang aktif --}}
                            <option value="kegiatan" {{ old('category', $news->category) == 'kegiatan' ? 'selected' : '' }}>Berita Kegiatan</option>
                            <option value="sidang" {{ old('category', $news->category) == 'sidang' ? 'selected' : '' }}>Berita Sidang</option>
                            <option value="umum" {{ old('category', $news->category) == 'umum' ? 'selected' : '' }}>Berita Umum/Lainnya</option>
                        </select>
                    </div>

                    {{-- Gambar Thumbnail --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Ganti Gambar (Opsional)</label>

                        {{-- Tampilkan gambar saat ini --}}
                        @if($news->image_path)
                            <div class="mt-2 mb-2">
                                <p class="text-xs text-gray-500 mb-1">Gambar saat ini:</p>
                                <img src="{{ Storage::url($news->image_path) }}" alt="Gambar Berita" class="w-48 h-auto rounded border">
                            </div>
                        @endif

                        <input type="file" name="image" class="mt-1 block w-full">
                        <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengganti gambar.</p>
                    </div>

                    {{-- Konten (CKEditor) --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Isi Berita</label>
                        {{-- ID 'content' ini akan otomatis dideteksi oleh script CKEditor di app.js --}}
                        <textarea name="content" id="content" rows="10" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('content', $news->content) }}</textarea>
                    </div>

                    <div class="flex items-center gap-4">
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Simpan Perubahan</button>
                        <a href="{{ route('admin.news.index') }}" class="text-gray-600 hover:text-gray-900 text-sm">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
