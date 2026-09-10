<?php

return [
    'title' => 'Badge',
    'badge' => 'Component',
    'group' => 'UI Components',
    'description' => 'A versatile badge/label component for presenting status, numeric counts, tags, or categories with multiple color variants, sizes (sm to xl), status dot indicators with pulsing animations, leading & trailing icons, and interactive dismiss buttons.',

    // Section 1: Basic Usage
    'basic_usage' => [
        'title' => 'Basic Usage',
        'desc' => 'Use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:badge&gt;</code> tag to render a standard badge. By default, it uses the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">default</code> variant and <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">md</code> size.',
        'preview_title' => 'Standard Badge',
        'default' => 'Standard Badge',
        'primary' => 'Primary Badge',
    ],

    // Section 2: Variants
    'variants' => [
        'title' => 'Visual Variants',
        'desc' => 'The <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">variant</code> prop controls the color scheme and visual appearance. Colors integrate with Vibe UI theme tokens (<code class="font-mono text-xs text-foreground">success</code>, <code class="font-mono text-xs text-foreground">warning</code>, <code class="font-mono text-xs text-foreground">info</code>, <code class="font-mono text-xs text-foreground">destructive</code>) for dark and light mode consistency.',
        'preview_title' => 'Badge Color Variants',
        'items' => [
            'default' => 'Default',
            'primary' => 'Primary',
            'secondary' => 'Secondary',
            'outline' => 'Outline',
            'ghost' => 'Ghost',
            'accent' => 'Accent',
            'destructive' => 'Destructive',
            'success' => 'Success',
            'warning' => 'Warning',
            'info' => 'Info',
        ],
    ],

    // Section 3: Sizes
    'sizes' => [
        'title' => 'Sizes',
        'desc' => 'Badges come in 4 sizes: <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">sm</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">md</code> (default), <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">lg</code>, and <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">xl</code>, scaling heights, paddings, fonts, and icon/dot dimensions proportionately.',
        'preview_title' => 'Badge Sizes sm to xl',
    ],

    // Section 4: Pill Style
    'pill' => [
        'title' => 'Rounded Pill Style',
        'desc' => 'In accordance with Vibe UI design guidelines, use the Tailwind utility class <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">class="rounded-full"</code> to achieve fully rounded pill badges without extra attributes.',
        'preview_title' => 'Pill Badges with rounded-full',
    ],

    // Section 5: Dot Status
    'dot' => [
        'title' => 'Status Dot & Pulse Indicator',
        'desc' => 'Add the boolean prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">dot</code> to display a status dot. The dot color matches the selected variant. Enable <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">dotPulse</code> for an animated ping radar effect.',
        'preview_title' => 'Status Dot and Pulse Animation',
        'online' => 'Online',
        'away' => 'Busy',
        'offline' => 'Offline',
        'maintenance' => 'Maintenance',
    ],

    // Section 6: Icons and Addons
    'icons_addons' => [
        'title' => 'Icons & Prefix / Suffix',
        'desc' => 'Badges support leading icons (<code class="font-mono text-xs text-foreground">icon</code>), trailing icons (<code class="font-mono text-xs text-foreground">trailingIcon</code>), and prefix or suffix texts (<code class="font-mono text-xs text-foreground">prefix</code> / <code class="font-mono text-xs text-foreground">suffix</code>).',
        'preview_title' => 'Icons & Prefix / Suffix',
    ],

    // Section 7: Dismissible
    'dismissible' => [
        'title' => 'Dismissible Badges',
        'desc' => 'Use the boolean prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">dismissible</code> to show a close icon button allowing users to dismiss or remove the badge interactively.',
        'preview_title' => 'Dismissible Badge with Close Action',
    ],

    // Section 8: Link Badge
    'link' => [
        'title' => 'Link Badge (href)',
        'desc' => 'Passing an <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">href</code> prop automatically renders an interactive hyperlink <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;a wire:navigate&gt;</code> with hover states.',
        'preview_title' => 'Badge as a Link',
        'changelog' => 'View Changelog v2.0',
    ],

    // Section 9: Props Table
    'props' => [
        'title' => 'Props & Slots Reference',
        'desc' => 'Comprehensive reference of attributes and slots available on <code class="font-mono text-xs text-foreground">&lt;vibe:badge&gt;</code>.',
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
            'desc' => 'Description',
        ],
    ],

    'props_items' => [
        'variant' => 'Color scheme and visual variant of the badge.',
        'size' => 'Height, horizontal padding, and typography sizing.',
        'icon' => 'Leading visual icon placed on the left side.',
        'trailingIcon' => 'Trailing visual icon placed on the right side.',
        'prefix' => 'Prefix text before main content slot (e.g. currency symbol).',
        'suffix' => 'Suffix text after main content slot.',
        'dot' => 'Display status indicator dot on the left side.',
        'dotPulse' => 'Add radar ping animation effect to the status dot.',
        'dismissible' => 'Display interactive dismiss button on the right edge.',
        'href' => 'When provided, automatically renders badge as an `<a wire:navigate>` hyperlink.',
        'class' => 'Additional Tailwind classes via `twMerge` (e.g. `rounded-full` for pill style).',
    ],
    'slots_items' => [
        'default' => 'Main text or child element content inside the badge.',
        'icon' => 'Custom slot for leading SVG icon on the left.',
        'trailingIcon' => 'Custom slot for trailing SVG icon on the right.',
    ],
];
