<?php

return [
    'title' => 'Directory Structure',
    'badge' => 'Documentation',
    'subtitle' => 'Architecture & File Layout',
    'description' => 'Understand the folder layout and file architecture of Vibe UI in a Laravel project for streamlined customization of Blade components, Tailwind CSS v4 styling, JavaScript assets, and multi-language localization.',

    // Section 1: Overview
    'overview' => [
        'title' => 'Directory Structure Overview',
        'desc' => 'After running the installation command <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">php artisan vibe:install</code>, Vibe UI files and assets are established in the following locations:',
        'tree_title' => 'Vibe UI Directory Tree',
        'tree_comments' => [
            'config' => 'Main Vibe UI configuration (prefix, theme, etc.)',
            'lang_en' => 'Component translation files (English)',
            'lang_id' => 'Component translation files (Bahasa Indonesia)',
            'css_app' => 'Semantic color tokens, radius, & dark mode',
            'css_variant' => 'Tailwind CSS v4 custom variants (select:, minified:, etc.)',
            'css_highlight' => 'Built-in Syntax Highlighter theme',
            'js_highlight' => 'Highlight.js syntax renderer helper',
            'js_theme' => 'Theme manager (Dark / Light mode switcher)',
            'views' => 'All Vibe UI Blade component templates',
            'routes' => 'Modular application routing files',
        ],
    ],

    // Section 2: Blade Views
    'blade_views' => [
        'title' => '1. Blade Components (resources/views/vibe/)',
        'desc' => 'All Vibe UI components are constructed with standard Blade Views. Once published, you have 100% control to modify HTML markup, Tailwind CSS classes, or Alpine.js interactions directly in this folder.',
        'structure_card' => [
            'title' => 'Component Structure',
            'desc' => 'Each component has its own dedicated subfolder (e.g., <code class="font-mono text-foreground">vibe/input/</code>, <code class="font-mono text-foreground">vibe/sheet/</code>). The <code class="font-mono text-foreground">index.blade.php</code> file serves as the primary component entry point.',
        ],
        'props_card' => [
            'title' => 'Clean Prop Definitions',
            'desc' => 'All properties and default values are concisely declared using the <code class="font-mono text-foreground">@props</code> directive, including built-in localized string lookups.',
        ],
    ],

    // Section 3: CSS Styling
    'css_styling' => [
        'title' => '2. CSS Tokens & Styling (resources/css/vibe/)',
        'desc' => 'This folder manages all Vibe UI Design System tokens powered by Tailwind CSS v4:',
        'columns' => [
            'file' => 'CSS File',
            'desc' => 'Role & Usage',
        ],
        'rows' => [
            'app' => 'Defines CSS custom properties (<code class="font-mono text-foreground">--background</code>, <code class="font-mono text-foreground">--primary</code>, etc.), radius (<code class="font-mono text-foreground">--radius-*</code>), and dark mode color schemes.',
            'variant' => 'Registers Tailwind CSS v4 custom variants such as <code class="font-mono text-foreground">select:</code> (for active items), <code class="font-mono text-foreground">minified:</code>, and sheet/sidebar states.',
            'highlight' => 'Codeblock syntax color themes that seamlessly transition between light and dark modes.',
        ],
    ],

    // Section 4: JavaScript Assets
    'js_assets' => [
        'title' => '3. JavaScript Assets (resources/js/vibe/)',
        'desc' => 'Vibe UI emphasizes peak performance without heavy JavaScript dependencies. Helper scripts are organized modularly:',
        'theme_card' => [
            'title' => 'Theme Manager',
            'desc' => 'Handles instant Dark/Light mode switching, synchronizes with OS preference, and stores state in LocalStorage without FOUC (<i>Flash of Unstyled Content</i>).',
        ],
        'highlight_card' => [
            'title' => 'Syntax Highlighter',
            'desc' => 'Lightweight initializer for <code class="font-mono text-foreground">&lt;vibe:highlightjs&gt;</code> and <code class="font-mono text-foreground">&lt;vibe:preview&gt;</code> with code copying and automatic language detection.',
        ],
    ],

    // Section 5: Localization
    'localization' => [
        'title' => '4. Languages & Localization (lang/{locale}/vibe/)',
        'desc' => 'All labels and UI strings across Vibe UI components natively support multiple languages via Laravel translation keys:',
        'card_desc' => 'Language files are partitioned by component for clear organization and easy modification:',
    ],

    // Section 6: Configuration
    'config' => [
        'title' => '5. Configuration File (config/vibe.php)',
        'desc' => 'Primary configuration file to adjust global Vibe UI behavior in your application:',
    ],
];
