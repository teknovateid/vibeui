<vibe:nav id="sidebar-menu" {{ $attributes->twMerge(['class' => 'gap-2']) }} pinnable maxpin="5">
    <vibe:nav.pinned persist />

    <vibe:nav.label :title="__('docs/sidebar.groups.get_started')" persist>
        <!-- Docs -->
        <vibe:nav.item href="{{ route('docs.index') }}" :active="request()->routeIs('docs.index')">
            <x-slot:icon>
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 8c0-2.828 0-4.243.879-5.121C5.757 2 7.172 2 10 2h4c2.828 0 4.243 0 5.121.879C20 3.757 20 5.172 20 8v8c0 2.828 0 4.243-.879 5.121C18.243 22 16.828 22 14 22h-4c-2.828 0-4.243 0-5.121-.879C4 20.243 4 18.828 4 16V8Z" />
                    <path d="M19.898 16H7.898c-.93 0-1.395 0-1.777.102A3.003 3.003 0 0 0 4 18.224" />
                    <path d="M8 7h8M8 10.5h5" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.docs') }}
        </vibe:nav.item>

        <!-- Instalation -->
        <vibe:nav.item href="{{ route('docs.instalation.index') }}" :active="request()->routeIs('docs.instalation.*')">
            <x-slot:icon>
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke-linejoin="round" d="M12 7v7m-3-3 3 3 3-3" />
                    <path d="M16 17H8" />
                    <path d="M2 12c0-4.714 0-7.071 1.464-8.536C4.93 2 7.286 2 12 2c4.714 0 7.071 0 8.536 1.464C22 4.93 22 7.286 22 12c0 4.714 0 7.071-1.464 8.536C19.07 22 16.714 22 12 22c-4.714 0-7.071 0-8.536-1.464C2 19.07 2 16.714 2 12Z" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.instalation') }}
        </vibe:nav.item>

        <!-- Directories -->
        <vibe:nav.item href="{{ route('docs.directories.index') }}" :active="request()->routeIs('docs.directories.*')">
            <x-slot:icon>
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 10h-5" />
                    <path d="M2 6.95C2 6.067 2 5.626 2.069 5.258A3.75 3.75 0 0 1 5.258 2.07C5.626 2 6.067 2 6.95 2c.386 0 .58 0 .765.017a4.5 4.5 0 0 1 2.181.904c.144.119.28.256.554.529l.55.55c.816.816 1.224 1.224 1.712 1.495.269.15.553.268.849.352.537.153 1.114.153 2.268.153h.373c2.633 0 3.949 0 4.805.77a3 3 0 0 1 .224.224C22 7.85 22 9.166 22 11.798V14c0 3.771 0 5.657-1.172 6.828C19.657 22 17.771 22 14 22h-4c-3.771 0-5.657 0-6.828-1.172C2 19.657 2 17.771 2 14V6.95Z" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.directories') }}
        </vibe:nav.item>

        <!-- Design System (Color Rules) -->
        <vibe:nav.item href="{{ route('docs.design-system.index') }}" :active="request()->routeIs('docs.design-system.*')">
            <x-slot:icon>
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M2 6c0-1.4 0-2.1.272-2.635a2.5 2.5 0 0 1 1.093-1.093C3.9 2 4.6 2 6 2s2.1 0 2.635.272a2.5 2.5 0 0 1 1.093 1.093C10 3.9 10 4.6 10 6v12c0 1.4 0 2.1-.272 2.635a2.5 2.5 0 0 1-1.093 1.093C8.1 22 7.4 22 6 22s-2.1 0-2.635-.272a2.5 2.5 0 0 1-1.093-1.093C2 20.1 2 19.4 2 18V6Z" />
                    <path d="M7 19H5" />
                    <path d="m13.314 4.929-2.142 2.142c-.578.578-.867.867-1.02 1.235C10 8.673 10 9.082 10 9.9v9.656l8.97-8.97c.99-1 1.485-1.495 1.671-2.066a2.8 2.8 0 0 0 0-1.545c-.186-.57-.68-1.066-1.67-2.056-.99-.99-1.486-1.485-2.056-1.671a2.8 2.8 0 0 0-1.545 0c-.571.186-1.066.68-2.056 1.67Z" />
                    <path d="M6 22h12c1.4 0 2.1 0 2.635-.272a2.5 2.5 0 0 0 1.093-1.093C22 20.1 22 19.4 22 18c0-1.4 0-2.1-.272-2.635a2.5 2.5 0 0 0-1.093-1.093C20.1 14 19.4 14 18 14h-2.5" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.design_system') }}
        </vibe:nav.item>

        <!-- Authentication -->
        <vibe:nav.group :title="__('docs/sidebar.nav.auth.group')" :active="request()->routeIs('docs.auth.*')" persist>
            <x-slot:icon>
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M2 16c0-2.828 0-4.243.879-5.121C3.757 10 5.172 10 8 10h8c2.828 0 4.243 0 5.121.879C22 11.757 22 13.172 22 16c0 2.828 0 4.243-.879 5.121C20.243 22 18.828 22 16 22H8c-2.828 0-4.243 0-5.121-.879C2 20.243 2 18.828 2 16Z" />
                    <circle cx="12" cy="16" r="2" />
                    <path d="M6 10V8a6 6 0 1 1 12 0v2" />
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
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 10c0-3.771 0-5.657 1.172-6.828C5.343 2 7.229 2 11 2h2c3.771 0 5.657 0 6.828 1.172C21 4.343 21 6.229 21 10v4c0 3.771 0 5.657-1.172 6.828C18.657 22 16.771 22 13 22h-2c-3.771 0-5.657 0-6.828-1.172C3 19.657 3 17.771 3 14v-4Z" />
                    <path d="M8 10h8M8 14h5" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.form') }}
        </vibe:nav.item>

        <!-- Input Group -->
        <vibe:nav.group :title="__('docs/sidebar.nav.input_group.group')" :active="request()->routeIs('docs.input.*')" persist>
            <x-slot:icon>
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M2 12c0-3.771 0-5.657 1.172-6.828C4.343 4 6.229 4 10 4h4c3.771 0 5.657 0 6.828 1.172C22 6.343 22 8.229 22 12c0 3.771 0 5.657-1.172 6.828C19.657 20 17.771 20 14 20h-4c-3.771 0-5.657 0-6.828-1.172C2 17.657 2 15.771 2 12Z" />
                    <path d="M9 8.5H7.925C7.055 8.5 6.62 8.5 6.336 8.752a.7.7 0 0 0-.083.084C6 9.12 6 9.555 6 10.425M9 8.5h1.075c.87 0 1.305 0 1.589.252a.7.7 0 0 1 .083.084c.253.284.253.719.253 1.589M9 8.5v7m-2 0h4" />
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
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 22C17.523 22 22 17.523 22 12S17.523 2 12 2 2 6.477 2 12c0 1.6.376 3.112 1.043 4.453.178.356.237.763.134 1.148l-.595 2.226c-.259.966.625 1.85 1.591 1.592l2.226-.596c.385-.103.792-.044 1.148.134A9.957 9.957 0 0 0 12 22Z" />
                    <path d="M8 10.5h8M8 14h5.5" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.textarea') }}
        </vibe:nav.item>

        <!-- Select -->
        <vibe:nav.item href="{{ route('docs.select.index') }}" :active="request()->routeIs('docs.select.index')">
            <x-slot:icon>
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="18" height="18" x="3" y="3" rx="4" />
                    <path d="M8 12h.01M12 12h.01M16 12h.01" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.select') }}
        </vibe:nav.item>

        <!-- Checkbox -->
        <vibe:nav.item href="{{ route('docs.checkbox.index') }}" :active="request()->routeIs('docs.checkbox.index')">
            <x-slot:icon>
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M2 12c0-4.714 0-7.071 1.464-8.536C4.93 2 7.286 2 12 2c4.714 0 7.071 0 8.536 1.464C22 4.93 22 7.286 22 12c0 4.714 0 7.071-1.464 8.536C19.07 22 16.714 22 12 22c-4.714 0-7.071 0-8.536-1.464C2 19.07 2 16.714 2 12Z" />
                    <path d="m8.5 12.5 2 2 5-5" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.checkbox') }}
        </vibe:nav.item>

        <!-- Radio -->
        <vibe:nav.item href="{{ route('docs.radio.index') }}" :active="request()->routeIs('docs.radio.index')">
            <x-slot:icon>
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10" />
                    <circle cx="12" cy="12" r="4" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.radio') }}
        </vibe:nav.item>

        <!-- Switch -->
        <vibe:nav.item href="{{ route('docs.switch.index') }}" :active="request()->routeIs('docs.switch.index')">
            <x-slot:icon>
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="20" height="12" x="2" y="6" rx="6" />
                    <circle cx="16" cy="12" r="2.5" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.switch') }}
        </vibe:nav.item>

        <!-- Range Slider -->
        <vibe:nav.item href="{{ route('docs.range.index') }}" :active="request()->routeIs('docs.range.index')">
            <x-slot:icon>
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 12h18" />
                    <circle cx="14" cy="12" r="3" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.range') }}
        </vibe:nav.item>

        <!-- Date & Time -->
        <vibe:nav.item href="{{ route('docs.date-time.index') }}" :active="request()->routeIs('docs.date-time.*')">
            <x-slot:icon>
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M2 12c0-3.771 0-5.657 1.172-6.828C4.343 4 6.229 4 10 4h4c3.771 0 5.657 0 6.828 1.172C22 6.343 22 8.229 22 12v2c0 3.771 0 5.657-1.172 6.828C19.657 22 17.771 22 14 22h-4c-3.771 0-5.657 0-6.828-1.172C2 19.657 2 17.771 2 14v-2Z" />
                    <path d="M7 4V2.5M17 4V2.5M2.5 9h19" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.date-time') }}
        </vibe:nav.item>

        <!-- Dynamic Form -->
        <vibe:nav.item href="{{ route('docs.dynamic-form.index') }}" :active="request()->routeIs('docs.dynamic-form.*')">
            <x-slot:icon>
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M11 15H9M9 15L7 15M9 15L9 13M9 15L9 17" />
                    <path d="M13 2.263V5c0 2.357 0 3.536.732 4.268C14.464 10 15.643 10 18 10h3.58" />
                    <path stroke-linejoin="round" d="M3.171 3.172C4.343 2 6.239 2 10.03 2c1.525 0 2.287 0 2.979.266.692.265 1.256.772 2.384 1.787l3.959 3.563c1.304 1.174 1.956 1.761 2.302 2.538.346.777.346 1.654.346 3.408V14c0 3.771 0 5.657-1.172 6.828C19.657 22 17.771 22 14 22h-4c-3.772 0-5.657 0-6.828-1.172C2 19.657 2 17.771 2 14V9.998C2 6.228 2 4.343 3.171 3.172Z" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.dynamic-form') }}
        </vibe:nav.item>

        <!-- FilePond -->
        <vibe:nav.item href="{{ route('docs.filepond.index') }}" :active="request()->routeIs('docs.filepond.*')">
            <x-slot:icon>
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M8.667 11.243A4.5 4.5 0 0 0 6.286 10.53C3.919 10.53 2 12.426 2 14.765C2 17.104 3.919 19 6.286 19M14.38 8.027A6.4 6.4 0 0 1 16.286 7.7c.655 0 1.284.108 1.87.308M7.116 10.609A6.7 6.7 0 0 1 6.762 8.647C6.762 5.528 9.32 3 12.476 3c2.94 0 5.361 2.194 5.68 5.015a6.5 6.5 0 0 1 3.844 5.338c0 2.707-1.927 4.97-4.5 5.519" />
                    <path d="M12 16v6m-2-4 2-2 2 2" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.filepond') }}
        </vibe:nav.item>

        <!-- Button -->
        <vibe:nav.item href="{{ route('docs.button.index') }}" :active="request()->routeIs('docs.button.*')">
            <x-slot:icon>
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M2 12c0-4.714 0-7.071 1.464-8.536C4.93 2 7.286 2 12 2c4.714 0 7.071 0 8.536 1.464C22 4.93 22 7.286 22 12c0 4.714 0 7.071-1.464 8.536C19.07 22 16.714 22 12 22c-4.714 0-7.071 0-8.536-1.464C2 19.07 2 16.714 2 12Z" />
                    <path d="M8 12h8" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.button') }}
        </vibe:nav.item>

        <!-- Show -->
        <vibe:nav.item href="{{ route('docs.show.index') }}" :active="request()->routeIs('docs.show.*')">
            <x-slot:icon>
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3.275 15.296C2.425 14.192 2 13.639 2 12c0-1.639.425-2.192 1.275-3.296C4.972 6.5 7.818 4 12 4s7.028 2.5 8.725 4.704C21.575 9.808 22 10.36 22 12c0 1.639-.425 2.192-1.275 3.296C19.028 17.5 16.182 20 12 20s-7.028-2.5-8.725-4.704Z" />
                    <circle cx="12" cy="12" r="3" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.show') }}
        </vibe:nav.item>

        <!-- Dropdown -->
        <vibe:nav.item href="{{ route('docs.dropdown.index') }}" :active="request()->routeIs('docs.dropdown.*')">
            <x-slot:icon>
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="18" height="18" x="3" y="3" rx="4" />
                    <path d="m8 10 4 4 4-4" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.dropdown') }}
        </vibe:nav.item>

        <!-- Context Menu -->
        <vibe:nav.item href="{{ route('docs.context.index') }}" :active="request()->routeIs('docs.context.*')">
            <x-slot:icon>
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 7H4M15 12H4M9 17H4" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.context') }}
        </vibe:nav.item>

        <!-- Badge -->
        <vibe:nav.item href="{{ route('docs.badge.index') }}" :active="request()->routeIs('docs.badge.*')">
            <x-slot:icon>
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4.728 16.137C3.183 14.591 2.41 13.819 2.123 12.816c-.288-1.003-.042-2.068.45-4.197l.283-1.229C3.27 5.599 3.476 4.703 4.09 4.09c.613-.614 1.51-.82 3.301-1.234l1.228-.284c2.13-.491 3.195-.737 4.197-.45 1.003.288 1.776 1.061 3.321 2.606l1.83 1.83C20.655 9.247 22 10.592 22 12.262c0 1.67-1.345 3.015-4.034 5.704C15.278 20.655 13.933 22 12.262 22c-1.67 0-3.015-1.345-5.704-4.034L4.728 16.137Z" />
                    <circle cx="8.607" cy="8.879" r="2" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.badge') }}
        </vibe:nav.item>

        <!-- Avatar -->
        <vibe:nav.item href="{{ route('docs.avatar.index') }}" :active="request()->routeIs('docs.avatar.*')">
            <x-slot:icon>
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="9" r="3" />
                    <circle cx="12" cy="12" r="10" />
                    <path d="M17.969 20C17.81 17.109 16.925 15 12 15s-5.81 2.109-5.969 5" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.avatar') }}
        </vibe:nav.item>

        <!-- Image -->
        <vibe:nav.item href="{{ route('docs.image.index') }}" :active="request()->routeIs('docs.image.*')">
            <x-slot:icon>
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M2 12c0-4.714 0-7.071 1.464-8.536C4.93 2 7.286 2 12 2c4.714 0 7.071 0 8.536 1.464C22 4.93 22 7.286 22 12c0 4.714 0 7.071-1.464 8.536C19.07 22 16.714 22 12 22c-4.714 0-7.071 0-8.536-1.464C2 19.07 2 16.714 2 12Z" />
                    <circle cx="16" cy="8" r="2" />
                    <path d="m2 12.5 1.752-1.533a3 3 0 0 1 3.14 0l4.29 4.29a3 3 0 0 0 2.564.222l.298-.21a3 3 0 0 1 3.732.225L21 18.5" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.image') }}
        </vibe:nav.item>

        <!-- Card -->
        <vibe:nav.item href="{{ route('docs.card.index') }}" :active="request()->routeIs('docs.card.*')">
            <x-slot:icon>
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M2 12c0-8 0-8 8-8h4c8 0 8 0 8 8s0 8-8 8h-4c-8 0-8 0-8-8Z" />
                    <path d="M10 16H6M14 16h-1.5M2 10h20" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.card') }}
        </vibe:nav.item>

        <!-- Grid List -->
        <vibe:nav.item href="{{ route('docs.grid-list.index') }}" :active="request()->routeIs('docs.grid-list.*')">
            <x-slot:icon>
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="7" height="7" rx="2" />
                    <rect x="14" y="3" width="7" height="7" rx="2" />
                    <rect x="14" y="14" width="7" height="7" rx="2" />
                    <rect x="3" y="14" width="7" height="7" rx="2" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.grid-list') }}
        </vibe:nav.item>

        <!-- Header -->
        <vibe:nav.item href="{{ route('docs.header.index') }}" :active="request()->routeIs('docs.header.*')">
            <x-slot:icon>
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="18" height="18" x="3" y="3" rx="4" />
                    <path d="M3 9h18" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.header') }}
        </vibe:nav.item>

        <!-- Nav -->
        <vibe:nav.item href="{{ route('docs.nav.index') }}" :active="request()->routeIs('docs.nav.*')">
            <x-slot:icon>
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="18" height="18" x="3" y="3" rx="4" />
                    <path d="M9 3v18M14 9l3 3-3 3" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.nav') }}
        </vibe:nav.item>

        <!-- Breadcrumb -->
        <vibe:nav.item href="{{ route('docs.breadcrumb.index') }}" :active="request()->routeIs('docs.breadcrumb.*')">
            <x-slot:icon>
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m9 19 6-7-6-7" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.breadcrumb') }}
        </vibe:nav.item>

        <!-- Table -->
        <vibe:nav.item href="{{ route('docs.table.index') }}" :active="request()->routeIs('docs.table.*')">
            <x-slot:icon>
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="18" height="18" x="3" y="3" rx="4" />
                    <path d="M3 9h18M9 21V9" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.table') }}
        </vibe:nav.item>

        <!-- Grid -->
        <vibe:nav.item href="{{ route('docs.grid.index') }}" :active="request()->routeIs('docs.grid.*')">
            <x-slot:icon>
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="7" height="7" rx="2" />
                    <rect x="14" y="3" width="7" height="7" rx="2" />
                    <rect x="14" y="14" width="7" height="7" rx="2" />
                    <rect x="3" y="14" width="7" height="7" rx="2" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.grid') }}
        </vibe:nav.item>

        <!-- DataTable -->
        <vibe:nav.item href="{{ route('docs.datatable.index') }}" :active="request()->routeIs('docs.datatable.*')">
            <x-slot:icon>
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="18" height="18" x="3" y="3" rx="4" />
                    <path d="M3 9h18M9 21V9M15 21V9" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.datatable') }}
        </vibe:nav.item>

        <!-- Alert -->
        <vibe:nav.item href="{{ route('docs.alert.index') }}" :active="request()->routeIs('docs.alert.*')">
            <x-slot:icon>
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5.312 10.762C8.23 5.587 9.69 3 12 3c2.31 0 3.77 2.587 6.688 7.762l.364.644c2.425 4.3 3.638 6.45 2.542 8.022C20.498 21 17.786 21 12.364 21h-.728c-5.422 0-8.134 0-9.23-1.572-1.096-1.572.117-3.722 2.542-8.022l.364-.644Z" />
                    <path d="M12 8v5M12 16h.01" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.alert') }}
        </vibe:nav.item>

        <!-- Toast -->
        <vibe:nav.item href="{{ route('docs.toast.index') }}" :active="request()->routeIs('docs.toast.*')">
            <x-slot:icon>
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18.75 9.71V9c0-3.864-3.022-7-6.75-7S5.25 5.136 5.25 9v.71c0 .845-.24 1.672-.693 2.375L3.45 13.81c-1.012 1.575-.24 3.715 1.52 4.213 4.602 1.303 9.458 1.303 14.06 0 1.76-.498 2.532-2.638 1.52-4.213l-1.107-1.725c-.452-.703-.693-1.53-.693-2.375ZM8.5 19c.7 1.5 2 2.5 3.5 2.5s2.8-1 3.5-2.5" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.toast') }}
        </vibe:nav.item>

        <!-- Modal -->
        <vibe:nav.item href="{{ route('docs.modal.index') }}" :active="request()->routeIs('docs.modal.*')">
            <x-slot:icon>
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="18" height="18" x="3" y="3" rx="4" />
                    <path d="M3 8h18M8 5.5h.01M11 5.5h.01" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.modal') }}
        </vibe:nav.item>

        <!-- Sheet -->
        <vibe:nav.item href="{{ route('docs.sheet.index') }}" :active="request()->routeIs('docs.sheet.*')">
            <x-slot:icon>
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="18" height="18" x="3" y="3" rx="4" />
                    <path d="M15 3v18" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.sheet') }}
        </vibe:nav.item>

        <!-- Tabs -->
        <vibe:nav.item href="{{ route('docs.tabs.index') }}" :active="request()->routeIs('docs.tabs.*')">
            <x-slot:icon>
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4.979 9.685C2.993 8.89 2 8.494 2 8c0-.494.993-.89 2.979-1.685l2.808-1.124C9.773 4.397 10.766 4 12 4s2.227.397 4.213 1.191l2.808 1.124C21.007 7.11 22 7.506 22 8c0 .494-.993.89-2.979 1.685l-2.808 1.124C14.227 11.603 13.234 12 12 12s-2.227-.397-4.213-1.191L4.979 9.685Z" />
                    <path d="M22 12c0 0-.993.89-2.979 1.685l-2.808 1.124C14.227 15.603 13.234 16 12 16s-2.227-.397-4.213-1.191L4.979 13.685C2.993 12.89 2 12 2 12M22 16c0 0-.993.89-2.979 1.685l-2.808 1.124C14.227 19.603 13.234 20 12 20s-2.227-.397-4.213-1.191L4.979 17.685C2.993 16.89 2 16 2 16" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.tabs') }}
        </vibe:nav.item>

        <!-- Accordion -->
        <vibe:nav.item href="{{ route('docs.accordion.index') }}" :active="request()->routeIs('docs.accordion.*')">
            <x-slot:icon>
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 6L3 6" />
                    <path d="M20 11L3 11" />
                    <path d="M10 16H3" />
                    <path stroke-linejoin="round" d="m14 15 3.5 3 3.5-3" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.accordion') }}
        </vibe:nav.item>

        <!-- Highlight.js -->
        <vibe:nav.item href="{{ route('docs.highlightjs.index') }}" :active="request()->routeIs('docs.highlightjs.*')">
            <x-slot:icon>
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m17 7.83 1.696 1.527c1.543 1.388 2.314 2.082 2.314 2.973s-.771 1.585-2.314 2.973L17 16.83M13.987 5 12 12.415 10.013 19.83M7 7.83 5.304 9.357C3.76 10.745 2.99 11.439 2.99 12.33s.77 1.585 2.314 2.973L7 16.83" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.highlightjs') }}
        </vibe:nav.item>

        <!-- Display Group -->
        <vibe:nav.group :title="__('docs/sidebar.nav.display.group')" :active="request()->routeIs('docs.display.*')" persist>
            <x-slot:icon>
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="6" height="6" x="3" y="3" rx="1.5" />
                    <rect width="6" height="6" x="15" y="3" rx="1.5" />
                    <rect width="6" height="6" x="3" y="15" rx="1.5" />
                    <path d="M15 15h2v2h-2zM19 15h2v2h-2zM15 19h2v2h-2zM19 19h2v2h-2z" />
                </svg>
            </x-slot:icon>
            <vibe:nav.item href="{{ route('docs.display.qrcode') }}" :active="request()->routeIs('docs.display.qrcode')">
                {{ __('docs/sidebar.nav.display.qrcode') }}
            </vibe:nav.item>
        </vibe:nav.group>

        <!-- Chart -->
        <vibe:nav.item href="{{ route('docs.chart.index') }}" :active="request()->routeIs('docs.chart.*')">
            <x-slot:icon>
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M2 12c0-4.714 0-7.071 1.464-8.536C4.93 2 7.286 2 12 2c4.714 0 7.071 0 8.536 1.464C22 4.93 22 7.286 22 12c0 4.714 0 7.071-1.464 8.536C19.07 22 16.714 22 12 22c-4.714 0-7.071 0-8.536-1.464C2 19.07 2 16.714 2 12Z" />
                    <path d="M7 18v-9M12 18V6M17 18v-5" />
                </svg>
            </x-slot:icon>
            {{ __('docs/sidebar.nav.chart') }}
        </vibe:nav.item>

    </vibe:nav.label>


    <vibe:nav.label :title="__('docs/sidebar.groups.pages')" persist>
        <vibe:nav.group :title="__('docs/sidebar.groups.dashboard')" :active="request()->routeIs('docs.dashboard.*')">
            <x-slot:icon>
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3.742 20.555C4.941 22 7.174 22 11.64 22h.72c4.466 0 6.699 0 7.898-1.445 1.2-1.446.789-3.64-.034-8.03l-.823-4.39C18.816 5.03 18.523 3.47 17.412 2.548 16.3 1.626 14.714 1.626 11.538 1.626h-.72c-3.176 0-4.762 0-5.874.922-.977.81-1.27 2.37-1.855 5.49L2.266 12.525c-.823 4.39-1.235 6.584-.034 8.03Z" />
                    <path d="M9 6V5a3 3 0 0 1 6 0v1" />
                </svg>
            </x-slot:icon>
            <vibe:nav.item href="{{ route('docs.dashboard.show', 'index') }}" :active="request()->routeIs('docs.dashboard.show','index')">Semua Produk</vibe:nav.item>
            <vibe:nav.item href="{{ route('docs.dashboard.show', 'index') }}" badge="14" badgeColor="warning">Pesanan Pelanggan</vibe:nav.item>
            <vibe:nav.item href="{{ route('docs.dashboard.show', 'index') }}">Daftar Pembeli</vibe:nav.item>
        </vibe:nav.group>

        <vibe:nav.item href="{{ route('docs.settings.index') }}" :active="request()->routeIs('docs.settings.*')">
            <x-slot:icon>
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="3" />
                    <path d="M13.765 2.152C13.398 2 12.932 2 12 2c-.932 0-1.398 0-1.765.152a2.6 2.6 0 0 0-1.083.916 3.6 3.6 0 0 1-.143.864c-.02.557-.306 1.074-.79 1.353-.483.279-1.073.268-1.566.008a3.2 3.2 0 0 0-.82-.308 2.6 2.6 0 0 0-1.478.396 6.3 6.3 0 0 0-1.015 1.453c-.466.807-.7 1.21-.752 1.605a2.6 2.6 0 0 0 .396 1.478c.148.193.355.354.676.556.473.297.777.803.777 1.361s-.304 1.064-.777 1.361c-.321.202-.529.363-.676.556a2.6 2.6 0 0 0-.396 1.478c.052.395.286.798.752 1.605.466.807.7 1.21 1.015 1.453a2.6 2.6 0 0 0 1.478.396 3.2 3.2 0 0 0 .82-.308c.493-.26 1.083-.27 1.566.008.483.279.77.796.79 1.353.014.38.05.64.143.864a2.6 2.6 0 0 0 1.083.916C10.602 22 11.068 22 12 22c.932 0 1.398 0 1.765-.152a2.6 2.6 0 0 0 1.083-.916c.092-.224.129-.484.143-.864.02-.557.306-1.074.79-1.353.483-.279 1.073-.268 1.566-.008.336.177.58.276.82.308a2.6 2.6 0 0 0 1.479-.396c.315-.242.549-.646 1.014-1.453.466-.807.7-1.21.752-1.605a2.6 2.6 0 0 0-.396-1.478c-.148-.193-.355-.354-.676-.556a1.6 1.6 0 0 1-.777-1.361c0-.558.304-1.064.777-1.361.321-.202.528-.363.676-.556a2.6 2.6 0 0 0 .396-1.478c-.052-.395-.286-.798-.752-1.605-.465-.807-.7-1.21-1.014-1.453a2.6 2.6 0 0 0-1.479-.396 3.2 3.2 0 0 0-.82.308c-.493.26-1.083.27-1.566-.008-.483-.279-.77-.796-.79-1.353-.014-.38-.05-.64-.143-.864a2.6 2.6 0 0 0-1.083-.916Z" />
                </svg>
            </x-slot:icon>
            {{ __('docs/page/settings/index.breadcrumb.settings') }}
        </vibe:nav.item>
    </vibe:nav.label>

</vibe:nav>
