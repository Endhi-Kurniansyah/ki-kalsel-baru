<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Dokumen Baru') }}
            @if(request('type'))
                - {{ ucwords(str_replace('-', ' ', request('type'))) }}
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                        <strong class="font-bold">Oops!</strong>
                        <ul class="mt-2 list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.documents.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Input Hidden Type agar redirect balik ke menu yang benar --}}
                    @if(request('type'))
                        <input type="hidden" name="redirect_type" value="{{ request('type') }}">
                    @endif

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Judul Dokumen</label>
                        <input type="text" name="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Kategori</label>
                        <select name="category" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            <option value="">-- Pilih Kategori --</option>

                            {{-- Tampilkan opsi sesuai 'type' di URL --}}

                            @if(!request('type') || request('type') == 'laporan')
                                <optgroup label="Laporan">
                                    <option value="laporan-kinerja">Laporan Perkembangan Kinerja</option>
                                    <option value="laporan-evaluasi-kip">Laporan Hasil Evaluasi KIP</option>
                                    <option value="laporan-kip">Laporan KIP</option>
                                </optgroup>
                            @endif

                            @if(!request('type') || request('type') == 'regulasi')
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
                            @endif

                            @if(!request('type') || request('type') == 'informasi-publik')
                                <optgroup label="Informasi Publik">
                                    <option value="putusan">Putusan</option>
                                    <option value="informasi-berkala">Informasi Berkala</option>
                                    <option value="informasi-setiap-saat">Informasi Setiap Saat</option>
                                    <option value="informasi-serta-merta">Informasi Serta Merta</option>
                                    <option value="dipa">DIPA</option>
                                    <option value="form-permohonan-psi">Form Permohonan PSI</option>
                                </optgroup>
                            @endif
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Deskripsi (Opsional)</label>
                        <textarea name="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Upload File</label>
                        <input type="file" name="file" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                    </div>

                    <div class="flex justify-end gap-2 mt-6">
                        <a href="{{ route('admin.documents.index', ['type' => request('type')]) }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300">Batal</a>
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
