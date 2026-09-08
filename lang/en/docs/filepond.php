<?php

return [
    'title' => 'FilePond',
    'badge' => 'Component',
    'group' => 'Form & Upload',
    'description' => 'Modern and feature-rich drag & drop file upload component. Supports image previews, crop & resize, circular avatar photo upload, file size & type validation, Livewire v3 integration, and Presigned URLs for direct-to-cloud uploads (S3/R2) without loading the PHP server.',

    // Section 1: Basic Usage
    'basic_usage' => [
        'title' => 'Basic Usage',
        'desc' => 'Use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:filepond&gt;</code> tag to render a dropzone. CSS assets are automatically pushed to <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;head&gt;</code> and JS to <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;body&gt;</code>.',
        'preview_title' => 'Basic File Upload',
        'label' => 'Upload Document',
        'description' => 'Choose a document or drag it here.',
    ],

    // Section 2: Multiple & Image Preview
    'multiple_preview' => [
        'title' => 'Multiple Files & Image Preview',
        'desc' => 'Add <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">multiple</code> and <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">max-files="5"</code> to allow uploading multiple files with an instant image preview gallery.',
        'preview_title' => 'Multiple Files & Preview',
        'label' => 'Product Photo Gallery',
        'description' => 'Up to 5 photos at once.',
    ],

    // Section 3: Avatar / Circular
    'avatar_mode' => [
        'title' => 'Avatar Mode (Circular Profile Photo)',
        'desc' => 'Enable the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">avatar</code> prop to style the drop area as a 1:1 circle, perfect for user account profile settings.',
        'preview_title' => 'Profile Avatar Upload',
        'label' => 'User Profile Photo',
        'description' => 'JPG or PNG format, automatic 1:1 ratio.',
    ],

    // Section 4: Validation
    'validation' => [
        'title' => 'File Validation (Size & Type)',
        'desc' => 'Set size restrictions with <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">max-file-size="2MB"</code> and allowed types with <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">accepted-file-types="image/*, application/pdf"</code>.',
        'preview_title' => 'File Validation',
        'label' => 'Verified Document (Max 2MB, PDF/Images)',
    ],

    // Section 5: Presigned URL Direct S3
    'presigned' => [
        'title' => 'Presigned URL Direct-to-Cloud Upload (S3/R2)',
        'desc' => 'For large files (hundreds of MBs up to GBs) without consuming PHP worker memory or hitting <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">upload_max_filesize</code>, pass <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">presign-url</code>. Files upload directly to your cloud storage bucket via XHR with a real-time progress bar.',
        'preview_title' => 'Direct Cloud Upload via Presigned URL',
        'label' => 'Large Video or Archive File',
        'description' => 'Files upload directly to cloud storage (AWS S3, Cloudflare R2, MinIO).',
    ],

    // Section 6: Livewire
    'livewire' => [
        'title' => 'Native Livewire v3 Integration',
        'desc' => 'This component automatically detects <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">wire:model</code> and pairs with Livewire\'s <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">WithFileUploads</code> trait.',
    ],
];
