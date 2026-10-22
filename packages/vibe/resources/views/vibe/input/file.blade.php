@props([
    'label'        => null,
    'id'           => null,
    'name'         => null,
    'variant'      => 'default',   // 'default' | 'dropzone' | 'avatar' | 'logo'
    'size'         => 'md',        // 'sm' | 'md' | 'lg'
    'aspectRatio'  => 'auto',      // 'auto' | 'horizontal' | 'square' | 'video'
    'accept'       => null,
    'multiple'     => false,
    'maxFiles'     => null,
    'maxSize'      => null,
    'preview'      => true,
    'browseText'   => null,
    'removeText'   => null,
    'hint'         => null,
    'dropText'     => null,
    'placeholder'  => null,
    'description'  => null,
    'info'         => null,
    'error'        => null,
    'errorName'    => null,
    'existingUrl'  => null,
    'disabled'     => false,
    'readonly'     => false,
    'required'     => false,
    'wrapperClass' => null,
    'icon'         => null,
    'animation'    => false,
])

@php
    $wireModel  = $attributes->wire('model')->value();
    $name       = $name ?? ($wireModel ?: $attributes->whereStartsWith('wire:model')->first());
    $id         = $id ?? ($name ? preg_replace('/[^a-zA-Z0-9_-]/', '-', (string) $name) : uniqid('file-'));
    $errorKey   = $errorName ?? ($name ? str_replace(['[', ']'], ['.', ''], rtrim($name, ']')) : null);

    $errorBag     = $errors ?? (view()->shared('errors') ?? new \Illuminate\Support\ViewErrorBag);
    $hasError     = !empty($error) || ($errorKey && $errorBag->has($errorKey));
    $errorMessage = $error && !is_bool($error) ? $error : ($errorKey ? $errorBag->first($errorKey) : null);

    $isDisabled   = $disabled || ($attributes->has('disabled') && $attributes->get('disabled') !== false);
    $isReadonly   = $readonly || ($attributes->has('readonly') && $attributes->get('readonly') !== false);
    $isRequired   = $required || ($attributes->has('required') && $attributes->get('required') !== false);
    $maxFilesCount = !empty($maxFiles) ? (int) $maxFiles : null;

    // Parse maxSize → bytes
    $maxSizeBytes = null;
    if (!empty($maxSize)) {
        if (is_numeric($maxSize)) {
            $maxSizeBytes = (int) $maxSize;
        } else {
            $units = ['GB' => 1073741824, 'MB' => 1048576, 'KB' => 1024, 'B' => 1];
            $str   = strtoupper(trim((string) $maxSize));
            foreach ($units as $unit => $mul) {
                if (str_ends_with($str, $unit)) {
                    $maxSizeBytes = (int) (floatval(trim(substr($str, 0, -strlen($unit)))) * $mul);
                    break;
                }
            }
        }
    }

    // Localised labels
    $browseLabel    = $browseText ?? match ($variant) {
        'logo'   => trans()->has('vibe/input.file_change_logo')
                        ? ($existingUrl ? __('vibe/input.file_change_logo')   : __('vibe/input.file_select_logo'))
                        : ($existingUrl ? 'Ganti Logo'  : 'Pilih Logo'),
        'avatar' => trans()->has('vibe/input.file_change_avatar')
                        ? ($existingUrl ? __('vibe/input.file_change_avatar') : __('vibe/input.file_select_avatar'))
                        : ($existingUrl ? 'Ubah Foto'   : 'Pilih Foto'),
        default  => trans()->has('vibe/input.file_browse') ? __('vibe/input.file_browse') : 'Pilih Berkas',
    };
    $removeLabel     = $removeText     ?? (trans()->has('vibe/input.file_remove')       ? __('vibe/input.file_remove')       : 'Hapus');
    $placeholderText = $placeholder    ?? (trans()->has('vibe/input.file_placeholder')  ? __('vibe/input.file_placeholder')  : 'Tidak ada berkas yang dipilih');
    $dragDropText    = $dropText       ?? (trans()->has('vibe/input.file_dropzone_text')? __('vibe/input.file_dropzone_text'): 'Klik untuk mengunggah atau seret dan lepas berkas ke sini');

    // Aspect ratio normalisation
    $aspectRatio = match ($aspectRatio) {
        'horizontal', 'rect', 'landscape' => 'horizontal',
        'square', '1:1'                   => 'square',
        'video', '16:9'                   => 'video',
        default                           => ($variant === 'logo' ? 'horizontal' : 'auto'),
    };

    // Logo dimension classes
    $logoDimensionClasses = match ($aspectRatio) {
        'square' => match ($size) { 'sm' => 'size-20', 'lg' => 'size-32', default => 'size-24 sm:size-28' },
        'video'  => match ($size) { 'sm' => 'w-36 h-20', 'lg' => 'w-56 h-32', default => 'w-48 h-28 sm:w-56 sm:h-32' },
        default  => match ($size) { 'sm' => 'w-36 h-14', 'lg' => 'w-64 h-24', default => 'w-48 h-18 sm:w-56 sm:h-20' },
    };

    // Avatar size classes
    $avatarSizeClasses = match ($size) {
        'sm'    => 'size-16',
        'lg'    => 'size-28 sm:size-32',
        default => 'size-20 sm:size-24',
    };

    // Animation
    $animationClass = match ($animation) {
        true, 'auto' => ($hasError ? 'animate-vibe-shake' : ''),
        'shake'      => 'animate-vibe-shake',
        'pop', 'bounce' => 'animate-vibe-pop',
        'pulse'      => 'animate-vibe-pulse',
        'wobble'     => 'animate-vibe-wobble',
        default      => '',
    };

    // Checkerboard SVG (transparency indicator)


    // Shared border / focus classes — match vibe input design
    $baseWrapperClasses = 'w-full rounded-lg border bg-background shadow-2xs transition-all duration-150';
    $borderClasses = $hasError
        ? 'border-destructive ring-2 ring-destructive/20'
        : 'border-input hover:border-primary/40 focus-within:border-primary focus-within:ring-2 focus-within:ring-primary/20';
    $disabledClasses = $isDisabled ? 'opacity-50 pointer-events-none cursor-not-allowed bg-muted/40' : '';
@endphp

<div {{ $attributes->only('class')->twMerge(['class' => trim("w-full {$wrapperClass}")]) }}
    x-data="{
        files: [],
        isDragging: false,
        existingUrl: @js($existingUrl),
        isRemoved: false,
        clientError: '',
        maxSizeBytes: @js($maxSizeBytes),
        maxFilesCount: @js($maxFilesCount),
        isMultiple: @js((bool) $multiple),
        isUploading: false,
        uploadProgress: 0,
        _syncing: false,

        handleFiles(fileList) {
            if (this._syncing) return;
            this.clientError = '';
            if (!fileList || fileList.length === 0) return;
            let incoming = Array.from(fileList);
            if (this.maxFilesCount && this.isMultiple && (this.files.length + incoming.length > this.maxFilesCount)) {
                this.clientError = 'Maksimal ' + this.maxFilesCount + ' berkas diperbolehkan.';
                return;
            }
            for (let f of incoming) {
                if (this.maxSizeBytes && f.size > this.maxSizeBytes) {
                    this.clientError = 'Ukuran berkas \'' + f.name + '\' melebihi batas {{ $maxSize ?? '' }}.';
                    return;
                }
            }
            if (this.isMultiple) {
                incoming.forEach(f => this.addFile(f));
                this.syncInput();
            } else {
                this.clearLocalFiles();
                this.addFile(incoming[0]);
                this.isRemoved = false;
            }
        },

        addFile(file) {
            let isImg = file.type.startsWith('image/');
            this.files.push({
                file: file,
                name: file.name,
                size: this.formatBytes(file.size),
                type: file.type,
                isImage: isImg,
                previewUrl: isImg ? URL.createObjectURL(file) : null
            });
        },

        removeFile(index) {
            let r = this.files.splice(index, 1)[0];
            if (r && r.previewUrl) URL.revokeObjectURL(r.previewUrl);
            this.syncInput();
        },

        removeExisting() {
            this.isRemoved = true;
            this.clearAll();
        },

        clearAll() {
            this.clearLocalFiles();
            this.clientError = '';
            if (this.$refs.fileInput) {
                this._syncing = true;
                this.$refs.fileInput.value = '';
                this.$refs.fileInput.dispatchEvent(new Event('change', { bubbles: true }));
                this._syncing = false;
            }
        },

        clearLocalFiles() {
            this.files.forEach(f => { if (f.previewUrl) URL.revokeObjectURL(f.previewUrl); });
            this.files = [];
        },

        syncInput() {
            if (!this.$refs.fileInput) return;
            this._syncing = true;
            try {
                let dt = new DataTransfer();
                this.files.forEach(item => dt.items.add(item.file));
                this.$refs.fileInput.files = dt.files;
                this.$refs.fileInput.dispatchEvent(new Event('change', { bubbles: true }));
            } catch (e) {}
            this._syncing = false;
        },

        formatBytes(bytes) {
            if (!bytes || bytes === 0) return '0 B';
            const k = 1024, sizes = ['B', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(1)) + ' ' + sizes[i];
        }
    }"
    x-on:livewire-upload-start="isUploading = true; uploadProgress = 0"
    x-on:livewire-upload-finish="isUploading = false"
    x-on:livewire-upload-error="isUploading = false"
    x-on:livewire-upload-progress="uploadProgress = $event.detail.progress"
>
    {{-- Label --}}
    @if ($label)
        <label for="{{ $id }}" class="block text-xs font-semibold text-foreground mb-1.5 select-none">
            {{ $label }}
            @if ($isRequired)
                <span class="text-destructive font-bold ml-0.5" aria-hidden="true">*</span>
            @endif
        </label>
    @endif

    {{-- Description --}}
    @if ($description)
        <p id="{{ $id }}-description" class="mb-2 text-xs text-muted-foreground">{{ $description }}</p>
    @endif

    {{-- Hidden native file input --}}
    <input
        type="file"
        x-ref="fileInput"
        id="{{ $id }}"
        name="{{ $name }}"
        @if ($accept) accept="{{ $accept }}" @endif
        @if ($multiple) multiple @endif
        @if ($isDisabled) disabled @endif
        @if ($isRequired) required @endif
        class="sr-only"
        tabindex="-1"
        @change="handleFiles($event.target.files)"
        {{ $attributes->except(['class', 'disabled', 'required', 'multiple', 'accept', 'type', 'id', 'name']) }}
    />

    {{-- Remove hidden input for existing files --}}
    <template x-if="isRemoved && existingUrl">
        <input type="hidden" name="remove_{{ preg_replace('/[^a-zA-Z0-9_]/', '_', (string)$name) }}" value="1" />
    </template>


    {{-- ================================================================ --}}
    {{-- VARIANT: DEFAULT                                                  --}}
    {{-- ================================================================ --}}
    @if ($variant === 'default')
        <div @class([
            $baseWrapperClasses,
            $borderClasses,
            $disabledClasses,
            $animationClass,
            'flex items-center gap-0',
        ])>
            {{-- Browse button — left pill --}}
            <button
                type="button"
                @click="$refs.fileInput.click()"
                @disabled($isDisabled)
                class="group/fbtn inline-flex items-center gap-1.5 shrink-0 px-3 h-9 text-xs font-medium text-foreground bg-muted/50 hover:bg-muted border-r border-input rounded-l-[calc(var(--radius-lg)-1px)] transition-colors duration-150 cursor-pointer select-none focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary"
            >
                <svg class="size-3.5 text-muted-foreground group-hover/fbtn:text-foreground transition-colors" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-2"/>
                    <polyline points="7 9 12 4 17 9"/>
                    <line x1="12" y1="4" x2="12" y2="16"/>
                </svg>
                <span>{{ $browseLabel }}</span>
            </button>

            {{-- File name display --}}
            <div class="flex-1 min-w-0 px-3 h-9 flex items-center gap-2">
                {{-- Placeholder --}}
                <template x-if="files.length === 0 && !existingUrl">
                    <span class="text-xs text-muted-foreground truncate select-none">{{ $placeholderText }}</span>
                </template>

                {{-- Existing file active --}}
                <template x-if="files.length === 0 && existingUrl && !isRemoved">
                    <span class="text-xs text-foreground font-medium truncate flex items-center gap-1.5">
                        <svg class="size-3.5 text-primary shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        <span class="truncate">Berkas saat ini aktif</span>
                    </span>
                </template>

                {{-- Single new file --}}
                <template x-if="files.length === 1">
                    <span class="text-xs text-foreground font-medium truncate flex items-center gap-1.5">
                        <svg class="size-3.5 text-primary shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                        <span x-text="files[0].name" class="truncate"></span>
                        <span class="text-muted-foreground text-[11px] shrink-0" x-text="'(' + files[0].size + ')'"></span>
                    </span>
                </template>

                {{-- Multiple files --}}
                <template x-if="files.length > 1">
                    <span class="text-xs text-foreground font-medium flex items-center gap-1.5">
                        <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-semibold bg-primary/10 text-primary" x-text="files.length + ' berkas'"></span>
                        <span class="text-muted-foreground truncate" x-text="files.map(f => f.name).join(', ')"></span>
                    </span>
                </template>
            </div>

            {{-- Clear button --}}
            <button
                type="button"
                x-show="files.length > 0 || (existingUrl && !isRemoved)"
                x-cloak
                @click="existingUrl && files.length === 0 ? removeExisting() : clearAll()"
                class="shrink-0 mr-2 size-5 flex items-center justify-center rounded-md text-muted-foreground hover:text-destructive hover:bg-destructive/10 transition-colors duration-150 cursor-pointer"
                title="{{ $removeLabel }}"
            >
                <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>

        {{-- Multi-file chips --}}
        @if ($multiple)
            <template x-if="files.length > 1">
                <div class="mt-2 space-y-1.5">
                    <div class="flex items-center justify-between text-xs px-0.5">
                        <span class="text-muted-foreground" x-text="files.length + ' berkas terpilih'"></span>
                        <button type="button" @click="clearAll()" class="text-destructive hover:underline font-medium cursor-pointer text-[11px]">Hapus Semua</button>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-1.5">
                        <template x-for="(item, idx) in files" :key="idx">
                            <div class="flex items-center justify-between gap-2 px-2.5 py-1.5 rounded-lg border border-border bg-muted/30 text-xs">
                                <div class="flex items-center gap-2 min-w-0">
                                    <template x-if="item.isImage && item.previewUrl">
                                        <img :src="item.previewUrl" class="size-6 rounded-md object-cover border border-border shrink-0" />
                                    </template>
                                    <template x-if="!item.isImage || !item.previewUrl">
                                        <svg class="size-4 text-muted-foreground shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                                    </template>
                                    <span class="truncate font-medium text-foreground" x-text="item.name"></span>
                                    <span class="text-muted-foreground text-[10px] shrink-0" x-text="item.size"></span>
                                </div>
                                <button type="button" @click="removeFile(idx)" class="shrink-0 size-5 flex items-center justify-center rounded text-muted-foreground hover:text-destructive hover:bg-destructive/10 transition-colors cursor-pointer">
                                    <svg class="size-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                </button>
                            </div>
                        </template>
                    </div>
                </div>
            </template>
        @endif


    {{-- ================================================================ --}}
    {{-- VARIANT: DROPZONE                                                 --}}
    {{-- ================================================================ --}}
    @elseif ($variant === 'dropzone')
        <div
            @dragover.prevent="if (!{{ $isDisabled ? 'true' : 'false' }}) isDragging = true"
            @dragleave.prevent="isDragging = false"
            @drop.prevent="if (!{{ $isDisabled ? 'true' : 'false' }}) { isDragging = false; handleFiles($event.dataTransfer.files); }"
            @click="if (!{{ $isDisabled ? 'true' : 'false' }}) $refs.fileInput.click()"
            @class([
                'group relative w-full rounded-xl border-2 border-dashed cursor-pointer select-none transition-all duration-200',
                'border-destructive bg-destructive/5 hover:bg-destructive/8' => $hasError,
                'border-border bg-muted/20 hover:bg-muted/40 hover:border-primary/50' => !$hasError && !$isDisabled,
                'opacity-50 pointer-events-none bg-muted/20 cursor-not-allowed' => $isDisabled,
                $animationClass,
            ])
            :class="isDragging && !{{ $isDisabled ? 'true' : 'false' }} ? 'border-primary bg-primary/5 ring-4 ring-primary/10 scale-[1.005]' : ''"
        >
            <div class="flex flex-col items-center justify-center py-10 px-6 text-center">
                {{-- Animated upload icon --}}
                <div class="mb-4 size-14 rounded-2xl bg-primary/8 border border-primary/15 flex items-center justify-center text-primary shadow-sm group-hover:shadow-md group-hover:bg-primary/12 transition-all duration-200"
                     :class="isDragging ? 'scale-110 bg-primary/15' : ''">
                    <svg class="size-7 transition-transform duration-200" :class="isDragging ? '-translate-y-0.5' : 'group-hover:-translate-y-0.5'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-2"/>
                        <polyline points="7 9 12 4 17 9"/>
                        <line x1="12" y1="4" x2="12" y2="16"/>
                    </svg>
                </div>

                <p class="text-sm font-semibold text-foreground mb-1">
                    <span class="text-primary">{{ $browseLabel }}</span>
                    <span class="text-muted-foreground font-normal"> atau seret & lepas di sini</span>
                </p>

                <p class="text-xs text-muted-foreground max-w-xs leading-relaxed">
                    @if ($hint)
                        {{ $hint }}
                    @elseif ($accept)
                        Format: <span class="font-medium text-foreground">{{ $accept }}</span>{{ $maxSize ? ' &bull; Maks. ' . $maxSize : '' }}
                    @else
                        Semua format berkas didukung{{ $maxSize ? ' (Maks. ' . $maxSize . ')' : '' }}
                    @endif
                </p>

                @if ($maxFilesCount && $multiple)
                    <p class="mt-1 text-[11px] text-muted-foreground/70">Hingga {{ $maxFilesCount }} berkas sekaligus</p>
                @endif
            </div>

            {{-- Drag hint overlay --}}
            <div x-show="isDragging" x-cloak
                 class="pointer-events-none absolute inset-0 rounded-xl flex items-center justify-center bg-primary/5">
                <p class="text-sm font-semibold text-primary">Lepaskan untuk mengunggah&hellip;</p>
            </div>
        </div>

        {{-- Selected files list --}}
        <template x-if="files.length > 0">
            <div class="mt-3 space-y-2">
                <div class="flex items-center justify-between text-xs px-0.5">
                    <span class="font-medium text-foreground" x-text="files.length + ' berkas siap diunggah'"></span>
                    <button type="button" @click="clearAll()" class="text-destructive hover:underline font-medium cursor-pointer">Hapus Semua</button>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-2">
                    <template x-for="(item, idx) in files" :key="idx">
                        <div class="group/card relative flex items-center gap-2.5 px-3 py-2.5 rounded-xl border border-border bg-background shadow-2xs hover:shadow-sm transition-shadow duration-150">
                            {{-- Thumbnail or file icon --}}
                            <template x-if="item.isImage && item.previewUrl">
                                <div class="size-10 rounded-lg border border-border overflow-hidden shrink-0 bg-muted">
                                    <img :src="item.previewUrl" class="size-full object-cover" />
                                </div>
                            </template>
                            <template x-if="!item.isImage || !item.previewUrl">
                                <div class="size-10 rounded-lg bg-muted border border-border flex items-center justify-center shrink-0 text-muted-foreground">
                                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                                </div>
                            </template>

                            <div class="min-w-0 flex-1">
                                <p class="text-xs font-medium text-foreground truncate" x-text="item.name"></p>
                                <p class="text-[11px] text-muted-foreground" x-text="item.size"></p>
                            </div>

                            <button type="button" @click="removeFile(idx)"
                                class="shrink-0 size-6 flex items-center justify-center rounded-md text-muted-foreground hover:text-destructive hover:bg-destructive/10 transition-colors cursor-pointer opacity-0 group-hover/card:opacity-100"
                                title="Hapus berkas ini">
                                <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                            </button>
                        </div>
                    </template>
                </div>
            </div>
        </template>


    {{-- ================================================================ --}}
    {{-- VARIANT: AVATAR                                                   --}}
    {{-- ================================================================ --}}
    @elseif ($variant === 'avatar')
        <div class="flex items-center gap-4">
            {{-- Circle frame --}}
            <div
                @click="if (!{{ $isDisabled ? 'true' : 'false' }}) $refs.fileInput.click()"
                @class([
                    'group relative rounded-full overflow-hidden shrink-0 cursor-pointer select-none transition-all duration-200',
                    $avatarSizeClasses,
                    $hasError
                        ? 'ring-2 ring-destructive ring-offset-2 ring-offset-background'
                        : 'ring-2 ring-border ring-offset-2 ring-offset-background hover:ring-primary',
                    'opacity-50 pointer-events-none' => $isDisabled,
                    $animationClass,
                ])
            >
                {{-- New image preview --}}
                <template x-if="files.length > 0 && files[0].isImage">
                    <img :src="files[0].previewUrl" class="size-full object-cover" />
                </template>

                {{-- Existing image --}}
                <template x-if="files.length === 0 && existingUrl && !isRemoved">
                    <img :src="existingUrl" class="size-full object-cover" />
                </template>

                {{-- Fallback silhouette --}}
                <template x-if="(files.length === 0 && !existingUrl) || isRemoved">
                    <div class="size-full flex items-center justify-center bg-muted text-muted-foreground/50">
                        <svg class="size-2/5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 12a5 5 0 1 0 0-10 5 5 0 0 0 0 10Zm0 2c-5.33 0-8 2.67-8 4v1h16v-1c0-1.33-2.67-4-8-4Z"/>
                        </svg>
                    </div>
                </template>

                {{-- Camera overlay --}}
                <div class="absolute inset-0 bg-black/55 flex flex-col items-center justify-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity duration-150">
                    <svg class="size-[22%]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/>
                        <circle cx="12" cy="13" r="4"/>
                    </svg>
                    <span class="text-white text-[9px] font-bold tracking-widest uppercase">Ubah</span>
                </div>
            </div>

            {{-- Side controls --}}
            <div class="space-y-2">
                <div class="flex items-center gap-2 flex-wrap">
                    <vibe:button type="button" size="xs" variant="outline" @click="$refs.fileInput.click()" :disabled="$isDisabled">
                        <svg class="size-3 -ml-0.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                        <span>{{ $browseLabel }}</span>
                    </vibe:button>

                    <button type="button"
                        x-show="files.length > 0 || (existingUrl && !isRemoved)"
                        x-cloak
                        @click="existingUrl && files.length === 0 ? removeExisting() : clearAll()"
                        class="text-xs text-destructive hover:text-destructive/80 font-medium cursor-pointer leading-none py-1"
                    >{{ $removeLabel }}</button>
                </div>

                <p class="text-xs text-muted-foreground leading-relaxed">
                    {{ $hint ?? 'Format: JPG, PNG, atau WebP' . ($maxSize ? ' &bull; Maks. ' . $maxSize : '') }}
                </p>

                {{-- Selected file name --}}
                <template x-if="files.length > 0">
                    <p class="text-xs text-primary font-medium flex items-center gap-1">
                        <svg class="size-3.5 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        <span x-text="files[0].name" class="truncate max-w-50"></span>
                    </p>
                </template>
            </div>
        </div>


    {{-- ================================================================ --}}
    {{-- VARIANT: LOGO                                                     --}}
    {{-- ================================================================ --}}
    @elseif ($variant === 'logo')
        <div class="flex flex-col sm:flex-row sm:items-start gap-4">
            {{-- Logo preview frame --}}
            <div
                @click="if (!{{ $isDisabled ? 'true' : 'false' }}) $refs.fileInput.click()"
                @class([
                    'group relative shrink-0 overflow-hidden rounded-xl border-2 cursor-pointer select-none transition-all duration-200 flex items-center justify-center',
                    $logoDimensionClasses,
                    $hasError
                        ? 'border-destructive ring-2 ring-destructive/20 bg-destructive/5'
                        : 'border-border hover:border-primary bg-card',
                    'opacity-50 pointer-events-none' => $isDisabled,
                    $animationClass,
                ])
                title="Klik untuk memilih logo"
            >
                <template x-if="files.length > 0 && files[0].isImage">
                    <img :src="files[0].previewUrl" class="max-h-full max-w-full object-contain p-2 drop-shadow-xs" />
                </template>

                <template x-if="files.length === 0 && existingUrl && !isRemoved">
                    <img :src="existingUrl" class="max-h-full max-w-full object-contain p-2 drop-shadow-xs" />
                </template>

                <template x-if="(files.length === 0 && !existingUrl) || isRemoved">
                    <div class="flex flex-col items-center justify-center gap-1 text-muted-foreground/50 p-3">
                        <svg class="size-7" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                            <circle cx="8.5" cy="8.5" r="1.5"/>
                            <polyline points="21 15 16 10 5 21"/>
                        </svg>
                        <span class="text-[10px] font-medium tracking-wide select-none">Logo Preview</span>
                    </div>
                </template>

                {{-- Change overlay --}}
                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-150 bg-black/35 backdrop-blur-[2px]">
                    <div class="flex items-center gap-1.5 text-[11px] font-semibold text-white bg-black/50 px-2.5 py-1.5 rounded-lg">
                        <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        <span>Ganti</span>
                    </div>
                </div>
            </div>

            {{-- Side instructions --}}
            <div class="flex-1 min-w-0 space-y-2.5 pt-0.5">
                <div class="flex items-center gap-2 flex-wrap">
                    <vibe:button type="button" size="xs" variant="outline" @click="$refs.fileInput.click()" :disabled="$isDisabled">
                        <svg class="size-3.5 -ml-0.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-2"/><polyline points="7 9 12 4 17 9"/><line x1="12" y1="4" x2="12" y2="16"/></svg>
                        <span>{{ $browseLabel }}</span>
                    </vibe:button>

                    <button type="button"
                        x-show="files.length > 0 || (existingUrl && !isRemoved)"
                        x-cloak
                        @click="existingUrl && files.length === 0 ? removeExisting() : clearAll()"
                        class="text-xs text-destructive hover:text-destructive/80 font-medium cursor-pointer leading-none py-1"
                    >{{ $removeLabel }}</button>
                </div>

                <div class="text-xs text-muted-foreground space-y-0.5">
                    @if ($hint)
                        <p class="font-medium text-foreground">{{ $hint }}</p>
                    @else
                        <p>Format: <span class="font-medium text-foreground">SVG, PNG transparan, WebP</span></p>
                        <p class="text-[11px] text-muted-foreground/80">
                            {{ $aspectRatio === 'square'
                                ? 'Rasio 1:1 &bull; Rekomendasi min. 512&times;512px'
                                : 'Rasio horizontal 3:1 atau 4:1 &bull; Rekomendasi 512&times;128px' }}
                            @if ($maxSize) &bull; Maks. {{ $maxSize }} @endif
                        </p>
                    @endif
                </div>

                <template x-if="files.length > 0">
                    <div class="inline-flex items-center gap-1.5 text-xs text-primary font-medium">
                        <svg class="size-3.5 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        <span x-text="files[0].name" class="truncate max-w-xs"></span>
                        <span class="text-muted-foreground text-[10px]" x-text="'(' + files[0].size + ')'"></span>
                    </div>
                </template>
            </div>
        </div>
    @endif


    {{-- ================================================================ --}}
    {{-- Livewire upload progress                                          --}}
    {{-- ================================================================ --}}
    <div x-show="isUploading" x-cloak class="mt-3 space-y-1.5">
        <div class="flex items-center justify-between text-xs font-medium text-primary">
            <span>Mengunggah berkas&hellip;</span>
            <span x-text="uploadProgress + '%'"></span>
        </div>
        <div class="w-full h-1.5 bg-muted rounded-full overflow-hidden">
            <div class="h-full bg-primary rounded-full transition-all duration-150" :style="'width:' + uploadProgress + '%'"></div>
        </div>
    </div>


    {{-- ================================================================ --}}
    {{-- Error / info messages                                             --}}
    {{-- ================================================================ --}}
    @if ($hasError && $errorMessage)
        <p id="{{ $id }}-error" role="alert" class="mt-1.5 text-xs text-destructive font-medium flex items-center gap-1">
            <svg class="size-3.5 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 8v5M12 16h.01"/></svg>
            <span>{{ $errorMessage }}</span>
        </p>
    @endif

    <p x-show="clientError" x-cloak x-text="clientError" class="mt-1.5 text-xs text-destructive font-medium flex items-center gap-1">
        <svg class="size-3.5 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 8v5M12 16h.01"/></svg>
    </p>

    @if ($info && !$hasError)
        <p id="{{ $id }}-info" class="mt-1.5 text-xs text-muted-foreground">{{ $info }}</p>
    @endif
</div>
