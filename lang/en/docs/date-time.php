<?php

return [
    'title' => 'Date & Time Picker',
    'badge' => 'Component',
    'group' => 'Form & Input',
    'description' => 'A versatile date and time picker component supporting single date, range, time picker, multiple date selection, fast-jump month/year navigation, quick presets, event markers, and seamless Laravel form integration.',

    'basic_usage' => [
        'title' => 'Basic Usage (Single Date)',
        'desc' => 'Use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:date-time&gt;</code> tag to select a single date. Features calendar icon, smart popover positioning, and clearable action.',
        'preview_title' => 'Basic Date Picker',
        'birth_label' => 'Date of Birth',
        'birth_placeholder' => 'Select date...',
    ],

    'fast_jump' => [
        'title' => 'Fast-Jump Month & Year Navigation',
        'desc' => 'Click on the month or year name in the calendar header to open a quick-selection grid for months or decades. Perfect for selecting birth dates or past records in just a couple of clicks.',
        'preview_title' => 'Fast-Jump Selector Demo',
    ],

    'range_presets' => [
        'title' => 'Date Range & Presets',
        'desc' => 'Use <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">type="range"</code> and <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:presets="true"</code> to select date ranges with a comprehensive shortcut sidebar (*Today, Yesterday, This Week, Last Week, Last 7 & 14 Days, Last 30 Days, This Month, Last Month, Last 3 Months, Quarters, This Year, Last Year, YTD*), or pass a custom array like <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:presets="[\'today\', \'last7Days\', \'thisMonth\']"</code>.',
        'preview_title' => 'Date Range with Presets',
        'period_label' => 'Transaction Report Period',
    ],

    'datetime' => [
        'title' => 'Date & Time (DateTime)',
        'desc' => 'Use <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">type="datetime"</code> to select both date and time in a unified popup.',
        'preview_title' => 'DateTime Picker',
        'schedule_label' => 'Content Publishing Schedule',
    ],

    'datetime_range' => [
        'title' => 'Date & Time Range (DateTime Range)',
        'desc' => 'Use <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">type="datetime-range"</code> to select a full date range along with start time and end time. Ideal for room bookings, event rentals, ticket scheduling, or reservation systems.',
        'preview_title' => 'Date & Time Range with Dual Time',
        'event_period_label' => 'Event & Rental Period',
    ],

    'time_only' => [
        'title' => 'Time Only (Time Picker)',
        'desc' => 'Use <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">type="time"</code> to pick hours and minutes. Supports 24-hour mode (<code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:time24="true"</code>) or 12-hour AM/PM format.',
        'preview_title' => 'Time Picker (24h & 12h)',
        'opening_label' => 'Store Opening Time (24h)',
        'closing_label' => 'Store Closing Time (12h AM/PM)',
    ],

    'time_range' => [
        'title' => 'Time Range',
        'desc' => 'Use <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">type="time-range"</code> to select a time span (start time and end time) without calendar dates. Ideal for business operating hours, work shifts, or appointment slots.',
        'preview_title' => 'Time Range / Working Hours',
        'shift_label' => 'Office Work Shift',
    ],

    'multiple' => [
        'title' => 'Multiple Dates Selection',
        'desc' => 'Use <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">type="multiple"</code> to select several non-contiguous dates, ideal for booking shifts or choosing holidays.',
        'preview_title' => 'Multiple Dates Picker',
        'holidays_label' => 'Select Holiday Dates',
    ],

    'inline' => [
        'title' => 'Inline Calendar & Event Markers',
        'desc' => 'Use <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:inline="true"</code> to embed the calendar directly on the page without popover. Use <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:markers="[...]"</code> to add status dot indicators on specific dates.',
        'preview_title' => 'Inline Calendar with Event Markers',
    ],

    'props' => [
        'title' => 'Props Reference',
        'desc' => 'List of attributes and options supported by <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:date-time&gt;</code>.',
        'columns' => [
            'prop' => 'Prop / Attribute',
            'type' => 'Data Type',
            'default' => 'Default',
            'desc' => 'Description',
        ],
    ],
];
