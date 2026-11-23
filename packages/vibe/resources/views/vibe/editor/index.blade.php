@blaze

@props([
    'label' => null,
    'id' => null,
    'name' => null,
    'value' => null,
    'placeholder' => null,
    'preset' => 'standard', // 'minimal', 'basic', 'standard', 'full'
    'height' => 350,
    'minHeight' => 200,
    'maxHeight' => null,
    'autoresize' => false,
    'menubar' => false,
    'toolbar' => null,
    'toolbarMode' => 'sliding', // 'sliding', 'floating', 'wrap', 'scrolling'
    'toolbarSticky' => true,
    'toolbarStickyOffset' => 0,
    'plugins' => null,
    'statusbar' => true,
    'readonly' => false,
    'disabled' => false,
    'required' => false,
    'variables' => [],
    'variableStyle' => 'badge', // 'badge', 'raw'
    'variablePrefix' => '{{ ',
    'variableSuffix' => ' }}',
    'variableButtonLabel' => null,
    'uploadUrl' => null,
    'uploadParam' => 'file',
    'uploadDisk' => null,
    'uploadFolder' => null,
    'baseUrl' => null,
    'description' => null,
    'info' => null,
    'error' => null,
    'errorName' => null,
    'wrapperClass' => null,
])

@php
    $wireModel = $attributes->whereStartsWith('wire:model')->first();
    $name = $name ?? $wireModel;
    $id = $id ?? ($name ? 'editor-' . preg_replace('/[^a-zA-Z0-9\-_]/', '-', $name) . '-' . uniqid() : uniqid('editor-'));
    $errorKey = $errorName ?? ($name ? str_replace(['[', ']'], ['.', ''], rtrim($name, ']')) : null);

    $hasError = !empty($error) || ($errorKey && $errors->has($errorKey));
    $errorMessage = ($error && !is_bool($error)) ? $error : ($errorKey ? $errors->first($errorKey) : null);

    $isWireLive = $attributes->whereStartsWith('wire:model.live')->isNotEmpty();
    $resolvedValue = (string) ($slot->isNotEmpty() ? $slot : ($value ?? ''));

    // Normalize Variables Data Structure
    $flatVariables = [];
    $groupedVariables = [];

    if (!empty($variables)) {
        $rawVars = $variables;
        if (is_string($rawVars)) {
            $decoded = json_decode($rawVars, true);
            $rawVars = (json_last_error() === JSON_ERROR_NONE) ? $decoded : [$rawVars];
        }

        foreach ($rawVars as $groupKey => $groupValue) {
            if (is_array($groupValue)) {
                if (isset($groupValue['items']) && is_array($groupValue['items'])) {
                    $groupName = (string) ($groupValue['label'] ?? ucfirst($groupKey));
                    foreach ($groupValue['items'] as $fieldKey => $fieldLabel) {
                        $itemKey = is_numeric($fieldKey) ? $fieldLabel : (str_contains($fieldKey, '.') ? $fieldKey : "{$groupKey}.{$fieldKey}");
                        $itemLabel = is_numeric($fieldKey) ? ucwords(str_replace(['.', '_', '-'], ' ', $fieldLabel)) : $fieldLabel;
                        $item = ['key' => $itemKey, 'label' => $itemLabel, 'group' => $groupName];
                        $flatVariables[] = $item;
                        $groupedVariables[$groupName][] = $item;
                    }
                } else {
                    $groupName = (string) ucfirst($groupKey);
                    foreach ($groupValue as $fieldKey => $fieldLabel) {
                        $itemKey = is_numeric($fieldKey) ? $fieldLabel : (str_contains($fieldKey, '.') ? $fieldKey : "{$groupKey}.{$fieldKey}");
                        $itemLabel = is_numeric($fieldKey) ? ucwords(str_replace(['.', '_', '-'], ' ', $fieldLabel)) : $fieldLabel;
                        $item = ['key' => $itemKey, 'label' => $itemLabel, 'group' => $groupName];
                        $flatVariables[] = $item;
                        $groupedVariables[$groupName][] = $item;
                    }
                }
            } elseif (is_string($groupValue)) {
                if (is_numeric($groupKey)) {
                    $itemKey = $groupValue;
                    $parts = explode('.', $itemKey);
                    $groupName = count($parts) > 1 ? ucfirst($parts[0]) : 'General';
                    $itemLabel = ucwords(str_replace(['.', '_', '-'], ' ', end($parts)));
                } else {
                    $itemKey = $groupKey;
                    $parts = explode('.', $itemKey);
                    $groupName = count($parts) > 1 ? ucfirst($parts[0]) : 'General';
                    $itemLabel = $groupValue;
                }
                $item = ['key' => $itemKey, 'label' => $itemLabel, 'group' => $groupName];
                $flatVariables[] = $item;
                $groupedVariables[$groupName][] = $item;
            }
        }
    }

    $config = [
        'id' => $id,
        'name' => $name,
        'value' => $resolvedValue,
        'placeholder' => $placeholder,
        'preset' => $preset,
        'height' => $height,
        'minHeight' => $minHeight,
        'maxHeight' => $maxHeight,
        'autoresize' => (bool) $autoresize,
        'menubar' => $menubar,
        'toolbar' => $toolbar,
        'toolbarMode' => $toolbarMode,
        'toolbarSticky' => (bool) $toolbarSticky,
        'toolbarStickyOffset' => (int) $toolbarStickyOffset,
        'plugins' => $plugins,
        'statusbar' => (bool) $statusbar,
        'readonly' => (bool) $readonly,
        'disabled' => (bool) $disabled,
        'variables' => $flatVariables,
        'groupedVariables' => $groupedVariables,
        'variableStyle' => $variableStyle,
        'variablePrefix' => $variablePrefix,
        'variableSuffix' => $variableSuffix,
        'variableButtonLabel' => $variableButtonLabel ?? 'Variabel',
        'uploadUrl' => $uploadUrl,
        'uploadParam' => $uploadParam,
        'uploadDisk' => $uploadDisk,
        'uploadFolder' => $uploadFolder,
        'baseUrl' => $baseUrl,
        'wireModelName' => $wireModel,
        'isWireLive' => $isWireLive,
    ];
@endphp

@pushOnce('head', 'vibe-editor-styles')
    @vite(['resources/css/vibe/editor.css'])
@endPushOnce

@pushOnce('head', 'vibe-editor-scripts')
    @vite(['resources/js/vibe/editor.js'])
@endPushOnce

<div {{ $attributes->only('class')->twMerge(['class' => trim("w-full space-y-1.5 {$wrapperClass}")]) }}
     x-data="typeof window.vibeEditor === 'function' ? window.vibeEditor(@js($config)) : {
         id: @js($id),
         isMounted: false,
         isFocused: false,
         value: @js($resolvedValue),
         destroy() {
             if (window.tinymce) {
                 try { window.tinymce.remove('#' + this.id); } catch (e) {}
             }
         },
         init() {
             var self = this;
             var bindEditor = function() {
                 if (typeof window.vibeEditor === 'function') {
                     clearInterval(timer);
                     if (window.Alpine && typeof window.Alpine.initTree === 'function' && self.$el) {
                         var el = self.$el;
                         if (typeof window.Alpine.destroyTree === 'function') {
                             try { window.Alpine.destroyTree(el); } catch (e) {}
                         }
                         delete el._x_dataStack;
                         window.Alpine.initTree(el);
                     }
                 }
             };
             window.addEventListener('vibe-editor-ready', bindEditor, { once: true });
             var timer = setInterval(bindEditor, 25);
             setTimeout(function() { clearInterval(timer); }, 3000);
         }
     }">

    {{-- Top Label & Description --}}
    @if ($label || $description)
        <div class="space-y-0.5">
            @if ($label)
                <label for="{{ $id }}" class="block text-sm font-medium text-foreground">
                    {{ $label }}
                    @if ($required)
                        <span class="text-destructive font-semibold ml-0.5">*</span>
                    @endif
                </label>
            @endif

            @if ($description)
                <p id="{{ $id }}-description" class="text-xs text-muted-foreground">
                    {{ $description }}
                </p>
            @endif
        </div>
    @endif

    {{-- Editor Wrapper Container --}}
    <div 
        class="vibe-editor-wrapper"
        data-vibe-editor="{{ $name }}"
        :class="{
            'is-focused': isFocused,
            'has-error': {{ $hasError ? 'true' : 'false' }},
            'is-disabled': {{ $disabled ? 'true' : 'false' }}
        }"
    >
        {{-- Skeleton Loader before TinyMCE mounts --}}
        <div x-show="!isMounted" class="vibe-editor-skeleton" style="min-height: {{ is_numeric($height) ? $height . 'px' : $height }};">
            <div class="vibe-editor-skeleton-toolbar">
                <div class="vibe-editor-skeleton-btn"></div>
                <div class="vibe-editor-skeleton-btn"></div>
                <div class="vibe-editor-skeleton-divider"></div>
                <div class="vibe-editor-skeleton-btn vibe-editor-skeleton-btn-wide"></div>
                <div class="vibe-editor-skeleton-divider"></div>
                <div class="vibe-editor-skeleton-btn"></div>
                <div class="vibe-editor-skeleton-btn"></div>
                <div class="vibe-editor-skeleton-btn"></div>
            </div>
            <div class="vibe-editor-skeleton-body">
                <div class="vibe-editor-skeleton-line w-3/4"></div>
                <div class="vibe-editor-skeleton-line w-full"></div>
                <div class="vibe-editor-skeleton-line w-5/6"></div>
                <div class="vibe-editor-skeleton-line w-2/3"></div>
            </div>
        </div>

        {{-- Hidden Textarea as Mount Target and Native Form Synchronizer --}}
        <textarea
            x-ref="textarea"
            id="{{ $id }}"
            name="{{ $name }}"
            @if ($required) required @endif
            @if ($disabled) disabled @endif
            @if ($readonly) readonly @endif
            aria-invalid="{{ $hasError ? 'true' : 'false' }}"
            @if ($hasError && $errorMessage) aria-describedby="{{ $id }}-error" @elseif ($description) aria-describedby="{{ $id }}-description" @endif
            class="sr-only"
        >{{ $resolvedValue }}</textarea>
    </div>

    {{-- Error Message --}}
    @if ($hasError && $errorMessage)
        <p role="alert" id="{{ $id }}-error" class="text-xs font-medium text-destructive flex items-center gap-1 mt-1">
            <svg class="size-3.5 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10" />
                <path d="M12 8v5M12 16h.01" />
            </svg>
            <span>{{ $errorMessage }}</span>
        </p>
    @endif

    {{-- Info Helper Text --}}
    @if ($info)
        <p id="{{ $id }}-info" class="text-xs text-muted-foreground mt-1">
            {{ $info }}
        </p>
    @endif
</div>
