<?php

return [
    'title' => 'Select',
    'badge' => 'Component',
    'group' => 'Form & Input',
    'description' => 'An elegant, full-featured interactive combobox/select component. Features instant search, option grouping, rich avatars, custom icons, subtext descriptions, and total variant & size parity with the Input component.',

    // Section 1: Basic Usage
    'basic_usage' => [
        'title' => 'Basic Usage',
        'desc' => 'Use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:select&gt;</code> tag combined with <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:select.option&gt;</code> to create clean selection menus.',
        'preview_title' => 'Basic Select',
        'label' => 'Account Role',
        'placeholder' => 'Select account role...',
    ],

    // Section 1.5: Label, Description & Info
    'label_info' => [
        'title' => 'Label, Description & Info',
        'desc' => 'Use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">description</code> prop to add a hint text below the label, and the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">info</code> prop for helper text below the select component.',
        'preview_title' => 'Label, Description & Helper Info',
        'plan_label' => 'Subscription Plan',
        'plan_desc' => 'Choose the plan that best fits your team\'s needs.',
        'plan_placeholder' => 'Select plan...',
        'tz_label' => 'Timezone',
        'tz_info' => 'Times are displayed according to the selected timezone.',
        'tz_placeholder' => 'Select timezone...',
    ],

    // Section 2: Searchable
    'searchable' => [
        'title' => 'Real-Time Search (Searchable)',
        'desc' => 'Add the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">searchable</code> attribute to display an instant search box in the dropdown popover.',
        'preview_title' => 'Select with Search Filter',
        'label' => 'Country of Residence',
        'placeholder' => 'Search and choose country...',
        'search_placeholder' => 'Type country name...',
    ],

    // Section 3: Option Groups
    'groups' => [
        'title' => 'Option Groups',
        'desc' => 'Use <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:select.group label="..."&gt;</code> to organize options into categories. Group headers automatically hide if search results yield no matches.',
        'preview_title' => 'Select with Categorized Groups',
        'label' => 'Primary Skill',
        'placeholder' => 'Select skill...',
    ],

    // Section 4: Avatars & Icons
    'avatars_icons' => [
        'title' => 'Rich Options (Avatars & Icons)',
        'desc' => 'Every option can be enriched with <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">avatar="url"</code> for profile pictures, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">icon="svg"</code> for icons, and <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">description="..."</code> for subtitles.',
        'preview_title' => 'Select with Avatars & Descriptions',
        'label' => 'Select Assignee',
        'placeholder' => 'Choose staff member...',
    ],

    // Section 5: Variants
    'variants' => [
        'title' => 'Visual Variants',
        'desc' => 'Features 5 visual variants identical to <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:input&gt;</code> through the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">variant</code> prop.',
        'preview_title' => 'Select Variants',
    ],

    // Section 6: Sizes
    'sizes' => [
        'title' => 'Sizes Scale',
        'desc' => 'Available in 4 proportional sizes: <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">sm</code> (32px), <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">md</code> (36px, default), <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">lg</code> (40px), and <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">xl</code> (44px).',
        'preview_title' => 'Select Sizes Scale',
    ],

    // Section 7: States
    'states' => [
        'title' => 'Validation States & Disabled',
        'desc' => 'Full support for <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">disabled</code> status on both select and option levels, automatic <span class="text-destructive font-bold">*</span> indicator when <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">required</code>, and validation error messages.',
        'preview_title' => 'Disabled State & Validation Error',
        'disabled_label' => 'Operational Region (Locked)',
        'disabled_placeholder' => 'Disabled select...',
        'error_label' => 'Service Category',
        'error_msg' => 'Please choose a category before continuing.',
    ],

    // Section 8: Keyboard Navigation
    'keyboard' => [
        'title' => 'Keyboard Navigation',
        'desc' => 'Add the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">keyboard</code> (or <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:keyboard="true"</code>) attribute to enable full navigation using arrow keys (Up/Down), Enter, Space, and Escape just like the dropdown component.',
        'preview_title' => 'Select with Keyboard Navigation',
        'label' => 'Keyboard Navigation',
        'placeholder' => 'Use arrow keys to navigate...',
    ],

    // Section 9: Multiple Select & Limits
    'multiple' => [
        'title' => 'Multiple Selection & Limits (Multiple, Min & Max)',
        'desc' => 'Add the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">multiple</code> attribute to enable selecting more than one option. Selected values are cleanly presented as interactive removable chip tags. Use <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:min="n"</code> to enforce a minimum number of selections and <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:max="n"</code> to restrict the maximum number of items.',
        'preview_title' => 'Multiple Selection (Multi-Select)',
        'basic_title' => 'Basic Multiple Select',
        'basic_label' => 'Technical Skills',
        'basic_placeholder' => 'Select multiple skills...',
        'searchable_title' => 'Multi-Select with Instant Search',
        'searchable_label' => 'Frameworks & Tools',
        'searchable_placeholder' => 'Search and choose frameworks...',
        'limits_title' => 'Selection Limits (Min & Max)',
        'limits_label' => 'Topics of Interest (Min 2, Max 4)',
        'limits_placeholder' => 'Choose between 2 and 4 topics...',
        'limits_info' => 'Tags cannot be removed once at the minimum of 2, and other items lock once 4 are selected.',
    ],

    // Props table
    'props' => [
        'title' => 'Component Properties',
        'select_title' => '<vibe:select> Props',
        'group_title' => '<vibe:select.group> Props',
        'option_title' => '<vibe:select.option> Props',
        'col_prop' => 'Property',
        'col_type' => 'Data Type',
        'col_default' => 'Default Value',
        'col_desc' => 'Description',
    ],
];
