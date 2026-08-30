<vibe:nav {{ $attributes->twMerge(['class' => 'gap-2']) }} pinnable maxpin="5">
    <vibe:nav.pinned title="PINNED" persist />

    <div class="h-px bg-border"></div>

    <vibe:nav.label title="GET STARTED" persist>
        <!-- Docs -->
        <vibe:nav.item href="{{ route('docs.index') }}" :active="request()->routeIs('docs.index')">
            <x-slot:icon>
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="3" y1="9" x2="21" y2="9"></line>
                    <line x1="9" y1="21" x2="9" y2="9"></line>
                </svg>
            </x-slot:icon>
            Docs
        </vibe:nav.item>

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



    <vibe:nav.label title="COMPONENTS" persist>
        <!-- Input Group -->
        <vibe:nav.group title="Input" :active="request()->routeIs('docs.input.*')">
            <x-slot:icon>
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path>
                </svg>
            </x-slot:icon>

            <vibe:nav.item href="{{ route('docs.input.index') }}" :active="request()->routeIs('docs.input.index')">
                List Input
            </vibe:nav.item>
            <vibe:nav.item href="{{ route('docs.input.create') }}" :active="request()->routeIs('docs.input.create')">
                Create Input
            </vibe:nav.item>
        </vibe:nav.group>
    </vibe:nav.label>
</vibe:nav>
