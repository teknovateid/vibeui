<li data-vibe-topbar-dropdown @if (request()->routeIs('[route].*')) data-active="true" @endif>
    <button
        type="button"
        class="vibe-topbar-subtrigger"
        popovertarget="topbar-sub-{{ str()->slug('[route]') }}"
        aria-expanded="false"
        aria-controls="topbar-sub-{{ str()->slug('[route]') }}"
        data-vibe-topbar-submenu-trigger
    >
        <span>[Title]</span>
        <svg class="size-3.5 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m6 9 6 6 6-6" />
        </svg>
    </button>
    <ul id="topbar-sub-{{ str()->slug('[route]') }}" data-vibe-topbar-submenu>
        <li>
            <a href="{{ route('[route].index') }}" wire:navigate class="vibe-topbar-link w-full" @if (request()->routeIs('[route].index')) aria-current="page" @endif>
                List [Title]
            </a>
        </li>
        <li>
            <a href="{{ route('[route].create') }}" wire:navigate class="vibe-topbar-link w-full" @if (request()->routeIs('[route].create')) aria-current="page" @endif>
                Create [Title]
            </a>
        </li>
    </ul>
</li>
