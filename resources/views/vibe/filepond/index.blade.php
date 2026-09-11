@blaze

@props([
    'label' => null,
    'id' => null,
    'name' => null,
    'description' => null,
    'info' => null,
    'error' => null,
    'errorName' => null,
    'wrapperClass' => null,
    'title' => null,
    'subtitle' => null,
    'hint' => null,
    'browseLabel' => null,
    'buttonText' => null,
    'icon' => 'cloud',
    'variant' => 'default',
    'size' => 'md',
    'dashed' => true,
    'dropHeight' => null,
    'multiple' => false,
    'maxFiles' => null,
    'maxFileSize' => null,
    'minFileSize' => null,
    'maxTotalFileSize' => null,
    'acceptedFileTypes' => null,
    'accept' => null,
    'imagePreview' => true,
    'imagePreviewHeight' => null,
    'imagePreviewMinHeight' => null,
    'imagePreviewMaxHeight' => null,
    'imageCrop' => false,
    'imageCropAspectRatio' => null,
    'imageResize' => false,
    'imageResizeTargetWidth' => null,
    'imageResizeTargetHeight' => null,
    'imageResizeMode' => 'cover',
    'imageTransform' => false,
    'imageQuality' => null,
    'avatar' => false,
    'encode' => false,
    'server' => null,
    'presignUrl' => null,
    'presignMethod' => 'PUT',
    'chunkUploads' => false,
    'chunkSize' => 2000000,
    'files' => null,
    'existingFiles' => [],
    'disabled' => false,
    'required' => false,
    'instantUpload' => true,
    'labels' => [],
    'panelLayout' => null,
    'storeAsFile' => null,
    'protectUpload' => false,
    'preventUnload' => false,
    'preventNavigation' => false,
    'protectSubmit' => false,
    'protectTitle' => null,
    'protectMessage' => null,
])

@php
    $wireModelAttr = $attributes->whereStartsWith('wire:model')->first();
    $name = $name ?? $wireModelAttr;
    $id = $id ?? ($name ? 'filepond-' . preg_replace('/[^a-zA-Z0-9\-_]/', '-', $name) . '-' . uniqid() : uniqid('filepond-'));
    $errorKey = $errorName ?? ($name ? str_replace(['[', ']'], ['.', ''], rtrim($name, ']')) : null);

    $hasError = !empty($error) || ($errorKey && $errors->has($errorKey));
    $errorMessage = $error && !is_bool($error) ? $error : ($errorKey ? $errors->first($errorKey) : null);

    $isRequired = $required || ($attributes->has('required') && $attributes->get('required') !== false);
    $isDisabled = $disabled || ($attributes->has('disabled') && $attributes->get('disabled') !== false);

    $resolvedAccept = $acceptedFileTypes ?? $accept;

    $isAvatar = $avatar || $variant === 'avatar';
    $isCompact = $variant === 'compact';

    $resolvedExistingFiles = $files ?? $existingFiles ?? [];
    if (is_string($resolvedExistingFiles) && !empty($resolvedExistingFiles)) {
        if (str_starts_with(trim($resolvedExistingFiles), '[') || str_starts_with(trim($resolvedExistingFiles), '{')) {
            $decoded = json_decode($resolvedExistingFiles, true);
            $resolvedExistingFiles = (json_last_error() === JSON_ERROR_NONE) ? $decoded : [$resolvedExistingFiles];
        } else {
            $resolvedExistingFiles = [$resolvedExistingFiles];
        }
    }

    $fpLang = function ($key, $default = '') {
        if (Lang::has("vibe/filepond.{$key}")) {
            return __("vibe/filepond.{$key}");
        }
        if (Lang::has("vibe::vibe/filepond.{$key}")) {
            return __("vibe::vibe/filepond.{$key}");
        }
        return $default;
    };

    if ($isAvatar) {
        $resolvedLabelIdle = $fpLang('label_avatar_idle', '<div class="w-full h-full flex flex-col items-center justify-center gap-2 p-2 select-none cursor-pointer"><div class="size-9 rounded-full bg-muted/70 border border-border/60 flex items-center justify-center text-muted-foreground"><svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></div><span class="filepond--label-action text-[11px] font-semibold text-primary cursor-pointer">Pilih Foto</span></div>');
    } else {
        // Resolve Icon SVG
        $iconSvg = '';
        if ($icon === 'cloud' || empty($icon)) {
            $iconSvg = '<svg class="size-11 text-foreground/80" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M7 16.5A5.5 5.5 0 0 1 7 5.5a5.5 5.5 0 0 1 10 2 4.5 4.5 0 0 1 1.5 8.5"/><circle cx="12" cy="15" r="3.5" fill="var(--card, #ffffff)" stroke-width="1.6"/><path d="m10.5 15 1.1 1.1 2.2-2.2" stroke-width="1.6"/></svg>';
        } elseif ($icon === 'upload') {
            $iconSvg = '<svg class="size-9 text-foreground/75" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M4 14.899A7 7 0 1 1 15.71 8h1.79a4.5 4.5 0 0 1 2.5 8.242"/><path d="M12 12v9"/><path d="m16 16-4-4-4 4"/></svg>';
        } elseif ($icon === 'folder') {
            $iconSvg = '<svg class="size-9 text-foreground/75" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M4 20h16a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.93a2 2 0 0 1-1.66-.9l-.82-1.2A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13c0 1.1.9 2 2 2Z"/></svg>';
        } elseif ($icon !== 'none') {
            $iconSvg = $icon;
        }

        $resolvedTitle = $title ?? $fpLang('drop_title', 'Choose a file or drag & drop it here');

        $resolvedSubtitle = $subtitle ?? $hint;
        if (!$resolvedSubtitle) {
            $formatsStr = null;
            if ($resolvedAccept) {
                $formatsArr = is_array($resolvedAccept) ? $resolvedAccept : explode(',', $resolvedAccept);
                $cleanFormats = array_unique(array_filter(array_map(function ($f) {
                    $f = trim($f);
                    if (str_starts_with($f, '.')) return strtoupper(substr($f, 1));
                    if (str_contains($f, '/')) {
                        $parts = explode('/', $f);
                        return strtoupper(end($parts));
                    }
                    return strtoupper($f);
                }, $formatsArr)));
                if (!empty($cleanFormats)) {
                    $formatsStr = implode(', ', array_slice($cleanFormats, 0, 4));
                    if (count($cleanFormats) > 4) $formatsStr .= '...';
                }
            }

            $sizeStr = $maxFileSize ? strtoupper($maxFileSize) : '50MB';

            if ($formatsStr) {
                $subTemplate = $fpLang('drop_subtitle', ':formats formats, up to :max_size');
                $resolvedSubtitle = str_replace([':formats', ':max_size'], [$formatsStr, $sizeStr], $subTemplate);
            } else {
                $subTemplate = $fpLang('drop_subtitle_default', 'Semua jenis berkas didukung, hingga :max_size');
                $resolvedSubtitle = str_replace(':max_size', $sizeStr, $subTemplate);
            }
        }

        $resolvedBrowse = $browseLabel ?? $buttonText ?? $fpLang('browse_button', 'Browse File');

        if ($isCompact) {
            $resolvedLabelIdle = '<div class="filepond--custom-dropzone filepond--compact-dropzone">' .
                '<div class="filepond--compact-left">' .
                    $iconSvg .
                    '<div class="filepond--compact-text">' .
                        '<div class="filepond--drop-title">' . htmlspecialchars($resolvedTitle) . '</div>' .
                        '<div class="filepond--drop-subtitle">' . htmlspecialchars($resolvedSubtitle) . '</div>' .
                    '</div>' .
                '</div>' .
                '<div class="filepond--drop-action">' .
                    '<span class="filepond--label-action">' . htmlspecialchars($resolvedBrowse) . '</span>' .
                '</div>' .
            '</div>';
        } else {
            $resolvedLabelIdle = '<div class="filepond--custom-dropzone">' .
                '<div class="filepond--cloud-icon">' .
                    $iconSvg .
                '</div>' .
                '<div class="filepond--drop-title">' . htmlspecialchars($resolvedTitle) . '</div>' .
                '<div class="filepond--drop-subtitle">' . htmlspecialchars($resolvedSubtitle) . '</div>' .
                '<div class="filepond--drop-action">' .
                    '<span class="filepond--label-action">' . htmlspecialchars($resolvedBrowse) . '</span>' .
                '</div>' .
            '</div>';
        }
    }

    // Load localized labels
    $langLabels = [
        'labelIdle' => $resolvedLabelIdle,
        'labelInvalidField' => $fpLang('label_invalid_field', 'Bidang berisi berkas tidak valid'),
        'labelFileWaitingForSize' => $fpLang('label_file_waiting_for_size', 'Menunggu ukuran berkas'),
        'labelFileSizeNotAllowed' => $fpLang('label_file_size_not_allowed', 'Ukuran berkas melebihi batas maksimal'),
        'labelFileSizeTooSmall' => $fpLang('label_file_size_too_small', 'Ukuran berkas terlalu kecil'),
        'labelFileTypeNotAllowed' => $fpLang('label_file_type_not_allowed', 'Format berkas tidak didukung'),
        'labelFileProcessing' => $fpLang('label_file_processing', 'Mengunggah...'),
        'labelFileProcessingComplete' => $fpLang('label_file_processing_complete', 'Unggahan selesai'),
        'labelFileProcessingAborted' => $fpLang('label_file_processing_aborted', 'Unggahan dibatalkan'),
        'labelFileProcessingError' => $fpLang('label_file_processing_error', 'Gagal mengunggah berkas'),
        'labelTapToCancel' => $fpLang('label_tap_to_cancel', 'ketuk untuk membatalkan'),
        'labelTapToRetry' => $fpLang('label_tap_to_retry', 'ketuk untuk mencoba lagi'),
        'labelTapToUndo' => $fpLang('label_tap_to_undo', 'ketuk untuk mengembalikan'),
        'labelButtonRemoveItem' => $fpLang('label_button_remove_item', 'Hapus'),
        'labelButtonAbortItemLoad' => $fpLang('label_button_abort_item_load', 'Batal'),
        'labelButtonRetryItemLoad' => $fpLang('label_button_retry_item_load', 'Coba lagi'),
        'labelButtonAbortItemProcessing' => $fpLang('label_button_abort_item_processing', 'Batal'),
        'labelButtonUndoItemProcessing' => $fpLang('label_button_undo_item_processing', 'Batal'),
        'labelButtonRetryItemProcessing' => $fpLang('label_button_retry_item_processing', 'Coba lagi'),
        'labelButtonProcessItem' => $fpLang('label_button_process_item', 'Unggah'),
        'labelMaxFilesExceeded' => $fpLang('label_max_files_exceeded', 'Jumlah maksimal berkas terlampaui'),
    ];

    $mergedLabels = array_merge($langLabels, (array) $labels);


    $size = in_array($size, ['sm', 'md', 'lg']) ? $size : 'md';

    $config = [
        'id' => $id,
        'name' => $name,
        'size' => $size,
        'hasError' => (bool) $hasError,
        'errorMessage' => $errorMessage,
        'multiple' => (bool) $multiple,
        'maxFiles' => $maxFiles,
        'maxFileSize' => $maxFileSize,
        'minFileSize' => $minFileSize,
        'maxTotalFileSize' => $maxTotalFileSize,
        'acceptedFileTypes' => $resolvedAccept,
        'imagePreview' => (bool) $imagePreview,
        'imagePreviewHeight' => $imagePreviewHeight,
        'imagePreviewMinHeight' => $imagePreviewMinHeight,
        'imagePreviewMaxHeight' => $imagePreviewMaxHeight,
        'imageCrop' => (bool) $imageCrop,
        'imageCropAspectRatio' => $imageCropAspectRatio,
        'imageResize' => (bool) $imageResize,
        'imageResizeTargetWidth' => $imageResizeTargetWidth,
        'imageResizeTargetHeight' => $imageResizeTargetHeight,
        'imageResizeMode' => $imageResizeMode,
        'imageTransform' => (bool) $imageTransform,
        'imageQuality' => $imageQuality,
        'avatar' => (bool) $isAvatar,
        'encode' => (bool) $encode,
        'server' => $server,
        'presignUrl' => $presignUrl,
        'presignMethod' => $presignMethod,
        'chunkUploads' => (bool) $chunkUploads,
        'chunkSize' => $chunkSize,
        'existingFiles' => $resolvedExistingFiles,
        'disabled' => (bool) $isDisabled,
        'required' => (bool) $isRequired,
        'instantUpload' => (bool) $instantUpload,
        'labels' => $mergedLabels,
        'wireModel' => $wireModelAttr,
        'dashed' => (bool) $dashed,
        'variant' => $variant,
        'panelLayout' => $panelLayout,     // [FIX QA-2] Expose panelLayout prop to JS
        'storeAsFile' => $storeAsFile,     // [FIX QA-3] Expose storeAsFile prop to JS (null = auto-detect)
        'protect' => [
            'enabled' => (bool) ($protectUpload || $preventUnload || $preventNavigation || $protectSubmit),
            'protectSubmit' => (bool) ($protectUpload || $preventUnload || $protectSubmit),
            'preventNavigation' => (bool) ($protectUpload || $preventUnload || $preventNavigation),
            'preventUnload' => (bool) ($protectUpload || $preventUnload),
            'title' => $protectTitle ?? $fpLang('protect_title', 'Unggahan Belum Selesai'),
            'submitMessage' => $protectMessage ?? $fpLang('protect_submit_message', 'Berkas Anda masih dalam proses pengunggahan. Harap tunggu hingga semua berkas selesai diunggah sebelum mengirim formulir.'),
            'navigationMessage' => $protectMessage ?? $fpLang('protect_navigation_message', 'Berkas Anda masih dalam proses pengunggahan. Jika Anda meninggalkan halaman ini sekarang, proses unggah akan dibatalkan. Apakah Anda yakin ingin berpindah halaman?'),
            'stayButton' => $fpLang('protect_stay_button', 'Tetap di Sini'),
            'leaveButton' => $fpLang('protect_leave_button', 'Tinggalkan Halaman'),
        ],
    ];
@endphp

@pushOnce('head', 'vibe-filepond-styles')
    @vite(['resources/css/vibe/filepond.css'])
@endPushOnce

@pushOnce('head', 'vibe-filepond-scripts')
    @vite(['resources/js/vibe/filepond.js'])
@endPushOnce

<div 
    id="{{ $id }}-container"
    data-vibe-filepond
    {{ $attributes->only('class')->twMerge(['class' => trim("w-full {$wrapperClass} " . ($isAvatar ? 'filepond-avatar-mode ' : '') . ($isCompact ? 'filepond-compact-mode ' : '') . ($dashed ? 'filepond-dashed ' : 'filepond-solid ') . "filepond-size-{$size} " . ($hasError ? 'filepond-has-error' : ''))]) }}
    :class="{ 'filepond-has-error': hasError || Boolean(serverError) }"
    x-data="typeof window.vibeFilepond === 'function' ? window.vibeFilepond(@js($config)) : {
        pond: null,
        input: null,
        isUploading: false,
        fileCount: 0,
        files: [],
        hasError: {{ $hasError ? 'true' : 'false' }},
        serverError: @js($errorMessage),
        init() {
            var self = this;
            var mount = function() {
                if (self.pond) return;
                if (typeof window.vibeFilepond === 'function') {
                    var comp = window.vibeFilepond(@js($config));
                    Object.assign(self, comp);
                    self.$el = self.$el;
                    self.$refs = self.$refs;
                    self.init();
                }
            };
            if (typeof window.vibeFilepond === 'function') {
                mount();
            } else {
                window.addEventListener('vibe-filepond-ready', mount, { once: true });
            }
        },
        destroy() {
            if (this.pond) {
                try { this.pond.destroy(); } catch (e) {}
                this.pond = null;
            }
        },
        browse() {
            if (this.pond && typeof this.pond.browse === 'function') {
                this.pond.browse();
            } else {
                var el = document.getElementById('{{ $id }}');
                if (el) el.click();
            }
        },
        clear() {
            this.serverError = null;
            this.hasError = false;
            if (this.pond && typeof this.pond.removeFiles === 'function') {
                this.pond.removeFiles();
            }
        },
        getFiles() {
            return this.pond && typeof this.pond.getFiles === 'function' ? this.pond.getFiles() : [];
        }
    }">

    @if ($label)
        <label for="{{ $id }}" class="block text-xs font-semibold text-foreground mb-1.5 select-none cursor-pointer {{ $isAvatar ? 'text-center' : '' }}" @click.prevent="browse()">
            {{ $label }}
            @if ($isRequired)
                <span class="text-destructive font-bold ml-0.5" aria-hidden="true">*</span>
            @endif
        </label>
    @endif

    @if ($description)
        <p id="{{ $id }}-description" class="mb-1.5 text-xs text-muted-foreground {{ $isAvatar ? 'text-center' : '' }}">
            {{ $description }}
        </p>
    @endif

    <div wire:ignore 
         @if ($dropHeight) style="min-height: {{ $dropHeight }};" @endif 
         {{ $attributes->except(['class', 'disabled', 'required'])->twMerge(['class' => 'relative w-full']) }}>

        <input 
            x-ref="input" 
            type="file" 
            id="{{ $id }}" 
            name="{{ $name ? ($multiple ? "{$name}[]" : $name) : 'file' }}" 
            @if ($multiple) multiple @endif 
            @if ($resolvedAccept) accept="{{ is_array($resolvedAccept) ? implode(',', $resolvedAccept) : $resolvedAccept }}" @endif 
            @if ($isRequired) required @endif 
            @if ($isDisabled) disabled @endif
            aria-invalid="{{ $hasError ? 'true' : 'false' }}"
            @if ($hasError && $errorMessage) aria-describedby="{{ $id }}-error" @elseif ($description) aria-describedby="{{ $id }}-description" @endif
        >

        {{-- Fallback UI before FilePond JS mounts (prevents FOUC and native input flash) --}}
        <div class="filepond--fallback-dropzone {{ $isAvatar ? 'filepond-fallback-avatar' : '' }}" onclick="document.getElementById('{{ $id }}')?.click()">
            @if (isset($slot) && $slot->isNotEmpty())
                {{ $slot }}
            @else
                {!! $resolvedLabelIdle !!}
            @endif
        </div>

        {{-- Hidden container for presigned upload keys synchronization with standard forms --}}
        <div x-ref="hiddenContainer" class="hidden"></div>
    </div>

    {{-- Error message (Blade prop or runtime JS upload/validation error) --}}
    <p x-show="serverError"
       role="alert"
       id="{{ $id }}-error"
       class="mt-1.5 text-xs font-medium text-destructive flex items-center gap-1 {{ $isAvatar ? 'justify-center' : '' }}"
       @if (!$hasError || !$errorMessage) style="display:none" @endif>
        <svg class="size-3.5 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10" />
            <line x1="12" y1="8" x2="12" y2="12" />
            <line x1="12" x2="12.01" y1="16" y2="16" />
        </svg>
        <span x-text="serverError">{{ $errorMessage }}</span>
    </p>

    @if ($info)
        <p x-show="!serverError" id="{{ $id }}-info" class="mt-1.5 text-xs text-muted-foreground {{ $isAvatar ? 'text-center' : '' }}" @if ($hasError && $errorMessage) style="display:none" @endif>
            {{ $info }}
        </p>
    @endif
</div>
