<?php

return [
    'title' => 'Directory Structure',
    'badge' => 'Documentation',
    'subtitle' => 'Vibe UI Architecture & File Organization',
    'description' => 'Learn how Vibe UI files and folders are structured within your Laravel project for seamless customization of Blade components, Tailwind CSS styling, JavaScript assets, and multi-language localization.',

    // Section 1: Overview
    'overview_title' => 'Directory Overview',
    'overview_desc' => 'After running the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">php artisan vibe:install</code> command, Vibe UI files and assets will be placed in your Laravel application directories:',
    'tree_title' => 'Vibe UI Directory Structure',
    'tree_comment_config' => 'Main Vibe UI configuration (prefix, theme, etc.)',
    'tree_comment_lang_en' => 'Component translation files (English)',
    'tree_comment_lang_id' => 'Component translation files (Indonesian)',
    'tree_comment_css_app' => 'Semantic color tokens, radius, & dark mode',
    'tree_comment_css_variant' => 'Tailwind CSS v4 custom variants (select:, minified:, etc.)',
    'tree_comment_css_highlight' => 'Built-in Syntax Highlighter theme',
    'tree_comment_js_highlight' => 'Highlight.js syntax renderer helper',
    'tree_comment_js_theme' => 'Theme manager (Dark / Light mode switcher)',
    'tree_comment_views' => 'All Vibe UI Blade component view templates',
    'tree_comment_routes' => 'Modular application routing file',

    // Section 2: Blade Components
    'views_title' => '1. Blade Components (resources/views/vibe/)',
    'views_desc' => 'All Vibe UI components are built using standard Blade views. Once published, you have 100% control to customize HTML markup, Tailwind CSS styling, or Alpine.js interactions directly in this folder.',
    'views_card_structure_title' => 'Component Structure',
    'views_card_structure_desc' => 'Each component has its own dedicated subfolder (e.g., <code class="font-mono text-foreground">vibe/input/</code>, <code class="font-mono text-foreground">vibe/sheet/</code>). The <code class="font-mono text-foreground">index.blade.php</code> file acts as the main entry point.',
    'views_card_props_title' => 'Clean Prop Configuration',
    'views_card_props_desc' => 'All properties and default values are concisely declared via the <code class="font-mono text-foreground">@props</code> directive, including built-in localized translation strings.',

    // Section 3: CSS & Styling
    'css_title' => '2. Styling & Theme Tokens (resources/css/vibe/)',
    'css_desc' => 'This folder manages all Vibe UI Design System tokens powered by Tailwind CSS v4:',
    'css_th_file' => 'CSS File',
    'css_th_desc' => 'Purpose & Usage',
    'css_row_app' => 'Defines CSS color variables (<code class="font-mono text-foreground">--background</code>, <code class="font-mono text-foreground">--primary</code>, etc.), radius (<code class="font-mono text-foreground">--radius-*</code>), and dark mode scheme.',
    'css_row_variant' => 'Registers Tailwind CSS v4 custom variants such as <code class="font-mono text-foreground">select:</code> (for active items), <code class="font-mono text-foreground">minified:</code>, and sheet/sidebar states.',
    'css_row_highlight' => 'Built-in codeblock syntax highlighting theme that automatically adapts to light and dark modes.',

    // Section 4: JavaScript Assets
    'js_title' => '3. JavaScript Assets (resources/js/vibe/)',
    'js_desc' => 'Vibe UI emphasizes high performance without heavy JS frameworks. Supporting scripts are organized modularly:',
    'js_card_theme_title' => 'Theme Manager',
    'js_card_theme_desc' => 'Handles instantaneous Dark/Light mode switching, synchronizes with OS system preferences, and persists state in LocalStorage without FOUC (<i>Flash of Unstyled Content</i>).',
    'js_card_highlight_title' => 'Syntax Highlighter',
    'js_card_highlight_desc' => 'Lightweight initialization for <code class="font-mono text-foreground">&lt;vibe:highlightjs&gt;</code> and <code class="font-mono text-foreground">&lt;vibe:preview&gt;</code> with copy code and language auto-detection.',

    // Section 5: Localization
    'lang_title' => '4. Languages & Translations (lang/{locale}/vibe/)',
    'lang_desc' => 'All UI labels and text in Vibe UI components natively support multi-language localization via Laravel\'s translation system:',
    'lang_card_desc' => 'Language files are neatly organized per component, making them easy to maintain and extend:',

    // Section 6: Configuration
    'config_title' => '5. Configuration (config/vibe.php)',
    'config_desc' => 'The primary configuration file for managing global Vibe UI behavior in your application:',
];
