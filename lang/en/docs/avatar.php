<?php

return [
    'title' => 'Avatar',
    'badge' => 'Component',
    'group' => 'UI Components',
    'description' => 'A versatile avatar component for rendering user profile photos, initials, or fallback silhouettes with multiple sizes (xs to 2xl), shapes (circle, square, rounded), color palettes for initials, presence status indicators (online/busy/away/offline), and stacked avatar grouping with overflow counter badges (+N).',

    // Section 1: Basic Usage
    'basic_usage' => [
        'title' => 'Basic Usage & Fallbacks',
        'desc' => 'The <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:avatar&gt;</code> component gracefully adapts to multiple display modes: profile images via the <code class="font-mono text-xs text-foreground">src</code> prop, initials via the <code class="font-mono text-xs text-foreground">initials</code> prop, custom icons via default slot, or standard silhouette fallback when no source is specified.',
        'preview_title' => 'Photo, Initials, Custom Icon & Default Silhouette',
        'image_label' => 'Profile Photo',
        'initials_label' => 'Initials Fallback',
        'custom_icon_label' => 'Custom Icon Slot',
        'fallback_label' => 'Default Silhouette',
    ],

    // Section 2: Sizes
    'sizes' => [
        'title' => 'Size Options (sizes)',
        'desc' => '6 proportional sizes are available: <code class="font-mono text-xs text-foreground">xs</code> (24px), <code class="font-mono text-xs text-foreground">sm</code> (32px), <code class="font-mono text-xs text-foreground">md</code> (40px, default), <code class="font-mono text-xs text-foreground">lg</code> (48px), <code class="font-mono text-xs text-foreground">xl</code> (56px), and <code class="font-mono text-xs text-foreground">2xl</code> (64px).',
        'preview_title' => 'Sizes from xs to 2xl',
    ],

    // Section 3: Shapes
    'shapes' => [
        'title' => 'Shape Geometries (shape)',
        'desc' => 'Use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">shape</code> prop to configure the avatar outline: <code class="font-mono text-xs text-foreground">circle</code> (default, fully circular), <code class="font-mono text-xs text-foreground">rounded</code> (medium rounded corners), or <code class="font-mono text-xs text-foreground">square</code> (large rounded corners). Presence indicators automatically align to shape corners.',
        'preview_title' => 'Avatar Shape Options',
        'circle' => 'Circle (Default)',
        'rounded' => 'Rounded',
        'square' => 'Square',
    ],

    // Section 4: Status Indicator
    'indicators' => [
        'title' => 'Presence Status Indicators (indicator)',
        'desc' => 'Provide the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">indicator</code> prop to reflect user availability: <code class="font-mono text-xs text-foreground">online</code> (success green), <code class="font-mono text-xs text-foreground">busy</code> (destructive red), <code class="font-mono text-xs text-foreground">away</code> (warning amber), or <code class="font-mono text-xs text-foreground">offline</code> (muted gray). Status dots automatically apply background contrast rings.',
        'preview_title' => 'Presence Indicators',
        'online' => 'Online',
        'busy' => 'Busy / Do Not Disturb',
        'away' => 'Away',
        'offline' => 'Offline',
    ],

    // Section 5: Initials Colors
    'colors' => [
        'title' => 'Initials Color Palette (color)',
        'desc' => 'For initials-based avatars, pick from curated vibrant color palettes with light and dark mode support: <code class="font-mono text-xs text-foreground">blue</code>, <code class="font-mono text-xs text-foreground">green</code>, <code class="font-mono text-xs text-foreground">red</code>, <code class="font-mono text-xs text-foreground">purple</code>, <code class="font-mono text-xs text-foreground">yellow</code>, <code class="font-mono text-xs text-foreground">pink</code>, and <code class="font-mono text-xs text-foreground">orange</code>.',
        'preview_title' => 'Initials Color Palette',
    ],

    // Section 6: Avatar Group
    'group_sec' => [
        'title' => 'Stacked Avatar Groups (Avatar Group)',
        'desc' => 'Utilize the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:avatar.group&gt;</code> component to display stacked collaborator avatars with separator rings, visual capacity limits (<code class="font-mono text-xs text-foreground">limit</code>), and dynamic overflow counters (<code class="font-mono text-xs text-foreground">+N</code>).',
        'preview_title' => 'Avatar Group with Overflow Counter',
        'sample_team' => 'Vibe UI Core Team',
    ],

    // Section 7: Props Reference
    'props' => [
        'title' => 'Props & Slots Reference',
        'desc' => 'Comprehensive reference of props and slots available for <code class="font-mono text-xs text-foreground">&lt;vibe:avatar&gt;</code> and <code class="font-mono text-xs text-foreground">&lt;vibe:avatar.group&gt;</code>.',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Type',
            'default' => 'Default',
            'desc' => 'Description',
        ],
    ],

    'slots' => [
        'title' => 'Available Slots',
        'columns' => [
            'slot' => 'Slot',
            'desc' => 'Description & Usage',
        ],
    ],

    'props_items' => [
        'avatar' => [
            'src' => 'Profile image source URL.',
            'alt' => 'Image accessibility alt text.',
            'initials' => 'Fallback initials text (1-3 letters) when image is unavailable.',
            'size' => "Size options: `'xs'`, `'sm'`, `'md'`, `'lg'`, `'xl'`, or `'2xl'`.",
            'shape' => "Avatar shape geometry: `'circle'`, `'rounded'`, or `'square'`.",
            'indicator' => "Online presence status dot: `'online'`, `'busy'`, `'away'`, or `'offline'`.",
            'color' => "Initials background color palette: `'blue'`, `'green'`, `'red'`, `'purple'`, `'yellow'`, `'pink'`, `'orange'` (default: secondary).",
        ],
        'group' => [
            'limit' => 'Maximum visible avatars rendered before truncation.',
            'total' => 'Total members count to compute remaining overflow counter badge (+N).',
            'size' => "Group avatar and badge counter size: `'xs'`, `'sm'`, `'md'`, `'lg'`, `'xl'`, `'2xl'`.",
            'overlap' => 'If `true`, applies overlapping negative spacing (-space-x-3) with border rings.',
        ],
    ],
];
