<aside class="fixed inset-y-0 left-0 z-40 flex w-64 flex-col border-r border-slate-200 bg-white">
    <div class="flex h-20 items-center border-b border-slate-100 px-7">
        <a href="{{ route('admin.fotografer.index') }}" class="flex items-center gap-3">
            <img src="{{ asset('images/Logo.svg') }}" alt="Momenta" class="h-10 w-auto">
            <span class="rounded-md bg-slate-100 px-2 py-0.5 text-[10px] font-semibold uppercase tracking-wider text-slate-600">Admin</span>
        </a>
    </div>

    <div class="flex-1 px-4 py-7">
        <p class="mb-3 px-3 text-[10px] font-semibold uppercase tracking-[.18em] text-slate-400">
            Menu Utama
        </p>

        @php
            $pendingNavCount = \App\Models\User::where('role', 'fotografer')->where('status_akun', 'pending')->count();
        @endphp

        <a href="{{ route('admin.fotografer.index') }}"
            class="flex items-center justify-between rounded-xl bg-brand-soft px-3 py-3 text-sm font-semibold text-brand">
            <span class="flex items-center gap-3">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                    <circle cx="10" cy="7" r="4"/>
                    <polyline points="16 11 18 13 22 9"/>
                </svg>
                Verifikasi Fotografer
            </span>
            @if($pendingNavCount > 0)
                <span class="rounded-full bg-amber-500 px-2 py-0.5 text-[10px] font-bold text-white shadow-xs">
                    {{ $pendingNavCount }}
                </span>
            @endif
        </a>
    </div>

    <div class="border-t border-slate-100 p-4">
        <div class="mb-4 flex items-center gap-3 px-2">
            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-slate-100 text-sm font-semibold text-slate-600">
                {{ strtoupper(substr(auth()->user()?->name ?? 'A', 0, 1)) }}
            </div>
            <div class="min-w-0">
                <p class="truncate text-sm font-semibold text-ink">{{ auth()->user()?->name ?? 'Admin' }}</p>
                <p class="text-xs text-ink-soft">Administrator</p>
            </div>
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                onclick="return confirm('Apakah Anda yakin ingin keluar?')"
                class="flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-slate-500 transition hover:bg-red-50 hover:text-red-600">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M10 17l5-5-5-5"/>
                    <path d="M15 12H3"/>
                    <path d="M12 3h6a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-6"/>
                </svg>
                Keluar
            </button>
        </form>
    </div>
</aside>