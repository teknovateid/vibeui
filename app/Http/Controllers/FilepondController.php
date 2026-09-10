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
            $formatted[$key] = $this->formatRequestValue($value);
        }

        return response()->json([
            'status' => 'success',
            'request' => $formatted,
            'timestamp' => now()->toIso8601String(),
        ]);
    }

    /**
     * Format request payload values, converting UploadedFile instances to readable file metadata.
     */
    protected function formatRequestValue($value)
    {
        if ($value instanceof \Illuminate\Http\UploadedFile) {
            $bytes = $value->getSize();
            $size = $bytes >= 1048576
                ? round($bytes / 1048576, 2) . ' MB'
                : round($bytes / 1024, 1) . ' KB';

            return [
                'original_name' => $value->getClientOriginalName(),
                'mime_type' => $value->getClientMimeType(),
                'size' => $size,
                'type' => 'UploadedFile (Multipart)',
            ];
        }

        if (is_array($value)) {
            return array_map([$this, 'formatRequestValue'], $value);
        }

        return $value;
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
            'size' => ['nullable', 'integer','max:500000'],
        ]);

        $rawFilename = $request->filename ?? Str::random(10);
        $extension = pathinfo($rawFilename, PATHINFO_EXTENSION);
        $hashedName = hash('sha256', $rawFilename . microtime()) . ($extension ? '.' . $extension : '');

        $url = Storage::temporaryUploadUrl(
            'public/presigned/' . $hashedName,
            now()->addMinutes(15)
        );

        // $url = Storage::temporaryUploadUrl('public/presigned/' . ($request->filename ?? Str::random(10)), now()->addMinutes(15));

        return response()->json([
            'url' => $url,
            // 'full-url' => Storage::url($url),
            'method' => 'PUT',
        ]);
    }
}
