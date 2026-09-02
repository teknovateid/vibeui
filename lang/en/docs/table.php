<?php

return [
    'title' => 'Table',
    'badge' => 'Component',
    'group' => 'UI Components',
    'description' => 'Responsive, modular, and elegant data table component. Supports 4 visual variants (default, striped, bordered, flush), dense row density, hover highlights, sortable columns, active row selection, and dedicated empty states.',

    // Section 1: Basic Usage
    'basic_usage' => [
        'title' => 'Basic Usage',
        'desc' => 'Use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:table&gt;</code> component alongside header, column, rows, row, and cell compound subcomponents to build structured tables.',
        'preview_title' => 'Basic Table',
    ],

    // Columns & Sample Data
    'columns' => [
        'name' => 'Name',
        'email' => 'Email',
        'role' => 'Role',
        'status' => 'Status',
        'actions' => 'Actions',
    ],

    'sample_data' => [
        'roles' => [
            'admin' => 'Administrator',
            'developer' => 'Developer',
            'designer' => 'UI Designer',
            'manager' => 'Product Manager',
            'viewer' => 'Viewer',
        ],
        'statuses' => [
            'active' => 'Active',
            'inactive' => 'Inactive',
            'pending' => 'Pending',
        ],
    ],

    // Section 2: Variants
    'variants' => [
        'title' => 'Visual Variants',
        'desc' => 'The <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">variant</code> prop provides 4 visual styles: <code class="font-mono text-xs text-foreground">default</code> (clean horizontal dividers), <code class="font-mono text-xs text-foreground">striped</code> (zebra rows), <code class="font-mono text-xs text-foreground">bordered</code> (full cell grid boundaries), and <code class="font-mono text-xs text-foreground">flush</code> (frameless presentation).',
        'preview_title' => 'Table Visual Variants',
        'items' => [
            'default' => 'Default (Clean Divider)',
            'striped' => 'Striped (Zebra Rows)',
            'bordered' => 'Bordered (Full Grid)',
            'flush' => 'Flush (Frameless)',
        ],
    ],

    // Section 3: Dense
    'dense' => [
        'title' => 'Dense Table',
        'desc' => 'Add the boolean prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">dense</code> to reduce vertical and horizontal cell padding, perfect for high-volume data grids.',
        'preview_title' => 'Compact Dense Table',
    ],

    // Section 4: Sortable Columns
    'sortable' => [
        'title' => 'Sortable Columns',
        'desc' => 'Add the prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">sortable</code> to <code class="font-mono text-xs text-foreground">&lt;vibe:table.column&gt;</code>. Combine with <code class="font-mono text-xs text-foreground">:sorted</code> and <code class="font-mono text-xs text-foreground">direction="asc|desc"</code> to display directional sorting indicators.',
        'preview_title' => 'Sortable Column Headers',
    ],

    // Section 5: Row Selection & Actions
    'selection' => [
        'title' => 'Row Selection & Actions',
        'desc' => 'Use the boolean prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">selected</code> on <code class="font-mono text-xs text-foreground">&lt;vibe:table.row&gt;</code> to highlight checked or active table rows with brand accent backgrounds.',
        'preview_title' => 'Row Selection & Action Buttons',
    ],

    // Section 6: Empty State
    'empty_state' => [
        'title' => 'Empty State',
        'desc' => 'Render the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:table.empty&gt;</code> subcomponent when records are missing or filter queries yield zero matches.',
        'preview_title' => 'Empty State Presentation',
        'empty_title' => 'No Records Found',
        'empty_desc' => 'There are no items currently available in this dataset or matching the search criteria.',
        'empty_btn' => 'Add New Record',
    ],

    // Section 7: Props Reference
    'props' => [
        'title' => 'Props Reference',
        'desc' => 'Comprehensive list of attributes and properties accepted across the Table component family.',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Type',
            'default' => 'Default',
            'desc' => 'Description',
        ],
    ],

    // Section 8: Subcomponents
    'subcomponents' => [
        'title' => 'Table Subcomponents',
        'desc' => 'Compound components designed to work cohesively with <code class="font-mono text-xs text-foreground">&lt;vibe:table&gt;</code>.',
        'columns' => [
            'component' => 'Component',
            'desc' => 'Description',
        ],
    ],
];
