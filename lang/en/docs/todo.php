<?php

return [
    'title' => 'Todo',
    'badge' => 'Component',
    'group' => 'Interactive & Forms',
    'description' => 'Advanced Todo & Kanban Board component featuring buttery smooth drag-and-drop, anti-FOUC (Flash of Unstyled Content) architecture, column navigation buttons, and versatile Tri-Mode synchronization: Realtime Livewire 3, asynchronous REST API, or Form batch submit.',

    'livewire' => [
        'title' => '1. Realtime Livewire 3 Kanban Board',
        'desc' => 'Use <code>mode="livewire"</code> and <code>layout="board"</code> to bind your Kanban board directly to your Livewire component actions. Card positions, column migrations, and status updates synchronize in real time without triggering full page reloads.',
        'preview_title' => 'Livewire Realtime Kanban Board Interactive Demo',
        'tip' => '💡 Tip: Drag cards or the ⠿ grip handle between columns to update their status in real time. Try refreshing the page (F5) to witness the zero-flicker <strong>Anti-FOUC</strong> architecture in action!',
    ],

    'api' => [
        'title' => '2. REST API Mode Kanban Board (Asynchronous Sync)',
        'desc' => 'Use <code>mode="api"</code> with <code>reorder-url</code> or <code>endpoint</code> props to interact with your JSON backend. Dragging cards between columns dispatches background AJAX requests with automated Laravel CSRF header injection.',
        'preview_title' => 'REST API Kanban Sync with Optimistic UI',
    ],

    'kanban' => [
        'title' => '3. Interactive Kanban Board & Column Navigation',
        'desc' => 'Compose with <code>&lt;vibe:todo.group&gt;</code> subcomponents to assemble multi-stage workflows. Enable column navigation arrows with <code>:nav-buttons="true"</code> to allow quick column movement without dragging.',
        'preview_title' => 'Interactive Multi-Column Kanban Board',
        'hint' => 'Drag cards between columns or click column navigation buttons (← / →) to move tasks to the previous or next column.',
        'reset_btn' => 'Reset Board Layout',
    ],

    'form' => [
        'title' => '4. Form Submit Mode (Single Non-Kanban / Batch Save)',
        'desc' => 'For traditional multi-step wizards or standard web forms, use <code>mode="form"</code> in a linear list layout. The component automatically maintains and re-indexes hidden inputs on reorder, saving everything upon form submission.',
        'preview_title' => 'Batch Save Task List Form with Hidden Inputs',
        'hint' => 'Hidden inputs <code>batch_tasks[i][id]</code>, <code>[order]</code>, and <code>[group]</code> are automatically re-indexed whenever items are reordered.',
        'submit_btn' => 'Save Batch Changes',
        'alert_submitted' => 'Form submitted with the latest task order and data!',
    ],

    'persist' => [
        'title' => '5. Kanban Board with LocalStorage Persistence',
        'desc' => 'Pass <code>:persist="true"</code> to automatically persist card arrangement and column states into the browser\'s <code>localStorage</code>. Card positions remain preserved across page reloads and browser sessions.',
        'preview_title' => 'Kanban Board with Local State Persistence',
        'hint' => 'Move tasks across columns and reload the page (F5). Your board layout and card states will remain intact in your browser.',
        'reset_btn' => 'Clear Local Storage',
    ],

    'nav_buttons' => [
        'title' => '6. Column Navigation Buttons Control (nav-buttons)',
        'desc' => 'By default, column navigation arrows are hidden (<code>:nav-buttons="false"</code>). You can enable them globally on the container with <code>&lt;vibe:todo :nav-buttons="true"&gt;</code> or per-card using the <code>:nav-buttons="true"</code> prop.',
        'preview_title' => 'Navigation Buttons Comparison: Enabled vs Disabled',
        'enabled_hint' => 'This column showcases column navigation buttons enabled (:nav-buttons="true").',
        'disabled_hint' => 'This column hides navigation buttons by default (:nav-buttons="false").',
    ],

    'drag_handle' => [
        'title' => '7. 3x2 Drag Indicator Visibility (drag-handle)',
        'desc' => 'Control the visibility of the 3x2 dot drag grip indicator via <code>drag-handle</code>, <code>drag-indicator</code>, or <code>handle</code>. Defaults to <code>hover</code> (revealed on hover on desktop, always visible on mobile), with options for <code>visible</code> (always shown) or <code>hidden</code> / <code>false</code> (completely hidden).',
        'preview_title' => 'Drag Indicator Visibility Comparison (Visible, On Hover, Hidden)',
        'visible_badge' => 'Visible',
        'visible_desc' => 'The 3x2 grip dots are always displayed on the left side of the card for clear drag affordance.',
        'hover_badge' => 'On Hover (Default)',
        'hover_desc' => 'By default, the 3x2 grip dots stay hidden and appear on hover on desktop, and remain always visible on mobile devices for easy touch dragging.',
        'hidden_badge' => 'Hidden / false',
        'hidden_desc' => 'The 3x2 grip dots are completely hidden for a clean, ultra-minimalist card design.',
        'locked_badge' => 'Locked (:lock="true")',
        'locked_desc' => 'Displays a padlock icon and disables dragging so the card cannot be moved.',
        'mobile_hint' => '📱 Mobile & Touch Devices Tip: On <code>visible</code> or <code>hover</code> mode, touch the 3x2 dots directly to drag. On <code>hidden</code> mode, touch and hold (250ms long-press) the card body to initiate drag with tactile haptic feedback.',
    ],

    'backend' => [
        'title' => '8. Complete Backend Integration Guide',
        'desc' => 'Learn how to wire the Todo component with your preferred Laravel backend architecture: Livewire 3 Component, REST API Controller (asynchronous JSON), or traditional Form Batch Submit Controller.',
        'tab_livewire' => 'Livewire 3 Component',
        'tab_api' => 'REST API Controller',
        'tab_form' => 'Form Batch Controller',
        'livewire_card_title' => 'Livewire 3 Component Class Implementation',
        'livewire_card_desc' => 'Handle card repositioning, completion toggling, and item deletion in real-time using the <code>Task</code> Eloquent model.',
        'api_card_title' => 'Laravel REST API Controller Implementation',
        'api_card_desc' => 'Handle asynchronous JSON requests with Laravel CSRF protection across <code>reorder-url</code>, <code>toggle-url</code>, and <code>delete-url</code> endpoints.',
        'form_card_title' => 'Form Batch Controller Implementation',
        'form_card_desc' => 'Handle traditional POST form submissions containing the dynamically re-indexed <code>batch_tasks[i]</code> input array.',
    ],

    'anti_fouc' => [
        'title' => '9. Zero-Jank Anti-FOUC Guarantee',
        'desc' => 'Cards and columns are rendered 100% on the server via Blade (SSR), guaranteeing instantaneous initial paint on page load without blank flashes or layout shift (CLS = 0). Alpine.js progressively attaches event listeners.',
        'card1_title' => '100% Server Rendered (SSR)',
        'card1_desc' => 'Items are printed directly by Laravel Blade with compiled Tailwind CSS v4 utility classes. Browsers render the view in 0 milliseconds without white flash delays.',
        'card2_title' => 'Progressive Hydration',
        'card2_desc' => 'Alpine.js reads existing data-id attributes in the HTML without destroying or reconstructing DOM nodes, preserving buttery-smooth animations.',
        'card3_title' => 'Stable Morphing Keys',
        'card3_desc' => 'Using wire:key locks the identity of DOM nodes during background sync, preventing flicker during Livewire morphing updates.',
    ],

    'events' => [
        'title' => '10. JavaScript Events & Custom Events Ecosystem',
        'desc' => 'The component dispatches standard DOM custom events that can be listened to with Alpine.js, Vanilla JavaScript, or other client libraries.',
        'table_event' => 'Event Name',
        'table_detail' => 'Detail Properties ($event.detail)',
        'table_desc' => 'Trigger Description',
        'reordered_desc' => 'Dispatched whenever a card is dropped or relocated to a new position or group.',
        'toggled_desc' => 'Dispatched when an item\'s completion status or checkbox is toggled.',
        'deleted_desc' => 'Dispatched immediately before or upon item deletion.',
        'added_desc' => 'Dispatched when a new task item is added via the quick input.',
        'updated_desc' => 'Dispatched when an item\'s title or description is updated via inline editing.',
        'subtask_updated_desc' => 'Dispatched when a subtask or checklist inside a card is toggled.',
    ],

    'props' => [
        'title' => '11. Props & Subcomponents Reference',
        'desc' => 'Comprehensive directory of available attributes and options for &lt;vibe:todo&gt; and all companion subcomponents.',
        'table_prop' => 'Prop',
        'table_type' => 'Data Type',
        'table_default' => 'Default Value',
        'table_desc' => 'Description',

        // vibe:todo
        'todo_mode' => "Data sync mode: 'livewire', 'api', 'form', or 'local'",
        'todo_layout' => "Layout presentation: 'board' (multi-column kanban) or 'list' (vertical linear list)",
        'todo_nav_buttons' => "Show or hide previous/next column navigation buttons on cards (default false / hidden)",
        'todo_checkbox' => "Show checkbox on cards (default false)",
        'todo_lock' => "Lock all cards in the board/list to prevent moving or dragging (default false)",
        'todo_editable' => "Enable inline quick editing for card title and description (default false)",
        'todo_quick_add' => "Enable inline '+ Add Task' button at the bottom of each column (default false)",
        'todo_searchable' => "Enable client-side live search bar at the top of the board (default false)",
        'todo_keyboard' => "Enable keyboard navigation shortcuts (Space, Delete, Left/Right arrow) (default true)",
        'todo_reorderable' => "Enable or disable drag-and-drop capability between cards and columns",
        'todo_drag_handle' => "Visibility mode for the 3x2 drag indicator dots: 'hover' (default: revealed on hover on desktop, always visible on mobile), 'visible' (always shown), or 'hidden' / false (hide)",
        'todo_persist' => "Automatically persist card ordering and layout to browser localStorage (local mode only)",
        'todo_storage_key' => "Unique identifier for the todo entry inside the 'vibe-todo' array in localStorage (default: component ID)",
        'todo_expire_hours' => "Expiration lifetime in hours for stored local data before it is automatically invalidated (default: 720 hours / 30 days)",
        'todo_gap' => "Spacing gap between columns or items: '1', '2', '3', '4', '6' (default: '3')",
        'todo_wire_reorder' => "Livewire action method name to handle reorder and column migration events",
        'todo_wire_toggle' => "Livewire action method name to handle item completion toggles",
        'todo_wire_delete' => "Livewire action method name to handle item removal",
        'todo_wire_add' => "Livewire action method name to handle new item addition",
        'todo_wire_update' => "Livewire action method name to handle item title/description updates",
        'todo_endpoint' => "Base REST API URL for CRUD synchronization",
        'todo_name' => "Form array input prefix name for batch submit mode (mode='form')",

        // vibe:todo.group
        'group_name' => "Unique identifier for the status column (e.g. 'todo', 'progress', 'done')",
        'group_title' => "Title string displayed in the column header",
        'group_count' => "Numeric counter for total cards in column (optional)",
        'group_color' => "Accent color badge variant for column header: 'default', 'blue', 'amber', 'emerald', 'purple'",
        'group_max' => "Maximum card limit (WIP Limit) with visual alert indicators when exceeded",
        'group_collapsible' => "Enable collapsible column capability into a slim vertical ribbon (default false)",
        'group_collapsed' => "Initial collapsed state on first render (default false)",
        'group_quick_add' => "Column-specific override for the inline quick add task button",
        'group_empty_text' => "Placeholder message displayed when column contains no cards",

        // vibe:todo.item
        'item_id' => "Unique identifier for the card item (string or integer)",
        'item_title' => "Card title text (can alternatively be passed via default slot)",
        'item_description' => "Secondary explanatory text placed underneath the title",
        'item_group' => "Column group identifier where this card belongs (for kanban board layout)",
        'item_nav_buttons' => "Per-item override for column navigation arrow buttons (true/false/null)",
        'item_checkbox' => "Explicitly show or hide the checkbox for this specific card",
        'item_completed' => "Completion state (strikes through text with muted styling)",
        'item_editable' => "Per-item override to allow inline title and description editing",
        'item_labels' => "Multi-labels / category tag badges (array or comma-separated string)",
        'item_assignees' => "Task assignees (array of collaborator profiles or avatar slot)",
        'item_subtasks' => "Checklist subtasks array with automatic progress bar calculation",
        'item_badge' => "Priority or category tag text displayed on the card (single badge fallback)",
        'item_badge_variant' => "Badge color variant: 'default', 'primary', 'warning', 'destructive', 'outline'",
        'item_due_date' => "Due date string with smart urgency calculations (overdue, today, upcoming)",
        'item_variant' => "Card visual variant: 'default' (subtle elevation shadow), 'flat', or 'outline'",
        'item_reorderable' => "Whether this specific card can be dragged or repositioned",
        'item_drag_handle' => "Override visibility mode for the 3x2 drag indicator dots per item: 'hover' (default), 'visible', or 'hidden' / false",
        'item_lock' => "Lock this specific card to prevent moving or dragging to other columns (default false)",
        'item_deletable' => "Show delete action button when card is hovered",

        // vibe:todo.subtask
        'subtask_id' => "Unique identifier for the subtask item",
        'subtask_title' => "Title text of the subtask checklist item",
        'subtask_completed' => "Subtask completion state (default false)",
        'subtask_disabled' => "Disable toggle interaction for this subtask (default false)",

        // vibe:todo.input
        'input_placeholder' => "Placeholder text for the new task input field",
        'input_button_text' => "Action button label text for adding tasks",
        'input_group' => "Target column/group name where newly created tasks will be added",
    ],
];
