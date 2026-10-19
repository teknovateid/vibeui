<?php

return [
    'title' => 'Input Number',
    'badge' => 'Form Component',
    'group' => 'Form & Input',
    'sub_badge' => 'Thousand Separator & Numeric Formatting',
    'description' => 'Versatile numeric input component with automatic thousand separator without currency prefix. Sends pure clean numbers (1500000) by default to the backend, complete with keep-format option to retain dots and commas, suffix unit support, min/max limits, and stepper buttons.',

    'breadcrumbs' => [
        'home' => 'Home',
        'docs' => 'Docs',
        'input' => 'Input',
        'input_number' => 'Input Number',
    ],

    // Section 1: Basic Usage
    'basic_usage' => [
        'title' => '1. Basic Usage (Thousand Separator)',
        'desc' => 'By default, the component formats numbers with period (<code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">.</code>) thousand separators without any currency prefix:',
        'preview_title' => 'Basic Thousand Number Input',
        'label' => 'Total Visitors',
        'placeholder' => '0',
    ],

    // Section 2: Data Posting (Clean vs Formatted)
    'data_posting' => [
        'title' => '2. Data Posting Control (Clean Raw vs Formatted)',
        'desc' => 'By default (<code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">raw=true</code>), the data sent to the controller/database on form submission is a <strong>pure numeric number without periods or commas</strong> (e.g. <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">1500000</code>). Use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">keep-format</code> prop (or <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:raw="false"</code>) if you want to submit a formatted string preserving separators (e.g. <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">1.500.000</code>):',
        'preview_title' => 'Form POST Data Comparison',
        'clean_card_title' => 'Default: Clean Data',
        'clean_label' => 'Inventory Stock',
        'clean_hint' => 'Value sent to server:',
        'formatted_card_title' => 'keep-format: Formatted Data',
        'formatted_label' => 'Report Stock',
        'formatted_hint' => 'Value sent to server:',
    ],

    // Section 3: Unit Suffix
    'suffix' => [
        'title' => '3. Unit Suffixes',
        'desc' => 'Add the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">suffix</code> prop to display unit indicators on the right side of the input, such as <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">kg</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">pcs</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">cm</code>, or <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">%</code>:',
        'preview_title' => 'Number Input with Suffix Units',
        'weight_label' => 'Item Weight',
        'quantity_label' => 'Unit Quantity',
        'discount_label' => 'Discount Percentage',
    ],

    // Section 4: Decimal & Precision
    'precision' => [
        'title' => '4. Decimal Values & Precision',
        'desc' => 'Use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">precision="2"</code> prop to support decimal digits after the separator:',
        'preview_title' => 'Decimal Number Input',
        'volume_label' => 'Liquid Volume',
        'volume_placeholder' => '0.00',
    ],

    // Section 5: Mini Stepper
    'stepper' => [
        'title' => '5. Mini Stepper Buttons (+/-) & Min/Max Limits',
        'desc' => 'Enable mini up/down buttons on the right side with the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">stepper</code> prop, and constrain numbers with <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">min</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">max</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">step</code>, and <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">clamp</code>:',
        'preview_title' => 'Mini Stepper with Min/Max Limits',
        'box_label' => 'Box Count (Min 1, Max 50, Step 5)',
    ],

    // Section 6: Controller Test
    'controller_test' => [
        'title' => '6. Form Submit Controller Test',
        'desc' => 'Submit the form below to the controller to test live how <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">$request->all()</code> values are received on the server side (clean vs formatted):',
        'preview_title' => 'Form Submit Controller Test',
        'card_title' => 'Input Number Form Test',
        'card_desc' => 'Submit data to controller and see the $request->all() payload in the modal.',
        'clean_label' => 'Inventory Stock (Default: Clean Raw Data)',
        'formatted_label' => 'Report Metric (keep-format: Preserves Separators)',
        'order_label' => 'Order Quantity (Stepper Min 1, Max 100, Step 5)',
        'submit_btn' => 'Submit Form & Test $request->all()',
    ],

    // Section 7: Props Reference
    'props_table' => [
        'title' => '7. Props & Attributes Reference',
        'desc' => 'Complete list of attributes and props supported by the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:input.number&gt;</code> component:',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Type',
            'default' => 'Default',
            'desc' => 'Description',
        ],
        'items' => [
            'name' => 'Input name for form submission and model binding.',
            'value' => 'Initial numeric value of the input.',
            'raw' => 'If true, sends clean pure numbers without periods/commas to the backend.',
            'keepFormat' => 'Alias for raw=false. If true, sends formatted string with separators to backend.',
            'prefix' => 'Prefix text or symbol on the left side (default null, without Rp prefix).',
            'suffix' => 'Unit suffix text on the right side (e.g. "kg", "pcs", "%").',
            'thousandSeparator' => 'Thousand separator character.',
            'decimalSeparator' => 'Decimal separator character.',
            'precision' => 'Number of decimal places (0 = integer).',
            'integer' => 'Enforce integer values without decimals.',
            'round' => 'Round value to nearest integer if decimal is present.',
            'allowNegative' => 'Allow negative values (minus sign).',
            'min' => 'Minimum value threshold.',
            'max' => 'Maximum value threshold.',
            'step' => 'Increment/decrement step for stepper or keyboard arrow.',
            'clamp' => 'Automatically clamp value to min/max on blur.',
            'stepper' => 'Display mini up/down buttons on the right side of the input.',
            'keyboard' => 'Enable up/down arrow key shortcuts on keyboard.',
            'size' => 'Scale of input height and font size.',
            'variant' => 'Visual style variation of border and background.',
            'disabled' => 'Disable input interaction.',
            'readonly' => 'Make input read-only.',
        ],
    ],
];
