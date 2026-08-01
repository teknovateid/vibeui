    <!-- [Title] Group -->
    <vibe:nav.group title="[Title]" :active="request()->routeIs('[route].*')">
        <x-slot:icon>
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path>
            </svg>
        </x-slot:icon>

        <vibe:nav.item href="{{ route('[route].index') }}" :active="request()->routeIs('[route].index')">
            List [Title]
        </vibe:nav.item>
        <vibe:nav.item href="{{ route('[route].create') }}" :active="request()->routeIs('[route].create')">
            Create [Title]
        </vibe:nav.item>
    </vibe:nav.group>
