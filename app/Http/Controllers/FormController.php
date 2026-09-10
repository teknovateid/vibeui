<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    public function index()
    {
        return view('docs.form.index');
    }

    public function store(Request $request)
    {
        $submittedData = $this->formatRequestData($request->all());
        $submittedAt = now()->format('H:i:s d M Y');

        if ($request->expectsJson() || $request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Formulir berhasil diposting ke FormController!',
                'submitted_data' => $submittedData,
                'submitted_at' => $submittedAt,
            ]);
        }

        return back()
            ->with('submitted_data', $submittedData)
            ->with('submitted_at', $submittedAt);
    }

    /**
     * Format request payload values, converting UploadedFile instances to readable file metadata.
     */
    protected function formatRequestData($value)
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
            return array_map([$this, 'formatRequestData'], $value);
        }

        return $value;
    }
}
