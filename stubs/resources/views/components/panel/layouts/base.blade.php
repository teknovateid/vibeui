@props([
    'layout' => 'sidebar',
    'layoutGroup' => 'panel',
    'panel' => null,
    'shell' => null,
    'sidebarId' => null,
    'sidebarState' => 'expanded',
    'styles' => [],
    'scripts' => [],
    'cssVars' => [],
    'skipToContent' => true,
    'mainContentId' => 'vibe-main-content',
    'bodyClass' => null,
])

@php
    $currentIdleTimeout = request()->attributes->get('vibeIdleTimeout', $vibeIdleTimeout ?? null);
    $idleConfirmUrl = Route::has('password.confirm') ? route('password.confirm', [], false) : '/confirm-password';
    $idleLockUrl = Route::has('password.idle-lock') ? route('password.idle-lock', [], false) : ($idleConfirmUrl . '/idle-lock');
    $keepAliveUrl = Route::has('auth.keep-alive') ? route('auth.keep-alive', [], false) : '/keep-alive';
    $resolvedAssetTags = \Teknovate\VibeUi\Vibe::renderAssetTags($styles, $scripts);
    $cssVarsStyle = \Teknovate\VibeUi\Vibe::cssVarsStyle(is_array($cssVars) ? $cssVars : []);
    $resolvedSidebarId = $sidebarId ?: 'sidebar-menu';
    $shellXDataExpr = "typeof window.VibeLayout?.vibeLayoutShell === 'function' ? window.VibeLayout.vibeLayoutShell({ sidebarId: " . \Illuminate\Support\Js::from($resolvedSidebarId)->toHtml() . " }) : { sidebarId: " . \Illuminate\Support\Js::from($resolvedSidebarId)->toHtml() . ", isDark: document.documentElement.classList.contains('dark'), isFullscreen: false, isMobileBackdropOpen: false, sidebarState: " . \Illuminate\Support\Js::from($sidebarState)->toHtml() . ", init() {}, syncThemeState() { this.isDark = document.documentElement.classList.contains('dark'); }, toggleTheme(e) { window.VibeTheme ? window.VibeTheme.toggle(e) : document.documentElement.classList.toggle('dark'); this.syncThemeState(); }, syncFullscreenState() { this.isFullscreen = !!document.fullscreenElement; }, toggleFullscreen() { if (!document.fullscreenElement) { document.documentElement.requestFullscreen?.(); } else { document.exitFullscreen?.(); } }, handleSheetEvent() {} }";
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" translate="no">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google" content="notranslate">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if($currentIdleTimeout && $currentIdleTimeout > 0)
        <meta name="vibe-idle-timeout" content="{{ $currentIdleTimeout }}">
        <meta name="vibe-idle-lock-url" content="{{ $idleLockUrl }}">
        <meta name="vibe-confirm-url" content="{{ $idleConfirmUrl }}">
        <meta name="vibe-keep-alive-url" content="{{ $keepAliveUrl }}">
    @endif
    @vibeStyles
    @stack('seo')
    @isset($seo)
        {{ $seo }}
    @endisset
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @if ($resolvedAssetTags !== '')
        {!! $resolvedAssetTags !!}
    @endif
    @livewireStyles
    @stack('head')
    @isset($head)
        {{ $head }}
    @endisset
</head>
<body class="{{ twMerge('font-medium font-sans antialiased bg-background text-foreground vibe-scrollbar', $bodyClass) }}"
    @if($currentIdleTimeout && $currentIdleTimeout > 0) data-idle-timeout="{{ $currentIdleTimeout }}" @endif>
    @if($currentIdleTimeout && $currentIdleTimeout > 0)
        <div id="vibe-idle-tracker"
            data-timeout="{{ $currentIdleTimeout }}"
            data-lock-url="{{ $idleLockUrl }}"
            data-confirm-url="{{ $idleConfirmUrl }}"
            data-keep-alive-url="{{ $keepAliveUrl }}"
            class="hidden"
            style="display:none;"></div>
    @endif

    <div
        data-vibe-layout="{{ $layout }}"
        data-vibe-layout-group="{{ $layoutGroup }}"
        @if ($panel) data-vibe-panel="{{ $panel }}" @endif
        @if ($shell) data-vibe-shell="{{ $shell }}" @endif
        @if ($sidebarId) data-vibe-sidebar-id="{{ $sidebarId }}" data-vibe-sidebar-state="{{ $sidebarState }}" @endif
        @if ($cssVarsStyle !== '') style="{{ $cssVarsStyle }}" @endif
        x-data="{!! $shellXDataExpr !!}"
        x-init="init()"
        @open-sheet.window="handleSheetEvent('open', $event.detail)"
        @close-sheet.window="handleSheetEvent('close', $event.detail)"
        @toggle-sheet.window="handleSheetEvent('toggle', $event.detail)"
        @fullscreenchange.window="syncFullscreenState()"
        @vibe-theme-changed.window="syncThemeState()"
        class="min-h-dvh w-full"
    >
        @if ($skipToContent)
            <a href="#{{ $mainContentId }}" class="sr-only focus:not-sr-only focus:fixed focus:top-3 focus:left-3 focus:z-[100] focus:px-3.5 focus:py-2 focus:rounded-lg focus:bg-primary focus:text-primary-foreground focus:text-xs focus:font-semibold focus:shadow-lg">
                Skip to content
            </a>
        @endif

        {{ $slot }}
    </div>

    <vibe:alert position="top-right" />
    <vibe:toast position="top-right" />
    @isset($overlays)
        {{ $overlays }}
    @endisset
    <script data-navigate-once="true">
        window.VibeCommonI18n = @js(__('vibe/common'));
        window.VibeTodoI18n = @js(__('vibe/todo'));
    </script>
    @livewireScripts
    @stack('body')
    @isset($body)
        {{ $body }}
    @endisset
</body>
</html>
