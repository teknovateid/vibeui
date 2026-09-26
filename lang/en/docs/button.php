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
        'desc' => 'The <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">variant</code> prop controls the color scheme and visual hierarchy of the button. 11 pre-configured variants are available for diverse UI needs.',
        'preview_title' => 'Button Visual Variants',
        'items' => [
            'default' => 'Default',
            'primary' => 'Primary',
            'secondary' => 'Secondary',
            'outline' => 'Outline',
            'ghost' => 'Ghost',
            'surface' => 'Surface',
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
        'title' => 'Loading State (Realtime Alpine & Livewire)',
        'desc' => 'The Button component supports responsive realtime loading spinners via the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">loading</code> prop (boolean or custom text), reactive Alpine.js bindings (<code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">::loading="isBusy"</code> or <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">x-loading="isBusy"</code>), and native Livewire auto-wiring.',
        'preview_title' => 'Loading Spinner & Reactive State',
        'saving' => 'Saving Data...',
        'deleting' => 'Deleting...',
        'alpine_demo_btn' => 'Click for Loading Simulation (2s)',
        'alpine_demo_busy' => 'Processing Request...',
        'custom_text_btn' => 'Save Changes',
        'custom_text_loading' => 'Saving to Server...',
    ],

    // Section 7: Animation & Attention
    'animation' => [
        'title' => 'Animation & Attention Effects (Pulse & Shake)',
        'desc' => 'Draw user attention to primary actions or Call-to-Actions (CTA) using the boolean prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">pulse</code> (or <code class="font-mono text-xs text-foreground">animation="pulse"</code>) for a rhythmic glowing radar ring, or use <code class="font-mono text-xs text-foreground">animation="shake"</code> for hazardous actions or validation failure cues.',
        'preview_title' => 'Buttons with Animation Effects',
        'cta' => 'Get Started Free',
        'danger' => 'Confirm Delete Data',
        'pop' => 'Claim 50% Off',
    ],

    // Section 8: Status Disabled & Type
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
        'title' => 'Livewire Integration (Auto-Wiring Loading)',
        'desc' => 'The Button component automatically detects Livewire actions like <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">wire:click</code> or <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">wire:target</code> when the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">loading</code> prop is present. The spinner and disabled state engage automatically during requests without needing manual boilerplate.',
        'preview_title' => 'Livewire Action with Auto-Loading Target',
        'sync' => 'Sync Livewire Action',
        'auto_loading_desc' => 'Simply add the <code>loading</code> attribute to your button with <code>wire:click</code>:',
    ],

    // Section 10: Button Group
    'button_group' => [
        'title' => 'Button Group',
        'desc' => 'The <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:button.group&gt;</code> component attaches multiple buttons together into a cohesive visual unit. Inner button corners automatically flatten, borders collapse cleanly without doubling up, and active or focused buttons gracefully elevate their z-index above sibling elements.',
        'preview_attached_title' => 'Attached Button Group',
        'preview_padded_title' => 'Button Group with Padding (Padded Container)',
        'preview_split_title' => 'Split Button with Dropdown',
        'preview_pill_title' => 'Pill Button Group',
        'preview_vertical_title' => 'Vertical Button Group',
        'padded_active' => 'Active',
        'padded_pending' => 'Pending',
        'padded_completed' => 'Completed',
        'segmented' => [
            'daily' => 'Daily',
            'weekly' => 'Weekly',
            'monthly' => 'Monthly',
            'yearly' => 'Yearly',
        ],
        'split' => [
            'save' => 'Save Changes',
            'save_draft' => 'Save as Draft',
            'save_publish' => 'Save & Publish',
        ],
        'vertical' => [
            'overview' => 'Overview',
            'analytics' => 'Analytics',
            'reports' => 'Reports',
        ],
        'props_title' => '<vibe:button.group> Props',
        'props_desc' => 'Listing of attributes and properties accepted by the <code class="font-mono text-xs text-foreground">&lt;vibe:button.group&gt;</code> component.',
    ],

    // Section 11: Button Show & Data Population
    'button_show' => [
        'title' => 'Data Show Button (<vibe:button.show>)',
        'desc' => 'The <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:button.show&gt;</code> component fetches data from an AJAX endpoint and automatically populates elements inside the target container using <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:show key="..."&gt;</code>, the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">vibe-show="..."</code> attribute, array looping via <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:show.each key="..."&gt;</code>, and all Vibe UI form components (input, textarea, select, switch, checkbox, radio, etc.).',
        'preview_title' => 'Fetch & Populate Data (Modal Target)',
        'sheet_preview_title' => 'Fetch & Populate Data (Sheet / Drawer Target)',
        'inline_preview_title' => 'Direct Inline Container Population',
        'trigger_btn' => 'Show Demo Data',
        'trigger_sheet_btn' => 'View in Side Sheet',
        'trigger_inline_btn' => 'Load into Card',
        'modal_title' => 'User Details',
    ],

    // Section 12: Button Delete & Confirmation
    'button_delete' => [
        'title' => 'Delete Button (<vibe:button.delete>)',
        'desc' => 'The <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:button.delete&gt;</code> component is built specifically for destructive actions, featuring an integrated confirmation dialog. It prevents accidental deletion and supports seamless execution via Livewire (<code class="font-mono text-xs">wire:click</code>), HTTP DELETE form submit (<code class="font-mono text-xs">url</code>), or custom JavaScript callbacks (<code class="font-mono text-xs">action</code>).',
        'preview_title' => 'Delete Button with Confirmation Dialog',
        'preview_methods_title' => 'Execution Method Support',
        'preview_table_title' => 'Table Row Action Example (Icon Mode)',
        'custom_dialog_title' => 'Customizing Dialog Title, Message, and Action Buttons',
        'trigger_btn' => 'Delete Item',
        'trigger_account' => 'Delete Account Permanently',
        'trigger_icon' => 'Delete',
        'alert_deleted' => 'Item successfully deleted!',
        'alert_account_deleted' => 'Account deletion request has been processed.',
        'props_title' => '<vibe:button.delete> Props',
        'props_desc' => 'Listing of attributes and properties accepted by the <code class="font-mono text-xs text-foreground">&lt;vibe:button.delete&gt;</code> component.',
    ],

    // Section 13: Props Reference
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

    // Section 14: Slots Reference
    'slots' => [
        'title' => 'Slots',
        'desc' => 'Listing of slots accepted by the component.',
        'columns' => [
            'slot' => 'Slot',
            'desc' => 'Description',
        ],
    ],
];

