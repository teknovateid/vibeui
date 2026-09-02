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
            'editor' => 'Editor',
            'member' => 'Member',
            'developer' => 'Developer',
            'designer' => 'UI Designer',
            'manager' => 'Product Manager',
            'viewer' => 'Viewer',
        ],
        'statuses' => [
            'active' => 'Active',
            'inactive' => 'Inactive',
            'pending' => 'Pending',
            'offline' => 'Offline',
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
        'product' => 'Product',
        'category' => 'Category',
        'price' => 'Price',
        'keyboard' => 'Mechanical Keyboard',
        'mouse' => 'Wireless Mouse',
        'monitor' => '4K Monitor 27"',
        'cat_accessories' => 'Accessories',
        'cat_display' => 'Display',
        'feature' => 'Feature',
        'starter' => 'Starter',
        'pro' => 'Pro',
        'unlimited_projects' => 'Unlimited Projects',
        'custom_domain' => 'Custom Domain',
        'unlimited' => 'Unlimited',
    ],

    // Section 3: Dense
    'dense' => [
        'title' => 'Dense Table',
        'desc' => 'Add the boolean prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">dense</code> to reduce vertical and horizontal cell padding, perfect for high-volume data grids.',
        'preview_title' => 'Compact Dense Table',
        'invoice' => 'Invoice #',
        'date' => 'Date',
        'client' => 'Client',
        'amount' => 'Amount',
        'total' => 'Total',
    ],

    // Section 4: Sortable Columns
    'sortable' => [
        'title' => 'Sortable Columns',
        'desc' => 'Add the prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">sortable</code> to <code class="font-mono text-xs text-foreground">&lt;vibe:table.column&gt;</code>. Combine with <code class="font-mono text-xs text-foreground">:sorted</code> and <code class="font-mono text-xs text-foreground">direction="asc|desc"</code> to display directional sorting indicators.',
        'preview_title' => 'Sortable Column Headers',
        'department' => 'Department',
        'performance' => 'Performance',
        'dept_engineering' => 'Engineering',
        'dept_product' => 'Product',
        'dept_design' => 'Design',
    ],

    // Section 5: Row Selection & Actions
    'selection' => [
        'title' => 'Row Selection & Actions',
        'desc' => 'Use the boolean prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">selected</code> on <code class="font-mono text-xs text-foreground">&lt;vibe:table.row&gt;</code> to highlight checked or active table rows with brand accent backgrounds.',
        'preview_title' => 'Row Selection & Action Buttons',
        'user' => 'User',
        'plan' => 'Plan',
        'action' => 'Action',
        'selected_badge' => '(Selected)',
        'edit' => 'Edit',
    ],

    // Section 6: Empty State
    'empty_state' => [
        'title' => 'Empty State',
        'desc' => 'Render the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:table.empty&gt;</code> subcomponent when records are missing or filter queries yield zero matches.',
        'preview_title' => 'Empty State Presentation',
        'stock' => 'Stock',
        'empty_title' => 'No Records Found',
        'empty_desc' => 'There are no items currently available in this dataset or matching the search criteria.',
        'empty_btn' => 'Add New Record',
        'clear_filters' => 'Clear Filters',
    ],

    // Section 7: Subcomponents Reference
    'subcomponents' => [
        'title' => 'Table Subcomponents',
        'desc' => 'Compound components designed to work cohesively with <code class="font-mono text-xs text-foreground">&lt;vibe:table&gt;</code>.',
        'columns' => [
            'component' => 'Component',
            'tag' => 'HTML Tag',
            'desc' => 'Description',
        ],
        'items' => [
            'table' => 'Main table container with responsive overflow wrapper and subtle styling.',
            'header' => 'Table header section. Supports sticky header via the <code class="font-mono text-foreground">sticky</code> prop.',
            'column' => 'Table header column cell. Supports horizontal text alignment and sortable indicators via <code class="font-mono text-foreground">sortable</code>.',
            'rows' => 'Table body section grouping data rows with horizontal dividers.',
            'row' => 'Single table row. Supports selected state via <code class="font-mono text-foreground">selected</code> and clickable interactions.',
            'cell' => 'Individual table data cell with text alignment control (<code class="font-mono text-foreground">align</code>) and typography variants.',
            'footer' => 'Table footer section for summary rows, totals, or pagination controls.',
            'empty' => 'Dedicated empty state display rendered when no dataset records exist.',
        ],
    ],

    // Section 8: Props Reference
    'props' => [
        'title' => 'Props Reference',
        'desc' => 'Comprehensive list of attributes and properties accepted across the Table component family.',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Type',
            'default' => 'Default',
            'desc' => 'Description',
        ],
        'table' => [
            'variant' => 'Visual style variant of the table.',
            'dense' => 'Compact mode with reduced row height and tighter cell padding.',
            'hoverable' => 'Highlight effect when hovering over table rows.',
            'caption' => 'Small caption text rendered below the table.',
            'containerClass' => 'Additional Tailwind classes for the outer wrapper container div.',
        ],
        'column' => [
            'align' => 'Horizontal content alignment of the column.',
            'sortable' => 'Marks column as sortable and renders sorting indicator icons.',
            'sorted' => 'Whether the column is currently active as the sorting target.',
            'direction' => 'Sorting direction arrow when column is sorted ("asc" or "desc").',
        ],
        'row' => [
            'selected' => 'Highlights the row with selected state styling.',
            'clickable' => 'Applies pointer cursor and enhanced hover feedback for interactive rows.',
        ],
        'cell' => [
            'align' => 'Horizontal content alignment of the cell.',
            'variant' => 'Typography styling variant ("default", "strong", "muted").',
            'colspan' => 'Number of columns that the cell should span across.',
        ],
    ],

    // Backward-compatibility aliases
    'basic_usage_title' => 'Basic Usage',
    'basic_usage_desc' => 'Use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:table&gt;</code> component alongside header, column, rows, row, and cell compound subcomponents to build structured tables.',
    'variants_title' => 'Visual Variants',
    'variants_desc' => 'The <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">variant</code> prop provides 4 visual styles: <code class="font-mono text-xs text-foreground">default</code> (clean horizontal dividers), <code class="font-mono text-xs text-foreground">striped</code> (zebra rows), <code class="font-mono text-xs text-foreground">bordered</code> (full cell grid boundaries), and <code class="font-mono text-xs text-foreground">flush</code> (frameless presentation).',
    'dense_title' => 'Dense Table',
    'dense_desc' => 'Add the boolean prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">dense</code> to reduce vertical and horizontal cell padding, perfect for high-volume data grids.',
    'sortable_title' => 'Sortable Columns',
    'sortable_desc' => 'Add the prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">sortable</code> to <code class="font-mono text-xs text-foreground">&lt;vibe:table.column&gt;</code>. Combine with <code class="font-mono text-xs text-foreground">:sorted</code> and <code class="font-mono text-xs text-foreground">direction="asc|desc"</code> to display directional sorting indicators.',
    'selection_title' => 'Row Selection & Actions',
    'selection_desc' => 'Use the boolean prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">selected</code> on <code class="font-mono text-xs text-foreground">&lt;vibe:table.row&gt;</code> to highlight checked or active table rows with brand accent backgrounds.',
    'empty_title' => 'Empty State',
    'empty_desc' => 'Render the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:table.empty&gt;</code> subcomponent when records are missing or filter queries yield zero matches.',
    'subcomponents_title' => 'Table Subcomponents',
    'subcomponents_desc' => 'Compound components designed to work cohesively with <code class="font-mono text-xs text-foreground">&lt;vibe:table&gt;</code>.',
    'props_title' => 'Props Reference',
    'props_desc' => 'Comprehensive list of attributes and properties accepted across the Table component family.',
    'table_component' => 'Component',
    'table_desc' => 'Description',
    'table_prop' => 'Prop',
    'table_type' => 'Type',
    'table_default' => 'Default',
];
