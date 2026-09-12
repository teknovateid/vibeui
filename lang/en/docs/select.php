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

    // Section 1.2: Selected Values (2 Methods)
    'selected_methods' => [
        'title' => 'Pre-selecting Options (2 Methods: value & selected)',
        'desc' => 'Vibe UI provides two flexible ways to declare pre-selected or active options for both <strong>Single Select</strong> and <strong>Multiple Select</strong> modes:<br><br>
        1. <strong>Method 1 (Prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">value</code> on <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:select&gt;</code>)</strong>: Declare the active value at the parent component level. Accepts a single string (e.g. <code class="font-mono text-xs">value="active"</code>) or an array for multiple mode (e.g. <code class="font-mono text-xs">:value="[\'react\', \'vue\']"</code>).<br>
        2. <strong>Method 2 (Attribute <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">selected</code> on <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:select.option&gt;</code>)</strong>: Place the boolean attribute <code class="font-mono text-xs">selected</code> or dynamic condition <code class="font-mono text-xs">:selected="..."</code> directly on each option tag. In multiple mode, you simply add <code class="font-mono text-xs">selected</code> to multiple option tags.',
        'preview_title' => 'Comparison of Both Pre-selection Methods',
        'single_tab' => 'Single Selection',
        'multi_tab' => 'Multiple Selection',
        'method1_title' => 'Method 1: Using value Prop on <vibe:select>',
        'method1_label' => 'Account Status (via value prop)',
        'method1_placeholder' => 'Choose status...',
        'method2_title' => 'Method 2: Using selected Attribute on <vibe:select.option>',
        'method2_label' => 'Department (via option selected)',
        'method2_placeholder' => 'Choose department...',
        'multi_method1_title' => 'Method 1: Array :value="[\'...\']"',
        'multi_method1_label' => 'Frontend Stack (via value prop)',
        'multi_method1_placeholder' => 'Select technologies...',
        'multi_method2_title' => 'Method 2: Multiple <option selected>',
        'multi_method2_label' => 'Backend Skills (via option selected)',
        'multi_method2_placeholder' => 'Select skills...',
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

    'demo_options' => [
        'sm' => 'Small Option',
        'md' => 'Medium Option',
        'lg' => 'Large Option',
        'xl' => 'Extra Large Option',
        'server_label' => 'Server Allocation',
        'server_placeholder' => 'Choose server...',
        'no_limits_badge' => 'No Limits (Free Selection/Empty)',
    ],

    'test' => [
        'title' => 'Form Submission Test ($request->all())',
        'badge' => 'Live Controller Test',
        'desc' => 'Test submitting select component values (single select, searchable, and multi-select) directly to <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">FormController@store</code>. When submitted, the test modal automatically displays the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">$request->all()</code> payload.',
        'preview_title' => 'Form Testing Sandbox',
        'card_title' => 'Role Assignment & Team Skills',
        'card_desc' => 'Test submitting single select, searchable, and multi-select values to the backend controller.',
        'role_label' => 'User Role Selection',
        'role_placeholder' => 'Choose Role...',
        'role_superadmin' => 'Super Administrator',
        'role_editor' => 'Lead Content Editor',
        'role_developer' => 'Full-stack Developer',
        'dept_label' => 'Company Department',
        'dept_placeholder' => 'Search Department...',
        'dept_engineering' => 'Technology & Engineering',
        'dept_design' => 'UI/UX & Product Design',
        'dept_marketing' => 'Digital Marketing',
        'dept_finance' => 'Finance & Accounting',
        'frameworks_label' => 'Framework Skills (Multiple)',
        'frameworks_placeholder' => 'Choose Framework...',
        'submit_btn' => 'Submit Form & Test $request->all()',
    ],

    'props_items' => [
        'label' => 'Text label placed above the select component.',
        'name' => 'Input field name for standard form submission.',
        'id' => 'Unique ID attribute for the select element.',
        'placeholder' => 'Placeholder text displayed when no option is selected.',
        'size' => 'Component sizing: "sm", "md", "lg", or "xl".',
        'variant' => 'Visual style variant of the select component.',
        'disabled' => 'Disables the select component from user interaction.',
        'readonly' => 'Read-only mode, selection cannot be modified.',
        'multiple' => 'Enables selecting multiple options concurrently (Multi-Select).',
        'searchable' => 'Enables a real-time search input inside the popover menu.',
        'clearable' => 'Shows a clear button to remove all selected options at once.',
        'keyboard' => 'Enables full keyboard navigation control (up/down arrows, Enter, Space, Escape).',
        'max' => 'Maximum allowed number of selected options (multiple mode only).',
        'min' => 'Minimum required number of selected options (multiple mode only).',
        'indicator' => 'Displays the dropdown arrow/chevron indicator icon.',
        'description' => 'Small helper text placed below the label.',
        'info' => 'Informational note message at the bottom of the select.',
        'error' => 'Custom error message or boolean validation trigger.',
        'errorName' => 'Alternative Laravel validation key if different from the name attribute.',
        'wrapperClass' => 'Additional CSS classes applied to the outer wrapper element.',
        'badgeVariant' => 'Color variant for selected item badges in multiple mode.',
        'required' => 'Marks the select input as mandatory.',
        'group_label' => 'Header label text for an option group.',
        'group_disabled' => 'Disables all child options within the group.',
        'option_value' => 'The actual value submitted with the form payload.',
        'option_disabled' => 'Disables this individual option from selection.',
        'option_selected' => 'Pre-selects this option on initial page load.',
    ],

    // Section 10: Remote API Select
    'remote' => [
        'title' => 'API-Driven Select (<vibe:select.remote>)',
        'desc' => 'Use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:select.remote&gt;</code> component to fetch and filter options asynchronously from a backend endpoint (Ajax/Fetch). Includes debounced searching, request cancellation (AbortController), automatic fetching, avatar & description rendering directly from JSON responses, and edit mode with <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:initial-label</code>.',
        'basic_title' => 'User Search from API Controller',
        'basic_label' => 'Select User from API',
        'basic_placeholder' => 'Search user name or email...',
        'edit_title' => 'Edit Mode (Prefilled Value & Initial Label)',
        'edit_label' => 'Project Lead (Saved Record)',
        'multiple_title' => 'API-Driven Multi-Select',
        'multiple_label' => 'Assigned Team Members',
        'multiple_placeholder' => 'Search and add members...',
        'edit_multiple_title' => 'Multi-Select Edit Mode (Pre-selected Options)',
        'edit_multiple_desc' => 'To pre-populate existing records in multiple mode (such as Eloquent Many-to-Many relationships), simply pass the data to the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:value</code> prop. It supports an array/collection of full option objects (<code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:value="$collaborators"</code>) or a simple array of IDs (<code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:value="[\'13\', \'24\']"</code>) along with <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:initial-label="[\'Alanna\', \'Corene\']"</code>.',
        'edit_multiple_label' => 'Project Collaborators (Saved Records)',
        'props_title' => 'Props <vibe:select.remote>',
        'backend_title' => 'Backend Controller & API Endpoint Implementation',
        'backend_desc' => 'The <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:select.remote&gt;</code> component sends an HTTP GET request to the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:api</code> URL with a query search parameter (default: <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">?q=keyword</code>). The backend must return a JSON array response.',
        'route_title' => '1. Laravel Route Registration',
        'controller_title' => '2. Backend Controller Function (SelectController@api)',
        'controller_desc' => 'Example controller method filtering queries on a User database and mapping records into compatible JSON array objects:',
        'schema_title' => '3. JSON Response Schema Structure',
        'schema_desc' => 'The API endpoint must return a JSON array containing option objects with the following keys:',
        'schema_value' => 'Unique option ID or value submitted with the form payload (required).',
        'schema_label' => 'Primary display label text rendered in the dropdown and trigger button (required).',
        'schema_description' => 'Secondary descriptive subtext rendered below the label. Automatically omitted without leaving blank space if null or absent (optional).',
        'schema_icon' => 'Avatar image URL (JPG/PNG/WebP), pure SVG markup (&lt;svg...&gt;), or text initials circle. Automatically omitted if null or absent (optional).',
        'schema_disabled' => 'Boolean flag to lock individual options from being selectable (optional).',
        'advanced_title' => 'Advanced Search Configuration (Additional Props)',
        'advanced_desc' => 'You can customize the search query parameter key, minimum character threshold before triggering a fetch, debounce delay, and additional HTTP headers for authenticated APIs:',
    ],
];
