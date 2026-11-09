<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fotografer | Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-50 text-gray-900 antialiased">

    <x-admin.sidebar />

    <main class="min-h-screen pl-64 p-8">
        <div class="max-w-6xl mx-auto space-y-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-xl font-bold">Verifikasi Fotografer</h1>
                    <p class="text-sm text-gray-500">Daftar akun fotografer yang mendaftar di Momenta.</p>
                </div>

                <form method="GET" class="flex gap-2">
                    <input type="search" name="search" value="{{ request('search') }}" placeholder="Cari fotografer..."
                           class="rounded-lg border-gray-300 text-sm px-3 py-1.5 focus:border-blue-600 focus:ring-blue-600">
                    <button type="submit" class="px-3 py-1.5 bg-gray-900 text-white text-sm rounded-lg hover:bg-gray-800">Cari</button>
                </form>
            </div>

            @if(session('success'))
                <div class="p-3 text-sm text-green-800 bg-green-50 border border-green-200 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-xs">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-500 text-xs uppercase border-b border-gray-200">
                        <tr>
                            <th class="px-4 py-3">Nama</th>
                            <th class="px-4 py-3">Kontak</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($fotografer as $item)
                            <tr class="hover:bg-gray-50/50 {{ $item->status_akun === 'pending' ? 'bg-amber-50/30' : '' }}">
                                <td class="px-4 py-3 font-medium text-gray-900">
                                    {{ $item->name }}
                                </td>
                                <td class="px-4 py-3 text-gray-500">
                                    {{ $item->email }}
                                    @if($item->no_hp)
                                        <span class="block text-xs text-gray-400">{{ $item->no_hp }}</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    @if($item->status_akun === 'pending')
                                        <span class="px-2 py-0.5 text-xs font-medium rounded-full bg-amber-100 text-amber-800">Menunggu</span>
                                    @elseif($item->status_akun === 'active')
                                        <span class="px-2 py-0.5 text-xs font-medium rounded-full bg-green-100 text-green-800">Aktif</span>
                                    @else
                                        <span class="px-2 py-0.5 text-xs font-medium rounded-full bg-red-100 text-red-800">Ditolak</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <div class="inline-flex items-center gap-1.5">
                                        @if($item->status_akun !== 'active')
                                            <form action="{{ route('admin.fotografer.accept', $item->user_id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="px-2.5 py-1 text-xs font-medium text-white bg-green-600 rounded-md hover:bg-green-700">Setujui</button>
                                            </form>
                                        @endif

                                        @if($item->status_akun !== 'rejected')
                                            <form action="{{ route('admin.fotografer.reject', $item->user_id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="px-2.5 py-1 text-xs font-medium text-amber-700 bg-amber-50 border border-amber-200 rounded-md hover:bg-amber-100">Tolak</button>
                                            </form>
                                        @endif

                                        <form action="{{ route('admin.fotografer.destroy', $item->user_id) }}" method="POST" onsubmit="return confirm('Hapus akun ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-2.5 py-1 text-xs font-medium text-red-600 hover:text-red-800">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-8 text-center text-gray-400">Belum ada akun fotografer.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div>
                {{ $fotografer->links() }}
            </div>
        </div>
    </main>

</body>
</html>
