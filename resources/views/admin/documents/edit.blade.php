<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Dokumen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Oops!</strong>
                            <span class="block sm:inline">Ada masalah dengan data yang Anda masukkan.</span>
                        </div>
                    @endif

                    <form action="{{ route('admin.documents.update', $document) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') {{-- PENTING untuk edit --}}

                        {{-- Judul Dokumen --}}
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">Judul Dokumen</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $document->title) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>

                        {{-- Kategori Dokumen --}}
                        <div class="mb-4">
                            <label for="category" class="block text-sm font-medium text-gray-700">Kategori</label>
                            <select name="category" id="category" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                <option value="">-- Pilih Kategori --</option>

                                {{-- Kita buat array kategori di controller agar lebih rapi, tapi untuk sekarang kita hardcode --}}
                                <optgroup label="Laporan">
                                    <option value="laporan-kinerja" {{ $document->category == 'laporan-kinerja' ? 'selected' : '' }}>Laporan Perkembangan Kinerja</option>
                                    <option value="laporan-evaluasi-kip" {{ $document->category == 'laporan-evaluasi-kip' ? 'selected' : '' }}>Laporan Hasil Evaluasi KIP</option>
                                    <option value="laporan-kip" {{ $document->category == 'laporan-kip' ? 'selected' : '' }}>Laporan KIP</option>
                                </optgroup>

                                <optgroup label="Regulasi">
                                    <option value="undang-undang" {{ $document->category == 'undang-undang' ? 'selected' : '' }}>Undang-Undang</option>
                                    <option value="peraturan-pemerintah" {{ $document->category == 'peraturan-pemerintah' ? 'selected' : '' }}>Peraturan Pemerintah</option>
                                    {{-- Tambahkan semua opsi kategori lainnya di sini seperti di create.blade.php --}}
                                </optgroup>

                                <optgroup label="Informasi Publik">
                                    <option value="putusan" {{ $document->category == 'putusan' ? 'selected' : '' }}>Putusan</option>
                                    {{-- Tambahkan semua opsi kategori lainnya di sini seperti di create.blade.php --}}
                                    <option value="dipa" {{ $document->category == 'dipa' ? 'selected' : '' }}>DIPA</option>
                                </optgroup>
                            </select>
                        </div>

                        {{-- Deskripsi (Opsional) --}}
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi (Opsional)</label>
                            <textarea name="description" id="description" rows="3"
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('description', $document->description) }}</textarea>
                        </div>

                        {{-- Upload File (Opsional saat Edit) --}}
                        <div class="mb-4">
                            <label for="file" class="block text-sm font-medium text-gray-700">Ganti File (Opsional)</label>
                            <p class="text-xs text-gray-500 mb-1">File saat ini: <a href="{{ Storage::url($document->file_path) }}" target="_blank" class="text-indigo-600">Lihat File</a></p>
                            <input type="file" name="file" id="file" class="mt-1 block w-full">
                            <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengganti file.</p>
                        </div>

                        {{-- Tombol Simpan --}}
                        <div class="mt-6">
                            <button type="submit"
                                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                Simpan Perubahan
                            </button>
                            <a href="{{ route('admin.documents.index') }}" class="ml-4 text-sm text-gray-600">Batal</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
