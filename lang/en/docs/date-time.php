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
        'birth_desc' => 'Select date of birth to complete user profile.',
    ],

    'fast_jump' => [
        'title' => 'Fast-Jump Month & Year Navigation',
        'desc' => 'Click on the month or year name in the calendar header to open a quick-selection grid for months or decades. Perfect for selecting birth dates or past records in just a couple of clicks.',
        'preview_title' => 'Fast-Jump Selector Demo',
        'tip_title' => 'Usage Tip:',
        'tip_desc' => 'Click the month text (e.g., <em>September</em>) or year digits (e.g., <em>2026</em>) at the top of the popup to jump across decades and months instantly.',
        'archive_label' => 'Past Document Archive',
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

    'props_items' => [
        'type' => "Picker mode: `'single'`, `'datetime'`, `'range'`, `'datetime-range'`, `'time'`, `'time-range'`, `'multiple'`, or `'month'`.",
        'name' => 'Form input name for backend controller submission.',
        'startName' => 'Specific form input name for range start date (dual input output).',
        'endName' => 'Specific form input name for range end date (dual input output).',
        'label' => 'Label text above the input field.',
        'presets' => 'Display popular date range presets shortcut (*Today, Last 7 Days, etc.*).',
        'time24' => '24-hour format (`true`) or 12-hour format with AM/PM toggle (`false`).',
        'minuteStep' => 'Minute increment interval in time selector (e.g., 5, 10, or 15).',
        'showSeconds' => 'Display seconds selection input.',
        'dualMonth' => 'Display two side-by-side months on desktop screens for range mode.',
        'inline' => 'Render the calendar directly inline without floating popovers.',
        'clearable' => 'Show clear button to wipe the selected value.',
        'minDate' => 'Earliest selectable date boundary (format `YYYY-MM-DD`).',
        'maxDate' => 'Latest selectable date boundary (format `YYYY-MM-DD`).',
        'disabledDates' => 'List of specific disabled / unselectable dates.',
        'disabledDaysOfWeek' => 'Disabled days of the week (e.g., `[0, 6]` for weekends).',
        'markers' => 'Associative array of dates to status dot indicator colors (`primary`, `emerald`, `rose`, `amber`).',
        'locale' => "Calendar interface locale: `'id'` (Indonesian) or `'en'` (English).",
        'firstDayOfWeek' => 'First day of the week: `1` (Monday) or `0` (Sunday).',
    ],

    'test' => [
        'title' => 'Form Testing ($request->all())',
        'badge' => 'Live Controller Test',
        'desc' => 'Test submitting various date-time picker modes (single date, range with dual start/end inputs, datetime, and time-range) directly to <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">FormController@store</code>. Upon submission, a modal automatically displays the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">$request->all()</code> payload.',
        'preview_title' => 'Form Testing Sandbox',
        'card_title' => 'Scheduling & Time Periods',
        'card_desc' => 'Test submitting date, range, datetime, and time-range values directly to the backend controller.',
        'birth_label' => 'Date of Birth',
        'birth_placeholder' => 'Select date of birth...',
        'range_label' => 'Leave / Vacation Period (Range)',
        'datetime_label' => 'Consultation Schedule (DateTime)',
        'time_range_label' => 'Service Operating Hours (Time Range)',
        'submit_btn' => 'Submit Form & Test $request->all()',
    ],
];
