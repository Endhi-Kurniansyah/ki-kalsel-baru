<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tulis Berita Baru</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Judul --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Judul Berita</label>
                        <input type="text" name="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>

                    {{-- Kategori (Penting untuk Tab di Beranda) --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Kategori</label>
                        <select name="category" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <option value="kegiatan">Berita Kegiatan</option>
                            <option value="sidang">Berita Sidang</option>
                            <option value="umum">Berita Umum/Lainnya</option>
                        </select>
                    </div>

                    {{-- Gambar Thumbnail --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Gambar Utama</label>
                        <input type="file" name="image" class="mt-1 block w-full" required>
                    </div>

                    {{-- Konten (CKEditor) --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Isi Berita</label>
                        {{-- ID 'content' ini akan otomatis dideteksi oleh script CKEditor di app.js --}}
                        <textarea name="content" id="content" rows="10" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                    </div>

                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Terbitkan Berita</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
