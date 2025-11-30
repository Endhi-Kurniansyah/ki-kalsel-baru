<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Agenda') }}
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
                            <ul class="mt-3 list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- PERBAIKAN 1: Tambahkan enctype="multipart/form-data" --}}
                    <form action="{{ route('admin.agendas.update', $agenda) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') {{-- PENTING untuk edit --}}

                        {{-- Judul Agenda --}}
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">Judul Agenda</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $agenda->title) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>

                        {{-- Kategori --}}
                        <div class="mb-4">
                            <label for="category" class="block text-sm font-medium text-gray-700">Kategori</label>
                            <select name="category" id="category" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                <option value="">-- Pilih Kategori --</option>
                                <option value="Agenda Komisioner" {{ old('category', $agenda->category) == 'Agenda Komisioner' ? 'selected' : '' }}>Agenda Komisioner</option>
                                <option value="Jadwal Sidang" {{ old('category', $agenda->category) == 'Jadwal Sidang' ? 'selected' : '' }}>Jadwal Sidang</option>
                            </select>
                        </div>

                        {{-- Lokasi --}}
                        <div class="mb-4">
                            <label for="location" class="block text-sm font-medium text-gray-700">Lokasi</label>
                            <input type="text" name="location" id="location" value="{{ old('location', $agenda->location) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>

                        {{-- Waktu Mulai --}}
                        <div class="mb-4">
                            <label for="start_time" class="block text-sm font-medium text-gray-700">Waktu Mulai</label>
                            {{-- Kita perlu format tanggalnya agar bisa dibaca input datetime-local --}}
                            <input type="datetime-local" name="start_time" id="start_time" value="{{ old('start_time', $agenda->start_time->format('Y-m-d\TH:i')) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>

                        {{-- Waktu Selesai (Opsional) --}}
                        <div class="mb-4">
                            <label for="end_time" class="block text-sm font-medium text-gray-700">Waktu Selesai (Opsional)</label>
                            <input type="datetime-local" name="end_time" id="end_time" value="{{ old('end_time', $agenda->end_time ? $agenda->end_time->format('Y-m-d\TH:i') : '') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>

                        {{-- Deskripsi (Opsional) --}}
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi (Opsional)</label>
                            <textarea name="description" id="description" rows="4"
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('description', $agenda->description) }}</textarea>
                        </div>

                        {{-- PERBAIKAN 2: Input File Tambahan (Untuk Edit) --}}
                        <div class="mb-4">
                            <label for="file" class="block text-sm font-medium text-gray-700">Ganti Lampiran (Opsional)</label>

                            {{-- Tampilkan link file jika sudah ada --}}
                            @if($agenda->file_path)
                                <div class="mb-2">
                                    <a href="{{ Storage::url($agenda->file_path) }}" target="_blank" class="text-indigo-600 hover:underline text-sm font-semibold inline-flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                                        Lihat Lampiran Saat Ini
                                    </a>
                                </div>
                            @endif

                            <input type="file" name="file" id="file" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengganti file. Format: PDF, JPG, PNG. Maks: 5MB.</p>
                        </div>

                        {{-- Tombol Simpan --}}
                        <div class="mt-6">
                            <button type="submit"
                                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                Simpan Perubahan
                            </button>
                            <a href="{{ route('admin.agendas.index') }}" class="ml-4 text-sm text-gray-600">Batal</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
