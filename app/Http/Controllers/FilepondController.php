<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class FilepondController extends Controller
{
    /**
     * Tampilkan halaman dokumentasi FilePond.
     */
    public function index()
    {
        return view('docs.filepond.index');
    }

    public function requestTest(Request $request)
    {
        $all = $request->all();
        $formatted = [];

        foreach ($all as $key => $value) {
            if ($value instanceof \Illuminate\Http\UploadedFile) {
                $formatted[$key] = [
                    'original_name' => $value->getClientOriginalName(),
                    'mime_type' => $value->getClientMimeType(),
                    'size' => $value->getSize() . ' bytes (' . round($value->getSize() / 1024, 1) . ' KB)',
                    'type' => 'UploadedFile (Multipart)',
                ];
            } elseif (is_array($value)) {
                $formatted[$key] = array_map(function ($item) {
                    if ($item instanceof \Illuminate\Http\UploadedFile) {
                        return [
                            'original_name' => $item->getClientOriginalName(),
                            'mime_type' => $item->getClientMimeType(),
                            'size' => $item->getSize() . ' bytes (' . round($item->getSize() / 1024, 1) . ' KB)',
                            'type' => 'UploadedFile (Multipart)',
                        ];
                    }
                    return $item;
                }, $value);
            } else {
                $formatted[$key] = $value;
            }
        }

        return response()->json([
            'status' => 'success',
            'request' => $formatted,
            'timestamp' => now()
        ]);
    }

    public function store(Request $request)
    {
        return $this->requestTest($request);
    }

    public function presigned(Request $request)
    {
        $request->validate([
            'filename' => ['nullable', 'string'],
            'type' => ['nullable', 'string'],
            'size' => ['nullable', 'integer'],
        ]);

        $url = Storage::temporaryUploadUrl('public/presigned/' . ($request->filename ?? Str::random(10)), now()->addMinutes(15));

        return response()->json([
            'url' => $url,
            'method' => 'PUT',
        ]);
    }
}
