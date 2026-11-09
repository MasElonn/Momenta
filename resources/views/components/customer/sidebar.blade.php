@props(['user' => Auth::user()])

<aside class="sticky top-0 flex h-screen w-64 flex-col items-center overflow-y-auto border-r border-gray-200 px-4 py-10 shadow-xl">
    <div class="mb-10 flex flex-col items-center">
        <div class="mb-3 flex h-16 w-16 items-center justify-center rounded-full bg-primary text-2xl font-medium uppercase text-white">
            {{ substr($user?->name ?? 'User', 0, 1) }}
        </div>
        <h2 class="mt-1 text-xl font-bold">{{ $user?->name ?? 'User' }}</h2>
        <span class="mt-0.5 text-xs font-semibold uppercase text-gray-500">{{ $user?->role ?? 'customer' }}</span>
    </div>

    <nav class="flex h-full w-full flex-col justify-between">
        <div class="space-y-3">
            <button type="button"
                    @click="tab = 'overview'"
                    :class="tab === 'overview' ? 'bg-primary text-primary-foreground' : 'bg-primary-100 text-primary-800 hover:bg-primary-200'"
                    class="flex w-full items-center gap-3 rounded-lg px-4 py-3 text-sm font-medium transition-colors">
                <x-lucide-layout-grid class="h-5 w-5" />
                Overview
            </button>

            <button type="button"
                    @click="tab = 'booking'; section = ''"
                    :class="tab === 'booking' ? 'bg-primary text-primary-foreground' : 'bg-primary-100 text-primary-800 hover:bg-primary-200'"
                    class="flex w-full items-center gap-3 rounded-lg px-4 py-3 text-sm font-medium transition-colors">
                <x-lucide-calendar class="h-5 w-5" />
                My Booking
            </button>

            <button type="button"
                    @click="tab = 'gallery'; section = ''"
                    :class="tab === 'gallery' ? 'bg-primary text-primary-foreground' : 'bg-primary-100 text-primary-800 hover:bg-primary-200'"
                    class="flex w-full items-center gap-3 rounded-lg px-4 py-3 text-sm font-medium transition-colors">
                <x-lucide-image class="h-5 w-5" />
                My Gallery
            </button>

            <button type="button"
                    @click="tab = 'account'"
                    :class="tab === 'account' ? 'bg-primary text-primary-foreground' : 'bg-primary-100 text-primary-800 hover:bg-primary-200'"
                    class="flex w-full items-center gap-3 rounded-lg px-4 py-3 text-sm font-medium transition-colors">
                <x-lucide-user class="h-5 w-5" />
                My Account
            </button>
        </div>

        <form action="{{ route('logout') }}" method="POST" class="w-full">
            @csrf
            <button type="submit" class="flex w-full items-center gap-2 rounded-lg border border-red-500 px-4 py-3 text-sm font-medium text-red-500 transition hover:border-red-400 hover:text-red-400 focus:outline-hidden">
                <x-lucide-log-out class="h-5 w-5" />
                Logout
            </button>
        </form>
    </nav>
</aside>