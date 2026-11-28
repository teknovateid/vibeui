<li>
    <a href="{{ route('docs.index') }}" wire:navigate class="vibe-topbar-link" @if (request()->routeIs('docs.index')) aria-current="page" @endif>
        {{ __('docs/sidebar.nav.docs') }}
    </a>
</li>
<li>
    <a href="{{ route('docs.instalation.index') }}" wire:navigate class="vibe-topbar-link" @if (request()->routeIs('docs.instalation.*')) aria-current="page" @endif>
        {{ __('docs/sidebar.nav.instalation') }}
    </a>
</li>
<li>
    <a href="{{ route('docs.layouts.index') }}" wire:navigate class="vibe-topbar-link" @if (request()->routeIs('docs.layouts.*')) aria-current="page" @endif>
        {{ __('docs/sidebar.nav.layouts') }}
    </a>
</li>
<li data-vibe-topbar-dropdown @if (request()->routeIs('docs.button.*', 'docs.input.*', 'docs.clipboard.*', 'docs.table.*', 'docs.modal.*')) data-active="true" @endif>
    <button
        type="button"
        class="vibe-topbar-subtrigger"
        popovertarget="topbar-sub-components"
        aria-expanded="false"
        aria-controls="topbar-sub-components"
        data-vibe-topbar-submenu-trigger
    >
        <span>{{ __('docs/sidebar.groups.components') }}</span>
        <svg class="size-3.5 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m6 9 6 6 6-6" />
        </svg>
    </button>
    <ul id="topbar-sub-components" data-vibe-topbar-submenu>
        <li>
            <a href="{{ route('docs.input.index') }}" wire:navigate class="vibe-topbar-link w-full" @if (request()->routeIs('docs.input.*')) aria-current="page" @endif>
                {{ __('docs/sidebar.nav.input') }}
            </a>
        </li>
        <li>
            <a href="{{ route('docs.button.index') }}" wire:navigate class="vibe-topbar-link w-full" @if (request()->routeIs('docs.button.*')) aria-current="page" @endif>
                {{ __('docs/sidebar.nav.button') }}
            </a>
        </li>
        <li>
            <a href="{{ route('docs.clipboard.index') }}" wire:navigate class="vibe-topbar-link w-full" @if (request()->routeIs('docs.clipboard.*')) aria-current="page" @endif>
                {{ __('docs/sidebar.nav.clipboard') }}
            </a>
        </li>
        <li>
            <a href="{{ route('docs.table.index') }}" wire:navigate class="vibe-topbar-link w-full" @if (request()->routeIs('docs.table.*')) aria-current="page" @endif>
                {{ __('docs/sidebar.nav.table') }}
            </a>
        </li>
        <li>
            <a href="{{ route('docs.modal.index') }}" wire:navigate class="vibe-topbar-link w-full" @if (request()->routeIs('docs.modal.*')) aria-current="page" @endif>
                {{ __('docs/sidebar.nav.modal') }}
            </a>
        </li>
    </ul>
</li>
<li>
    <a href="{{ route('docs.settings.index') }}" wire:navigate class="vibe-topbar-link" @if (request()->routeIs('docs.settings.*')) aria-current="page" @endif>
        {{ __('docs/page/settings/index.breadcrumb.settings') }}
    </a>
</li>
