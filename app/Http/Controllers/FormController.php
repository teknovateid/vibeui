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
        $submittedData = $request->all();
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
}
