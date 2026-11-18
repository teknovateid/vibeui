<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Blade;

function flattenVibeLang(array $items, string $prefix = ''): array
{
    $flat = [];
    foreach ($items as $key => $value) {
        $fullKey = $prefix === '' ? (string) $key : "{$prefix}.{$key}";
        if (is_array($value)) {
            $flat += $value === [] ? [$fullKey => '[]'] : flattenVibeLang($value, $fullKey);
        } else {
            $flat[$fullKey] = (string) $value;
        }
    }

    return $flat;
}

test('vibe package and auth translation files have full key and placeholder parity across id and en', function () {
    $errors = [];

    foreach (['vibe', 'auth'] as $namespace) {
        $idDir = lang_path("id/{$namespace}");
        $enDir = lang_path("en/{$namespace}");

        $idFiles = collect(glob("{$idDir}/*.php"))->map(fn ($p) => basename($p))->sort()->values()->all();
        $enFiles = collect(glob("{$enDir}/*.php"))->map(fn ($p) => basename($p))->sort()->values()->all();

        expect($idFiles)->toBe($enFiles);

        foreach ($idFiles as $file) {
            $idFlat = flattenVibeLang(require "{$idDir}/{$file}");
            $enFlat = flattenVibeLang(require "{$enDir}/{$file}");

            foreach (array_diff_key($idFlat, $enFlat) as $key => $_) {
                $errors[] = "Missing EN key: {$namespace}/{$file}::{$key}";
            }
            foreach (array_diff_key($enFlat, $idFlat) as $key => $_) {
                $errors[] = "Missing ID key: {$namespace}/{$file}::{$key}";
            }

            foreach (array_intersect_key($idFlat, $enFlat) as $key => $idVal) {
                preg_match_all('/(?<![a-zA-Z0-9\/]):([a-zA-Z_][a-zA-Z0-9_]*)/', $idVal, $idMatches);
                preg_match_all('/(?<![a-zA-Z0-9\/]):([a-zA-Z_][a-zA-Z0-9_]*)/', $enFlat[$key], $enMatches);

                $idPh = array_values(array_unique($idMatches[1]));
                $enPh = array_values(array_unique($enMatches[1]));
                sort($idPh);
                sort($enPh);

                if ($idPh !== $enPh) {
                    $errors[] = "Placeholder mismatch: {$namespace}/{$file}::{$key}";
                }
            }
        }
    }

    expect($errors)->toBeEmpty();
});

test('packages/vibe directory stays synchronized with host resources and lang', function () {
    $exitCode = Artisan::call('vibe:sync', ['--check' => true]);

    expect($exitCode)->toBe(0);
});

test('synced vibe components and auth layouts localize dynamically in id and en and expose js i18n bridges', function () {
    foreach (['id', 'en'] as $locale) {
        app()->setLocale($locale);

        $qrHtml = Blade::render('<vibe:display.qrcode value="https://example.com" :copyable="true" :downloadable="true" />');
        expect($qrHtml)->toContain(__('vibe/qrcode.copy_btn', [], $locale));

        $gridCardHtml = Blade::render('<vibe:grid cols="2"><vibe:grid.card>Unlocked</vibe:grid.card><vibe:grid.card :reorderable="false" :resizable="false">Locked</vibe:grid.card></vibe:grid>');
        expect($gridCardHtml)
            ->toContain(__('vibe/grid.lock_both', [], $locale))
            ->toContain(__('vibe/grid.swap_position', [], $locale))
            ->toContain(__('vibe/grid.cols_suffix', [], $locale));

        $qtyHtml = Blade::render('<vibe:input.quantity name="qty" />');
        expect($qtyHtml)
            ->toContain(__('vibe/input.decrease_value', [], $locale))
            ->toContain(__('vibe/input.increase_value', [], $locale));

        $todoHtml = Blade::render('<vibe:todo><vibe:todo.empty /></vibe:todo>');
        expect($todoHtml)->toContain(__('vibe/todo.empty_title', [], $locale));

        $baseHtml = Blade::render('<x-docs.layouts.base>Body</x-docs.layouts.base>');
        expect($baseHtml)
            ->toContain('window.VibeCommonI18n')
            ->toContain('window.VibeTodoI18n')
            ->toContain('translate="no"');

        $splitHtml = view('auth.layouts.split', ['title' => 'Login', 'slot' => 'Form'])->render();
        expect($splitHtml)
            ->toContain(e(__('auth/layout.headline', [], $locale)))
            ->toContain(__('auth/layout.toggle_theme', [], $locale))
            ->toContain('window.VibeCommonI18n');

        $cardHtml = view('auth.layouts.card', ['title' => 'Login', 'slot' => 'Form'])->render();
        expect($cardHtml)
            ->toContain(__('auth/layout.toggle_theme', [], $locale))
            ->toContain('window.VibeCommonI18n');

        $simpleHtml = view('auth.layouts.simple', ['title' => 'Login', 'slot' => 'Form'])->render();
        expect($simpleHtml)
            ->toContain(__('auth/layout.toggle_theme', [], $locale))
            ->toContain('window.VibeCommonI18n');
    }
});
