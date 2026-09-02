@aware(['tableName', 'isTailwind', 'isBootstrap', 'isBootstrap4', 'isBootstrap5', 'localisationPath'])

<div class="w-full md:w-auto">
    <select
        wire:model.live="perPage"
        id="{{ $tableName }}-perPage"
        {{ 
            $attributes->merge($this->getPerPageFieldAttributes())
            ->class([
                'h-9 rounded-lg border border-border bg-background px-2.5 py-1 text-xs font-medium text-foreground shadow-2xs focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring transition-colors cursor-pointer' => $this->getPerPageFieldAttributes()['default-styling'] ?? true,
            ])
            ->except(['default', 'default-styling', 'default-colors']) 
        }}
    >
        @foreach ($this->getPerPageAccepted() as $item)
            <option
                value="{{ $item }}"
                wire:key="{{ $tableName }}-per-page-{{ $item }}"
            >
                {{ $item === -1 ? __($localisationPath.'All') : $item }}
            </option>
        @endforeach
    </select>
</div>
