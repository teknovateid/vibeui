<?php

return [
    'title' => 'DataTable',
    'badge' => 'Enterprise Component',
    'group' => 'UI Components',
    'description' => 'High-performance server-side data table powered by Rappasoft and completely redesigned with Vibe UI theme tokens. Features debounced live search, multi-column sorting, dynamic column visibility, bulk actions, column filters, footer summary rows, bordered mode, and seamless pagination.',

    'common' => [
        'preview_component' => 'Preview Component',
        'livewire_component' => 'Livewire Component',
        'home' => 'Home',
        'docs' => 'Docs',
    ],

    'code' => [
        'blade_call_1' => 'Approach 1: Using Vibe UI Tag Helper (Recommended)',
        'blade_call_2' => 'Or using Livewire kebab-case alias string',
        'blade_call_3' => 'Approach 2: Using Native Livewire Tag',
        'blade_call_4' => 'Approach 3: Using Classic Blade Directive',
        'prop_forwarding_1' => 'Forwarding id and status parameters to the Livewire component',
        'prop_forwarding_2' => 'Adding a custom wrapper styling class',
        'bordered_1' => 'Approach 1: Using Utility Class (Clean & Convenient)',
        'bordered_2' => 'Approach 2: Using Boolean "bordered" Attribute',
        'bordered_3' => 'Approach 3: Using Component with PHP Class Configuration',
        'comment_bordered_enabled' => 'Enable full borders on every row & column cell',
        'comment_default_sort' => 'Default sorting order',
        'comment_export_csv' => 'Export selected rows to CSV file',
        'comment_delete_selected' => 'Delete selected rows',
        'comment_clear_selected' => 'Clear row selections after action completes',
        'comment_secondary_header' => 'Enable secondary header row for per-column search',
        'comment_footer_status' => 'Enable table footer row',
        'comment_header_as_footer' => 'Mirror column headers as footer row at the bottom of the table',
        'comment_large_dataset' => 'Set per-page options up to 250 rows with 50 rows by default',
        'placeholder_id' => 'ID...',
        'placeholder_name' => 'Search name...',
        'placeholder_email' => 'Search email...',
        'filter_all_domains' => 'All Domains',
    ],

    'how_to_call' => [
        'title' => 'Calling DataTable',
        'desc' => 'DataTable components in Vibe UI are built on Livewire, providing versatile and flexible ways to invoke and render them within your Blade views:',
        'vibe_tag' => [
            'title' => 'Using the <vibe:datatable> Tag Helper',
            'desc' => 'The cleanest and recommended way in the Vibe UI ecosystem. Accepts either a Fully Qualified Class Name (FQCN) or a Livewire alias string:',
        ],
        'livewire_tag' => [
            'title' => 'Using the Native <livewire:...> Tag',
            'desc' => 'If you prefer standard Livewire tag syntax, you can invoke your table directly using its kebab-case component alias:',
        ],
        'blade_directive' => [
            'title' => 'Using the @livewire Directive',
            'desc' => 'The classic Blade directive `@livewire(...)` is also fully supported with either class names or aliases:',
        ],
        'prop_forwarding' => [
            'title' => 'Passing Properties & Parameters (Prop Forwarding)',
            'desc' => 'Any extra HTML attributes or props specified on `<vibe:datatable>` will be automatically forwarded to the underlying Livewire component:',
        ],
    ],

    'basic_usage' => [
        'title' => 'Basic Usage',
        'desc' => 'Basic DataTable implementation by extending <code class="font-mono text-xs">VibeDataTableComponent</code>. Provides interactive column sorting and debounced live search out of the box.',
        'preview_title' => 'Preview: Basic DataTable',
        'livewire_title' => 'Livewire Component',
        'livewire_desc' => 'Complete PHP class code calling <code class="font-mono text-xs">parent::configure()</code> and defining model queries via <code class="font-mono text-xs">builder()</code>.',
    ],

    'bordered' => [
        'title' => 'Bordered Table',
        'desc' => 'Displays vertical and horizontal divider borders on every header (<code class="font-mono text-xs">&lt;th&gt;</code>) and data (<code class="font-mono text-xs">&lt;td&gt;</code>) cell. Can be activated instantly by adding <code class="font-mono text-xs">class="border"</code> or the <code class="font-mono text-xs">bordered</code> attribute on the Blade tag, or via the <code class="font-mono text-xs">$this-&gt;setBorderedEnabled()</code> method in the PHP class.',
        'preview_title' => 'Preview: Bordered DataTable',
        'livewire_title' => 'Livewire Component',
        'livewire_desc' => 'Complete PHP class code using <code class="font-mono text-xs">setBorderedEnabled()</code> or <code class="font-mono text-xs">setBorderedStatus(true)</code> inside <code class="font-mono text-xs">configure()</code>.',
    ],

    'columns' => [
        'title' => 'Column Customization & Action Buttons',
        'desc' => 'Display formatted data (such as avatar badges or dates) and action buttons (Edit, Delete) on each row using the <code class="font-mono text-xs">format()</code> and <code class="font-mono text-xs">html()</code> methods.',
        'preview_title' => 'Preview: Custom Columns & Action Buttons',
        'livewire_title' => 'Livewire Component',
        'livewire_desc' => 'Complete PHP class code with custom badge columns and row action buttons using <code class="font-mono text-xs">&lt;vibe:button&gt;</code>.',
    ],

    'bulk_actions' => [
        'title' => 'Bulk Actions',
        'desc' => 'Enables users to select multiple or all table rows using checkboxes, then execute batch actions such as CSV export or bulk record deletion.',
        'preview_title' => 'Preview: Bulk Actions',
        'livewire_title' => 'Livewire Component',
        'livewire_desc' => 'Complete PHP class code defining <code class="font-mono text-xs">setBulkActions()</code> and bulk action handler methods.',
    ],

    'column_search' => [
        'title' => 'Per-Column Search',
        'desc' => 'Embed search inputs directly beneath column headers using the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">secondaryHeader</code> feature, allowing users to independently filter rows by ID, name, or email.',
        'preview_title' => 'Preview: Per-Column Search',
        'livewire_title' => 'Livewire Component',
        'livewire_desc' => 'Complete PHP class code with bound public properties, <code class="font-mono text-xs">setSecondaryHeaderStatus(true)</code> activation, and conditional <code class="font-mono text-xs">when()</code> queries.',
    ],

    'footer_column_search' => [
        'title' => 'Per-Column Search (Footer)',
        'desc' => 'Place per-column search inputs at the bottom of the table (<code class="font-mono text-xs">&lt;tfoot&gt;</code>) instead of beneath headers. Ideal for large datasets where users prefer filtering from the base of the table using <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">-&gt;footer(...)</code> and <code class="font-mono text-xs">$this-&gt;setFooterStatus(true)</code>.',
        'preview_title' => 'Preview: Per-Column Search (Footer)',
        'livewire_title' => 'Livewire Component',
        'livewire_desc' => 'Complete PHP class code calling <code class="font-mono text-xs">setFooterStatus(true)</code> inside <code class="font-mono text-xs">configure()</code> and closure callbacks on column definitions.',
    ],

    'filters' => [
        'title' => 'Custom Popover Filters',
        'desc' => 'Add toolbar popover filters to refine data by criteria such as email domains, status, or date ranges.',
        'preview_title' => 'Preview: Custom Popover Filters',
        'livewire_title' => 'Livewire Component',
        'livewire_desc' => 'Complete PHP class code with the <code class="font-mono text-xs">filters()</code> method using <code class="font-mono text-xs">SelectFilter</code>.',
    ],

    'footer_calc' => [
        'title' => 'Column Footer & Summary Calculations',
        'desc' => 'Display summary calculation rows at the bottom of the table (<code class="font-mono text-xs">&lt;tfoot&gt;</code>), such as total counts, numeric sums, or statistical averages.',
        'preview_title' => 'Preview: Column Footer & Summary Calculations',
        'livewire_title' => 'Livewire Component',
        'livewire_desc' => 'Complete PHP class code calling <code class="font-mono text-xs">setFooterStatus(true)</code> and closure callbacks with <code class="font-mono text-xs">footer()</code>.',
    ],

    'header_as_footer' => [
        'title' => 'Header as Footer (Use Header as Footer)',
        'desc' => 'Mirror column headers at the bottom of the table (<code class="font-mono text-xs">&lt;tfoot&gt;</code>) with matching styling. Highly beneficial for lengthy datasets so users do not need to scroll back up to identify columns.',
        'preview_title' => 'Preview: Header as Footer',
        'livewire_title' => 'Livewire Component',
        'livewire_desc' => 'Simply add <code class="font-mono text-xs">setUseHeaderAsFooterStatus(true)</code> within the <code class="font-mono text-xs">configure()</code> method.',
    ],

    'performance' => [
        'title' => 'Large Dataset Performance',
        'desc' => 'Demonstrates the reliability and speed of server-side DataTable processing across thousands of records, with page sizes of 25, 50, 100, and up to 250 records per page without performance degradation.',
        'preview_title' => 'Preview: Large Dataset Performance',
        'livewire_title' => 'Livewire Component',
        'livewire_desc' => 'Complete PHP class code with large per-page options (<code class="font-mono text-xs">25, 50, 100, 250</code>), default 50 records per page, and multi-column sorting.',
    ],

    'api_reference' => [
        'title' => 'Complete API & Configuration Reference',
        'desc' => 'Overview of common configuration methods and component tag props available in Vibe UI DataTable.',
        'configure_table' => [
            'title' => 'Frequently Used configure() Methods',
            'method_col' => 'Method',
            'desc_col' => 'Description',
            'methods' => [
                'parent_configure' => 'Must be invoked first to inherit Vibe UI theme tokens and styling.',
                'set_primary_key' => 'Sets the unique primary key for row selection and data identification.',
                'set_bordered_enabled' => 'Enables vertical and horizontal border dividers on all table cells.',
                'set_default_sort' => 'Sets default sort column and order on initial page load.',
                'set_bulk_actions' => 'Configures batch checkbox actions (e.g. CSV export or bulk delete).',
                'set_secondary_header_status' => 'Enables secondary header row directly beneath column headers for per-column search inputs.',
                'set_footer_status' => 'Enables table footer row for aggregation / row totals.',
                'set_use_header_as_footer_status' => 'Mirrors header column titles as a footer row at the bottom of the table.',
                'set_search_debounce' => 'Sets debounce delay (in milliseconds) for live search queries to optimize server load.',
                'set_per_page_accepted' => 'Array of records-per-page options available in the pagination dropdown.',
                'set_column_select_status' => 'Enables interactive selector button to dynamically toggle column visibility.',
            ],
        ],
        'props_table' => [
            'title' => '<vibe:datatable> Tag Helper Props',
            'prop_col' => 'Property',
            'type_col' => 'Type',
            'default_col' => 'Default',
            'desc_col' => 'Description',
            'props' => [
                'component' => 'FQCN component class (e.g. App\Livewire\DemoBasicTable::class) or Livewire kebab-case alias string.',
                'bordered' => 'Enables full border dividers around every header and row cell directly from Blade.',
                'attributes' => 'All extra HTML attributes are automatically forwarded to the underlying Livewire component.',
                'slot' => 'Optional slot content if the tag is used as a custom table layout container.',
            ],
        ],
    ],
];
