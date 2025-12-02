<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Galeri Baru</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{-- Tampilkan Error jika ada --}}
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

                <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Judul --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Judul Foto/Video</label>
                        <input type="text" name="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>

                    {{-- Input File --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Upload File</label>
                        <input type="file" name="image" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                        <p class="text-xs text-gray-500 mt-1">Support: JPG, PNG, MP4. Maksimal: 20MB.</p>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Deskripsi (Opsional)</label>
                        <textarea name="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                    </div>

                    <div class="flex justify-end gap-3 mt-6">
                        <a href="{{ route('admin.galleries.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Batal</a>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Simpan Galeri</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
