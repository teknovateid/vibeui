<li>
    <a href="{{ route('[route].index') }}" wire:navigate class="vibe-topbar-link w-full" @if (request()->routeIs('[route].*')) aria-current="page" @endif>
        [Title]
    </a>
</li>
