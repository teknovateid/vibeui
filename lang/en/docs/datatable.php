<?php

return [
    'title' => 'DataTable',
    'badge' => 'Enterprise Component',
    'group' => 'UI Components',
    'description' => 'High-performance server-side data table powered by Rappasoft and completely redesigned with Vibe UI theme tokens. Features debounced live search, multi-column sorting, dynamic column visibility, bulk actions, column filters, footer summary rows, and seamless pagination.',

    'features' => [
        'title' => 'Core Capabilities',
        'server_side' => 'Server-side processing with Eloquent query optimization',
        'sorting' => 'Interactive sorting with visual indicators',
        'searching' => 'Debounced live searching across fields',
        'column_select' => 'Show / hide columns dynamically',
        'bulk_actions' => 'Bulk row selection with batch actions',
        'footer' => 'Summary footer rows for aggregates and counts',
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
        'preview_title' => 'Basic Table Preview',
    ],

    'bulk_actions' => [
        'title' => 'Bulk Actions',
        'desc' => 'Enable checkbox selection across rows to perform batch actions such as data exports, status updates, or mass deletion.',
        'preview_title' => 'Bulk Actions Preview',
    ],

    'column_search' => [
        'title' => 'Per-Column Search',
        'desc' => 'Embed search inputs directly beneath each column header using a secondary header row, allowing users to independently filter by ID, name, or email.',
        'preview_title' => 'Per-Column Search Preview',
    ],

    'filters_section' => [
        'title' => 'Custom Popover Filters',
        'desc' => 'Add popover filter components like select dropdowns, email domain pickers, date ranges, and custom criteria.',
        'preview_title' => 'Popover Filters Preview',
    ],

    'footer_section' => [
        'title' => 'Column Footers & Summaries',
        'desc' => 'Display a summary row at the bottom of the table to compute totals, counts, averages, or custom calculated values.',
        'preview_title' => 'Column Footer Preview',
    ],

    'secondary_header_section' => [
        'title' => 'Secondary Header',
        'desc' => 'Add an extra header row right below column labels to place search inputs or column-specific filter widgets.',
    ],

    'blade_usage' => [
        'title' => 'Blade Integration Options',
        'desc' => 'You can render your DataTable in any Blade view using either the Vibe UI tag helper or native Livewire syntax:',
    ],

    'columns' => [
        'title' => 'Column Customization & Action Buttons',
        'desc' => 'Define columns using the fluent <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">Column</code> class with sorting, searching, status badge formatting, and sleek icon actions via <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:button.group variant="ghost"&gt;</code>:',
        'preview_title' => 'Custom Columns & Actions Preview',
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
