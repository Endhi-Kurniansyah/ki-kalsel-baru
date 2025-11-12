<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Dokumen Baru') }}
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

                    {{-- Form harus punya enctype="multipart/form-data" untuk upload file --}}
                    <form action="{{ route('admin.documents.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Judul Dokumen --}}
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">Judul Dokumen</label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>

                        {{-- Kategori Dokumen (PENTING) --}}
                        <div class="mb-4">
                            <label for="category" class="block text-sm font-medium text-gray-700">Kategori</label>
                            <select name="category" id="category" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                <option value="">-- Pilih Kategori --</option>

                                <optgroup label="Laporan">
                                    <option value="laporan-kinerja">Laporan Perkembangan Kinerja</option>
                                    <option value="laporan-evaluasi-kip">Laporan Hasil Evaluasi KIP</option>
                                    <option value="laporan-kip">Laporan KIP</option>
                                </optgroup>

                                <optgroup label="Regulasi">
                                    <option value="undang-undang">Undang-Undang</option>
                                    <option value="peraturan-pemerintah">Peraturan Pemerintah</option>
                                    <option value="peraturan-daerah">Peraturan Daerah</option>
                                    <option value="peraturan-presiden">Peraturan Presiden</option>
                                    <option value="peraturan-mahkamah-agung">Peraturan Mahkamah Agung</option>
                                    <option value="peraturan-menteri">Peraturan Menteri</option>
                                    <option value="pengaturan-komisi-informasi">Pengaturan Komisi Informasi</option>
                                    <option value="surat-keputusan">Surat Keputusan</option>
                                    <option value="surat-edaran">Surat Edaran</option>
                                    <option value="mou">MOU</option>
                                </optgroup>

                                <optgroup label="Informasi Publik">
                                    <option value="putusan">Putusan</option>
                                    <option value="informasi-berkala">Informasi Berkala</option>
                                    <option value="informasi-setiap-saat">Informasi Setiap Saat</option>
                                    <option value="informasi-serta-merta">Informasi Serta Merta</option>
                                    <option value="dipa">DIPA</option>
                                    <option value="form-permohonan-psi">Form Permohonan PSI</option>
                                </optgroup>
                            </select>
                        </div>

                        {{-- Deskripsi (Opsional) --}}
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi (Opsional)</label>
                            <textarea name="description" id="description" rows="3"
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('description') }}</textarea>
                        </div>

                        {{-- Upload File --}}
                        <div class="mb-4">
                            <label for="file" class="block text-sm font-medium text-gray-700">Upload File (PDF, Word, Excel, JPG, PNG)</label>
                            <input type="file" name="file" id="file" class="mt-1 block w-full" required>
                        </div>

                        {{-- Tombol Simpan --}}
                        <div class="mt-6">
                            <button type="submit"
                                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                Simpan Dokumen
                            </button>
                            <a href="{{ route('admin.documents.index') }}" class="ml-4 text-sm text-gray-600">Batal</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
