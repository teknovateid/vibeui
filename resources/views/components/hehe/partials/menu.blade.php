<vibe:nav {{ $attributes->twMerge(['class' => 'p-2 gap-1']) }}>
    <!-- Hehe -->
    <vibe:nav.item href="{{ route('hehe.index') }}" :active="request()->routeIs('hehe.index')">
        <x-slot:icon>
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                <line x1="3" y1="9" x2="21" y2="9"></line>
                <line x1="9" y1="21" x2="9" y2="9"></line>
            </svg>
        </x-slot:icon>
        Hehe
    </vibe:nav.item>


    <!-- User -->
    <vibe:nav.item href="{{ route('hehe.user.index') }}" :active="request()->routeIs('hehe.user.*')">
        <x-slot:icon>
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                <line x1="3" y1="9" x2="21" y2="9"></line>
                <line x1="9" y1="21" x2="9" y2="9"></line>
            </svg>
        </x-slot:icon>
        User
    </vibe:nav.item>

</vibe:nav>
