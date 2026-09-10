<?php

return [
    'title' => 'Dynamic Form',
    'badge' => 'Form Repeater',
    'group' => 'Form Components',
    'description' => 'Dynamic form repeater component for adding, removing, duplicating, and reordering input rows interactively. Fully compatible with input, select, date-time, textarea, and native Blade @foreach loop.',

    'basic_usage' => [
        'title' => 'Basic Usage (Card Variant)',
        'desc' => 'Use the <code>&lt;vibe:dynamic-form&gt;</code> tag with <code>&lt;vibe:input&gt;</code>, <code>&lt;vibe:select&gt;</code>, <code>&lt;vibe:date-time&gt;</code>, and <code>&lt;vibe:textarea&gt;</code>. The component automatically handles input array namespacing.',
        'preview_title' => 'Work Experience Repeater Example',
    ],

    'foreach_mode' => [
        'title' => 'Edit Mode with PHP @foreach',
        'desc' => 'To render existing database records with full Blade control, loop with <code>@foreach</code> inside the slot and provide <code>&lt;x-slot:template&gt;</code> as the blueprint for newly added rows.',
        'preview_title' => 'Editing Existing Data with @foreach and x-slot:template',
    ],

    'table_variant' => [
        'title' => 'Table Variant (Line Items / Orders)',
        'desc' => 'Use prop <code>variant="table"</code> for compact line-item rows suitable for invoices, order items, or inventory lists.',
        'preview_title' => 'Product Order Items Example',
    ],

    'schema_mode' => [
        'title' => 'Schema Mode (Declarative)',
        'desc' => 'Define repeater fields directly using the <code>:schema="[...]"</code> array prop without writing HTML markup manually.',
        'preview_title' => 'Education History via Schema',
    ],

    'test_submit' => [
        'title' => 'Form Submission & Comprehensive AJAX Payload Test',
        'desc' => 'Test comprehensive repeater integration with all Vibe UI input controls: <code>&lt;vibe:input&gt;</code>, <code>&lt;vibe:select&gt;</code>, <code>&lt;vibe:date-time&gt;</code>, <code>&lt;vibe:textarea&gt;</code>, <code>&lt;vibe:range&gt;</code>, <code>&lt;vibe:switch&gt;</code>, <code>&lt;vibe:radio&gt;</code>, <code>&lt;vibe:checkbox&gt;</code>, and <code>&lt;vibe:filepond&gt;</code>. Click <b>Save Form & Test Payload</b> to preview the submitted nested array structure via AJAX in real-time.',
        'preview_title' => 'Live Demo Comprehensive Form Submission',
    ],
];
