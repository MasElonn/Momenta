
<x-auth-layout
    :title="'Create account — Momenta'"
    headline="Momenta Pilihan Terbaik untuk fotografer."
    subheadline="Daftar Untuk masuk"
    image="{{ asset('images/wisuda2.webp') }}"
>
    <h1 class="mb-2 text-4xl font-bold text-[#1447E6]">Buat Akun</h1>
    <p class="mb-8 text-sm text-gray-500">
        Tambahkan dengan detail untuk membuat akun baru
    </p>

    <form method="POST" action="{{ route('register') }}" class="space-y-4" novalidate>
        @csrf

        <div x-data="{ selectedRole: '{{ old('role', 'customer') }}' }">
            <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-gray-600">Daftar Sebagai</label>
            <div class="grid grid-cols-2 gap-3">
                <label :class="selectedRole === 'customer' ? 'border-[#1447E6] bg-[#1447E6]/5 text-[#1447E6]' : 'border-gray-200 text-gray-600 hover:border-gray-300'"
                       class="flex cursor-pointer flex-col rounded-xl border-2 p-3 transition">
                    <input type="radio" name="role" value="customer" class="sr-only" x-model="selectedRole">
                    <span class="text-sm font-bold">Customer</span>
                    <span class="mt-0.5 text-xs text-gray-500">Pesan fotografer acara</span>
                </label>

                <label :class="selectedRole === 'fotografer' ? 'border-[#1447E6] bg-[#1447E6]/5 text-[#1447E6]' : 'border-gray-200 text-gray-600 hover:border-gray-300'"
                       class="flex cursor-pointer flex-col rounded-xl border-2 p-3 transition">
                    <input type="radio" name="role" value="fotografer" class="sr-only" x-model="selectedRole">
                    <span class="text-sm font-bold">Fotografer</span>
                    <span class="mt-0.5 text-xs text-gray-500">Perlu persetujuan admin</span>
                </label>
            </div>
        </div>

        <x-auth-input
            label="Nama Lengkap"
            name="name"
            placeholder="Nama Anda"
            required
            autofocus
            autocomplete="name"
        />

        <x-auth-input
            label="Nomor WhatsApp / HP"
            name="no_hp"
            type="tel"
            placeholder="08123456789"
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

        <x-auth-button>Daftar Sekarang</x-auth-button>
    </form>

    <div class="my-6 flex items-center gap-3 text-xs font-medium text-gray-400">
        <div class="h-px flex-1 bg-gray-200"></div>
        OR
        <div class="h-px flex-1 bg-gray-200"></div>
    </div>

    <p class="mt-6 text-center text-sm text-gray-500">
        Sudah punya akun?
        <a href="{{ route('login') }}"
           class="font-semibold text-[#1447E6] hover:underline">
            Sign in
        </a>
    </p>
</x-auth-layout>
