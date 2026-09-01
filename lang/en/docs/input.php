<?php

return [
    'title' => 'Input',
    'badge' => 'Component',
    'group' => 'Form & Input',
    'description' => 'Modern and flexible text input component. Supports 5 visual variants, 4 sizes, leading/trailing icons, prefix/suffix text, error & disabled states, and full Livewire wire:model integration.',

    // Section 1: Basic Usage
    'basic_usage_title' => 'Basic Usage',
    'basic_usage_desc' => 'Use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:input&gt;</code> tag to create an input with an integrated label. The <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">name</code> prop automatically syncs with <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">id</code> and Laravel validation.',
    'basic_input_label' => 'Full Name',
    'basic_input_placeholder' => 'Enter your full name...',

    // Section 2: Variants
    'variants_title' => 'Visual Variants',
    'variants_desc' => 'The <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">variant</code> prop controls the visual style of the input. 5 choices are available for various design contexts.',
    'variant_outline' => 'Outline (default)',
    'variant_filled' => 'Filled',
    'variant_flush' => 'Flush',
    'variant_ghost' => 'Ghost',
    'variant_accent' => 'Accent',

    // Section 3: Sizes
    'sizes_title' => 'Sizes',
    'sizes_desc' => '4 size choices available: <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">sm</code> (32px), <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">md</code> (36px, default), <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">lg</code> (40px), and <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">xl</code> (44px).',

    // Section 4: Icons & Addons
    'icons_addons_title' => 'Icons & Addons',
    'icons_addons_desc' => 'Use the slot <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;x-slot:icon&gt;</code> for the left side and <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;x-slot:trailingIcon&gt;</code> for the right side. Use the props <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">prefix</code> / <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">suffix</code> for static text.',

    // Section 5: Pill
    'pill_title' => 'Pill Style',
    'pill_desc' => 'Use the Tailwind class <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">rounded-full</code> to create an input with fully rounded corners, perfect for search inputs.',

    // Section 6: Helper & Description
    'helper_title' => 'Description & Help Text',
    'helper_desc' => 'Use <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">description</code> for explanation text below the label, and <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">info</code> for helper notes below the input field.',

    // Section 7: Error & Validation
    'error_title' => 'Error & Validation',
    'error_desc' => 'Automatically displays errors from Laravel <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">$errors</code> matching the input <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">name</code>, or pass custom string messages via the prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">error</code>.',

    // Section 8: Status
    'status_title' => 'Status: Disabled & Readonly',
    'status_desc' => 'Supports native HTML attributes like <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">disabled</code> and <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">readonly</code> with automatic visual styling.',

    // Section 9: Livewire
    'livewire_title' => 'Livewire Integration',
    'livewire_desc' => 'Supports Livewire directives like <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">wire:model</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">wire:model.live</code>, and <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">wire:model.blur</code> seamlessly.',

    // Section 10: Props Reference
    'props_title' => 'Props Reference',
    'props_desc' => 'Comprehensive list of props supported by the <code class="font-mono text-xs text-foreground">&lt;vibe:input&gt;</code> component.',
    'table_prop' => 'Prop',
    'table_type' => 'Type',
    'table_default' => 'Default',
    'table_desc' => 'Description',

    // Section 11: Slots
    'slots_title' => 'Slots',
    'slots_desc' => 'List of available custom slots.',
    'table_slot' => 'Slot',
];
