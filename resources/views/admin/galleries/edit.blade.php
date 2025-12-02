<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Galeri</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('admin.galleries.update', $gallery) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Judul --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Judul Foto/Video</label>
                        <input type="text" name="title" value="{{ old('title', $gallery->title) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>

                    {{-- Ganti File --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Ganti File (Opsional)</label>

                        {{-- Preview File Lama --}}
                        <div class="mb-2 p-2 border rounded bg-gray-50">
                            <p class="text-xs text-gray-500 mb-1">File Saat Ini:</p>
                            @php
                                $ext = pathinfo($gallery->image_path, PATHINFO_EXTENSION);
                                $isVideo = in_array(strtolower($ext), ['mp4', 'webm', 'ogg']);
                            @endphp

                            @if($isVideo)
                                <video src="{{ Storage::url($gallery->image_path) }}" class="h-32 w-auto rounded" controls></video>
                            @else
                                <img src="{{ Storage::url($gallery->image_path) }}" class="h-32 w-auto rounded object-cover">
                            @endif
                        </div>

                        <input type="file" name="image" class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                        <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengganti file.</p>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Deskripsi (Opsional)</label>
                        <textarea name="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('description', $gallery->description) }}</textarea>
                    </div>

                    <div class="flex justify-end gap-3 mt-6">
                        <a href="{{ route('admin.galleries.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Batal</a>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
