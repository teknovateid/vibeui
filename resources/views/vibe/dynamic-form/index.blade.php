@blaze

@props([
    'id' => null,
    'name' => 'items',
    'label' => null,
    'description' => null,
    'min' => 1,
    'max' => null,
    'default' => 1,
    'value' => null,
    'variant' => 'card', // card, bordered, table, ghost
    'allowReorder' => true,
    'allowDuplicate' => true,
    'collapsible' => true,
    'confirmDelete' => false,
    'confirmDeleteMessage' => null,
    'addText' => null,
    'addButtonVariant' => 'outline',
    'addButtonSize' => 'sm',
    'emptyTitle' => null,
    'emptyDescription' => null,
    'schema' => null,
    'wrapperClass' => null,
    'locale' => null,
])

@php
    $resolvedLocale = $locale ?? (app()->getLocale() === 'en' ? 'en' : 'id');
    $rawTranslations = trans('vibe/dynamic-form', [], $resolvedLocale);
    if (!is_array($rawTranslations)) {
        $rawTranslations = trans('vibe::vibe/dynamic-form', [], $resolvedLocale);
    }
    $i18n = is_array($rawTranslations) ? $rawTranslations : [];

    $dfId = $id ?? 'vibe-df-' . uniqid();
    $addText = $addText ?? ($i18n['add_row'] ?? __('vibe/dynamic-form.add_row', [], $resolvedLocale));
    $confirmDeleteMessage = $confirmDeleteMessage ?? ($i18n['delete_confirm'] ?? ($i18n['delete_row'] ?? __('vibe/dynamic-form.delete_row', [], $resolvedLocale)) . '?');

    // Resolve initial items from old() input, $value, or defaults
    $resolvedItems = old($name, $value);
    if (!is_array($resolvedItems) && !($resolvedItems instanceof \Illuminate\Support\Collection)) {
        $resolvedItems = null;
    }

    $initialCount = $resolvedItems ? count($resolvedItems) : (int) $default;
    if ($min !== null && $initialCount < (int) $min) {
        $initialCount = (int) $min;
    }
    if ($max !== null && $initialCount > (int) $max) {
        $initialCount = (int) $max;
    }

    $hasCustomTemplate = isset($template);
    $hasSlotContent = $slot->isNotEmpty() && trim($slot) !== '';
    $isSchemaMode = !empty($schema) && is_array($schema);
@endphp

@pushOnce('head', 'vibe-dynamic-form')
    @vite(['resources/js/vibe/dynamic-form.js'])
@endPushOnce

<div id="{{ $dfId }}" {{ $attributes->twMerge(['class' => trim("w-full space-y-3.5 {$wrapperClass}")]) }} x-data="typeof window.vibeDynamicForm === 'function' ? window.vibeDynamicForm({
    id: '{{ $dfId }}',
    name: '{{ $name }}',
    min: {{ $min !== null ? (int) $min : 'null' }},
    max: {{ $max !== null ? (int) $max : 'null' }},
    default: {{ (int) $default }},
    variant: '{{ $variant }}',
    locale: '{{ $resolvedLocale }}',
    i18n: @js($i18n),
    allowReorder: {{ $allowReorder ? 'true' : 'false' }},
    allowDuplicate: {{ $allowDuplicate ? 'true' : 'false' }},
    collapsible: {{ $collapsible ? 'true' : 'false' }},
    confirmDelete: {{ $confirmDelete ? 'true' : 'false' }},
    confirmDeleteMessage: '{{ addslashes($confirmDeleteMessage) }}'
}) : {
    itemCount: {{ $initialCount }},
    canAdd: true,
    canRemove: true,
    isEmpty: false,
    addItem() {},
    removeItem() {},
    duplicateItem() {},
    moveUp() {},
    moveDown() {},
    toggleCollapse() {},
    startDrag() {},
    onDragOver() {},
    onDragLeave() {},
    onDrop() {},
    endDrag() {}
}">
    {{-- Header Section (Label, Description, Count Badge) --}}
    @if ($label || $description)
        <div class="flex items-start justify-between gap-4 pb-1">
            <div class="space-y-0.5">
                @if ($label)
                    <div class="flex items-center gap-2">
                        <label class="block text-xs font-semibold text-foreground select-none">
                            {{ $label }}
                            @if ($attributes->has('required') && $attributes->get('required') !== false)
                                <span class="text-destructive font-bold ml-0.5" aria-hidden="true">*</span>
                            @endif
                        </label>

                        @if ($max !== null)
                            <span class="text-[10px] font-mono text-muted-foreground px-1.5 py-0.5 rounded bg-muted">
                                max: {{ $max }}
                            </span>
                        @endif
                    </div>
                @endif

                @if ($description)
                    <p class="text-xs text-muted-foreground">{{ $description }}</p>
                @endif
            </div>

            {{-- Counter Pill --}}
            <span x-show="itemCount > 0" class="text-[11px] font-mono font-medium text-muted-foreground bg-muted/60 px-2 py-0.5 rounded-full shrink-0 select-none">
                <span x-text="itemCount"></span>
                @if ($max !== null)
                    <span class="text-muted-foreground/60">/{{ $max }}</span>
                @endif
                <span>{{ $i18n['items'] ?? 'item' }}</span>
            </span>
        </div>
    @endif

    {{-- Empty State (displayed when itemCount == 0) --}}
    <vibe:dynamic-form.empty :title="$emptyTitle" :description="$emptyDescription" :locale="$resolvedLocale" />

    {{-- Items Container --}}
    <div x-ref="container" data-dynamic-form-container class="w-full space-y-3">
        @if ($isSchemaMode)
            {{-- Mode Skema: Auto-generate dari konfigurasi $schema --}}
            @for ($i = 0; $i < $initialCount; $i++)
                @php
                    $rowVal = $resolvedItems[$i] ?? [];
                @endphp
                <vibe:dynamic-form.item :index="$i" :variant="$variant" :allow-reorder="$allowReorder" :allow-duplicate="$allowDuplicate" :collapsible="$collapsible" :locale="$resolvedLocale">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach ($schema as $field)
                            @php
                                $fType = $field['type'] ?? 'input';
                                $fName = $field['name'] ?? 'field';
                                $fLabel = $field['label'] ?? ucfirst($fName);
                                $fReq = !empty($field['required']);
                                $fSpan = isset($field['colSpan']) ? 'md:col-span-' . $field['colSpan'] : '';
                                $fVal = $rowVal[$fName] ?? ($field['default'] ?? null);
                            @endphp

                            <div class="{{ $fSpan }}">
                                @if ($fType === 'select')
                                    <vibe:select :name="$name.
                                    '['.$i.
                                    ']['.$fName.
                                    ']'" :label="$fLabel" :value="$fVal" :options="$field['options'] ?? []" :required="$fReq" :placeholder="$field['placeholder'] ?? null" />
                                @elseif ($fType === 'date-time')
                                    <vibe:date-time :name="$name.
                                    '['.$i.
                                    ']['.$fName.
                                    ']'" :label="$fLabel" :value="$fVal" :required="$fReq" :mode="$field['mode'] ?? 'single'" :placeholder="$field['placeholder'] ?? null" />
                                @elseif ($fType === 'textarea')
                                    <vibe:textarea :name="$name.
                                    '['.$i.
                                    ']['.$fName.
                                    ']'" :label="$fLabel" :required="$fReq" :rows="$field['rows'] ?? 3" :placeholder="$field['placeholder'] ?? null">{{ $fVal }}</vibe:textarea>
                                @else
                                    <vibe:input :type="$field['inputType'] ?? 'text'" :name="$name.
                                    '['.$i.
                                    ']['.$fName.
                                    ']'" :label="$fLabel" :value="$fVal" :required="$fReq" :placeholder="$field['placeholder'] ?? null" />
                                @endif
                            </div>
                        @endforeach
                    </div>
                </vibe:dynamic-form.item>
            @endfor
        @elseif ($hasCustomTemplate)
            {{-- Mode Template Terpisah (misal jika user me-loop dengan @foreach di dalam $slot) --}}
            {{ $slot }}
        @elseif ($hasSlotContent)
            {{-- Mode Slot Tunggal: Evaluasi awal untuk baris pertama atau baris terisi --}}
            @if ($resolvedItems && count($resolvedItems) > 0)
                @foreach ($resolvedItems as $idx => $rowItem)
                    {{-- Render baris untuk data existing --}}
                    @if (str_contains($slot, 'data-dynamic-form-item'))
                        {!! str_replace('__INDEX__', $idx, $slot) !!}
                    @else
                        <vibe:dynamic-form.item :index="$idx" :variant="$variant" :allow-reorder="$allowReorder" :allow-duplicate="$allowDuplicate" :collapsible="$collapsible" :locale="$resolvedLocale">
                            {!! str_replace('__INDEX__', $idx, $slot) !!}
                        </vibe:dynamic-form.item>
                    @endif
                @endforeach
            @else
                {{-- Render default rows --}}
                @for ($idx = 0; $idx < $initialCount; $idx++)
                    @if (str_contains($slot, 'data-dynamic-form-item'))
                        {!! str_replace('__INDEX__', $idx, $slot) !!}
                    @else
                        <vibe:dynamic-form.item :index="$idx" :variant="$variant" :allow-reorder="$allowReorder" :allow-duplicate="$allowDuplicate" :collapsible="$collapsible" :locale="$resolvedLocale">
                            {!! str_replace('__INDEX__', $idx, $slot) !!}
                        </vibe:dynamic-form.item>
                    @endif
                @endfor
            @endif
        @endif
    </div>

    {{-- Prototype Blueprint Template for JavaScript Cloning --}}
    <template x-ref="template" data-dynamic-form-template>
        @if ($hasCustomTemplate)
            {{ $template }}
        @elseif ($isSchemaMode)
            <vibe:dynamic-form.item index="__INDEX__" :variant="$variant" :allow-reorder="$allowReorder" :allow-duplicate="$allowDuplicate" :collapsible="$collapsible" :locale="$resolvedLocale">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach ($schema as $field)
                        @php
                            $fType = $field['type'] ?? 'input';
                            $fName = $field['name'] ?? 'field';
                            $fLabel = $field['label'] ?? ucfirst($fName);
                            $fReq = !empty($field['required']);
                            $fSpan = isset($field['colSpan']) ? 'md:col-span-' . $field['colSpan'] : '';
                        @endphp

                        <div class="{{ $fSpan }}">
                            @if ($fType === 'select')
                                <vibe:select :name="$name.
                                '[__INDEX__]['.$fName.
                                ']'" :label="$fLabel" :options="$field['options'] ?? []" :required="$fReq" :placeholder="$field['placeholder'] ?? null" />
                            @elseif ($fType === 'date-time')
                                <vibe:date-time :name="$name.
                                '[__INDEX__]['.$fName.
                                ']'" :label="$fLabel" :required="$fReq" :mode="$field['mode'] ?? 'single'" :placeholder="$field['placeholder'] ?? null" />
                            @elseif ($fType === 'textarea')
                                <vibe:textarea :name="$name.
                                '[__INDEX__]['.$fName.
                                ']'" :label="$fLabel" :required="$fReq" :rows="$field['rows'] ?? 3" :placeholder="$field['placeholder'] ?? null" />
                            @else
                                <vibe:input :type="$field['inputType'] ?? 'text'" :name="$name.
                                '[__INDEX__]['.$fName.
                                ']'" :label="$fLabel" :required="$fReq" :placeholder="$field['placeholder'] ?? null" />
                            @endif
                        </div>
                    @endforeach
                </div>
            </vibe:dynamic-form.item>
        @elseif ($hasSlotContent)
            @if (str_contains($slot, 'data-dynamic-form-item'))
                {!! $slot !!}
            @else
                <vibe:dynamic-form.item index="__INDEX__" :variant="$variant" :allow-reorder="$allowReorder" :allow-duplicate="$allowDuplicate" :collapsible="$collapsible" :locale="$resolvedLocale">
                    {!! $slot !!}
                </vibe:dynamic-form.item>
            @endif
        @endif
    </template>

    {{-- Bottom Action Toolbar --}}
    <div class="pt-1 flex items-center justify-between gap-3">
        <vibe:button type="button" :variant="$addButtonVariant" :size="$addButtonSize" @click="addItem()" x-bind:disabled="!canAdd" x-bind:class="{ 'opacity-50 pointer-events-none': !canAdd }">
            <svg class="size-3.5 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M5 12h14" />
                <path d="M12 5v14" />
            </svg>
            <span>{{ $addText }}</span>
        </vibe:button>

        @if ($max !== null)
            <p x-show="!canAdd" x-cloak class="text-xs text-muted-foreground">
                {{ str_replace(':max', $max, $i18n['max_reached'] ?? trans('vibe/dynamic-form.max_reached', ['max' => $max], $resolvedLocale)) }}
            </p>
        @endif
    </div>
</div>
