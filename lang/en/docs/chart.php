<?php

return [
    'title' => 'Chart',
    'badge' => 'Component',
    'group' => 'Data Visualization',
    'description' => 'A Chart.js-powered charting component featuring an intelligent JS helper and on-demand Vite bundling (@pushOnce). Gives developers 100% access to native Chart.js configurations, automatic app.css color token resolution, direct Database / Eloquent integration, and real-time Light/Dark mode reactivity.',

    // Section 1: Basic Usage
    'usage' => [
        'title' => 'How to Use',
        'desc' => 'Comprehensive guide to implementing the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:chart&gt;</code> component, covering fundamental syntax, passing data from Controllers, array configuration structures, theme color tokens, and automatic Dark Mode reactivity.',
        'preview_title' => 'Basic Chart Component Example',
        'features' => [
            'vite_title' => 'On-Demand Vite Bundle',
            'vite_desc' => 'Chart.js is loaded automatically on-demand via <code class="font-mono text-[11px] text-foreground">@pushOnce</code>. Zero performance overhead on other pages.',
            'colors_title' => 'app.css Color System',
            'colors_desc' => 'Supports semantic color tokens (<code class="font-mono text-[11px] text-foreground">destructive/20</code>, <code class="font-mono text-[11px] text-foreground">chart-1</code>) with automatic Dark Mode reactivity.',
            'native_title' => '100% Native Chart.js Features',
            'native_desc' => 'Complete freedom to configure scales, dual axes, custom plugins, animations, and callbacks without wrapper limits.',
        ],
        'steps' => [
            'step1_title' => '1. Fundamental Invocation Syntax',
            'step1_desc' => 'Invoke the <code class="font-mono text-xs text-foreground">&lt;vibe:chart&gt;</code> tag with the <code class="font-mono text-xs text-foreground">:config</code> and <code class="font-mono text-xs text-foreground">:height</code> props. Chart.js assets are loaded automatically on-demand via Vite without manual script tags.',
            'step2_title' => '2. Controller Data Preparation (Database / Eloquent)',
            'step2_desc' => 'Query dynamic data directly from the database using an Eloquent Model, map table columns into chart dataset arrays via <code class="font-mono text-xs text-foreground">pluck()</code>, then pass the variable into your Blade view.',
            'step3_title' => '3. Wrapping Inside Vibe Cards',
            'step3_desc' => 'For polished and consistent dashboard layouts, wrap the chart component within a <code class="font-mono text-xs text-foreground">&lt;vibe:card&gt;</code> container alongside header, title, and description elements.',
            'step4_title' => '4. Theme Color Tokens & Slash Opacity',
            'step4_desc' => 'Utilize semantic tokens such as <code class="font-mono text-xs text-foreground">primary</code>, <code class="font-mono text-xs text-foreground">destructive/20</code>, or <code class="font-mono text-xs text-foreground">chart-1</code> through <code class="font-mono text-xs text-foreground">chart-5</code> from <code class="font-mono text-xs text-foreground">app.css</code>. The JS helper auto-updates colors when switching between Light and Dark modes.',
        ],
        'demo' => [
            'card_title' => 'Helpdesk Ticket Status',
            'card_desc' => 'Monitoring active incidents by urgency level',
            'badge_text' => '119 Tickets',
            'dataset_label' => 'Active Tickets Count',
            'labels' => ['Critical', 'High', 'Medium', 'Low'],
        ],
        'step2_demo' => [
            'card_title' => 'Chart Metric Title',
            'card_desc' => 'Metric description or data timeframe',
            'example_title' => 'Standard Card Structure Example',
        ],
        'color_tokens' => [
            'semantic_title' => 'Semantic Color Tokens',
            'palette_title' => 'Curated Chart Palette (app.css)',
            'slash_opacity_title' => 'Tailwind Slash Opacity Syntax:',
            'slash_opacity_desc' => 'Append <code class="text-foreground font-mono">/percentage</code> to color tokens, e.g. <code class="text-foreground font-mono">\'destructive/20\'</code> (20% opacity), <code class="text-foreground font-mono">\'primary/15\'</code>, or <code class="text-foreground font-mono">\'chart-1/80\'</code>. The component automatically calculates the matching RGBA values.',
            'dark_mode_title' => 'Dark Mode Reactivity:',
            'dark_mode_desc' => 'The JS helper automatically observes <code class="text-foreground font-mono">.dark</code> theme class changes. Grid lines, label typography, tooltips, and chart colors adapt instantly without page reloads.',
        ],
        'config_anatomy' => [
            'title' => 'Summary of <code>:config</code> Configuration Structure:',
            'type' => 'Chart visualization type (e.g. <code>\'bar\'</code>, <code>\'line\'</code>, <code>\'doughnut\'</code>, <code>\'pie\'</code>, <code>\'radar\'</code>, <code>\'polarArea\'</code>).',
            'labels' => 'String array for horizontal (X) axis labels or donut/pie category slice names.',
            'datasets' => 'Array of one or more series objects with attributes like <code>label</code>, <code>data</code>, <code>borderColor</code>, <code>backgroundColor</code>, <code>borderWidth</code>, and <code>borderRadius</code>.',
            'options' => 'Advanced native Chart.js options (<code>scales</code>, <code>plugins.legend</code>, tooltips, and animations) customizable without limitation.',
            'height' => 'Controls canvas height in pixels (e.g. <code>:height="240"</code>) or CSS units (e.g. <code>height="300px"</code>). Chart width automatically fills the container (100% fluid).',
        ],
    ],

    // Section: Invocation Methods
    'methods' => [
        'title' => 'Chart Invocation Methods',
        'badge' => '4 Methods',
        'desc' => 'Vibe UI offers flexible approaches to initializing and orchestrating charts: structured Blade tag configurations (<code class="font-mono text-xs text-foreground">:config</code>), separated shorthand props, custom ID binding with real-time JavaScript APIs, or standalone canvas initialization via <code class="font-mono text-xs text-foreground">VibeChart.create</code>.',
        'card_title' => 'Testing 4 Invocation Methods',
        'card_desc' => 'Select a tab below to inspect live previews for each method',
        'method1_title' => 'Method 1: :config',
        'method1_desc' => 'The standard method passing a complete native Chart.js v4 array structure.',
        'method2_title' => 'Method 2: Shorthand',
        'method2_desc' => 'Separate chart type, dataset payload, and option overrides into distinct component props.',
        'method3_title' => 'Method 3: ID + JS',
        'method3_desc' => 'Set a custom <code class="font-mono text-xs text-foreground">id="..."</code> attribute on the Blade component, then access the instance using <code class="font-mono text-xs text-foreground">Chart.getChart(canvas)</code> to push dynamic updates seamlessly.',
        'method4_title' => 'Method 4: Pure JS',
        'method4_desc' => 'Initialize a chart directly on a standard HTML canvas element using <code class="font-mono text-xs text-foreground">VibeChart.create(\'#id\', config)</code> with automatic theme resolving.',
        'tabs' => [
            'method1' => 'Method 1 (:config)',
            'method2' => 'Method 2 (Shorthand)',
            'method3' => 'Method 3 (ID + JS)',
            'method4' => 'Method 4 (Pure JS)',
        ],
        'banners' => [
            'method1' => 'Method 1: Blade tag with structured array object <code class="font-mono text-foreground font-semibold">:config</code>',
            'badge_recommended' => 'Recommended',
            'method2' => 'Method 2: Blade tag with shorthand properties (<code class="font-mono text-foreground">type</code>, <code class="font-mono text-foreground">:data</code>, <code class="font-mono text-foreground">:options</code>)',
            'badge_shorthand' => 'Shorthand',
            'method3' => 'Method 3: Blade tag with <code class="font-mono text-foreground">id="chart-monitoring-live"</code> attribute & JavaScript control',
            'btn_randomize' => 'Randomize Data via JavaScript',
            'method4' => 'Method 4: Pure HTML canvas element <code class="font-mono text-foreground">#canvas-pure-js-demo</code> via <code class="font-mono text-foreground">VibeChart.create()</code>',
            'badge_js_api' => 'JavaScript API',
        ],
    ],

    // Section 2: Database & Eloquent Integration
    'database' => [
        'title' => 'Database & Eloquent Integration',
        'badge' => 'Database',
        'desc' => 'Bind dynamic database data directly from Laravel Eloquent models or query builders. Simply map collections using the <code class="font-mono text-xs text-foreground">pluck()</code> method into chart <code class="font-mono text-xs text-foreground">labels</code> and <code class="font-mono text-xs text-foreground">data</code> dataset arrays.',
        'preview_title' => 'Database-Driven Trend Chart (SalesMetric::all())',
        'card_title' => '2026 Financial Trends (Live Database)',
        'card_desc' => 'Real-time records from the <code class="font-mono text-xs">sales_metrics</code> database table',
        'months_tracked' => ':count Months Tracked',
        'datasets' => [
            'revenue' => 'Gross Revenue (M)',
            'profit' => 'Net Profit (M)',
        ],
    ],

    // Section 3: Bar & Column Chart
    'bar' => [
        'title' => 'Bar & Column Chart',
        'desc' => 'Column chart for comparing metrics across categories. Supports modern rounded bar ends (<code class="font-mono text-xs text-foreground">borderRadius</code>) and automatic coloring with <code class="font-mono text-xs text-foreground">chart-1</code> through <code class="font-mono text-xs text-foreground">chart-5</code> tokens from <code class="font-mono text-xs text-foreground">app.css</code>.',
        'preview_title' => 'Quarterly Sales Comparison by Category',
        'card_title' => 'Quarterly Sales Comparison',
        'card_desc' => 'Transaction realization across product categories',
        'labels' => ['Electronics', 'Fashion', 'Food & Bev', 'Healthcare', 'Automotive'],
        'datasets' => [
            'q1' => 'Quarter 1',
            'q2' => 'Quarter 2',
        ],
    ],

    // Section 4: Area & Line Chart
    'line' => [
        'title' => 'Area & Line Chart (Smooth Spline & Gradients)',
        'desc' => 'Smooth line and area curves (<code class="font-mono text-xs text-foreground">tension: 0.4</code>) with filled area backgrounds (<code class="font-mono text-xs text-foreground">fill: true</code>). Ideal for monthly revenue and visitor metric trends.',
        'preview_title' => 'Monthly Revenue Growth Trend',
        'card_title' => 'Traffic Trends & Active Sessions',
        'card_desc' => 'Smooth spline curve visualization with area fill',
        'labels' => ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
        'datasets' => [
            'visitors' => 'Unique Visitors',
        ],
    ],

    // Section 5: Donut & Pie Chart
    'donut' => [
        'title' => 'Donut & Pie Chart',
        'desc' => 'Circular charts for visualizing distribution proportions. Comes with automatic Vibe UI palette mapping and interactive clickable legends.',
        'preview_title' => 'Category Sales Distribution (Database)',
        'donut_card_title' => 'Revenue Proportion (Database)',
        'donut_card_desc' => 'Data plucked from SalesMetric by category',
        'pie_card_title' => 'Order Count Distribution',
        'pie_card_desc' => 'Total orders across product categories',
    ],

    // Section 6: Mixed Chart (Multi-Type)
    'mixed' => [
        'title' => 'Mixed Chart (Bar + Line Combined)',
        'desc' => 'One of the greatest strengths of native Chart.js: effortlessly blending different chart types on the same canvas, such as order volume bars paired with a conversion rate line.',
        'preview_title' => 'Order Volume (Bar) & Conversion Rate (Line)',
        'card_title' => 'Order Volume & Conversion Rate',
        'card_desc' => 'Bar and Line combined on a single coordinate system',
        'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        'datasets' => [
            'orders' => 'Order Volume',
            'conversion' => 'Conversion Rate (%)',
        ],
    ],

    // Section 7: Sparkline
    'sparkline' => [
        'title' => 'Sparkline (Mini KPI Chart)',
        'desc' => 'Use the boolean prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:sparkline="true"</code> to hide axis grids and legends, producing compact trends embedded within <code class="font-mono text-xs text-foreground">&lt;vibe:card&gt;</code> components.',
        'preview_title' => 'Compact Metric Cards with Sparklines',
        'cards' => [
            'revenue_title' => 'Total Revenue',
            'users_title' => 'New Users',
            'users_val' => '1,482 Sessions',
            'bounce_title' => 'Bounce Rate',
        ],
    ],

    // Section 8: Customization - Format Currency & Scales
    'custom_scales' => [
        'title' => 'Customization: Currency Formatting & Dual Axis',
        'badge' => 'Customization',
        'desc' => 'Use native <code class="font-mono text-xs text-foreground">scales.y.ticks</code> callbacks to format values into currency (IDR / USD), or configure dual Y-axes (left for currency, right for percentage).',
        'preview_title' => 'Currency Formatting & Dual Axis Setup',
        'card_title' => 'Dual Axis: Revenue (IDR) & Growth (%)',
        'card_desc' => 'Left axis for currency, right axis for percentage',
        'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        'datasets' => [
            'revenue' => 'Total Revenue (IDR)',
            'growth' => 'MoM Growth (%)',
        ],
    ],

    // Section 9: Customization - Custom Tooltips
    'custom_tooltip' => [
        'title' => 'Customization: Custom Tooltips',
        'badge' => 'Customization',
        'desc' => 'Customize the appearance, behavior, and data formatting of interactive tooltips. Enable multi-series hover (<code class="font-mono text-xs text-foreground">mode: "index"</code>), add currency prefixes/suffixes (<code class="font-mono text-xs text-foreground">prefix: "Rp "</code>), provide custom JavaScript callbacks for custom computations, or customize colors and corner radius.',
        'preview_title' => 'Custom Tooltip with Currency Formatting & Index Mode',
        'features' => [
            'mode_title' => 'Mode & Interactivity',
            'mode_desc' => 'Enable <code class="font-mono text-[10px]">mode: \'index\'</code> and <code class="font-mono text-[10px]">intersect: false</code> to show tooltips for all series simultaneously when hovering over the X axis.',
            'prefix_title' => 'Shorthand Prefix & Suffix',
            'prefix_desc' => 'Specify <code class="font-mono text-[10px]">\'prefix\' =&gt; \'Rp \'</code> or <code class="font-mono text-[10px]">\'suffix\' =&gt; \' k\'</code> in tooltip config for instant currency formatting without boilerplate JS.',
            'callbacks_title' => 'Custom Callbacks',
            'callbacks_desc' => 'Use callback functions on <code class="font-mono text-[10px]">callbacks.label</code> or <code class="font-mono text-[10px]">callbacks.footer</code> for dynamic calculations like series sum totals.',
        ],
        'card_title' => 'Revenue & Net Profit Analysis',
        'card_desc' => 'Hover over the chart to inspect combined currency-formatted tooltips',
        'badge_hover' => 'Multi-series Hover',
        'labels' => ['January', 'February', 'March', 'April', 'May', 'June'],
        'datasets' => [
            'revenue' => 'Gross Revenue',
            'profit' => 'Net Profit',
        ],
    ],

    // Section 10: Customization - Zoom, Pan & Drag Selection
    'zoom_pan' => [
        'title' => 'Customization: Zoom, Pan & Drag Selection',
        'badge' => 'Interactivity',
        'desc' => 'Advanced interactivity for deep data exploration. Users can zoom in/out using mouse wheel (<code class="font-mono text-xs text-foreground">wheel</code>), pinch gestures on touchscreens (<code class="font-mono text-xs text-foreground">pinch</code>), drag/pan across axes (<code class="font-mono text-xs text-foreground">pan</code>), drag a selection box to zoom into a region (<code class="font-mono text-xs text-foreground">drag-to-zoom</code>), or use programmatic toolbar buttons.',
        'preview_title' => 'Interactive Data Exploration: Zoom, Pan & Box Selection',
        'features' => [
            'wheel_title' => 'Wheel Zoom (Mouse)',
            'wheel_desc' => 'Scroll your mouse wheel up or down over the chart canvas to zoom in and zoom out seamlessly.',
            'pinch_title' => 'Pinch Zoom (Touch)',
            'pinch_desc' => 'Supports pinch-to-zoom touch gestures on smartphones and tablets for intuitive and responsive navigation.',
            'pan_title' => 'Pan / Drag Axes',
            'pan_desc' => 'Click and drag with mouse (or swipe with touch) to pan across the data timeline left and right.',
            'drag_title' => 'Drag-to-Zoom (Select)',
            'drag_desc' => 'Drag a bounding box over a region of interest to instantly zoom into that precise timeframe.',
        ],
        'card_title' => 'Traffic & Server Load Metrics (30 Days)',
        'card_desc' => 'Use mouse scroll to zoom, drag to pan, or use the interactive toolbar',
        'mode_select' => 'Mode: Box Select',
        'mode_pan' => 'Mode: Pan/Drag',
        'zoom_in_title' => 'Zoom In',
        'zoom_out_title' => 'Zoom Out',
        'reset_title' => 'Reset Scale',
        'datasets' => [
            'traffic' => 'Daily Visits (k)',
            'server' => 'Server Load (Req/s)',
        ],
    ],

    // Section 11: Customization - Direct JavaScript (VibeChart.create)
    'direct_js' => [
        'title' => 'Customization: Pure JavaScript Initialization',
        'badge' => 'JavaScript API',
        'desc' => 'In addition to Blade tags, you can invoke the global <code class="font-mono text-xs text-foreground">VibeChart.create(target, config)</code> helper directly within JavaScript script tags or Alpine.js components.',
        'preview_title' => 'Direct Initialization with VibeChart.create()',
        'card_title' => 'Standalone Radar Chart (JavaScript Helper)',
        'card_desc' => 'Created using <code class="font-mono text-xs">VibeChart.create(\'#standalone-radar-demo\', config)</code>',
        'labels' => ['Speed', 'Stability', 'Design', 'Support', 'Features', 'Security'],
        'datasets' => [
            'industry_avg' => 'Industry Average',
        ],
    ],

    // Section 12: Helper JS & Token Colors
    'helper' => [
        'title' => 'JS Helper & Dynamic app.css Colors',
        'desc' => 'The <code class="font-mono text-xs text-foreground">VibeChart</code> helper resolves semantic token names such as <code class="font-mono text-xs text-foreground">primary</code>, <code class="font-mono text-xs text-foreground">info</code>, <code class="font-mono text-xs text-foreground">chart-1/20</code> (with slash opacity) to computed CSS colors. Updates seamlessly during theme switching without page reloads.',
        'preview_title' => 'Semantic Colors & Slash Opacity',
    ],

    // Section 13: Props Reference Table
    'props' => [
        'title' => 'Props & Configuration Reference',
        'desc' => 'List of properties and configuration options supported by <code class="font-mono text-xs text-foreground">&lt;vibe:chart&gt;</code>.',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Type',
            'default' => 'Default',
            'desc' => 'Description',
        ],
        'items' => [
            'config' => 'Complete native Chart.js configuration object (type, data, options). Supports 100% of native Chart.js options without limitations.',
            'height' => 'Canvas height in pixels (numeric) or CSS string units (e.g. <code>"240"</code> or <code>"300px"</code>).',
            'sparkline' => 'When <code>true</code>, automatically hides X & Y axes and legend to generate compact KPI metric charts.',
            'zoom' => 'Enables Zoom (wheel & pinch) and Pan (drag) interactivity. Pass <code>true</code> for defaults or a custom config array (drag-to-zoom, mode x/y/xy).',
            'type' => 'Shorthand chart type when not using :config: <code>bar</code>, <code>line</code>, <code>doughnut</code>, <code>pie</code>, <code>radar</code>, etc.',
            'data' => 'Shorthand data payload containing <code>labels</code> and <code>datasets</code> arrays.',
            'options' => 'Shorthand options payload for scales, plugins, and animation overrides.',
            'tooltip' => 'Interactive tooltip configuration: <code>mode</code> ("index"/"nearest"), <code>intersect</code> (bool), <code>prefix</code> ("$"), <code>suffix</code> ("k"), <code>callbacks</code> (label/footer), etc.',
            'plugin_zoom' => 'Native <code>chartjs-plugin-zoom</code> options: <code>pan</code> (drag mouse/touch), <code>zoom.wheel</code> (mouse wheel), <code>zoom.pinch</code> (touch), and <code>zoom.drag</code> (box select).',
            'api_zoom' => 'Programmatically zoom chart scale: <code>VibeChart.zoom(target, factor)</code>.',
            'api_reset' => 'Reset zoom scale to default: <code>VibeChart.resetZoom(target)</code>.',
            'api_pan' => 'Pan chart coordinates programmatically: <code>VibeChart.pan(target, amount, mode)</code>.',
            'api_create' => 'Initialize standalone chart on target element: <code>VibeChart.create(selectorOrElement, config)</code>.',
            'api_resolve_color' => 'Color token resolution helper: <code>VibeChart.resolveColor("primary", isDark, opacity)</code>.',
        ],
    ],
];
