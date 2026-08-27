<vibe:nav {{ $attributes->twMerge(['class' => 'gap-1']) }} pinnable maxpin="5">
    <vibe:nav.label title="PINNED" pinned-container persist class="border-b border-vibe-200 dark:border-vibe-800" />
    <!-- Docs -->
    {{-- <vibe:nav.item href="{{ route('docs.index') }}" :active="request()->routeIs('docs.index')">
        <x-slot:icon>
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                <line x1="3" y1="9" x2="21" y2="9"></line>
                <line x1="9" y1="21" x2="9" y2="9"></line>
            </svg>
        </x-slot:icon>
        Docs
    </vibe:nav.item> --}}

    <vibe:nav.label title="GET STARTED" persist class="border-b border-vibe-200 dark:border-vibe-800">
        <!-- Instalation -->
        <vibe:nav.item href="{{ route('docs.instalation.index') }}" :active="request()->routeIs('docs.instalation.*')">
            <x-slot:icon>
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="3" y1="9" x2="21" y2="9"></line>
                    <line x1="9" y1="21" x2="9" y2="9"></line>
                </svg>
            </x-slot:icon>
            Instalation
        </vibe:nav.item>
    </vibe:nav.label>
</vibe:nav>
