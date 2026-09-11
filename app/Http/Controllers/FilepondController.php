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
        $all = $this->mergeInputsAndFiles($request->input(), $request->allFiles());
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
     * Merge request input data and uploaded files safely, ensuring files are not
     * overwritten or discarded when both string inputs and files share the same key (e.g. documents[]).
     */
    protected function mergeInputsAndFiles(array $input, array $files): array
    {
        $merged = $input;

        foreach ($files as $key => $fileVal) {
            if (!isset($merged[$key])) {
                $merged[$key] = $fileVal;
            } elseif (is_array($merged[$key]) && is_array($fileVal)) {
                if (array_is_list($merged[$key]) && array_is_list($fileVal)) {
                    $merged[$key] = array_merge($merged[$key], $fileVal);
                } else {
                    $merged[$key] = $this->mergeInputsAndFiles($merged[$key], $fileVal);
                }
            } elseif (is_array($merged[$key])) {
                $merged[$key][] = $fileVal;
            } else {
                $merged[$key] = [$merged[$key], $fileVal];
            }
        }

        return $merged;
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
        $maxBytes = 50 * 1024 * 1024; // 50MB

        $request->validate([
            'filename' => ['nullable', 'string'],
            'type' => ['nullable', 'string'],
            'size' => ['nullable', 'integer', 'max:' . $maxBytes],
        ], [
            'size.max' => app()->getLocale() === 'id'
                ? 'Ukuran berkas tidak boleh lebih dari 50MB.'
                : 'The file size must not be greater than 50MB.',
        ]);

        $rawFilename = $request->filename ?? Str::random(10);
        $extension = pathinfo($rawFilename, PATHINFO_EXTENSION);
        $hashedName = hash('sha256', $rawFilename . microtime()) . ($extension ? '.' . $extension : '');
        
        $url = Storage::temporaryUploadUrl('public/presigned/' . $hashedName, now()->addMinutes(15));

        return response()->json([
            'url' => $url,
        ]);
    }

    /**
     * Download proxy to stream remote/S3 files with forced Content-Disposition: attachment header.
     */
    public function download(Request $request)
    {
        $url = $request->query('url');
        $filename = $request->query('name') ?: basename(parse_url((string) $url, PHP_URL_PATH) ?: 'download');

        if (!$url || !filter_var($url, FILTER_VALIDATE_URL)) {
            abort(400, 'Invalid URL parameter');
        }

        try {
            $response = \Illuminate\Support\Facades\Http::timeout(15)->get($url);
            if (!$response->successful()) {
                abort(404, 'File not found');
            }

            $contentType = $response->header('Content-Type') ?: 'application/octet-stream';
            $body = $response->body();

            return response($body, 200, [
                'Content-Type' => $contentType,
                'Content-Disposition' => 'attachment; filename="' . addslashes($filename) . '"',
                'Content-Length' => strlen($body),
            ]);
        } catch (\Throwable $e) {
            return redirect()->away($url);
        }
    }
}
