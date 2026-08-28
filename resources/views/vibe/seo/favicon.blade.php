@props([
    'enabled' => config('vibe.seo.favicon.enabled', true),
    'dir' => config('vibe.seo.favicon.dir', '/vibe/favicon'),
    'themeColor' => config('vibe.seo.favicon.theme_color', '#0a0b0a'),
    'msTileColor' => config('vibe.seo.favicon.ms_tile_color', '#0a0b0a'),
])

@php
    if ($enabled) {
        $baseDir = trim(str_replace('public/', '', ltrim((string) $dir, '/')), '/');
        $siteName = config('vibe.seo.site_name', config('app.name', 'Vibe UI'));
    }
@endphp

@if($enabled)
    @push('seo')
        <!-- Favicon Suite -->
        <link rel="icon" type="image/png" href="{{ asset($baseDir . '/favicon-96x96.png') }}" sizes="96x96">
        <link rel="icon" type="image/svg+xml" href="{{ asset($baseDir . '/favicon.svg') }}">
        <link rel="shortcut icon" href="{{ asset($baseDir . '/favicon.ico') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset($baseDir . '/apple-touch-icon.png') }}">
        <meta name="apple-mobile-web-app-title" content="{{ $siteName }}">
        <link rel="manifest" href="{{ asset($baseDir . '/site.webmanifest') }}">
        <meta name="theme-color" content="{{ $themeColor }}">
        <meta name="msapplication-TileColor" content="{{ $msTileColor }}">
    @endpush
@endif
