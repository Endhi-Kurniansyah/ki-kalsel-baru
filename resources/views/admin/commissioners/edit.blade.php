<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Komisioner') }}
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

                    <form action="{{ route('admin.commissioners.update', $commissioner) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') {{-- PENTING untuk edit --}}

                        {{-- Nama --}}
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $commissioner->name) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>

                        {{-- Jabatan --}}
                        <div class="mb-4">
                            <label for="position" class="block text-sm font-medium text-gray-700">Jabatan</label>
                            <input type="text" name="position" id="position" value="{{ old('position', $commissioner->position) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>

                        {{-- Urutan --}}
                        <div class="mb-4">
                            <label for="order" class="block text-sm font-medium text-gray-700">Urutan Tampil</label>
                            <input type="number" name="order" id="order" value="{{ old('order', $commissioner->order) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>

                        {{-- Foto (Opsional saat Edit) --}}
                        <div class="mb-4">
                            <label for="photo" class="block text-sm font-medium text-gray-700">Ganti Foto (Opsional)</label>
                            <div class="mt-2">
                                <img src="{{ Storage::url($commissioner->photo_path) }}" alt="{{ $commissioner->name }}" class="h-16 w-16 rounded-full object-cover">
                            </div>
                            <input type="file" name="photo" id="photo" class="mt-2 block w-full">
                            <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengganti foto.</p>
                        </div>

                        {{-- Bio (Opsional) --}}
                        <div class="mb-4">
                            <label for="bio" class="block text-sm font-medium text-gray-700">Biografi Singkat (Opsional)</label>
                            <textarea name="bio" id="bio" rows="4"
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('bio', $commissioner->bio) }}</textarea>
                        </div>

                        {{-- Tombol Simpan --}}
                        <div class="mt-6">
                            <button type="submit"
                                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                Simpan Perubahan
                            </button>
                            <a href="{{ route('admin.commissioners.index') }}" class="ml-4 text-sm text-gray-600">Batal</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
