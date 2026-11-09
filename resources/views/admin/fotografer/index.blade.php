<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Fotografer | Momenta Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-page text-ink antialiased">

    <x-admin.sidebar />

    <main class="min-h-screen pl-64">
        <header class="flex h-20 items-center justify-between border-b border-slate-200 bg-white px-9">
            <div>
                <p class="text-xs text-ink-soft">Admin / Manajemen</p>
                <h1 class="mt-1 text-lg font-semibold">Manajemen Fotografer</h1>
            </div>

            <a href="{{ route('admin.fotografer.create') }}"
                class="inline-flex items-center gap-2 rounded-xl bg-brand px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-brand-dark">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 5v14M5 12h14"/>
                </svg>
                Tambah Fotografer
            </a>
        </header>

        <div class="mx-auto max-w-7xl space-y-7 px-9 py-9">

            <section>
                <p class="text-sm text-ink-soft">Kelola akun fotografer yang terdaftar di Momenta.</p>

                <div class="mt-6 max-w-xs rounded-2xl border border-slate-200 bg-white p-5">
                    <p class="text-sm font-medium text-ink-soft">Total Fotografer</p>
                    <div class="mt-3 flex items-end justify-between">
                        <h2 class="text-4xl font-semibold tracking-tight">{{ $totalFotografer }}</h2>
                        <span class="rounded-lg bg-brand-soft px-2.5 py-1 text-xs font-semibold text-brand">
                            Akun
                        </span>
                    </div>
                </div>
            </section>

            @if (session('success'))
                <div class="rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                    {{ session('error') }}
                </div>
            @endif

            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white">
                <div class="flex flex-wrap items-center justify-between gap-4 border-b border-slate-100 px-6 py-5">
                    <div>
                        <h2 class="font-semibold">Daftar Fotografer</h2>
                        <p class="mt-1 text-xs text-ink-soft">Informasi akun fotografer Momenta.</p>
                    </div>

                    <form action="{{ route('admin.fotografer.index') }}" method="GET" class="flex gap-2">
                        <input
                            type="search"
                            name="search"
                            value="{{ $search }}"
                            placeholder="Cari nama atau email..."
                            class="w-64 rounded-xl border-slate-200 text-sm focus:border-brand focus:ring-brand"
                        >
                        <button type="submit"
                            class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-medium transition hover:bg-slate-50">
                            Cari
                        </button>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500">
                            <tr>
                                <th class="px-6 py-4 font-semibold">Fotografer</th>
                                <th class="px-6 py-4 font-semibold">Email</th>
                                <th class="px-6 py-4 font-semibold">Role</th>
                                <th class="px-6 py-4 text-right font-semibold">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100">
                            @forelse ($fotografer as $item)
                                <tr class="transition hover:bg-slate-50/70">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-brand-soft font-semibold text-brand">
                                                {{ strtoupper(substr($item->name, 0, 1)) }}
                                            </div>
                                            <span class="font-semibold text-ink">{{ $item->name }}</span>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 text-slate-600">
                                        {{ $item->email }}
                                    </td>

                                    <td class="px-6 py-4">
                                        <span class="rounded-lg bg-blue-50 px-2.5 py-1 text-xs font-medium text-blue-700">
                                            Fotografer
                                        </span>
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('admin.fotografer.edit', $item->user_id) }}"
                                                class="rounded-lg border border-slate-200 px-3 py-2 text-xs font-semibold text-slate-600 transition hover:border-brand hover:text-brand">
                                                Edit
                                            </a>

                                            <form action="{{ route('admin.fotografer.destroy', $item->user_id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus akun fotografer ini?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="rounded-lg border border-red-100 px-3 py-2 text-xs font-semibold text-red-600 transition hover:bg-red-50">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-16 text-center">
                                        <p class="font-medium text-slate-600">Belum ada fotografer.</p>
                                        <p class="mt-1 text-xs text-slate-400">Tambahkan akun fotografer untuk mulai mengelola data.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="border-t border-slate-100 px-6 py-4">
                    {{ $fotografer->links() }}
                </div>
            </section>
        </div>
    </main>

</body>
</html>