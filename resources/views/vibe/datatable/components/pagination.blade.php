@aware(['isTailwind', 'isBootstrap', 'isBootstrap4', 'isBootstrap5', 'localisationPath'])
@props(['currentRows'])

@includeWhen(
    $this->hasConfigurableAreaFor('before-pagination'), 
    $this->getConfigurableAreaFor('before-pagination'), 
    $this->getParametersForConfigurableArea('before-pagination')
)

<div {{ $this->getPaginationWrapperAttributesBag() }}>
    @if ($this->paginationVisibilityIsEnabled())
        <div class="mt-4 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="text-xs text-muted-foreground order-2 sm:order-1">
                @if ($this->paginationIsEnabled && $this->isPaginationMethod('standard') && $currentRows->lastPage() > 1 && $this->showPaginationDetails)
                    <p class="paged-pagination-results">
                        <span>{{ __($localisationPath.'Showing') }}</span>
                        <span class="font-semibold text-foreground">{{ $currentRows->firstItem() }}</span>
                        <span>{{ __($localisationPath.'to') }}</span>
                        <span class="font-semibold text-foreground">{{ $currentRows->lastItem() }}</span>
                        <span>{{ __($localisationPath.'of') }}</span>
                        <span class="font-semibold text-foreground"><span x-text="paginationTotalItemCount"></span></span>
                        <span>{{ __($localisationPath.'results') }}</span>
                    </p>
                @elseif ($this->paginationIsEnabled && $this->isPaginationMethod('simple') && $this->showPaginationDetails)
                    <p class="paged-pagination-results">
                        <span>{{ __($localisationPath.'Showing') }}</span>
                        <span class="font-semibold text-foreground">{{ $currentRows->firstItem() }}</span>
                        <span>{{ __($localisationPath.'to') }}</span>
                        <span class="font-semibold text-foreground">{{ $currentRows->lastItem() }}</span>
                    </p>
                @else
                    @if($this->showPaginationDetails)
                        <p class="total-pagination-results">
                            <span>{{ __($localisationPath.'Showing') }}</span>
                            <span class="font-semibold text-foreground">{{ $currentRows->count() }}</span>
                            <span>{{ __($localisationPath.'results') }}</span>
                        </p>
                    @endif
                @endif
            </div>

            @if ($this->paginationIsEnabled)
                <div class="order-1 sm:order-2">
                    {{ $currentRows->links('livewire-tables::specific.tailwind.'.(!$this->isPaginationMethod('standard') ? 'simple-' : '').'pagination') }}
                </div>
            @endif
        </div>
    @endif
</div>

@includeWhen(
    $this->hasConfigurableAreaFor('after-pagination'), 
    $this->getConfigurableAreaFor('after-pagination'), 
    $this->getParametersForConfigurableArea('after-pagination')
)
