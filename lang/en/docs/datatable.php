<?php

return [
    'title' => 'DataTable',
    'badge' => 'Enterprise Component',
    'group' => 'UI Components',
    'description' => 'High-performance server-side data table powered by Rappasoft and completely redesigned with Vibe UI theme tokens. Features debounced live search, multi-column sorting, dynamic column visibility, bulk actions, and seamless pagination.',

    'features' => [
        'title' => 'Core Capabilities',
        'server_side' => 'Server-side processing with Eloquent query optimization',
        'sorting' => 'Interactive sorting with visual indicators',
        'searching' => 'Debounced live searching across fields',
        'column_select' => 'Show / hide columns dynamically',
        'pagination' => 'Tailored Vibe UI pagination controls',
    ],

    'installation' => [
        'title' => 'Installation & Generator',
        'desc' => 'Vibe UI comes with the official Rappasoft table engine pre-configured. You can scaffold a new ready-to-use DataTable component in seconds using the artisan command:',
    ],

    'generator' => [
        'title' => 'Artisan Generator',
        'desc' => 'Generate a complete, ready-to-use DataTable component in seconds using the Vibe UI artisan generator command:',
    ],

    'tag_helper' => [
        'title' => 'Using <vibe:datatable> Tag',
        'desc' => 'In addition to native Livewire syntax, Vibe UI provides a declarative <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:datatable&gt;</code> custom tag helper integrated with the Vibe UI ecosystem.',
        'preview_title' => 'DataTable via <vibe:datatable>',
    ],

    'basic_usage' => [
        'title' => 'Basic Usage',
        'desc' => 'Extend <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">VibeDataTableComponent</code> and define your query and columns. The component automatically inherits Vibe UI design tokens, search debouncing, and pagination layout.',
        'preview_title' => 'Interactive Live DataTable',
    ],

    'blade_usage' => [
        'title' => 'Blade Integration Options',
        'desc' => 'You can render your DataTable in any Blade view using either the Vibe UI tag helper or native Livewire syntax:',
    ],

    'columns' => [
        'title' => 'Column Configuration',
        'desc' => 'Define columns using the fluent <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">Column</code> class with sorting, searching, and custom rendering:',
    ],

    'props' => [
        'title' => '<vibe:datatable> Component Props',
        'desc' => 'Supported attributes and props for the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:datatable&gt;</code> tag helper:',
        'columns' => [
            'prop' => 'Property',
            'type' => 'Type',
            'default' => 'Default',
            'desc' => 'Description',
        ],
        'items' => [
            'component' => 'FQCN component class (e.g. App\Livewire\UsersTable::class) or Livewire alias string (kebab-case).',
            'attributes' => 'Any additional attributes or parameters are automatically forwarded to the underlying Livewire component.',
            'slot' => 'Alternative slot content when using the component as a wrapper container.',
        ],
    ],

    'configuration' => [
        'title' => 'Common Configuration Methods',
        'desc' => 'Popular methods inside the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">configure()</code> hook to customize table behavior:',
        'columns' => [
            'method' => 'Method',
            'desc' => 'Usage & Behavior',
        ],
    ],

    'features_section' => [
        'title' => 'Key Features',
        'desc' => 'Highlights and architectural advantages of Vibe DataTable:',
        'items' => [
            'server_perf' => [
                'title' => 'High Server-Side Performance',
                'desc' => 'Efficient data queries with SQL limit and offset, ensuring fast rendering even with millions of records.',
            ],
            'theme_native' => [
                'title' => '100% Vibe UI Design Tokens',
                'desc' => 'Search fields, chevron sort icons, selection checkboxes, and pagination buttons automatically follow the active theme.',
            ],
            'livewire_reactive' => [
                'title' => 'Livewire v3 Reactive',
                'desc' => 'Instant search debounced at 350ms, reactive sorting, and seamless DOM morphing without page reloads.',
            ],
            'column_visibility' => [
                'title' => 'Dynamic Column Selector',
                'desc' => 'Allow end-users to customize their view by selecting which columns to display or hide on the fly.',
            ],
        ],
    ],
];
