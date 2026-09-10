<?php

return [
    'seo_title' => 'Color Design System — Vibe UI',
    'seo_description' => 'Comprehensive guide to semantic color usage in Vibe UI: CSS tokens, component variant patterns, match() formulas, and system-wide color consistency rules.',
    'breadcrumb' => 'Color Design System',

    'header' => [
        'badge' => 'Design System',
        'subtitle' => 'Guidelines & Reference',
        'title' => 'Color Design System',
        'desc' => 'Comprehensive guide to Vibe UI semantic color tokens, per-component <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">match()</code> variant formulas, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">color-mix()</code> usage patterns, and color consistency rules across all components.',
    ],

    'sections' => [
        'tokens' => [
            'title' => 'Semantic Color Tokens',
            'desc' => 'Vibe UI uses CSS Custom Properties as the single source of truth for colors. All components <strong>must</strong> use these tokens — never raw hex values — to ensure light/dark theme switching works automatically.',
            'palette' => [
                'primary' => ['name' => 'primary', 'role' => 'Primary action, default foreground'],
                'secondary' => ['name' => 'secondary', 'role' => 'Secondary action, muted surface'],
                'success' => ['name' => 'success', 'role' => 'Confirmation, completed, saved'],
                'warning' => ['name' => 'warning', 'role' => 'Warning, threshold caution'],
                'destructive' => ['name' => 'destructive', 'role' => 'Error, danger, delete'],
                'info' => ['name' => 'info', 'role' => 'Information, help, system notice'],
                'accent' => ['name' => 'accent', 'role' => 'Hover surface, subtle highlight'],
                'muted' => ['name' => 'muted', 'role' => 'Secondary text, placeholder'],
            ],
            'surface_table' => [
                'title' => 'Surface & Structural Tokens',
                'columns' => [
                    'token' => 'CSS Token',
                    'light' => 'Light',
                    'dark' => 'Dark',
                    'usage' => 'Usage',
                ],
                'items' => [
                    'background' => 'Main page background',
                    'foreground' => 'Primary text on background',
                    'card' => 'Card & panel surface',
                    'card_foreground' => 'Text on cards',
                    'popover' => 'Dropdown, tooltip, popover surface',
                    'border' => 'Dividers, borders, outlines',
                    'input' => 'Empty input background / slider track',
                    'ring' => 'Focus ring outline',
                    'muted_foreground' => 'Placeholder text, hint, caption',
                    'sidebar' => 'Sidebar navigation background',
                    'header' => 'Header/topbar background',
                ],
            ],
        ],

        'formulas' => [
            'title' => 'Variant Formulas: Solid vs Soft',
            'desc' => 'Vibe UI uses two primary formulas for interactive components. Choose a formula based on the desired <strong>visual weight</strong>.',
            'solid' => [
                'title' => 'SOLID Formula',
                'badge' => 'Button, Switch Track, Range',
                'desc' => 'Used for high-priority interactive elements: primary buttons, active slider tracks, toggle switches.',
            ],
            'soft' => [
                'title' => 'SOFT (Tinted) Formula',
                'badge' => 'Badge, Alert, Card Highlight',
                'desc' => 'Used for status indicators, badges, and gentle highlights to prevent visual dominance.',
            ],
            'opacity' => [
                'title' => 'Standard Opacity Modifier Rules',
                'columns' => [
                    'modifier' => 'Modifier',
                    'usage' => 'Usage',
                    'example' => 'Example Class',
                ],
                'items' => [
                    ['mod' => '/90', 'usage' => 'Hover state for solid buttons', 'example' => 'hover:bg-primary/90'],
                    ['mod' => '/80', 'usage' => 'Hover state for secondary/muted', 'example' => 'hover:bg-secondary/80'],
                    ['mod' => '/15', 'usage' => 'Background for soft badge/alert', 'example' => 'bg-success/15'],
                    ['mod' => '/20', 'usage' => 'Border for soft badge/alert', 'example' => 'border-success/20'],
                    ['mod' => '/10', 'usage' => 'Hover overlay for ghost/icon buttons', 'example' => 'hover:bg-foreground/10'],
                    ['mod' => '/25–35', 'usage' => 'Focus ring via color-mix()', 'example' => 'color-mix(in srgb, --primary 25%, transparent)'],
                    ['mod' => '/50', 'usage' => 'Disabled state opacity', 'example' => 'disabled:opacity-50'],
                    ['mod' => '/70', 'usage' => 'Secondary text/subtle caption', 'example' => 'text-muted-foreground/70'],
                ],
            ],
        ],

        'components' => [
            'title' => 'Per-Component Color Formulas',
            'desc' => 'Reference table of color patterns for every component. All components use PHP <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">match($variant)</code> to generate clean Tailwind classes.',
            'button' => [
                'title' => 'Button',
                'columns' => [
                    'variant' => 'Variant',
                    'formula' => 'Color Formula',
                    'hover' => 'Hover',
                ],
            ],
            'badge' => [
                'title' => 'Badge',
                'formula_label' => '📐 Badge Formula (Soft/Tinted — distinct from Button):',
                'note' => '💡 Badges use a <strong>soft tinted</strong> pattern (/15 background opacity + direct text color) rather than solid backgrounds like Buttons.',
            ],
            'switch' => [
                'title' => 'Switch',
                'formula_label' => '📐 Switch Track Formula (Checked State):',
                'note' => '💡 Switch uses a <strong>SOLID pattern</strong> on active tracks, with thumb always set to <code class="font-mono">bg-background</code> for maximum contrast.',
            ],
            'range' => [
                'title' => 'Range Slider',
                'formula_label' => '📐 Range Formula (CSS Custom Property via PHP match()):',
            ],
            'form_group' => [
                'title' => 'Input, Textarea, Select, Date-Time',
                'badge' => 'Form Group',
                'labels' => [
                    'default' => 'Default',
                    'default_placeholder' => 'Normal value',
                    'error' => 'Error State',
                    'error_placeholder' => 'Invalid value',
                    'error_msg' => 'This field is required.',
                    'info' => 'Info State',
                    'info_placeholder' => 'Value with helper hint',
                    'info_msg' => 'Format: dd/mm/yyyy',
                    'readonly' => 'Readonly',
                    'readonly_val' => 'Cannot be modified',
                ],
                'formula_label' => '📐 Form Group Formula (state-based, no color variant prop):',
                'note' => '💡 Form components <strong>do not have a color <code class="font-mono">variant</code> prop</strong>. Colors change solely based on state: normal, error, disabled/readonly.',
            ],
            'dropdown' => [
                'title' => 'Dropdown',
                'formula_label' => '📐 Dropdown Item Color Formula:',
                'note' => '💡 Semantic dropdown items use a <strong>colored text + /10 background</strong> hover pattern — the cleanest formula for compact menus.',
            ],
            'modal_sheet' => [
                'title' => 'Modal & Sheet',
                'formula_label' => '📐 Modal & Sheet Formula:',
            ],
        ],

        'color_mix' => [
            'title' => 'Formula <code class="text-lg">color-mix()</code> — Focus Ring & Hover Glow',
            'desc' => 'CSS <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">color-mix(in srgb, ...)</code> is used to generate semi-transparent shades from solid tokens — ideal for focus rings and glowing active states.',
            'columns' => [
                'formula' => 'Formula',
                'usage' => 'Usage',
                'where' => 'Used In',
            ],
            'items' => [
                ['formula' => 'color-mix(in srgb, var(--primary) 25%, transparent)', 'usage' => 'Soft focus ring for buttons/inputs', 'where' => 'Button :active ring, Input focus'],
                ['formula' => 'color-mix(in srgb, var(--range-active-color) 25%, transparent)', 'usage' => 'Active ring for slider thumb', 'where' => 'Range Slider :active state'],
                ['formula' => 'color-mix(in srgb, var(--ring) 35%, transparent)', 'usage' => 'Main focus-visible ring', 'where' => 'Range Slider :focus-visible'],
                ['formula' => 'color-mix(in srgb, var(--primary-foreground) 35%, transparent)', 'usage' => 'Progress bar shimmer beam', 'where' => 'NProgress bar ::after'],
            ],
            'faq_title' => '📌 Why color-mix() instead of Tailwind opacity modifiers?',
            'faq_desc' => 'Tailwind opacity modifiers (<code class="font-mono">bg-primary/25</code>) only apply to <code class="font-mono">background</code> elements. For <code class="font-mono">box-shadow</code> and <code class="font-mono">border-color</code> requiring semi-transparent colors derived from dynamic CSS tokens, <code class="font-mono">color-mix()</code> is the only standard solution that works consistently across all modern browsers.',
        ],

        'dark_mode' => [
            'title' => 'Dark Mode Rules',
            'desc' => 'Because all component colors rely on CSS tokens (rather than raw hex values), dark mode functions automatically by updating CSS variables on the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">.dark</code> root — without writing <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">dark:</code> classes per component.',
            'correct_title' => '✅ Recommended Pattern',
            'correct_desc' => 'These tokens automatically adapt when switching themes.',
            'avoid_title' => '❌ Patterns to Avoid',
            'avoid_desc' => 'Literal color values cannot adapt to theme changes.',
            'exceptions_title' => '📌 Permitted Exceptions',
            'exceptions' => [
                '<code class="font-mono">bg-black/50</code> color for modal overlay backdrops (an absolute dark overlay desired in both themes).',
                'Pinned violet accent (<code class="font-mono">oklch(0.511 0.262 276.966)</code>) in range slider <code class="font-mono">accent</code> variant — because the <code class="font-mono">--accent</code> token in Vibe UI is reserved for hover surfaces (not violet).',
                'Chart colors (<code class="font-mono">--chart-1</code> through <code class="font-mono">--chart-5</code>) which may differ between light and dark themes.',
            ],
        ],

        'guidelines' => [
            'title' => 'Variant Selection Guide',
            'desc' => 'Use this table as a quick reference for choosing the semantically appropriate variant in any UI context.',
            'columns' => [
                'context' => 'Context / Scenario',
                'variant' => 'Recommended Variant',
                'note' => 'Notes',
            ],
            'items' => [
                ['context' => 'Primary action (Submit, Save, Confirm)', 'variant' => 'primary', 'note' => 'Always use primary for the most critical CTA on the page'],
                ['context' => 'Secondary action (Cancel, Back, Reset)', 'variant' => 'secondary / outline', 'note' => 'secondary provides solid surface, outline is lighter'],
                ['context' => 'Delete / Destructive / Irreversible', 'variant' => 'danger', 'note' => 'Mandatory danger variant for permanent actions that cannot be undone'],
                ['context' => 'Success / Done / Active / Saved', 'variant' => 'success', 'note' => 'Payment confirmation, active status badge, optimal slider range'],
                ['context' => 'Warning / Threshold / Almost full', 'variant' => 'warning', 'note' => 'Usage quota alert, soft validation, important settings warning'],
                ['context' => 'Information / Guide / System notice', 'variant' => 'info', 'note' => 'Informational alerts, info badges, system parameter ranges'],
                ['context' => 'Accent / Premium / Special feature', 'variant' => 'accent', 'note' => 'Star ratings, premium feature toggles, special highlights'],
                ['context' => 'Ghost action / inline in card or list', 'variant' => 'ghost', 'note' => 'Inline edit buttons, icon actions, context menus'],
                ['context' => 'Card surface / panel / container action', 'variant' => 'surface', 'note' => 'Buttons matching the card surface, low priority actions'],
            ],
        ],
    ],
];
