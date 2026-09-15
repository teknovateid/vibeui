@props([
    'active' => 'account',
])

<div class="w-full md:w-64 shrink-0 flex flex-col gap-0.5 p-3 border-b md:border-b-0 md:border-r border-border/60 bg-sidebar/40">
    {{-- Group: Akun --}}
    <p class="px-2 pt-1 pb-1 text-[10px] font-bold uppercase tracking-widest text-muted-foreground/60">Akun</p>

    <a wire:navigate href="{{ route('docs.settings.account') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-sm font-medium transition-all {{ $active === 'account' ? 'bg-primary/10 text-primary font-semibold' : 'text-muted-foreground hover:bg-muted/60 hover:text-foreground' }}">
        <svg class="size-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="8" r="5" />
            <path d="M20 21a8 8 0 0 0-16 0" />
        </svg>
        <span>Profil Akun</span>
        @auth<span class="ml-auto size-1.5 rounded-full bg-emerald-500 shrink-0"></span>@endauth
    </a>

    <a wire:navigate href="{{ route('docs.settings.security') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-sm font-medium transition-all {{ $active === 'security' ? 'bg-primary/10 text-primary font-semibold' : 'text-muted-foreground hover:bg-muted/60 hover:text-foreground' }}">
        <svg class="size-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect width="18" height="11" x="3" y="11" rx="2" ry="2" />
            <path d="M7 11V7a5 5 0 0 1 10 0v4" />
        </svg>
        <span>Keamanan</span>
        <svg class="size-3 ml-auto text-muted-foreground/50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="11" x="3" y="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
    </a>

    {{-- Group: Preferensi --}}
    <p class="px-2 pt-3 pb-1 text-[10px] font-bold uppercase tracking-widest text-muted-foreground/60">Preferensi</p>

    <a wire:navigate href="{{ route('docs.settings.appearance') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-sm font-medium transition-all {{ $active === 'appearance' ? 'bg-primary/10 text-primary font-semibold' : 'text-muted-foreground hover:bg-muted/60 hover:text-foreground' }}">
        <svg class="size-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z" />
            <path d="M5 3v4" />
            <path d="M19 17v4" />
        </svg>
        <span class="flex-1 text-left">Tampilan</span>
        <span class="text-[10px] font-semibold px-1.5 py-0.5 rounded-md bg-primary/10 text-primary">Live</span>
    </a>

    <a wire:navigate href="{{ route('docs.settings.notifications') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-sm font-medium transition-all {{ $active === 'notifications' ? 'bg-primary/10 text-primary font-semibold' : 'text-muted-foreground hover:bg-muted/60 hover:text-foreground' }}">
        <svg class="size-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9" />
            <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0" />
        </svg>
        <span>Notifikasi</span>
    </a>

    {{-- Group: Sesi & Perangkat --}}
    <p class="px-2 pt-3 pb-1 text-[10px] font-bold uppercase tracking-widest text-muted-foreground/60">Sesi & Perangkat</p>

    <a wire:navigate href="{{ route('docs.settings.login-history') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-sm font-medium transition-all {{ $active === 'login-history' ? 'bg-primary/10 text-primary font-semibold' : 'text-muted-foreground hover:bg-muted/60 hover:text-foreground' }}">
        <svg class="size-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8" />
            <path d="M3 3v5h5" />
            <path d="M12 7v5l4 2" />
        </svg>
        <span>Riwayat Login</span>
        @guest
            <svg class="size-3 ml-auto text-muted-foreground/50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="11" x="3" y="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
        @endguest
    </a>

    <a wire:navigate href="{{ route('docs.settings.passkey') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-sm font-medium transition-all {{ $active === 'passkey' ? 'bg-primary/10 text-primary font-semibold' : 'text-muted-foreground hover:bg-muted/60 hover:text-foreground' }}">
        <svg class="size-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 10a2 2 0 0 0-2 2c0 1.02-.1 2.51-.26 4" />
            <path d="M14 13.12c0 2.38 0 6.38-1 8.88" />
            <path d="M17.29 21.02c.12-.6.43-2.3.5-3.02" />
            <path d="M2 12a10 10 0 0 1 18-6" />
        </svg>
        <span>Passkey</span>
        @auth
            @php $passkeyCount = auth()->user()->passkeys?->count() ?? 0; @endphp
            @if ($passkeyCount > 0)
                <span class="ml-auto text-[10px] font-bold px-1.5 py-0.5 rounded-full bg-primary/10 text-primary">{{ $passkeyCount }}</span>
            @endif
        @else
            <svg class="size-3 ml-auto text-muted-foreground/50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="11" x="3" y="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
        @endauth
    </a>

    @auth
        <div class="mt-auto pt-3 border-t border-border/40">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl text-sm font-medium text-muted-foreground hover:bg-destructive/10 hover:text-destructive transition-all cursor-pointer">
                    <svg class="size-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    @endauth
</div>
