<?php

return [
    'title' => 'FilePond',
    'badge' => 'Component',
    'group' => 'Form & Upload',
    'description' => 'Modern, feature-rich drag & drop file upload component. Supports instant image preview, crop & resize, circular profile photo upload (avatar), file size and mime type validation, native Livewire v3 integration, and Presigned URLs for direct-to-cloud upload (S3/R2) without burdening the PHP server.',

    // Section 1: Basic Usage
    'basic_usage' => [
        'title' => 'Basic Usage',
        'desc' => 'Use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:filepond&gt;</code> tag to render a file upload dropzone. Required CSS assets will automatically be pushed to <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;head&gt;</code> and JS to <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;body&gt;</code>.',
        'preview_title' => 'Basic File Upload',
        'label' => 'Upload Document',
        'description' => 'Choose a file or drag and drop it here.',
        'submit_btn' => 'Send File (Test Request)',
    ],

    // Section 2: Multiple & Image Preview
    'multiple_preview' => [
        'title' => 'Multiple Files & Image Preview',
        'desc' => 'Add the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">multiple</code> and <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">max-files="5"</code> attributes to allow uploading multiple files simultaneously with instant gallery preview.',
        'preview_title' => 'Multiple Files Upload & Preview',
        'label' => 'Product Photo Gallery',
        'description' => 'Maximum of 5 photos at once.',
        'submit_btn' => 'Send Gallery (Test Request)',
    ],

    // Section 3: Avatar / Circular
    'avatar_mode' => [
        'title' => 'Avatar Mode (Circular Profile Photo)',
        'desc' => 'Enable the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">avatar</code> prop to transform the drop area into a 1:1 circular container, ideal for user profile settings.',
        'preview_title' => 'Upload Profile Avatar',
        'label' => 'User Profile Photo',
        'description' => 'JPG or PNG format, automatic 1:1 ratio.',
        'submit_btn' => 'Save Profile Photo',
    ],

    // Section 4: Validation
    'validation' => [
        'title' => 'File Validation (Size & Format)',
        'desc' => 'Set size limits using <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">max-file-size="2MB"</code> and permitted formats with <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">accepted-file-types="image/*, application/pdf"</code>.',
        'preview_title' => 'File Validation',
        'label' => 'Verified Document (Max 2MB, PDF/Image)',
        'submit_btn' => 'Send CV (Test Request)',
    ],

    // Section: Compact Variant
    'compact' => [
        'preview_title' => 'Compact Variant (Horizontal Layout)',
        'label' => 'Quick Attachment',
        'title' => 'Attach Supporting Documents',
        'subtitle' => 'All document formats allowed (max. 10MB)',
        'browse_label' => 'Browse',
        'submit_btn' => 'Send Attachment (Test Request)',
    ],

    // Section 5: Programmatic Control
    'programmatic' => [
        'title' => 'Programmatic Control & Dropzone Sizes',
        'desc' => 'FilePond provides size options <code class="text-xs font-mono text-primary font-semibold">size="sm" | "md" | "lg"</code> as well as Alpine methods such as <code class="text-xs font-mono text-primary font-semibold">browse()</code> and <code class="text-xs font-mono text-primary font-semibold">clear()</code>.',
        'preview_title' => 'External Programmatic Control',
        'label_sm' => 'Small Dropzone (size=\'sm\')',
        'btn_browse' => 'Open File Picker (browse)',
        'btn_clear' => 'Clear Files (clear)',
    ],

    // Section 6: Presigned URL Direct S3
    'presigned' => [
        'title' => 'Presigned URL Direct-to-Cloud Upload (S3/R2)',
        'desc' => 'To handle large files (hundreds of MBs to GBs) without consuming PHP memory or violating <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">upload_max_filesize</code> limits, use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">presign-url</code> prop. Files upload directly to your cloud bucket via XHR PUT/POST with real-time progress indicators.',
        'preview_title' => 'Direct Cloud Upload via Presigned URL',
        'label' => 'Large Video / Archive File',
        'description' => 'Files are uploaded directly to cloud storage buckets (AWS S3, Cloudflare R2, MinIO).',
        'submit_btn' => 'Send S3 Key to Controller (Test Request)',
        'submit_btn_code' => 'Send S3 Key to Controller',
        'pill_title' => 'Direct Cloud Upload (Presigned URL)',
        'pill_desc' => 'Files are sent straight to object storage without burdening the application backend server.',
        'backend_title' => 'Implementation in FilepondController@presigned',
        'backend_desc' => 'This endpoint receives file metadata requests and returns a temporary presigned upload URL using S3 / Cloudflare R2 drivers:',
    ],

    // Section 7: Form Controller Test
    'form_controller' => [
        'title' => 'Form Submission & Controller ($request->all())',
        'desc' => 'The &lt;vibe:filepond&gt; component can be embedded into standard forms and submitted directly to <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">FilepondController@requestTest</code>. Upon submit, the test modal automatically displays the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">$request->all()</code> payload and file storage keys in real-time.',
        'protect_title' => 'Active Upload Protection',
        'protect_desc' => 'If a user clicks submit or navigates away while a file is still uploading, Vibe UI automatically intercepts the action and shows an in-page alert and browser tab unload protection.',
        'preview_title' => 'Simple Form Submission Test',
        'doc_label' => 'Test Document',
        'submit_btn' => 'Save & Test Request',
    ],

    // Section: Preloaded / Existing Files (Edit Form)
    'existing_files_section' => [
        'title' => 'Preloaded & Existing Files (Edit Form)',
        'desc' => 'When building <strong>Edit Forms</strong> (e.g. Edit Profile, Edit Document, or Edit Product), you can preload files that already exist on the server or Cloud Storage (S3) using the <code class="text-xs font-mono text-primary font-semibold">:files="..."</code> or <code class="text-xs font-mono text-primary font-semibold">:existing-files="..."</code> prop. Each loaded file also features a direct <strong>Download</strong> action button so users can quickly retrieve the original file.',
        'preview_multiple_title' => 'Edit Form Attachments (PDF & Image from S3)',
        'preview_avatar_title' => 'Edit Profile Photo (Avatar Mode from S3)',
        'btn_submit' => 'Save Changes (Test Request)',
        'info_keys' => 'Existing files are automatically synced into hidden form inputs, ensuring previously uploaded keys/URLs are submitted safely without re-uploading.',
    ],

    // Section 8: Livewire
    'livewire' => [
        'title' => 'Native Livewire v3 Integration',
        'desc' => 'This component automatically detects <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">wire:model</code> and integrates seamlessly with Livewire\'s <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">WithFileUploads</code> trait.',
        'btn_save' => 'Save Gallery',
    ],

    // Section 9: Events
    'events' => [
        'title' => 'Events & Action Tracking',
        'desc' => 'The <code class="text-xs font-mono text-primary font-semibold">&lt;vibe:filepond&gt;</code> component dispatches unified <code class="text-xs font-mono text-primary font-semibold">vibe-filepond</code> events to both window and element levels. Differentiate between FilePond instances by checking <code class="text-xs font-mono text-primary font-semibold">if ($event.detail.id === \'...\')</code>.',
        'table' => [
            'columns' => [
                'event' => 'Value of $event.detail.event',
                'target' => 'Target',
                'desc' => 'Description & Trigger Timing',
            ],
            'items' => [
                'add' => 'Fired when a new file is selected from device and added to the FilePond queue.',
                'start' => 'Fired when the upload/transfer process begins.',
                'progress' => 'Fired in real-time reporting upload percentage (<code class="font-mono text-[11px]">$event.detail.progress</code> from 0 - 100%).',
                'success' => 'Fired when file upload completes and storage key (<code class="font-mono text-[11px]">$event.detail.key</code>) is received.',
                'revert' => 'Fired when an <strong>already uploaded file is reverted/cancelled</strong> by the user (undo button).',
                'abort' => 'Fired when an <strong>in-progress</strong> upload is halted before completion.',
                'remove' => 'Fired when a file item is removed from the pond queue.',
                'error' => 'Fired if file validation fails or the server rejects the upload.',
            ],
        ],
        'payload_title' => '1. Object Payload Structure',
        'payload_desc' => 'Every event delivers a uniform, information-rich payload:',
        'cookbook_title' => '3. Real-World Cookbook Recipes',
        'recipe_1_title' => 'Recipe 1: Handling Reverted Files (Revert / Delete from S3)',
        'recipe_1_desc' => 'When a user clicks undo/remove on a file already stored in cloud storage, call a backend endpoint to purge the orphan file to prevent storage leaks:',
        'recipe_2_title' => 'Recipe 2: Disabling Submit Button While Uploading',
        'recipe_2_desc' => 'Lock the submit button when transfer starts (<code class="font-mono text-xs text-primary">start</code>) and re-enable it when completed (<code class="font-mono text-xs text-primary">success</code> / <code class="font-mono text-xs text-primary">revert</code> / <code class="font-mono text-xs text-primary">error</code>) to prevent incomplete form submissions:',
        'recipe_3_title' => 'Recipe 3: Custom Progress Bar',
        'recipe_3_desc' => 'Monitor the real-time upload progress to render custom external progress meters outside the dropzone:',
        'sandbox_title' => 'Live Event Sandbox & Inspector',
        'sandbox_desc' => 'Select or drop any file below to inspect the sequence of events dispatched in real-time:',
        'drop_label' => 'Select File to Test Events',
        'empty_events' => 'No events captured yet. Select or drop a file above.',
        'tip' => '💡 Tip: Click the cancel (x) button on a completed file to trigger the <code class="font-mono text-rose-500 font-bold">revert</code> event.',
    ],

    // Section 10: Props Reference
    'props' => [
        'title' => 'Props Reference',
        'desc' => 'Complete list of configuration options for the &lt;vibe:filepond&gt; component.',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Type',
            'default' => 'Default',
            'desc' => 'Description',
        ],
        'items' => [
            'name' => 'Input field name (automatically derived from `wire:model` if present).',
            'size' => 'Dropzone height size option: `"sm"`, `"md"`, or `"lg"`.',
            'title' => 'Custom dropzone title (default: "Choose a file or drag & drop it here").',
            'subtitle' => 'Custom file format & size hint (computed automatically if omitted).',
            'browse_label' => 'File picker button text (default: "Browse File").',
            'icon' => 'Dropzone icon selection (`cloud`, `upload`, `folder`, or SVG string).',
            'variant' => 'Layout variant: `"default"` (full), `"compact"` (horizontal), or `"avatar"`.',
            'dashed' => 'Dashed border style (`true`) or solid line (`false`).',
            'drop_height' => 'Custom minimum dropzone height, e.g. `"16rem"`, `"250px"`.',
            'multiple' => 'Allow selecting and uploading multiple files concurrently.',
            'max_files' => 'Maximum number of concurrent files allowed.',
            'max_file_size' => 'Maximum file size limit, e.g. `"2MB"`, `"500KB"`.',
            'accepted_file_types' => 'Accepted MIME format filter, e.g. `"image/*, application/pdf"`.',
            'avatar' => 'Enable circular compact 1:1 mode for profile pictures.',
            'image_crop' => 'Enable automatic or manual image cropping.',
            'image_crop_aspect_ratio' => 'Image crop aspect ratio, e.g. `"1:1"`, `"16:9"`.',
            'presign_url' => 'Backend endpoint for generating temporary presigned cloud storage URLs.',
            'presign_method' => 'Direct cloud upload HTTP method.',
            'encode' => 'Convert files to base64 strings for standard form submission.',
            'existing_files' => 'Array of initial file URLs (e.g. for edit forms).',
            'protect_upload' => 'Prevent form submit and navigation during active uploads with confirmation alert and `beforeunload` warning.',
            'protect_title' => 'Custom title for active upload alert (default: "Upload in Progress").',
            'protect_message' => 'Custom confirmation warning message when attempting to navigate or submit during active upload.',
        ],
    ],

    // Card Preview & Custom Header
    'card_preview' => [
        'title' => 'Uploaded File Card Preview',
        'desc' => 'When files are selected or uploaded, they appear as modern individual cards complete with file extension icons, percentage progress, upload status, and delete/cancel action buttons.',
        'preview_title' => 'File Card Preview',
    ],
    'buttons' => [
        'submit_form' => 'Send Form (Test Request)',
        'submit_multiple' => 'Send Multiple Photos (Test Request)',
        'submit_avatar' => 'Save Avatar (Test Request)',
    ],
    'custom_header' => [
        'desc' => 'You can customize the dropzone title (<code class="text-xs font-mono text-primary font-semibold">title</code>), subtitle hint (<code class="text-xs font-mono text-primary font-semibold">subtitle</code>), and browse button label (<code class="text-xs font-mono text-primary font-semibold">browse-label</code>) to fit your page context.',
        'preview_title' => 'Dropzone with Custom Title & Buttons',
        'label' => 'Upload Application File',
        'title' => 'Drag & Drop Application File (CV/Resume)',
        'subtitle' => 'PDF or Word format (max. 5MB)',
        'browse_label' => 'Choose CV',
    ],
    'patterns' => [
        'pattern_a_title' => 'Pattern A: Unified Event with ID Filter (Recommended)',
        'pattern_a_desc' => 'Single global listener catching all actions and filtering by FilePond instance:',
        'pattern_b_title' => 'Pattern B: Specific Event with Action Suffix',
        'pattern_b_desc' => 'Listen only to specific event types with action name suffixes:',
        'pattern_c_title' => 'Pattern C: Local Event on Component Tag',
        'pattern_c_desc' => 'Attach shorthand listeners directly on the component tag:',
        'pattern_d_title' => 'Pattern D: Pure Vanilla JavaScript',
        'pattern_d_desc' => 'Use <code class="font-mono text-accent font-semibold">window.addEventListener</code> in external JavaScript script files:',
    ],
];
