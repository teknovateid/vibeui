<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/page/settings/index.title')" :description="__('docs/page/settings/index.subtitle')" :breadcrumbs="[
        ['name' => __('docs/page/settings/index.breadcrumb.home'), 'url' => '/'],
        ['name' => __('docs/page/settings/index.breadcrumb.pages'), 'url' => '#'],
        ['name' => __('docs/page/settings/index.breadcrumb.settings'), 'url' => route('docs.settings.account')],
        ['name' => __('docs/page/settings/index.tabs.notifications.label'), 'url' => route('docs.settings.notifications')],
    ]" />

    <div class="mx-auto w-full space-y-6">
        <vibe:breadcrumb title="{!! __('docs/page/settings/index.title') !!}">
            <vibe:breadcrumb.item href="{{ route('docs.index') }}">{{ __('docs/page/settings/index.breadcrumb.home') }}</vibe:breadcrumb.item>
            <vibe:breadcrumb.item>{{ __('docs/page/settings/index.breadcrumb.pages') }}</vibe:breadcrumb.item>
            <vibe:breadcrumb.item href="{{ route('docs.settings.account') }}">{{ __('docs/page/settings/index.breadcrumb.settings') }}</vibe:breadcrumb.item>
            <vibe:breadcrumb.item active>{{ __('docs/page/settings/index.tabs.notifications.label') }}</vibe:breadcrumb.item>
        </vibe:breadcrumb>

        <vibe:card class="p-0 overflow-hidden">
            <vibe:tabs selected="notifications" variant="sidebar" class="min-h-155">
                @include('docs.settings.tabs', ['active' => 'notifications'])

                <div class="flex-1 min-w-0 p-6 space-y-6">

                    {{-- Header --}}
                    <div class="border-b border-border/50 pb-4">
                        <h2 class="text-lg font-bold text-foreground">Preferensi Notifikasi</h2>
                        <p class="text-xs text-muted-foreground mt-0.5">
                            Atur notifikasi apa yang ingin Anda terima dan melalui kanal apa.
                        </p>
                    </div>

                    {{-- Email Notifications --}}
                    <div class="space-y-2">
                        <h3 class="text-sm font-semibold text-foreground">Notifikasi Email</h3>
                        <div class="max-w-xl space-y-0 divide-y divide-border/40 border border-border/60 rounded-2xl overflow-hidden">
                            <div class="p-4">
                                <vibe:switch name="alert_security" label="Peringatan Keamanan" description="Notifikasi login dari perangkat baru, perubahan kata sandi, dan aktivitas mencurigakan." checked />
                            </div>
                            <div class="p-4">
                                <vibe:switch name="alert_orders" label="Pembaruan Pesanan" description="Status pemrosesan, pengiriman, dan konfirmasi pesanan." checked />
                            </div>
                            <div class="p-4">
                                <vibe:switch name="alert_product" label="Pembaruan Produk" description="Fitur baru, rilis komponen, dan changelog Vibe UI." />
                            </div>
                            <div class="p-4">
                                <vibe:switch name="alert_newsletter" label="Newsletter Bulanan" description="Ringkasan bulanan tips, tutorial, dan update dari tim Teknovate." />
                            </div>
                        </div>
                    </div>

                    {{-- Push / In-App Notifications --}}
                    <div class="space-y-2 pt-2">
                        <h3 class="text-sm font-semibold text-foreground">Notifikasi In-App</h3>
                        <div class="max-w-xl space-y-0 divide-y divide-border/40 border border-border/60 rounded-2xl overflow-hidden">
                            <div class="p-4">
                                <vibe:switch name="alert_sound" label="Efek Suara Notifikasi" description="Mainkan suara saat notifikasi baru masuk di dalam aplikasi." checked />
                            </div>
                            <div class="p-4">
                                <vibe:switch name="alert_desktop" label="Notifikasi Desktop" description="Tampilkan notifikasi sistem operasi meski browser diminimalkan." />
                            </div>
                        </div>
                    </div>

                    {{-- Save Action --}}
                    <div class="pt-4 border-t border-border/50 flex items-center justify-end">
                        <vibe:button type="button" variant="primary" size="sm" class="cursor-pointer" @click="window.vibeToast ? vibeToast('Preferensi notifikasi disimpan.', { type: 'success', title: 'Tersimpan' }) : null">
                            Simpan Preferensi
                        </vibe:button>
                    </div>

                </div>
            </vibe:tabs>
        </vibe:card>
    </div>
</x-docs.layouts.sidebar>
