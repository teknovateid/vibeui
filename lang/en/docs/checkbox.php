<?php

return [
    'title' => 'Checkbox',
    'badge' => 'Component',
    'group' => 'Form & Input',
    'description' => 'A customizable checkbox component for single or multiple option selection. Supports checked, unchecked, indeterminate states, interactive card variants, different sizes, and checkbox groups.',

    'basic_usage' => [
        'title' => 'Basic Usage',
        'desc' => 'Use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:checkbox&gt;</code> tag with <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">label</code> and <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">name</code> props.',
        'preview_title' => 'Standard Checkbox',
        'label' => 'I agree to the terms and conditions',
        'desc_text' => 'You must agree to our privacy policy before proceeding.',
    ],

    'indeterminate' => [
        'title' => 'Indeterminate State',
        'desc' => 'Use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">indeterminate="true"</code> prop to represent a partially selected state (e.g. "Select All").',
        'preview_title' => 'Indeterminate Checkbox',
        'label' => 'Select all modules (3 of 5 selected)',
    ],

    'sizes' => [
        'title' => 'Sizes',
        'desc' => 'Available in 3 sizes: <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">sm</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">md</code> (default), and <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">lg</code>.',
        'preview_title' => 'Checkbox Sizes',
        'sm' => 'Small Size (sm)',
        'md' => 'Medium Size (md - Default)',
        'lg' => 'Large Size (lg)',
    ],

    'card' => [
        'title' => 'Card Variant',
        'desc' => 'Use <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">variant="card"</code> to create an elegant selectable card. You can also hide the checkbox indicator with <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:indicator="false"</code> or <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">hide-indicator</code>.',
        'preview_title' => 'Checkbox Card',
        'opt1_title' => 'Email Notifications',
        'opt1_desc' => 'Receive weekly digests and system activity reports directly to your inbox.',
        'opt2_title' => 'Two-Factor Authentication (2FA)',
        'opt2_desc' => 'Boost account security with one-time verification codes upon each login.',
        'card_hidden_title' => 'Card Without Checkbox Indicator',
        'card_hidden_desc' => 'Clean selectable card without showing the checkbox box by using <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">hide-indicator</code>.',
        'hidden1_title' => 'Pro Plan',
        'hidden1_desc' => 'Advanced analytics, priority support, and custom domain integration.',
        'hidden2_title' => 'Enterprise Plan',
        'hidden2_desc' => 'Dedicated infrastructure, 24/7 phone support, and custom SLA.',
    ],

    'checkbox_group' => [
        'title' => 'Checkbox Group',
        'desc' => 'Use <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:checkbox.group&gt;</code> to group multiple checkboxes with a single group legend and error message.',
        'preview_title' => 'Checkbox Group with Grid Layout',
        'group_label' => 'Select Primary Skills',
        'group_desc' => 'Choose one or more technologies you are proficient with.',
    ],

    'props' => [
        'title' => 'Checkbox Props Reference',
        'desc' => 'Complete list of properties and attributes available for the <code class="font-mono text-xs text-foreground">&lt;vibe:checkbox&gt;</code> component.',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Type',
            'default' => 'Default',
            'desc' => 'Description',
        ],
        'items' => [
            'name' => 'Form input name attribute. Automatically bound with <code>wire:model</code> if specified.',
            'id' => 'Unique HTML <code>id</code> for the checkbox input and <code>label</code> binding.',
            'value' => 'Form value submitted when the checkbox is checked.',
            'label' => 'Primary label text displayed alongside the checkbox or inside the card.',
            'description' => 'Optional guidance text displayed beneath the primary label.',
            'checked' => 'Initial checked status of the checkbox.',
            'indeterminate' => 'Renders a horizontal dash representing a partially selected / indeterminate state.',
            'size' => 'Visual dimensions of the checkbox box and label: <code>\'sm\'</code>, <code>\'md\'</code>, or <code>\'lg\'</code>.',
            'variant' => 'Visual design variant: <code>\'primary\'</code>, <code>\'accent\'</code>, or <code>\'card\'</code>.',
            'indicator' => 'Controls visibility of the visual checkbox box. Set to <code>false</code> to create border-only cards.',
            'hideIndicator' => 'Convenience boolean attribute to hide the checkbox box indicator on selectable cards.',
            'info' => 'Additional helper note text displayed beneath the checkbox.',
            'error' => 'Custom error message string or boolean flag to toggle red destructive styling.',
            'errorName' => 'Laravel validation error key in <code>$errors</code> to track automatically.',
            'disabled' => 'Native HTML attribute to disable interactions and dim component opacity.',
            'wrapperClass' => 'Additional custom CSS classes for the outer wrapper element.',
        ],
    ],

    'group_props' => [
        'title' => 'Checkbox Group Props Reference',
        'desc' => 'Available configuration properties for the <code class="font-mono text-xs text-foreground">&lt;vibe:checkbox.group&gt;</code> wrapper.',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Type',
            'default' => 'Default',
            'desc' => 'Description',
        ],
        'items' => [
            'label' => 'Legend title text for the checkbox group.',
            'description' => 'Supplementary guidance text displayed beneath the group title.',
            'orientation' => 'Layout orientation for child checkboxes: <code>\'vertical\'</code>, <code>\'horizontal\'</code>, or <code>\'grid\'</code>.',
            'columns' => 'Number of grid columns when orientation is set to <code>\'grid\'</code>: <code>2</code>, <code>3</code>, or <code>4</code>.',
            'required' => 'Appends a required red asterisk indicator (*) to the group legend.',
            'error' => 'Custom error message string displayed below the entire group.',
            'errorName' => 'Laravel validation error key in <code>$errors</code> for group-level validation.',
        ],
    ],
];
