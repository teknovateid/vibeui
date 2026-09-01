<?php

return [
    'title' => 'Table',
    'badge' => 'Component',
    'group' => 'UI Components',
    'description' => 'Responsive, modular, and elegant data table component system. Supports 4 visual variants (default, striped, bordered, flush), compact dense mode, hoverable rows, sortable column headers, row selection states, and built-in empty states.',

    // Section 1: Basic Usage
    'basic_usage_title' => 'Basic Usage',
    'basic_usage_desc' => 'Use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:table&gt;</code> component together with header, column, rows, row, and cell subcomponents to assemble clean and structured data tables.',

    // Section 2: Variants
    'variants_title' => 'Visual Variants',
    'variants_desc' => 'The <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">variant</code> prop offers 4 visual styles: <code class="font-mono text-xs text-foreground">default</code> (clean horizontal dividers), <code class="font-mono text-xs text-foreground">striped</code> (zebra rows), <code class="font-mono text-xs text-foreground">bordered</code> (full cell grid lines), and <code class="font-mono text-xs text-foreground">flush</code> (no outer card border).',

    // Section 3: Dense
    'dense_title' => 'Compact Table (Dense)',
    'dense_desc' => 'Add the boolean <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">dense</code> prop to reduce vertical and horizontal cell padding, ideal for displaying dense datasets within compact dashboard layouts.',

    // Section 4: Sortable Columns
    'sortable_title' => 'Sortable Columns',
    'sortable_desc' => 'Add the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">sortable</code> prop to <code class="font-mono text-xs text-foreground">&lt;vibe:table.column&gt;</code>. Pair with <code class="font-mono text-xs text-foreground">:sorted</code> and <code class="font-mono text-xs text-foreground">direction="asc|desc"</code> to automatically render interactive sort indicators.',

    // Section 5: Row Selection & Actions
    'selection_title' => 'Row Selection & Actions',
    'selection_desc' => 'Use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">selected</code> prop on <code class="font-mono text-xs text-foreground">&lt;vibe:table.row&gt;</code> to highlight checked or active rows with a subtle primary background accent.',

    // Section 6: Empty State
    'empty_title' => 'Empty State',
    'empty_desc' => 'Use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:table.empty&gt;</code> subcomponent when a query or collection yields no records.',

    // Section 7: Props Reference
    'props_title' => 'Props Reference',
    'props_desc' => 'Comprehensive list of props supported across the Table component family.',
    'table_prop' => 'Prop',
    'table_type' => 'Type',
    'table_default' => 'Default',
    'table_desc' => 'Description',

    // Section 8: Subcomponents
    'subcomponents_title' => 'Table Subcomponents',
    'subcomponents_desc' => 'Available compound components for composing tables.',
    'table_component' => 'Component',
];
