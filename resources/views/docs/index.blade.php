<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/index.title')" :description="__('docs/index.description')" schema="techarticle" :breadcrumbs="[
        ['name' => __('docs/index.breadcrumbs.home'), 'url' => '/'],
        ['name' => __('docs/index.breadcrumbs.docs'), 'url' => '/docs']
    ]" />



    <div class="mx-auto w-full max-w-7xl">
        <div class="mb-6 flex justify-end rounded-full">
            <vibe:button @click="$vibe.modal('test-modal').show()">
                {{ __('docs/index.demo.open_modal_btn') }}
            </vibe:button>
        </div>

        <div class="gap-6 grid grid-cols-1 md:grid-cols-3">
            <vibe:card>
                <h3 class="font-medium text-muted-foreground text-sm">{{ __('docs/index.demo.stats.total_users') }}</h3>
                <p class="mt-2 font-bold text-3xl text-foreground">1,204</p>
            </vibe:card>
            <vibe:card>
                <h3 class="font-medium text-muted-foreground text-sm">{{ __('docs/index.demo.stats.revenue') }}</h3>
                <p class="mt-2 font-bold text-3xl text-foreground">{{ __('docs/index.demo.stats.revenue_val') }}</p>
            </vibe:card>
            <vibe:card>
                <h3 class="font-medium text-muted-foreground text-sm">{{ __('docs/index.demo.stats.server_status') }}</h3>
                <p class="mt-2 font-bold text-3xl text-foreground">{{ __('docs/index.demo.stats.online') }}</p>
            </vibe:card>
        </div>

        <vibe:modal id="test-modal">
            <vibe:modal.header>
                <span>{{ __('docs/index.demo.modal.title') }}</span>
            </vibe:modal.header>
            <vibe:modal.content>
                <p class="text-muted-foreground">
                    {{ __('docs/index.demo.modal.content') }}
                </p>
            </vibe:modal.content>
            <vibe:modal.footer>
                <vibe:button variant="ghost" @click="close">{{ __('docs/index.demo.modal.cancel_btn') }}</vibe:button>
                <vibe:button variant="primary" @click="$vibe.modal('test-modal').close()">{{ __('docs/index.demo.modal.save_btn') }}</vibe:button>
            </vibe:modal.footer>
        </vibe:modal>
    </div>
</x-docs.layouts.sidebar>
