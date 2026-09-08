<?php

return [
    'title' => 'Radio',
    'badge' => 'Component',
    'group' => 'Form & Input',
    'description' => 'A radio button component for selecting a single option from a list of choices. Supports standard circular dot, selectable card variants, various sizes, and grouped layout.',

    'basic_usage' => [
        'title' => 'Basic Usage',
        'desc' => 'Use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:radio&gt;</code> tag inside a <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:radio.group&gt;</code>.',
        'preview_title' => 'Standard Radio Group',
        'plan_label' => 'Subscription Plan',
        'plan_desc' => 'Choose your billing cycle.',
        'opt1' => 'Monthly (Billed every month)',
        'opt2' => 'Yearly (Save 20% with annual billing)',
        'opt3' => 'Lifetime (Perpetual access with one-time payment)',
    ],

    'sizes' => [
        'title' => 'Sizes',
        'desc' => 'Available in <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">sm</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">md</code>, and <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">lg</code> sizes.',
        'preview_title' => 'Radio Button Sizes',
        'sm' => 'Small Size (sm)',
        'md' => 'Medium Size (md - Default)',
        'lg' => 'Large Size (lg)',
    ],

    'card' => [
        'title' => 'Radio Card Variant',
        'desc' => 'Use <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">variant="card"</code> to present options as rich selectable cards. You can hide the circular indicator using <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:indicator="false"</code> or <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">hide-indicator</code>.',
        'preview_title' => 'Radio Card Selection',
        'card1_title' => 'Developer Plan',
        'card1_desc' => 'Perfect for personal projects and experimentation with a 10k requests/day limit.',
        'card2_title' => 'Business Plan (Team)',
        'card2_desc' => 'Unlimited team seats, advanced analytics integration, and 99.9% uptime SLA.',
        'card_hidden_title' => 'Card Without Radio Indicator',
        'card_hidden_desc' => 'Selectable cards without the radio circle indicator using <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">hide-indicator</code>.',
        'hidden1_title' => 'Monthly Billing',
        'hidden1_desc' => '$19 billed each month. Cancel anytime.',
        'hidden2_title' => 'Annual Billing',
        'hidden2_desc' => '$15/mo billed annually ($180/yr). Save 20%.',
    ],

    'props' => [
        'title' => 'Radio Props Reference',
        'desc' => 'Complete list of properties and attributes available on the <code class="font-mono text-xs text-foreground">&lt;vibe:radio&gt;</code> component.',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Type',
            'default' => 'Default',
            'desc' => 'Description',
        ],
        'items' => [
            'name' => 'Form input name attribute. Inherited from parent group or set directly.',
            'id' => 'Unique HTML <code>id</code> for the radio input and <code>label</code> binding.',
            'value' => 'Form submission value when this radio option is selected.',
            'label' => 'Primary label text displayed beside the radio button or inside the card.',
            'description' => 'Optional guidance text displayed beneath the primary label.',
            'checked' => 'Initial selection status of the radio option.',
            'size' => 'Visual dimensions of the circular dot and label: <code>\'sm\'</code>, <code>\'md\'</code>, or <code>\'lg\'</code>.',
            'variant' => 'Visual design variant: <code>\'default\'</code>, <code>\'card\'</code>, or <code>\'accent\'</code>.',
            'indicator' => 'Controls visibility of the inner circular radio dot. Set to <code>false</code> for border-only cards.',
            'hideIndicator' => 'Convenience boolean attribute to hide the circular radio indicator on selectable cards.',
            'error' => 'Custom error message string or boolean flag to toggle red destructive styling.',
            'errorName' => 'Laravel validation error key in <code>$errors</code> to track automatically.',
            'disabled' => 'Native HTML attribute to disable interactions and dim component opacity.',
            'wrapperClass' => 'Additional custom CSS classes for the outer wrapper element.',
        ],
    ],

    'group_props' => [
        'title' => 'Radio Group Props Reference',
        'desc' => 'Available configuration properties for the <code class="font-mono text-xs text-foreground">&lt;vibe:radio.group&gt;</code> wrapper.',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Type',
            'default' => 'Default',
            'desc' => 'Description',
        ],
        'items' => [
            'label' => 'Legend title text for the radio group.',
            'name' => 'Default input name for child radio options within the group.',
            'description' => 'Supplementary guidance text displayed beneath the group title.',
            'orientation' => 'Layout orientation for child radios: <code>\'vertical\'</code>, <code>\'horizontal\'</code>, or <code>\'grid\'</code>.',
            'columns' => 'Number of grid columns when orientation is set to <code>\'grid\'</code>: <code>2</code>, <code>3</code>, or <code>4</code>.',
            'required' => 'Appends a required red asterisk indicator (*) to the group legend.',
            'error' => 'Custom error message string displayed below the entire group.',
            'errorName' => 'Laravel validation error key in <code>$errors</code> for group-level validation.',
        ],
    ],
];
