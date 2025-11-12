{{-- Gunakan layout frontend, kirim judul halaman dinamis --}}
<x-frontend-layout :page_title="$page_title">

    {{-- Konten ini akan "disuntikkan" ke dalam '{{ $slot }}' di layout --}}
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 md:p-12 text-gray-900">

            <h1 class="text-4xl font-bold mb-6 text-gray-800">{{ $page_title }}</h1>

            <table class="min-w-full divide-y divide-gray-200 border">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Judul Dokumen</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Deskripsi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Link</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($documents as $doc)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $doc->title }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $doc->description }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-indigo-600">
                                <a href="{{ Storage::url($doc->file_path) }}" target="_blank">Download/Lihat</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500">
                                Belum ada dokumen untuk kategori ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

</x-frontend-layout>
