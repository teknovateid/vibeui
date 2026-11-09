<?php

namespace Teknovate\VibeUi\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Gate;
use Teknovate\VibeUi\Services\ThemeService;

class ThemeSettingController extends Controller
{
    public function __construct(
        protected ThemeService $themeService
    ) {}

    /**
     * Get the current global theme status.
     */
    public function show(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'can_manage' => $this->themeService->canManage(Auth::user()),
            'theme' => $this->themeService->getGlobalTheme(),
        ]);
    }

    /**
     * Save global theme configuration (tokens + css + is_locked).
     */
    public function save(Request $request): JsonResponse
    {
        $gateName = Config::get('vibe.theme.gate');
        if ($gateName && Gate::has($gateName)) {
            Gate::authorize($gateName);
        }

        $validated = $request->validate([
            'tokens' => ['required', 'array'],
            'css' => ['nullable', 'string'],
            'is_locked' => ['nullable', 'boolean'],
        ]);

        $updatedBy = Auth::user()?->name 
            ?? Auth::user()?->username 
            ?? Auth::user()?->email 
            ?? 'Administrator';

        $theme = $this->themeService->saveGlobalTheme(
            tokens: $validated['tokens'],
            css: $validated['css'] ?? null,
            isLocked: (bool) ($validated['is_locked'] ?? false),
            updatedBy: (string) $updatedBy
        );

        return response()->json([
            'success' => true,
            'message' => 'Pengaturan tampilan global berhasil disimpan ke database & cache.',
            'theme' => $theme,
        ]);
    }

    /**
     * Reset global theme back to default Vibe UI tokens.
     */
    public function reset(): JsonResponse
    {
        $gateName = Config::get('vibe.theme.gate');
        if ($gateName && Gate::has($gateName)) {
            Gate::authorize($gateName);
        }

        $this->themeService->resetGlobalTheme();

        return response()->json([
            'success' => true,
            'message' => 'Tampilan global berhasil direset ke bawaan sistem.',
        ]);
    }
}
