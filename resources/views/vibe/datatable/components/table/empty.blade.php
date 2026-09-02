@aware(['isTailwind', 'isBootstrap'])

@php($attributes = $attributes->merge(['wire:key' => 'empty-message-'.$this->getId()]))

<tr {{ $attributes }}>
    <td colspan="{{ $this->getColspanCount() }}" class="py-12 px-4 text-center">
        <div class="flex flex-col items-center justify-center text-center">
            <div class="flex h-12 w-12 items-center justify-center rounded-full bg-muted/60 text-muted-foreground mb-3 shadow-2xs">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/>
                    <path d="m21 21-4.3-4.3"/>
                    <path d="m8 11 6 0"/>
                </svg>
            </div>
            <h3 class="text-sm font-semibold text-foreground">
                {{ $this->getEmptyMessage() ?: 'No records found' }}
            </h3>
            <p class="mt-1 text-xs text-muted-foreground max-w-sm">
                Try adjusting your search terms or filters to find what you are looking for.
            </p>
        </div>
    </td>
</tr>
