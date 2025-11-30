<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Agenda Baru') }}
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

                    {{-- PERBAIKAN 1: Tambahkan enctype="multipart/form-data" --}}
                    <form action="{{ route('admin.agendas.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Judul Agenda --}}
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">Judul Agenda</label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>

                        {{-- Kategori --}}
                        <div class="mb-4">
                            <label for="category" class="block text-sm font-medium text-gray-700">Kategori</label>
                            <select name="category" id="category" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                <option value="">-- Pilih Kategori --</option>
                                <option value="Agenda Komisioner" {{ old('category') == 'Agenda Komisioner' ? 'selected' : '' }}>Agenda Komisioner</option>
                                <option value="Jadwal Sidang" {{ old('category') == 'Jadwal Sidang' ? 'selected' : '' }}>Jadwal Sidang</option>
                            </select>
                        </div>

                        {{-- Lokasi --}}
                        <div class="mb-4">
                            <label for="location" class="block text-sm font-medium text-gray-700">Lokasi</label>
                            <input type="text" name="location" id="location" value="{{ old('location') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>

                        {{-- Waktu Mulai --}}
                        <div class="mb-4">
                            <label for="start_time" class="block text-sm font-medium text-gray-700">Waktu Mulai</label>
                            <input type="datetime-local" name="start_time" id="start_time" value="{{ old('start_time') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>

                        {{-- Waktu Selesai (Opsional) --}}
                        <div class="mb-4">
                            <label for="end_time" class="block text-sm font-medium text-gray-700">Waktu Selesai (Opsional)</label>
                            <input type="datetime-local" name="end_time" id="end_time" value="{{ old('end_time') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>

                        {{-- Deskripsi (Opsional) --}}
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi (Opsional)</label>
                            <textarea name="description" id="description" rows="4"
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('description') }}</textarea>
                        </div>

                        {{-- PERBAIKAN 2: Input File Tambahan --}}
                        <div class="mb-4">
                            <label for="file" class="block text-sm font-medium text-gray-700">Lampiran (Undangan/PDF/Gambar) - Opsional</label>
                            <input type="file" name="file" id="file" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <p class="text-xs text-gray-500 mt-1">Format: PDF, JPG, PNG. Maks: 5MB.</p>
                        </div>

                        {{-- Tombol Simpan --}}
                        <div class="mt-6">
                            <button type="submit"
                                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                Simpan Agenda
                            </button>
                            <a href="{{ route('admin.agendas.index') }}" class="ml-4 text-sm text-gray-600">Batal</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
