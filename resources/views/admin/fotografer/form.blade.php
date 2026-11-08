
@php
    $isEdit = $fotografer !== null;
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $isEdit ? 'Edit' : 'Tambah' }} Fotografer | Momenta Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-page text-ink antialiased">

    <x-admin.sidebar />

    <main class="min-h-screen pl-64">
        <header class="flex h-20 items-center justify-between border-b border-slate-200 bg-white px-9">
            <div>
                <p class="text-xs text-ink-soft">Admin / Manajemen Fotografer</p>
                <h1 class="mt-1 text-lg font-semibold">
                    {{ $isEdit ? 'Edit Fotografer' : 'Tambah Fotografer' }}
                </h1>
            </div>

            <a href="{{ route('admin.fotografer.index') }}"
                class="rounded-xl border border-slate-200 px-4 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-50">
                Kembali
            </a>
        </header>

        <div class="mx-auto max-w-3xl px-9 py-10">
            <div class="mb-7">
                <h2 class="text-2xl font-semibold tracking-tight">
                    {{ $isEdit ? 'Perbarui informasi akun' : 'Buat akun fotografer baru' }}
                </h2>
                <p class="mt-2 text-sm text-ink-soft">
                    {{ $isEdit
                        ? 'Ubah informasi akun fotografer melalui formulir berikut.'
                        : 'Masukkan informasi akun yang akan digunakan fotografer untuk login ke Momenta.' }}
                </p>
            </div>

            <form
                action="{{ $isEdit
                    ? route('admin.fotografer.update', $fotografer->user_id)
                    : route('admin.fotografer.store') }}"
                method="POST"
                class="space-y-6 rounded-2xl border border-slate-200 bg-white p-7"
            >
                @csrf

                @if ($isEdit)
                    @method('PUT')
                @endif

                <div>
                    <label for="name" class="mb-2 block text-sm font-semibold">
                        Nama Fotografer
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $fotografer?->name) }}"
                        placeholder="Masukkan nama lengkap"
                        required
                        class="w-full rounded-xl border-slate-200 px-4 py-3 text-sm focus:border-brand focus:ring-brand"
                    >

                    @error('name')
                        <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="mb-2 block text-sm font-semibold">
                        Alamat Email
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email', $fotografer?->email) }}"
                        placeholder="contoh@email.com"
                        required
                        class="w-full rounded-xl border-slate-200 px-4 py-3 text-sm focus:border-brand focus:ring-brand"
                    >

                    @error('email')
                        <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid gap-6 md:grid-cols-2">

                    <div x-data="{ showPassword: false }">
                        <label for="password" class="mb-2 block text-sm font-semibold">
                            Password

                            @if ($isEdit)
                                <span class="font-normal text-slate-400">(Opsional)</span>
                            @endif
                        </label>

                        <div class="relative">
                            <input
                                :type="showPassword ? 'text' : 'password'"
                                id="password"
                                name="password"
                                autocomplete="new-password"
                                {{ $isEdit ? '' : 'required' }}
                                placeholder="{{ $isEdit ? 'Kosongkan jika tidak diubah' : 'Minimal 8 karakter' }}"
                                class="w-full rounded-xl border-slate-200 px-4 py-3 pr-12 text-sm focus:border-brand focus:ring-brand"
                            >

                            <button
                                type="button"
                                @click="showPassword = !showPassword"
                                :aria-label="showPassword ? 'Sembunyikan password' : 'Lihat password'"
                                class="absolute inset-y-0 right-0 flex items-center px-4 text-slate-400 transition hover:text-brand"
                            >
                                <svg
                                    x-show="!showPassword"
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="20"
                                    height="20"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                >
                                    <path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7-10-7-10-7Z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>

                                <svg
                                    x-show="showPassword"
                                    x-cloak
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="20"
                                    height="20"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                >
                                    <path d="m3 3 18 18"/>
                                    <path d="M10.6 10.6a2 2 0 0 0 2.8 2.8"/>
                                    <path d="M9.9 5.2A11 11 0 0 1 12 5c6.4 0 10 7 10 7a13 13 0 0 1-3 3.8"/>
                                    <path d="M6.2 6.2C3.5 8 2 12 2 12s3.6 7 10 7a10 10 0 0 0 4-.8"/>
                                </svg>
                            </button>
                        </div>

                        @error('password')
                            <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div x-data="{ showConfirmation: false }">
                        <label for="password_confirmation" class="mb-2 block text-sm font-semibold">
                            Konfirmasi Password
                        </label>

                        <div class="relative">
                            <input
                                :type="showConfirmation ? 'text' : 'password'"
                                id="password_confirmation"
                                name="password_confirmation"
                                autocomplete="new-password"
                                {{ $isEdit ? '' : 'required' }}
                                placeholder="Ulangi password"
                                class="w-full rounded-xl border-slate-200 px-4 py-3 pr-12 text-sm focus:border-brand focus:ring-brand"
                            >

                            <button
                                type="button"
                                @click="showConfirmation = !showConfirmation"
                                :aria-label="showConfirmation ? 'Sembunyikan konfirmasi password' : 'Lihat konfirmasi password'"
                                class="absolute inset-y-0 right-0 flex items-center px-4 text-slate-400 transition hover:text-brand"
                            >
                                <svg
                                    x-show="!showConfirmation"
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="20"
                                    height="20"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                >
                                    <path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7-10-7-10-7Z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>

                                <svg
                                    x-show="showConfirmation"
                                    x-cloak
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="20"
                                    height="20"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                >
                                    <path d="m3 3 18 18"/>
                                    <path d="M10.6 10.6a2 2 0 0 0 2.8 2.8"/>
                                    <path d="M9.9 5.2A11 11 0 0 1 12 5c6.4 0 10 7 10 7a13 13 0 0 1-3 3.8"/>
                                    <path d="M6.2 6.2C3.5 8 2 12 2 12s3.6 7 10 7a10 10 0 0 0 4-.8"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                </div>

                <div class="rounded-xl bg-slate-50 px-4 py-3">
                    <p class="text-xs leading-5 text-slate-500">
                        Sistem akan menetapkan role akun sebagai fotografer secara otomatis.
                        Pengguna tidak dapat mengubah role melalui formulir ini.
                    </p>
                </div>

                <div class="flex justify-end gap-3 border-t border-slate-100 pt-5">
                    <a href="{{ route('admin.fotografer.index') }}"
                        class="rounded-xl border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">
                        Batal
                    </a>

                    <button
                        type="submit"
                        class="rounded-xl bg-brand px-5 py-3 text-sm font-semibold text-white transition hover:bg-brand-dark"
                    >
                        {{ $isEdit ? 'Simpan Perubahan' : 'Buat Akun Fotografer' }}
                    </button>
                </div>
            </form>
        </div>
    </main>

</body>
</html>
