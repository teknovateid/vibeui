<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php
        $currentIdleTimeout = request()->attributes->get('vibeIdleTimeout', $vibeIdleTimeout ?? null);
    @endphp
    @if($currentIdleTimeout && $currentIdleTimeout > 0)
        <meta name="vibe-idle-timeout" content="{{ $currentIdleTimeout }}">
    @endif
    @vibeStyles
    @stack('seo')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @stack('head')
</head>
<body class="font-medium font-sans antialiased bg-background text-foreground vibe-scrollbar"
    @if($currentIdleTimeout && $currentIdleTimeout > 0) data-idle-timeout="{{ $currentIdleTimeout }}" @endif>
    @if($currentIdleTimeout && $currentIdleTimeout > 0)
        <div id="vibe-idle-tracker" data-timeout="{{ $currentIdleTimeout }}" class="hidden" style="display:none;"></div>
    @endif
    {{ $slot }}
    <vibe:alert position="top-right" />
    <vibe:toast position="top-right" />
    @livewireScripts
    @stack('body')
</body>
</html>

