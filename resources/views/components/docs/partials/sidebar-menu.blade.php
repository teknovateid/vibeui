<vibe:nav id="sidebar-menu" {{ $attributes->twMerge(['class' => 'gap-2']) }} pinnable maxpin="5">
    <vibe:nav.pinned persist />

    <div class="h-px bg-border"></div>

    <vibe:nav.label :title="__('docs/sidebar.groups.get_started')" persist>
        <!-- Docs -->
        <vibe:nav.item href="{{ route('docs.index') }}" :active="request()->routeIs('docs.index')">
            <x-slot:icon>
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="3" y1="9" x2="21" y2="9"></line>
                    <line x1="9" y1="21" x2="9" y2="9"></line>
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.docs') }}
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
            {{ __('docs/sidebar.nav.instalation') }}
        </vibe:nav.item>

        <!-- Directories -->
        <vibe:nav.item href="{{ route('docs.directories.index') }}" :active="request()->routeIs('docs.directories.*')">
            <x-slot:icon>
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="3" y1="9" x2="21" y2="9"></line>
                    <line x1="9" y1="21" x2="9" y2="9"></line>
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.directories') }}
        </vibe:nav.item>
    </vibe:nav.label>



    <vibe:nav.label :title="__('docs/sidebar.groups.components')" persist>
        <!-- Input Group -->
        <vibe:nav.item href="{{ route('docs.input.index') }}" :active="request()->routeIs('docs.input.index')">
            <x-slot:icon>
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="6" width="18" height="12" rx="3"></rect>
                    <path d="M8 12h8"></path>
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.input') }}
        </vibe:nav.item>

        <!-- Select -->
        <vibe:nav.item href="{{ route('docs.select.index') }}" :active="request()->routeIs('docs.select.index')">
            <x-slot:icon>
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="18" height="18" x="3" y="3" rx="2"></rect>
                    <path d="m8 10 4 4 4-4"></path>
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.select') }}
        </vibe:nav.item>

        <!-- Button -->
        <vibe:nav.item href="{{ route('docs.button.index') }}" :active="request()->routeIs('docs.button.*')">
            <x-slot:icon>
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="6" width="18" height="12" rx="3"></rect>
                    <path d="M8 12h8"></path>
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.button') }}
        </vibe:nav.item>

        <!-- Table -->
        <vibe:nav.item href="{{ route('docs.table.index') }}" :active="request()->routeIs('docs.table.*')">
            <x-slot:icon>
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="18" height="18" x="3" y="3" rx="2" />
                    <path d="M3 9h18" />
                    <path d="M3 15h18" />
                    <path d="M12 3v18" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.table') }}
        </vibe:nav.item>

        <!-- DataTable -->
        <vibe:nav.item href="{{ route('docs.datatable.index') }}" :active="request()->routeIs('docs.datatable.*')">
            <x-slot:icon>
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="18" height="18" x="3" y="3" rx="2" />
                    <path d="M3 9h18" />
                    <path d="M9 21V9" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.datatable') }}
        </vibe:nav.item>

        <!-- Alert -->
        <vibe:nav.item href="{{ route('docs.alert.index') }}" :active="request()->routeIs('docs.alert.*')">
            <x-slot:icon>
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10" />
                    <line x1="12" y1="8" x2="12" y2="12" />
                    <line x1="12" y1="16" x2="12.01" y2="16" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.alert') }}
        </vibe:nav.item>


        <!-- Toast -->
        <vibe:nav.item href="{{ route('docs.toast.index') }}" :active="request()->routeIs('docs.toast.*')">
            <x-slot:icon>
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="3" y1="9" x2="21" y2="9"></line>
                    <line x1="9" y1="21" x2="9" y2="9"></line>
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.toast') }}
        </vibe:nav.item>
    </vibe:nav.label>




</vibe:nav>
