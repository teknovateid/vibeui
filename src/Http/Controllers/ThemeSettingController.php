<?php

namespace Teknovate\VibeUi\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Teknovate\VibeUi\Services\ThemeService;

class ThemeSettingController extends Controller
{
    public function __construct(
        protected ThemeService $themeService
    ) {}

    /**
     * Authorize global theme management using configured Laravel Gate.
     */
    protected function authorizeManagement(): void
    {
        $gateName = Config::get('vibe.theme.gate');
        if ($gateName && Gate::has($gateName)) {
            Gate::authorize($gateName);
        }
    }

    /**
     * Resolve the display name of the actor updating global theme settings.
     */
    protected function resolveActorName(): string
    {
        return (string) (
            Auth::user()?->name
            ?? Auth::user()?->username
            ?? Auth::user()?->email
            ?? 'Administrator'
        );
    }

    /**
     * Get the current global theme status.
     */
    public function show(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'can_manage' => $this->themeService->canManage(Auth::user()),
            'storage_mode' => $this->themeService->getStorageMode(),
            'theme' => $this->themeService->getGlobalTheme(),
        ]);
    }

    /**
     * Save global theme configuration (tokens + css + is_locked + optional storage_mode).
     */
    public function save(Request $request): JsonResponse
    {
        $this->authorizeManagement();

        $validated = $request->validate([
            'tokens' => ['required', 'array'],
            'css' => ['nullable', 'string'],
            'is_locked' => ['nullable', 'boolean'],
            'storage_mode' => ['nullable', 'string', Rule::in(ThemeService::VALID_STORAGE_MODES)],
        ]);

        $theme = $this->themeService->saveGlobalTheme(
            tokens: $validated['tokens'],
            css: $validated['css'] ?? null,
            isLocked: (bool) ($validated['is_locked'] ?? false),
            updatedBy: $this->resolveActorName(),
            storageMode: $validated['storage_mode'] ?? null
        );

        return response()->json([
            'success' => true,
            'message' => 'Pengaturan tampilan global berhasil disimpan ke database & cache.',
            'storage_mode' => $this->themeService->getStorageMode(),
            'theme' => $theme,
        ]);
    }

    /**
     * Save the active theme storage mode ('hybrid', 'local_only', 'global_only').
     */
    public function saveStorageMode(Request $request): JsonResponse
    {
        $this->authorizeManagement();

        $validated = $request->validate([
            'storage_mode' => ['required', 'string', Rule::in(ThemeService::VALID_STORAGE_MODES)],
        ]);

        $theme = $this->themeService->saveStorageMode(
            storageMode: $validated['storage_mode'],
            updatedBy: $this->resolveActorName()
        );

        return response()->json([
            'success' => true,
            'message' => 'Metode penyimpanan tema berhasil diperbarui.',
            'storage_mode' => $this->themeService->getStorageMode(),
            'theme' => $theme,
        ]);
    }

    /**
     * Reset global theme back to default Vibe UI tokens.
     */
    public function reset(): JsonResponse
    {
        $this->authorizeManagement();

        $this->themeService->resetGlobalTheme();

        return response()->json([
            'success' => true,
            'message' => 'Tampilan global berhasil direset ke bawaan sistem.',
        ]);
    }
}
