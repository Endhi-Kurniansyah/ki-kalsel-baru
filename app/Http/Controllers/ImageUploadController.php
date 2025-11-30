<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageUploadController extends Controller
{
    public function store(Request $request)
    {
        // CKEditor mengirim file dengan nama 'upload'
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');

            // Simpan file ke storage/app/public/content-images
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('content-images', $filename, 'public');

            // Kembalikan JSON dengan format yang diminta CKEditor: { "url": "..." }
            return response()->json([
                'url' => asset('storage/content-images/' . $filename)
            ]);
        }

        return response()->json(['error' => 'Gagal mengupload gambar.'], 400);
    }
}
