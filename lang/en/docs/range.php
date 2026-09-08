<?php

return [
    'title' => 'Range Slider',
    'badge' => 'Component',
    'group' => 'Form & Input',
    'description' => 'An enhanced numeric range slider with an active filled track bar, real-time value badges, step increments, and seamless touch/drag support.',

    'basic_usage' => [
        'title' => 'Basic Usage',
        'desc' => 'Use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:range&gt;</code> tag to pick numeric values within a defined range.',
        'preview_title' => 'Basic Slider',
        'volume_label' => 'Volume Level',
        'volume_desc' => 'Control audio player sound output level.',
    ],

    'value_display' => [
        'title' => 'Live Value Display & Prefix/Suffix',
        'desc' => 'Use <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:showValue="true"</code> to show a live value badge, along with <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">valuePrefix</code> or <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">valueSuffix</code>.',
        'preview_title' => 'Slider with Live Value Badge',
        'budget_label' => 'Monthly Budget',
        'zoom_label' => 'Zoom Scale',
    ],

    'steps' => [
        'title' => 'Step Increments & Min/Max Marks',
        'desc' => 'Configure step increments using <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">step</code>, and display boundary limits via <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">minLabel</code> and <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">maxLabel</code>.',
        'preview_title' => 'Step Increment Slider',
        'capacity_label' => 'Cloud Storage Capacity',
    ],

    'marks_continuous' => [
        'title' => 'Landmark Marks with Continuous Selection (Select In-Between)',
        'desc' => 'Use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:marks="[2 => \'2 GB\', 4 => \'4 GB\', 6 => \'6 GB\', 8 => \'8 GB\']"</code> prop to place landmark points on the track while allowing users to <strong>freely pick any value in-between</strong> (e.g. choosing <strong>3 GB</strong> between 2 GB and 4 GB).',
        'preview_title' => 'RAM Slider with In-Between Selection',
        'ram_label' => 'Server RAM Allocation',
        'ram_desc' => 'Milestone marks are available at 2 GB, 4 GB, 6 GB, and 8 GB. You can also pick intermediate sizes such as 3 GB or 5 GB.',
    ],

    'checkpoints' => [
        'title' => 'Locked Discrete Checkpoints (Strict Snap)',
        'desc' => 'Use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:checkpoints="[\'10 GB\', \'20 GB\', \'30 GB\', \'50 GB\', \'100 GB\']"</code> prop or add the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">strict</code> attribute to lock the slider, making it <strong>impossible to select values in-between</strong>.',
        'preview_title' => 'Cloud Storage Plans (Strict Discrete Tiers)',
        'storage_label' => 'Cloud Storage Plan Selection',
        'storage_desc' => 'Discrete quota packages. The slider snaps strictly to available checkpoints.',
    ],

    'marks' => [
        'title' => 'Automatic Tick Marks (:marks="true")',
        'desc' => 'Enable <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:marks="true"</code> to automatically generate visual tick marks across the track based on your <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">step</code> interval.',
        'preview_title' => 'Slider with Automatic Tick Marks',
        'rating_label' => 'Service Satisfaction Scale (1 - 5 Stars)',
    ],

    'sizes_status' => [
        'title' => 'Sizes, Disabled State & Error Validation',
        'desc' => 'Supports 3 size options (<code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">sm</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">md</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">lg</code>), native <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">disabled</code> state, and automatic destructive styling upon validation <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">error</code>.',
        'preview_title' => 'Size Variants and States',
        'sm_label' => 'Small Size (sm)',
        'md_label' => 'Default Size (md)',
        'lg_label' => 'Large Size (lg)',
        'disabled_label' => 'Disabled Slider',
        'error_label' => 'CPU Limit Exceeded (error)',
        'error_msg' => 'CPU workload cannot exceed standard baseline allocation (75%).',
    ],

    'props' => [
        'title' => 'Props & Attributes Reference',
        'desc' => 'Complete list of configuration properties and attributes available on the <code class="font-mono text-xs text-foreground">&lt;vibe:range&gt;</code> component.',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Type',
            'default' => 'Default',
            'desc' => 'Description',
        ],
        'items' => [
            'name' => 'Form input name attribute. Automatically extracted from <code>wire:model</code> if omitted.',
            'id' => 'Unique HTML <code>id</code> for the range input and <code>label</code> binding.',
            'label' => 'Main label text displayed above the slider.',
            'description' => 'Helper guidance text displayed between the label and slider input.',
            'value' => 'Initial selected value upon component mount (numeric or discrete checkpoint label).',
            'min' => 'Minimum boundary value for standard numeric range sliding.',
            'max' => 'Maximum boundary value for standard numeric range sliding.',
            'step' => 'Stepping increment interval for numeric range changes.',
            'marks' => 'Array of landmark marks (e.g. <code>[2 => \'2 GB\', 4 => \'4 GB\']</code>) or boolean <code>true</code>. Allows picking in-between values by default.',
            'checkpoints' => 'Array of discrete choices (e.g. <code>[\'10 GB\', \'20 GB\', \'30 GB\']</code>). Strictly locks slider to predefined choices by default.',
            'strict' => 'Snap restriction mode: if <code>true</code>, slider only allows checkpoint values. If <code>false</code>, allows picking in-between values.',
            'size' => 'Track thickness and thumb size: <code>\'sm\'</code>, <code>\'md\'</code>, or <code>\'lg\'</code>.',
            'showValue' => 'Renders a real-time live value badge at the top-right corner of the label.',
            'valuePrefix' => 'Prefix text/symbol displayed on the live value badge (e.g. <code>$</code>).',
            'valueSuffix' => 'Suffix unit text displayed on the live value badge (e.g. <code>GB</code>, <code>%</code>, <code>★</code>).',
            'minLabel' => 'Custom text label for the lower bound below the track. Defaults to the <code>min</code> number.',
            'maxLabel' => 'Custom text label for the upper bound below the track. Defaults to the <code>max</code> number.',
            'error' => 'Custom error string or boolean to trigger red destructive styling on the track.',
            'errorName' => 'Laravel validation error key in <code>$errors</code> if different from the <code>name</code> attribute.',
            'disabled' => 'Native HTML attribute to disable the slider and all checkpoint buttons.',
            'wrapperClass' => 'Additional CSS classes for the outermost container element.',
        ],
    ],
];
