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
    'existingFiles' => [],
    'disabled' => false,
    'required' => false,
    'labels' => [],
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

    $fpLang = function ($key, $default = '') {
        if (Lang::has("vibe/filepond.{$key}")) {
            return __("vibe/filepond.{$key}");
        }
        if (Lang::has("vibe::vibe/filepond.{$key}")) {
            return __("vibe::vibe/filepond.{$key}");
        }
        return $default;
    };

    // Load localized labels
    $langLabels = [
        'labelIdle' => $avatar ? $fpLang('label_avatar_idle', '<span class="filepond--label-action">Pilih Foto</span>') : $fpLang('label_idle', 'Tarik & Lepas berkas atau <span class="filepond--label-action">Pilih Berkas</span>'),
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

    $config = [
        'id' => $id,
        'name' => $name,
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
        'avatar' => (bool) $avatar,
        'encode' => (bool) $encode,
        'server' => $server,
        'presignUrl' => $presignUrl,
        'presignMethod' => $presignMethod,
        'chunkUploads' => (bool) $chunkUploads,
        'chunkSize' => $chunkSize,
        'existingFiles' => $existingFiles,
        'disabled' => (bool) $isDisabled,
        'required' => (bool) $isRequired,
        'labels' => $mergedLabels,
        'wireModel' => $wireModelAttr,
    ];

    $configJson = json_encode($config, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT);
@endphp

@pushOnce('head', 'vibe-filepond-styles')
    @vite(['resources/css/vibe/filepond.css'])
@endPushOnce

@pushOnce('head', 'vibe-filepond-scripts')
    @vite(['resources/js/vibe/filepond.js'])
@endPushOnce

<div class="{{ $wrapperClass }} {{ $avatar ? 'filepond-avatar-mode' : '' }}">
    @if ($label)
        <label for="{{ $id }}" class="block text-xs font-semibold text-foreground mb-1.5 select-none cursor-pointer {{ $avatar ? 'text-center' : '' }}" onclick="
                var c = document.getElementById('{{ $id }}')?.closest('[data-vibe-filepond]');
                if (c) {
                    var p = c._x_dataStack?.find(function(s) { return s && s.pond; })?.pond;
                    if (p && typeof p.browse === 'function') {
                        event.preventDefault();
                        p.browse();
                    }
                }
            ">
            {{ $label }}
            @if ($isRequired)
                <span class="text-destructive font-bold ml-0.5" aria-hidden="true">*</span>
            @endif
        </label>
    @endif

    @if ($description)
        <p id="{{ $id }}-description" class="mb-1.5 text-xs text-muted-foreground {{ $avatar ? 'text-center' : '' }}">
            {{ $description }}
        </p>
    @endif

    <div data-vibe-filepond wire:ignore x-data="{
        pond: null,
        init() {
            var self = this;
            var mount = function() {
                if (self.pond) return;
                if (typeof window.vibeFilepond === 'function') {
                    var comp = window.vibeFilepond({{ $configJson }});
                    comp.$el = self.$el;
                    comp.$refs = self.$refs;
                    comp.$dispatch = self.$dispatch ? self.$dispatch.bind(self) : function(name, detail) {
                        self.$el.dispatchEvent(new CustomEvent(name, { detail: detail, bubbles: true }));
                    };
                    comp.init();
                    self.pond = comp.pond;
                }
            };
    
            if (typeof window.vibeFilepond === 'function') {
                mount();
            } else {
                window.addEventListener('vibe-filepond-ready', mount, { once: true });
                var t = setInterval(function() {
                    if (typeof window.vibeFilepond === 'function') {
                        clearInterval(t);
                        mount();
                    }
                }, 25);
                setTimeout(function() { clearInterval(t); }, 4000);
            }
        },
        destroy() {
            if (this.pond) {
                try { this.pond.destroy(); } catch (e) {}
                this.pond = null;
            }
        }
    }" onclick="
            if (event.target.closest('button, a, .filepond--file-action-button, .filepond--action-remove-item, .filepond--action-retry-item-processing, .filepond--action-abort-item-processing, .filepond--action-revert-item-processing')) return;
            if (event.target.tagName === 'INPUT' && event.target.type === 'file') return;
            var p = this._x_dataStack?.find(function(s) { return s && s.pond; })?.pond;
            if (p && typeof p.browse === 'function') {
                event.preventDefault();
                p.browse();
            } else {
                var inp = this.querySelector('input.filepond--browser') || this.querySelector('input[type=file]');
                if (inp && event.target !== inp) inp.click();
            }
        " {{ $attributes->except(['class', 'disabled', 'required'])->twMerge(['class' => 'relative w-full cursor-pointer']) }}>
        <input x-ref="input" type="file" id="{{ $id }}" name="{{ $name ? ($multiple ? "{$name}[]" : $name) : 'file' }}" @if ($multiple) multiple @endif @if ($resolvedAccept) accept="{{ is_array($resolvedAccept) ? implode(',', $resolvedAccept) : $resolvedAccept }}" @endif @if ($isRequired) required @endif @if ($isDisabled) disabled @endif class="sr-only">

        {{-- Hidden container for presigned upload keys synchronization with standard forms --}}
        <div x-ref="hiddenContainer" class="hidden"></div>
    </div>

    @if ($hasError && $errorMessage)
        <p id="{{ $id }}-error" role="alert" class="mt-1.5 text-xs font-medium text-destructive flex items-center gap-1 {{ $avatar ? 'justify-center' : '' }}">
            <svg class="size-3.5 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10" />
                <line x1="12" x2="12" y1="8" y2="12" />
                <line x1="12" x2="12.01" y1="16" y2="16" />
            </svg>
            <span>{{ $errorMessage }}</span>
        </p>
    @elseif ($info)
        <p id="{{ $id }}-info" class="mt-1.5 text-xs text-muted-foreground {{ $avatar ? 'text-center' : '' }}">
            {{ $info }}
        </p>
    @endif
</div>
