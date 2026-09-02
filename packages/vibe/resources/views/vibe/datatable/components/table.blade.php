@aware(['tableName', 'isTailwind', 'isBootstrap'])

@php
    $customAttributes = [
        'wrapper' => $this->getTableWrapperAttributes(),
        'table' => $this->getTableAttributes(),
        'thead' => $this->getTheadAttributes(),
        'tbody' => $this->getTbodyAttributes(),
    ];
@endphp

<div
    wire:key="{{ $tableName }}-twrap"
    {{ $attributes->merge($customAttributes['wrapper'])
        ->class([
            'w-full overflow-x-auto rounded-xl border border-border bg-card text-card-foreground shadow-2xs' => $customAttributes['wrapper']['default'] ?? true
        ])
        ->except(['default','default-styling','default-colors']) }}
>
    <table
        wire:key="{{ $tableName }}-table"
        {{ $attributes->merge($customAttributes['table'])
            ->class([
                'w-full text-left text-sm caption-bottom select-text border-collapse' => $customAttributes['table']['default'] ?? true
            ])
            ->except(['default','default-styling','default-colors']) }}
    >
        <thead
            wire:key="{{ $tableName }}-thead"
            {{ $attributes->merge($customAttributes['thead'])
                ->class([
                    'border-b border-border bg-muted/40 text-xs font-semibold uppercase tracking-wider text-muted-foreground' => $customAttributes['thead']['default'] ?? true
                ])
                ->except(['default','default-styling','default-colors']) }}
        >
            <tr>
                {{ $thead }}
            </tr>
        </thead>

        <tbody
            wire:key="{{ $tableName }}-tbody"
            id="{{ $tableName }}-tbody"
            {{ $attributes->merge($customAttributes['tbody'])
                ->class([
                    'divide-y divide-border text-sm' => $customAttributes['tbody']['default'] ?? true
                ])
                ->except(['default','default-styling','default-colors']) }}
        >
            {{ $slot }}
        </tbody>

        @isset($tfoot)
            <tfoot
                wire:key="{{ $tableName }}-tfoot"
                class="border-t border-border bg-muted/20 text-xs font-medium text-muted-foreground"
            >
                {{ $tfoot }}
            </tfoot>
        @endisset
    </table>
</div>
