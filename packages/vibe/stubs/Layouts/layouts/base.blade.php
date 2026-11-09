<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php
        $currentIdleTimeout = request()->attributes->get('vibeIdleTimeout', $vibeIdleTimeout ?? null);
        $idleConfirmUrl = Route::has('password.confirm') ? route('password.confirm', [], false) : '/confirm-password';
        $idleLockUrl = Route::has('password.idle-lock') ? route('password.idle-lock', [], false) : ($idleConfirmUrl . '/idle-lock');
        $keepAliveUrl = Route::has('auth.keep-alive') ? route('auth.keep-alive', [], false) : '/keep-alive';
    @endphp
    @if($currentIdleTimeout && $currentIdleTimeout > 0)
        <meta name="vibe-idle-timeout" content="{{ $currentIdleTimeout }}">
        <meta name="vibe-idle-lock-url" content="{{ $idleLockUrl }}">
        <meta name="vibe-confirm-url" content="{{ $idleConfirmUrl }}">
        <meta name="vibe-keep-alive-url" content="{{ $keepAliveUrl }}">
    @endif
    @php
        $vibeThemeService = app(\Teknovate\VibeUi\Services\ThemeService::class);
        $globalThemeData = $vibeThemeService->getGlobalTheme();
        $themeStorageMode = config('vibe.theme.storage_mode', 'hybrid');
        $canManageTheme = $vibeThemeService->canManage(auth()->user());
    @endphp
    <script data-navigate-once="true">
        window.VIBE_GLOBAL_THEME = @json($globalThemeData);
        window.VIBE_THEME_STORAGE_MODE = @json($themeStorageMode);
        window.VIBE_CAN_MANAGE_THEME = @json($canManageTheme);
        (function() {
            try {
                var prefix = window.VIBE_PREFIX || 'vibe';
                var g = window.VIBE_GLOBAL_THEME;
                var mode = window.VIBE_THEME_STORAGE_MODE || 'hybrid';
                var isLocked = g && g.is_locked;
                var stored = null;

                if (!isLocked && mode !== 'global_only') {
                    try {
                        stored = localStorage.getItem(prefix + '-theme');
                    } catch(e) {}
                }

                var activeCss = null;
                var activeMode = null;

                if (stored) {
                    try {
                        var parsed = JSON.parse(stored);
                        activeCss = parsed.css;
                        activeMode = parsed.mode;
                    } catch(e) {}
                }

                if (!activeCss && g && g.css) {
                    activeCss = g.css;
                }
                if (!activeMode && g && g.tokens && g.tokens.mode) {
                    activeMode = g.tokens.mode;
                }

                if (activeMode) {
                    var isDark = activeMode === 'dark' || (activeMode === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches);
                    if (isDark) {
                        document.documentElement.classList.add('dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                    }
                }

                if (activeCss) {
                    var styleEl = document.getElementById(prefix + '-theme-override');
                    if (!styleEl) {
                        styleEl = document.createElement('style');
                        styleEl.id = prefix + '-theme-override';
                        styleEl.setAttribute('data-navigate-once', 'true');
                        document.head.appendChild(styleEl);
                    }
                    if (styleEl.textContent !== activeCss) {
                        styleEl.textContent = activeCss;
                    }
                }
            } catch(e) {}
        })();
    </script>
    @vibeStyles
    @stack('seo')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @stack('head')
</head>
<body class="font-medium font-sans antialiased bg-background text-foreground vibe-scrollbar"
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
    {{ $slot }}
    <vibe:alert position="top-right" />
    <vibe:toast position="top-right" />
    @livewireScripts
    @stack('body')
</body>
</html>

