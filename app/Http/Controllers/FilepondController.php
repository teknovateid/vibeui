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

    public function requestTest(Request $request){
        $data = $request->all();
        $timestamp=now();


        return response()->json([
            'status' => 'success',
            'request' => $data,
            'timestamp' => $timestamp
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
