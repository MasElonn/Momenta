<x-auth-layout
    :title="'Create account — Momenta'"
    headline="Momenta Pilihan Terbaik untuk fotografer."
    subheadline="Daftar Untuk masuk"
    image="{{ asset('images/wisuda2.webp') }}"
>
    <h1 class="mb-2 text-4xl font-bold text-[#1447E6]">Buat Akun</h1>
    <p class="mb-8 text-sm text-gray-500">Tambahkan dengan detail untuk membuat akun baru</p>

    <form method="POST" action="{{ route('register') }}" class="space-y-5" novalidate>
        @csrf

        <x-auth-input
            label="Nama Pengguna"
            name="name"
            placeholder="Nama"
            required
            autofocus
            autocomplete="name"
        />

        <x-auth-input
            label="Email address"
            name="email"
            type="email"
            icon="mail"
            placeholder="name@example.com"
            required
            autocomplete="username"
        />

        <x-auth-input
            label="Password"
            name="password"
            icon="lock"
            toggle
            placeholder="Password"
            required
            autocomplete="new-password"
        />

        <x-auth-input
            label="Confirm Password"
            name="password_confirmation"
            icon="lock"
            toggle
            placeholder="Confirm password"
            required
            autocomplete="new-password"
        />

               <div class="mt-4 flex gap-2">
            <div class="flex items-center">
                <input type="radio" value="customer" name="role" class="shrink-0 size-4 bg-transparent border-line-3 rounded-full shadow-2xs text-primary focus:ring-0 focus:ring-offset-0 checked:bg-primary-checked checked:border-primary-checked disabled:opacity-50 disabled:pointer-events-none" id="hs-checked-radio"checked>
                <label for="hs-checked-radio" class="text-sm ms-3 text-muted-foreground-1">Customer</label>
            </div>
            <div class="flex items-center">
                <input type="radio" value="fotografer" name="role" class="shrink-0 size-4 bg-transparent border-line-3 rounded-full shadow-2xs text-primary focus:ring-0 focus:ring-offset-0 checked:bg-primary-checked checked:border-primary-checked disabled:opacity-50 disabled:pointer-events-none" id="hs-default-radio" >
                <label for="hs-default-radio" class="text-sm ms-3 text-muted-foreground-1">Fotografer</label>
            </div>
        </div>

        <x-auth-button>Tambahkan Akun</x-auth-button>
    </form>

    <div class="my-6 flex items-center gap-3 text-xs font-medium text-gray-400">
        <div class="h-px flex-1 bg-gray-200"></div>
        OR
        <div class="h-px flex-1 bg-gray-200"></div>
    </div>

    <p class="mt-6 text-center text-sm text-gray-500">
        sudah punya akun?
        <a href="{{ route('login') }}" class="font-semibold text-[#1447E6] hover:underline">Sign in</a>
    </p>
</x-auth-layout>
