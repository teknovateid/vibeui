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

        <!-- Authentication -->
        <vibe:nav.group :title="__('docs/sidebar.nav.auth.group')" :active="request()->routeIs('docs.auth.*')" persist>
            <x-slot:icon>
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="18" height="11" x="3" y="11" rx="2" ry="2"/>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                </svg>
            </x-slot:icon>
            <vibe:nav.item href="{{ route('docs.auth.index') }}" :active="request()->routeIs('docs.auth.index')">
                {{ __('docs/sidebar.nav.auth.overview') }}
            </vibe:nav.item>
            <vibe:nav.item href="{{ route('docs.auth.installation') }}" :active="request()->routeIs('docs.auth.installation')">
                {{ __('docs/sidebar.nav.auth.installation') }}
            </vibe:nav.item>
            <vibe:nav.item href="{{ route('docs.auth.confirm') }}" :active="request()->routeIs('docs.auth.confirm')">
                {{ __('docs/sidebar.nav.auth.confirm') }}
            </vibe:nav.item>
            <vibe:nav.item href="{{ route('docs.auth.idle') }}" :active="request()->routeIs('docs.auth.idle')">
                {{ __('docs/sidebar.nav.auth.idle') }}
            </vibe:nav.item>
            <vibe:nav.item href="{{ route('docs.auth.two-factor') }}" :active="request()->routeIs('docs.auth.two-factor')">
                {{ __('docs/sidebar.nav.auth.two_factor') }}
            </vibe:nav.item>
            <vibe:nav.item href="{{ route('docs.auth.passkey') }}" :active="request()->routeIs('docs.auth.passkey')">
                {{ __('docs/sidebar.nav.auth.passkey') }}
            </vibe:nav.item>
        </vibe:nav.group>
    </vibe:nav.label>



    <vibe:nav.label :title="__('docs/sidebar.groups.components')" persist>
        <!-- Form -->
        <vibe:nav.item href="{{ route('docs.form.index') }}" :active="request()->routeIs('docs.form.*')">
            <x-slot:icon>
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="18" height="18" x="3" y="3" rx="2" />
                    <path d="M7 8h10" />
                    <path d="M7 12h10" />
                    <path d="M7 16h6" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.form') }}
        </vibe:nav.item>

        <!-- Input Group -->
        <vibe:nav.group :title="__('docs/sidebar.nav.input_group.group')" :active="request()->routeIs('docs.input.*')" persist>
            <x-slot:icon>
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="6" width="18" height="12" rx="3"></rect>
                    <path d="M8 12h8"></path>
                </svg>
            </x-slot:icon>
            <vibe:nav.item href="{{ route('docs.input.index') }}" :active="request()->routeIs('docs.input.index')">
                {{ __('docs/sidebar.nav.input_group.standard') }}
            </vibe:nav.item>
            <vibe:nav.item href="{{ route('docs.input.otp') }}" :active="request()->routeIs('docs.input.otp')">
                {{ __('docs/sidebar.nav.input_group.otp') }}
            </vibe:nav.item>
            <vibe:nav.item href="{{ route('docs.input.currency') }}" :active="request()->routeIs('docs.input.currency')">
                {{ __('docs/sidebar.nav.input_group.currency') }}
            </vibe:nav.item>
            <vibe:nav.item href="{{ route('docs.input.phone') }}" :active="request()->routeIs('docs.input.phone')">
                {{ __('docs/sidebar.nav.input_group.phone') }}
            </vibe:nav.item>
        </vibe:nav.group>

        <!-- Textarea -->
        <vibe:nav.item href="{{ route('docs.textarea.index') }}" :active="request()->routeIs('docs.textarea.index')">
            <x-slot:icon>
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.textarea') }}
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

        <!-- Checkbox -->
        <vibe:nav.item href="{{ route('docs.checkbox.index') }}" :active="request()->routeIs('docs.checkbox.index')">
            <x-slot:icon>
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="18" height="18" x="3" y="3" rx="2"></rect>
                    <path d="m9 12 2 2 4-4"></path>
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.checkbox') }}
        </vibe:nav.item>

        <!-- Radio -->
        <vibe:nav.item href="{{ route('docs.radio.index') }}" :active="request()->routeIs('docs.radio.index')">
            <x-slot:icon>
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="9"></circle>
                    <circle cx="12" cy="12" r="3"></circle>
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.radio') }}
        </vibe:nav.item>

        <!-- Switch -->
        <vibe:nav.item href="{{ route('docs.switch.index') }}" :active="request()->routeIs('docs.switch.index')">
            <x-slot:icon>
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="20" height="12" x="2" y="6" rx="6" ry="6"></rect>
                    <circle cx="16" cy="12" r="2"></circle>
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.switch') }}
        </vibe:nav.item>

        <!-- Range Slider -->
        <vibe:nav.item href="{{ route('docs.range.index') }}" :active="request()->routeIs('docs.range.index')">
            <x-slot:icon>
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="4" x2="20" y1="12" y2="12"></line>
                    <circle cx="14" cy="12" r="3"></circle>
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.range') }}
        </vibe:nav.item>

        <!-- Date & Time -->
        <vibe:nav.item href="{{ route('docs.date-time.index') }}" :active="request()->routeIs('docs.date-time.*')">
            <x-slot:icon>
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M8 2v4" />
                    <path d="M16 2v4" />
                    <rect width="18" height="18" x="3" y="4" rx="2" />
                    <path d="M3 10h18" />
                    <path d="M12 14v3l2 1" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.date-time') }}
        </vibe:nav.item>

        <!-- Dynamic Form -->
        <vibe:nav.item href="{{ route('docs.dynamic-form.index') }}" :active="request()->routeIs('docs.dynamic-form.*')">
            <x-slot:icon>
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V8Z" />
                    <path d="M15 3v5h5" />
                    <path d="M12 12v6" />
                    <path d="M9 15h6" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.dynamic-form') }}
        </vibe:nav.item>

        <!-- FilePond -->
        <vibe:nav.item href="{{ route('docs.filepond.index') }}" :active="request()->routeIs('docs.filepond.*')">
            <x-slot:icon>
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 14.899A7 7 0 1 1 15.71 8h1.79a4.5 4.5 0 0 1 2.5 8.242" />
                    <path d="M12 12v9" />
                    <path d="m16 16-4-4-4 4" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.filepond') }}
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

        <!-- Show -->
        <vibe:nav.item href="{{ route('docs.show.index') }}" :active="request()->routeIs('docs.show.*')">
            <x-slot:icon>
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" />
                    <circle cx="12" cy="12" r="3" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.show') }}
        </vibe:nav.item>

        <!-- Dropdown -->
        <vibe:nav.item href="{{ route('docs.dropdown.index') }}" :active="request()->routeIs('docs.dropdown.*')">
            <x-slot:icon>
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="18" height="18" x="3" y="3" rx="2" />
                    <path d="m9 10 3 3 3-3" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.dropdown') }}
        </vibe:nav.item>

        <!-- Context Menu -->
        <vibe:nav.item href="{{ route('docs.context.index') }}" :active="request()->routeIs('docs.context.*')">
            <x-slot:icon>
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="18" height="18" x="3" y="3" rx="2" />
                    <path d="M9 9h.01" />
                    <path d="M9 12h6" />
                    <path d="M9 15h4" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.context') }}
        </vibe:nav.item>

        <!-- Badge -->
        <vibe:nav.item href="{{ route('docs.badge.index') }}" :active="request()->routeIs('docs.badge.*')">
            <x-slot:icon>
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3.85 8.62a4 4 0 0 1 4.78-4.77 4 4 0 0 1 6.74 0 4 4 0 0 1 4.78 4.78 4 4 0 0 1 0 6.74 4 4 0 0 1-4.77 4.78 4 4 0 0 1-6.75 0 4 4 0 0 1-4.78-4.77 4 4 0 0 1 0-6.76Z" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.badge') }}
        </vibe:nav.item>

        <!-- Avatar -->
        <vibe:nav.item href="{{ route('docs.avatar.index') }}" :active="request()->routeIs('docs.avatar.*')">
            <x-slot:icon>
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                    <circle cx="12" cy="7" r="4" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.avatar') }}
        </vibe:nav.item>

        <!-- Image -->
        <vibe:nav.item href="{{ route('docs.image.index') }}" :active="request()->routeIs('docs.image.*')">
            <x-slot:icon>
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="18" height="18" x="3" y="3" rx="2" ry="2"/>
                    <circle cx="9" cy="9" r="2"/>
                    <path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/>
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.image') }}
        </vibe:nav.item>

        <!-- Card -->
        <vibe:nav.item href="{{ route('docs.card.index') }}" :active="request()->routeIs('docs.card.*')">
            <x-slot:icon>
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="18" height="14" x="3" y="5" rx="2" />
                    <path d="M3 10h18" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.card') }}
        </vibe:nav.item>

        <!-- Grid List -->
        <vibe:nav.item href="{{ route('docs.grid-list.index') }}" :active="request()->routeIs('docs.grid-list.*')">
            <x-slot:icon>
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="7" height="7" rx="1"/>
                    <rect x="14" y="3" width="7" height="7" rx="1"/>
                    <rect x="14" y="14" width="7" height="7" rx="1"/>
                    <rect x="3" y="14" width="7" height="7" rx="1"/>
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.grid-list') }}
        </vibe:nav.item>

        <!-- Header -->
        <vibe:nav.item href="{{ route('docs.header.index') }}" :active="request()->routeIs('docs.header.*')">
            <x-slot:icon>
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="18" height="18" x="3" y="3" rx="2" />
                    <path d="M3 9h18" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.header') }}
        </vibe:nav.item>

        <!-- Nav -->
        <vibe:nav.item href="{{ route('docs.nav.index') }}" :active="request()->routeIs('docs.nav.*')">
            <x-slot:icon>
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="18" height="18" x="3" y="3" rx="2"/>
                    <path d="M9 3v18"/>
                    <path d="m14 9 3 3-3 3"/>
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.nav') }}
        </vibe:nav.item>

        <!-- Breadcrumb -->
        <vibe:nav.item href="{{ route('docs.breadcrumb.index') }}" :active="request()->routeIs('docs.breadcrumb.*')">
            <x-slot:icon>
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m9 18 6-6-6-6"/>
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.breadcrumb') }}
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

        <!-- Grid -->
        <vibe:nav.item href="{{ route('docs.grid.index') }}" :active="request()->routeIs('docs.grid.*')">
            <x-slot:icon>
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="18" height="18" x="3" y="3" rx="2" />
                    <path d="M9 3v18" />
                    <path d="M15 3v18" />
                    <path d="M3 9h18" />
                    <path d="M3 15h18" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.grid') }}
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

        <!-- Modal -->
        <vibe:nav.item href="{{ route('docs.modal.index') }}" :active="request()->routeIs('docs.modal.*')">
            <x-slot:icon>
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="3" y1="9" x2="21" y2="9"></line>
                    <line x1="9" y1="21" x2="9" y2="9"></line>
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.modal') }}
        </vibe:nav.item>


        <!-- Sheet -->
        <vibe:nav.item href="{{ route('docs.sheet.index') }}" :active="request()->routeIs('docs.sheet.*')">
            <x-slot:icon>
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="18" height="18" x="3" y="3" rx="2" />
                    <path d="M15 3v18" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.sheet') }}
        </vibe:nav.item>

        <!-- Tabs -->
        <vibe:nav.item href="{{ route('docs.tabs.index') }}" :active="request()->routeIs('docs.tabs.*')">
            <x-slot:icon>
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 6h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2z" />
                    <path d="M2 10h20" />
                    <path d="M8 6v4" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.tabs') }}
        </vibe:nav.item>

        <!-- Accordion -->
        <vibe:nav.item href="{{ route('docs.accordion.index') }}" :active="request()->routeIs('docs.accordion.*')">
            <x-slot:icon>
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="18" height="18" x="3" y="3" rx="2" />
                    <path d="M3 9h18" />
                    <path d="M3 15h18" />
                    <path d="m16 6-2 2-2-2" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.accordion') }}
        </vibe:nav.item>

        <!-- Highlight.js -->
        <vibe:nav.item href="{{ route('docs.highlightjs.index') }}" :active="request()->routeIs('docs.highlightjs.*')">
            <x-slot:icon>
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="16 18 22 12 16 6" />
                    <polyline points="8 6 2 12 8 18" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.highlightjs') }}
        </vibe:nav.item>

        <!-- Display Group -->
        <vibe:nav.group :title="__('docs/sidebar.nav.display.group')" :active="request()->routeIs('docs.display.*')" persist>
            <x-slot:icon>
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="5" height="5" x="3" y="3" rx="1"/>
                    <rect width="5" height="5" x="16" y="3" rx="1"/>
                    <rect width="5" height="5" x="3" y="16" rx="1"/>
                    <path d="M21 16h-3a2 2 0 0 0-2 2v3"/>
                    <path d="M21 21v.01"/>
                    <path d="M12 7v3a2 2 0 0 1-2 2H7"/>
                    <path d="M3 12h.01"/>
                    <path d="M12 3h.01"/>
                    <path d="M12 16v.01"/>
                    <path d="M16 12h1"/>
                    <path d="M21 12v.01"/>
                    <path d="M12 21v-1"/>
                </svg>
            </x-slot:icon>
            <vibe:nav.item href="{{ route('docs.display.qrcode') }}" :active="request()->routeIs('docs.display.qrcode')">
                {{ __('docs/sidebar.nav.display.qrcode') }}
            </vibe:nav.item>
        </vibe:nav.group>

        <!-- Chart -->
        <vibe:nav.item href="{{ route('docs.chart.index') }}" :active="request()->routeIs('docs.chart.*')">
            <x-slot:icon>
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 3v18h18" />
                    <path d="m19 9-5 5-4-4-3 3" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.chart') }}
        </vibe:nav.item>

    </vibe:nav.label>




</vibe:nav>
