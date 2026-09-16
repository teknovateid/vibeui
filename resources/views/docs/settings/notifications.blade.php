<x-docs.layouts.sidebar>
    <vibe:seo :title="__('vibe/settings.title')" :description="__('vibe/settings.subtitle')" :breadcrumbs="[
        ['name' => __('vibe/settings.breadcrumb.home'), 'url' => '/'],
        ['name' => __('vibe/settings.breadcrumb.pages'), 'url' => '#'],
        ['name' => __('vibe/settings.breadcrumb.settings'), 'url' => route('docs.settings.account')],
        ['name' => __('vibe/settings.breadcrumb.notifications'), 'url' => route('docs.settings.notifications')],
    ]" />

    <div class="mx-auto w-full space-y-6">
        <vibe:breadcrumb title="{!! __('vibe/settings.title') !!}">
            <vibe:breadcrumb.item href="{{ route('docs.index') }}">{{ __('vibe/settings.breadcrumb.home') }}</vibe:breadcrumb.item>
            <vibe:breadcrumb.item>{{ __('vibe/settings.breadcrumb.pages') }}</vibe:breadcrumb.item>
            <vibe:breadcrumb.item href="{{ route('docs.settings.account') }}">{{ __('vibe/settings.breadcrumb.settings') }}</vibe:breadcrumb.item>
            <vibe:breadcrumb.item active>{{ __('vibe/settings.breadcrumb.notifications') }}</vibe:breadcrumb.item>
        </vibe:breadcrumb>

        <vibe:card class="p-0 overflow-hidden">
            <vibe:tabs selected="notifications" variant="sidebar" class="min-h-155">
                @include('docs.settings.tabs', ['active' => 'notifications'])

                <div class="flex-1 min-w-0 p-6 space-y-6">

                    {{-- Header --}}
                    <div class="border-b border-border/50 pb-4">
                        <h2 class="text-lg font-bold text-foreground">{{ __('vibe/settings.notifications.header_title') }}</h2>
                        <p class="text-xs text-muted-foreground mt-0.5">
                            {{ __('vibe/settings.notifications.header_desc') }}
                        </p>
                    </div>

                    {{-- Email Notifications --}}
                    <div class="space-y-2">
                        <h3 class="text-sm font-semibold text-foreground">{{ __('vibe/settings.notifications.email_section_title') }}</h3>
                        <div class="max-w-xl space-y-0 divide-y divide-border/40 border border-border/60 rounded-2xl overflow-hidden">
                            <div class="p-4">
                                <vibe:switch name="alert_security" :label="__('vibe/settings.notifications.security_alerts_label')" :description="__('vibe/settings.notifications.security_alerts_desc')" checked />
                            </div>
                            <div class="p-4">
                                <vibe:switch name="alert_orders" :label="__('vibe/settings.notifications.orders_label')" :description="__('vibe/settings.notifications.orders_desc')" checked />
                            </div>
                            <div class="p-4">
                                <vibe:switch name="alert_product" :label="__('vibe/settings.notifications.product_label')" :description="__('vibe/settings.notifications.product_desc')" />
                            </div>
                            <div class="p-4">
                                <vibe:switch name="alert_newsletter" :label="__('vibe/settings.notifications.newsletter_label')" :description="__('vibe/settings.notifications.newsletter_desc')" />
                            </div>
                        </div>
                    </div>

                    {{-- Push / In-App Notifications --}}
                    <div class="space-y-2 pt-2">
                        <h3 class="text-sm font-semibold text-foreground">{{ __('vibe/settings.notifications.inapp_section_title') }}</h3>
                        <div class="max-w-xl space-y-0 divide-y divide-border/40 border border-border/60 rounded-2xl overflow-hidden">
                            <div class="p-4">
                                <vibe:switch name="alert_sound" :label="__('vibe/settings.notifications.sound_label')" :description="__('vibe/settings.notifications.sound_desc')" checked />
                            </div>
                            <div class="p-4">
                                <vibe:switch name="alert_desktop" :label="__('vibe/settings.notifications.desktop_label')" :description="__('vibe/settings.notifications.desktop_desc')" />
                            </div>
                        </div>
                    </div>

                    {{-- Save Action --}}
                    <div class="pt-4 border-t border-border/50 flex items-center justify-end">
                        <vibe:button type="button" variant="primary" size="sm" class="cursor-pointer" @click="window.vibeToast ? vibeToast('{{ __('vibe/settings.notifications.saved_toast') }}', { type: 'success', title: '{{ __('vibe/settings.notifications.saved_title') }}' }) : null">
                            {{ __('vibe/settings.notifications.save_btn') }}
                        </vibe:button>
                    </div>

                </div>
            </vibe:tabs>
        </vibe:card>
    </div>
</x-docs.layouts.sidebar>
