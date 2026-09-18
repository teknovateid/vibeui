<x-docs.layouts.sidebar>
    <vibe:seo :title="__('vibe/settings.title')" :description="__('vibe/settings.subtitle')" :breadcrumbs="[
        ['name' => __('vibe/settings.breadcrumb.home'), 'url' => '/'],
        ['name' => __('vibe/settings.breadcrumb.pages'), 'url' => '#'],
        ['name' => __('vibe/settings.breadcrumb.settings'), 'url' => route('docs.settings.account')],
    ]" />

    <div class="mx-auto w-full space-y-6">
        <vibe:breadcrumb title="{!! __('vibe/settings.title') !!}">
            <vibe:breadcrumb.item href="{{ route('docs.index') }}">{{ __('vibe/settings.breadcrumb.home') }}</vibe:breadcrumb.item>
            <vibe:breadcrumb.item>{{ __('vibe/settings.breadcrumb.pages') }}</vibe:breadcrumb.item>
            <vibe:breadcrumb.item active>{{ __('vibe/settings.breadcrumb.settings') }}</vibe:breadcrumb.item>
        </vibe:breadcrumb>

        <vibe:card class="p-0 overflow-hidden">
            <vibe:tabs selected="account" variant="sidebar" class="min-h-155">
                @include('docs.settings.tabs', ['active' => 'account'])

                <div class="flex-1 min-w-0 p-6 space-y-6">
                    {{-- Header --}}
                    <div class="border-b border-border/50 pb-4">
                        <h2 class="text-lg font-bold text-foreground">{{ __('vibe/settings.profile.header_title') }}</h2>
                        <p class="text-xs text-muted-foreground mt-0.5">
                            {{ __('vibe/settings.profile.header_desc') }}
                        </p>
                    </div>

                    <livewire:settings.profile />
                </div>
            </vibe:tabs>
        </vibe:card>
    </div>
</x-docs.layouts.sidebar>
