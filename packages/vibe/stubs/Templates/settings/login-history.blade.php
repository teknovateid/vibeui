<x-[path].layouts.[style]>
    <vibe:seo :title="__('vibe/settings.title')" :description="__('vibe/settings.subtitle')" :breadcrumbs="[
        ['name' => __('vibe/settings.breadcrumb.home'), 'url' => '/'],
        ['name' => __('vibe/settings.breadcrumb.pages'), 'url' => '#'],
        ['name' => __('vibe/settings.breadcrumb.settings'), 'url' => route('[path].settings.account')],
        ['name' => __('vibe/settings.login_history.breadcrumb'), 'url' => route('[path].settings.login-history')],
    ]" />

    <div class="mx-auto w-full space-y-6">
        <vibe:breadcrumb title="{!! __('vibe/settings.title') !!}">
            <vibe:breadcrumb.item href="{{ route('[path].index') }}">{{ __('vibe/settings.breadcrumb.home') }}</vibe:breadcrumb.item>
            <vibe:breadcrumb.item>{{ __('vibe/settings.breadcrumb.pages') }}</vibe:breadcrumb.item>
            <vibe:breadcrumb.item href="{{ route('[path].settings.account') }}">{{ __('vibe/settings.breadcrumb.settings') }}</vibe:breadcrumb.item>
            <vibe:breadcrumb.item active>{{ __('vibe/settings.login_history.breadcrumb') }}</vibe:breadcrumb.item>
        </vibe:breadcrumb>

        <vibe:card class="p-0 overflow-hidden">
            <vibe:tabs selected="login-history" variant="sidebar" class="min-h-155">
                @include('[path].settings.tabs', ['active' => 'login-history'])

                <div class="flex-1 min-w-0 p-6 space-y-6">
                    {{-- Header --}}
                    <div class="border-b border-border/50 pb-4">
                        <h2 class="text-lg font-bold text-foreground">{{ __('vibe/settings.login_history.header_title') }}</h2>
                        <p class="text-xs text-muted-foreground mt-0.5">
                            {{ __('vibe/settings.login_history.header_desc') }}
                        </p>
                    </div>

                    <livewire:settings.login-history />
                </div>
            </vibe:tabs>
        </vibe:card>
    </div>
</x-[path].layouts.[style]>
