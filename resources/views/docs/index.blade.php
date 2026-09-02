<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/index.title')" :description="__('docs/index.description')" schema="techarticle" :breadcrumbs="[
        ['name' => __('docs/index.breadcrumbs.home'), 'url' => '/'],
        ['name' => __('docs/index.breadcrumbs.docs'), 'url' => '/docs']
    ]" />
    <div>
        <div class="mb-6 flex justify-end rounded-full">
            <vibe:button @click="$dispatch('open-modal', 'test-modal')">
                {{ __('docs/index.demo.open_modal_btn') }}
            </vibe:button>
        </div>

        <div class="gap-6 grid grid-cols-1 md:grid-cols-3">
            <vibe:card>
                <h3 class="font-medium text-gray-700 dark:text-gray-300 text-sm">{{ __('docs/index.demo.stats.total_users') }}</h3>
                <p class="mt-2 font-bold text-3xl">1,204</p>
            </vibe:card>
            <vibe:card>
                <h3 class="font-medium text-gray-700 dark:text-gray-300 text-sm">{{ __('docs/index.demo.stats.revenue') }}</h3>
                <p class="mt-2 font-bold text-3xl">{{ __('docs/index.demo.stats.revenue_val') }}</p>
            </vibe:card>
            <vibe:card>
                <h3 class="font-medium text-gray-700 dark:text-gray-300 text-sm">{{ __('docs/index.demo.stats.server_status') }}</h3>
                <p class="mt-2 font-bold text-3xl">{{ __('docs/index.demo.stats.online') }}</p>
            </vibe:card>
        </div>

        <vibe:modal id="test-modal">
            <h2 class="text-xl mb-4">{{ __('docs/index.demo.modal.title') }}</h2>
            <p class="text-gray-600 dark:text-gray-400 mb-6">
                {{ __('docs/index.demo.modal.content') }}
            </p>

            <div class="flex justify-end gap-3 mt-6">
                <vibe:button variant="ghost" @click="close">{{ __('docs/index.demo.modal.cancel_btn') }}</vibe:button>
                <vibe:button variant="primary" @click="$dispatch('close-modal', 'test-modal')">{{ __('docs/index.demo.modal.save_btn') }}</vibe:button>
            </div>
        </vibe:modal>
    </div>
</x-docs.layouts.sidebar>
