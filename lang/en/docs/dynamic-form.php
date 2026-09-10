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

    'order_demo' => [
        'label' => 'Order Items List',
        'add_text' => 'Add Item',
    ],

    'test_form' => [
        'label' => 'Project Team Members List (Complete Test)',
        'desc' => 'Comprehensive repeater testing featuring multiple Vibe UI input components.',
        'add_member' => 'Add Member',
        'member_name' => 'Full Name',
        'name_placeholder' => 'e.g. John Doe',
        'role' => 'Role',
        'role_placeholder' => 'Select Role',
        'role_lead' => 'Project Lead',
        'role_dev' => 'Developer',
        'role_design' => 'UI/UX Designer',
        'role_qa' => 'QA Engineer',
        'join_date' => 'Join Date',
        'join_placeholder' => 'Select date',
        'notes' => 'Notes / Short Bio',
        'notes_placeholder' => 'Write skill notes...',
        'skill_score' => 'Skill Score',
        'is_remote' => 'Remote Work',
        'remote_desc' => 'Full remote work / WFA',
        'contract_type' => 'Contract Type',
        'fulltime' => 'Full-Time',
        'contract' => 'Contract',
        'freelance' => 'Freelance',
        'facilities' => 'Facilities & Access',
        'laptop' => 'Company Laptop',
        'server_access' => 'Production Server Access',
        'signed_nda' => 'Signed NDA',
        'avatar' => 'Profile Photo / File',
        'card_title' => 'Project Team Members Form (Complete Test)',
        'card_desc' => 'Includes input, select, date-time, textarea, range, switch, radio, checkbox, and filepond. Try adding rows, duplicating, editing values, then submit to test the PHP array payload via AJAX.',
        'ajax_hint' => 'Payload sent via AJAX to FormController::store()',
        'submit_btn' => 'Save Form & Test Payload',
        'submit_btn_code' => 'Save Form & View $request->all()',
    ],
];
