<?php

return [
    'title' => 'Button',
    'badge' => 'Component',
    'group' => 'UI Components',
    'description' => 'Versatile button component supporting various color variants, 9 sizes (including icon-only), integrated loading spinner, automatic link navigation with wire:navigate, and full Livewire integration.',

    // Section 1: Basic Usage
    'basic_usage' => [
        'title' => 'Basic Usage',
        'desc' => 'Use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:button&gt;</code> tag to render a standard button. By default, buttons use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">default</code> variant and <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">md</code> size.',
        'preview_title' => 'Basic Button',
        'default_btn' => 'Default Button',
        'primary_btn' => 'Primary Button',
    ],

    // Section 2: Variants
    'variants' => [
        'title' => 'Visual Variants',
        'desc' => 'The <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">variant</code> prop controls the color scheme and visual hierarchy of the button. 12 pre-configured variants are available for diverse UI needs.',
        'preview_title' => 'Button Visual Variants',
        'items' => [
            'default' => 'Default',
            'primary' => 'Primary',
            'secondary' => 'Secondary',
            'outline' => 'Outline',
            'ghost' => 'Ghost',
            'surface' => 'Surface',
            'accent' => 'Accent',
            'destructive' => 'Destructive',
            'success' => 'Success',
            'warning' => 'Warning',
            'info' => 'Info',
            'link' => 'Link',
        ],
    ],

    // Section 3: Sizes
    'sizes' => [
        'title' => 'Sizes',
        'desc' => '5 standard text-based sizes: <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">xs</code> (28px), <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">sm</code> (32px), <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">md</code> (36px, default), <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">lg</code> (40px), and <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">xl</code> (44px).',
        'preview_title' => 'Text-Based Button Sizes',
    ],

    // Section 4: Icon Buttons
    'icons' => [
        'title' => 'Icon Buttons & Alignment',
        'desc' => 'SVG icons can be placed directly inside slots as leading or trailing elements. For icon-only buttons, use dedicated icon sizes: <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">icon-xs</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">icon-sm</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">icon-md</code>, or <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">icon-lg</code>.',
        'preview_title' => 'Buttons with Icons',
        'download' => 'Download File',
        'continue' => 'Continue',
        'filter' => 'Filter Data',
    ],

    // Section 5: Pill
    'pill' => [
        'title' => 'Pill Style',
        'desc' => 'Use the Tailwind class <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">rounded-full</code> to create buttons with fully rounded corners, ideal for filter chips, action badges, or circular controls.',
        'preview_title' => 'Fully Rounded Pill Buttons',
        'popular' => 'Popular Category',
        'explore' => 'Explore',
    ],

    // Section 6: Loading State
    'loading' => [
        'title' => 'Loading State',
        'desc' => 'Use the boolean prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">loading</code> to display an automated spinner animation next to button text and immediately disable user click interactions.',
        'preview_title' => 'Loading Spinner State',
        'saving' => 'Saving Data...',
        'deleting' => 'Deleting...',
    ],

    // Section 7: Status Disabled & Type
    'status' => [
        'title' => 'Disabled State & Button Type',
        'desc' => 'Standard HTML attributes like <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">disabled</code> are fully supported with reduced opacity styling and pointer event locking. Use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">type</code> prop for form actions (<code class="font-mono text-xs text-foreground">submit</code>, <code class="font-mono text-xs text-foreground">button</code>, <code class="font-mono text-xs text-foreground">reset</code>).',
        'preview_title' => 'Disabled State & Form Actions',
        'disabled' => 'Disabled Button',
        'submit' => 'Submit Form',
        'reset' => 'Reset Form',
    ],

    // Section 8: Button as Link
    'link' => [
        'title' => 'Button as Hyperlink (href)',
        'desc' => 'Passing an <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">href</code> prop automatically renders the component as an anchor tag <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;a wire:navigate&gt;</code> with full button aesthetics, preserving instant SPA transitions.',
        'preview_title' => 'Button Functioning as Hyperlink',
        'docs' => 'Go to Installation Guide',
    ],

    // Section 9: Livewire Integration
    'livewire' => [
        'title' => 'Livewire Integration',
        'desc' => 'The Button component supports all Livewire action directives seamlessly such as <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">wire:click</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">wire:loading.attr="disabled"</code>, and <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">wire:target</code>.',
        'preview_title' => 'Livewire Action with Target Loading',
        'sync' => 'Sync Livewire Action',
    ],

    // Section 10: Props Reference
    'props' => [
        'title' => 'Props Reference',
        'desc' => 'Complete list of attributes and properties supported by the <code class="font-mono text-xs text-foreground">&lt;vibe:button&gt;</code> component.',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Type',
            'default' => 'Default',
            'desc' => 'Description',
        ],
    ],

    // Section 11: Slots Reference
    'slots' => [
        'title' => 'Slots',
        'desc' => 'Listing of slots accepted by the component.',
        'columns' => [
            'slot' => 'Slot',
            'desc' => 'Description',
        ],
    ],
];
