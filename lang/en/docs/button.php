<?php

return [
    'title' => 'Button',
    'badge' => 'Component',
    'group' => 'UI Components',
    'description' => 'Versatile and interactive button component featuring multiple visual variants, 9 sizes (including dedicated icon-only dimensions), built-in loading spinner, automatic link tag conversion with wire:navigate, and seamless Livewire support.',

    // Section 1: Basic Usage
    'basic_usage_title' => 'Basic Usage',
    'basic_usage_desc' => 'Use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:button&gt;</code> tag to render a standard button. By default, the button uses the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">default</code> variant and <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">md</code> size.',

    // Section 2: Variants
    'variants_title' => 'Visual Variants',
    'variants_desc' => 'The <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">variant</code> prop determines the button color scheme and visual weight. 12 variants are available out of the box for various design requirements.',
    'variant_default' => 'Default',
    'variant_primary' => 'Primary',
    'variant_secondary' => 'Secondary',
    'variant_outline' => 'Outline',
    'variant_ghost' => 'Ghost',
    'variant_surface' => 'Surface',
    'variant_accent' => 'Accent',
    'variant_destructive' => 'Destructive',
    'variant_success' => 'Success',
    'variant_warning' => 'Warning',
    'variant_info' => 'Info',
    'variant_link' => 'Link',

    // Section 3: Sizes
    'sizes_title' => 'Sizes',
    'sizes_desc' => '5 standard text-based sizes are available: <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">xs</code> (28px), <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">sm</code> (32px), <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">md</code> (36px, default), <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">lg</code> (40px), and <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">xl</code> (44px).',

    // Section 4: Icon Buttons
    'icons_title' => 'Icon Buttons & Alignment',
    'icons_desc' => 'SVG icons can be placed directly inside the button slot as leading or trailing icons. For buttons that only contain an icon (icon-only), use one of the dedicated icon sizes: <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">icon-xs</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">icon-sm</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">icon-md</code>, or <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">icon-lg</code>.',

    // Section 5: Pill
    'pill_title' => 'Pill Style',
    'pill_desc' => 'Use the Tailwind class <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">rounded-full</code> to give the button a fully rounded shape, ideal for filter chips, tags, or circular actions.',

    // Section 6: Loading State
    'loading_title' => 'Loading State',
    'loading_desc' => 'Use the boolean <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">loading</code> prop to automatically display an animated SVG spinner to the left of the button content and disable user click interactions.',

    // Section 7: Status Disabled & Type
    'status_title' => 'Disabled Status & Button Types',
    'status_desc' => 'Native HTML attributes like <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">disabled</code> are fully supported with reduced opacity and blocked pointer events. Use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">type</code> prop to define the form button behavior (<code class="font-mono text-xs text-foreground">submit</code>, <code class="font-mono text-xs text-foreground">button</code>, <code class="font-mono text-xs text-foreground">reset</code>).',

    // Section 8: Button as Link
    'link_title' => 'Button as Link (href)',
    'link_desc' => 'When the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">href</code> prop is provided, the component renders as an <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;a wire:navigate&gt;</code> link while retaining complete button styling and instant SPA page transitions.',

    // Section 9: Livewire Integration
    'livewire_title' => 'Livewire Integration',
    'livewire_desc' => 'Button components work seamlessly with Livewire directives such as <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">wire:click</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">wire:loading.attr="disabled"</code>, and <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">wire:target</code>.',

    // Section 10: Props Reference
    'props_title' => 'Props Reference',
    'props_desc' => 'Comprehensive list of attributes and options supported by the <code class="font-mono text-xs text-foreground">&lt;vibe:button&gt;</code> component.',
    'table_prop' => 'Prop',
    'table_type' => 'Type',
    'table_default' => 'Default',
    'table_desc' => 'Description',

    // Section 11: Slots Reference
    'slots_title' => 'Slots',
    'slots_desc' => 'List of slots supported by the component.',
    'table_slot' => 'Slot',
];
