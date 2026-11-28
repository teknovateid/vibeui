<li>
    <a href="{{ route('[path].index') }}" wire:navigate class="vibe-topbar-link" @if (request()->routeIs('[path].index')) aria-current="page" @endif>
        [Title]
    </a>
</li>
<li>
    <a href="{{ route('[path].settings.index') }}" wire:navigate class="vibe-topbar-link" @if (request()->routeIs('[path].settings.*')) aria-current="page" @endif>
        {{ __('vibe/settings.breadcrumb.settings') }}
    </a>
</li>
