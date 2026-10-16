
<div x-show="tab === 'booking'" x-cloak class="space-y-6">

    @php
        $upcomingSessions = \App\Models\Acara::with([
            'transaksi.customer',
            'transaksi.paket'
        ])
        ->whereHas('transaksi.paket', function ($query) {
            $query->where('fotografer_id', auth()->id());
        })
        ->orderBy('tanggal')
        ->get();
    @endphp

    {{-- Header --}}
    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold tracking-tight text-gray-900">
                Upcoming Sessions
            </h2>
        </div>

        <div class="inline-flex w-fit items-center gap-2 rounded-xl border border-gray-200 bg-white px-4 py-3 shadow-sm">
            <x-lucide-calendar-days class="h-5 w-5 text-blue-600" />
            <span class="text-sm text-gray-600">Total sesi</span>
            <span class="font-bold text-gray-900">
                {{ $upcomingSessions->count() }}
            </span>
        </div>
    </div>

    {{-- Daftar Sesi --}} 
    @forelse ($upcomingSessions as $session)
        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm transition hover:border-blue-200 hover:shadow-md">

            <div class="flex flex-col gap-5 p-5 sm:flex-row sm:items-start">

                {{-- Tanggal --}}
                <div class="flex h-24 w-full shrink-0 flex-row items-center gap-4 rounded-xl bg-blue-50 p-4 sm:h-28 sm:w-24 sm:flex-col sm:justify-center sm:gap-1 sm:text-center">
                    <x-lucide-calendar-days class="h-6 w-6 text-blue-600" />

                    <div>
                        <p class="text-2xl font-bold text-blue-700">
                            {{ $session->tanggal?->format('d') ?? '--' }}
                        </p>
                        <p class="text-sm font-medium text-blue-600">
                            {{ $session->tanggal?->translatedFormat('M Y') ?? '-' }}
                        </p>
                    </div>
                </div>

                {{-- Informasi --}}
                <div class="min-w-0 flex-1 space-y-3">

                    <div class="flex flex-wrap items-start justify-between gap-3">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">
                                {{ $session->judul }}
                            </h3>

                            <p class="mt-1 text-sm text-gray-500">
                                Booking #{{ $session->trans_id }}
                            </p>
                        </div>

                        @php
                            $statusStyle = match ($session->status) {
                                'upcoming' => 'bg-blue-50 text-blue-700 ring-blue-600/20',
                                'ongoing' => 'bg-amber-50 text-amber-700 ring-amber-600/20',
                                'completed' => 'bg-green-50 text-green-700 ring-green-600/20',
                                default => 'bg-gray-50 text-gray-600 ring-gray-500/20',
                            };
                        @endphp

                        <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold ring-1 ring-inset {{ $statusStyle }}">
                            {{ ucfirst($session->status) }}
                        </span>
                    </div>

                    <div class="grid grid-cols-1 gap-3 text-sm text-gray-600 sm:grid-cols-2">

                        <div class="flex items-center gap-2">
                            <x-lucide-user-round class="h-4 w-4 shrink-0 text-gray-400" />
                            <span>
                                {{ $session->transaksi->customer->name ?? 'Customer' }}
                            </span>
                        </div>

                        <div class="flex items-center gap-2">
                            <x-lucide-clock class="h-4 w-4 shrink-0 text-gray-400" />
                            <span>
                                {{ $session->jam ?? 'Jam belum ditentukan' }}
                            </span>
                        </div>

                        <div class="flex items-center gap-2">
                            <x-lucide-map-pin class="h-4 w-4 shrink-0 text-gray-400" />
                            <span class="break-words">
                                {{ $session->lokasi ?? 'Lokasi belum ditentukan' }}
                            </span>
                        </div>

                        <div class="flex items-center gap-2">
                            <x-lucide-package class="h-4 w-4 shrink-0 text-gray-400" />
                            <span>
                                {{ $session->transaksi->paket->judul ?? 'Paket' }}
                            </span>
                        </div>

                    </div>

                    @if ($session->deskripsi)
                        <p class="border-t border-gray-100 pt-3 text-sm leading-relaxed text-gray-500">
                            {{ $session->deskripsi }}
                        </p>
                        <div class="mt-4 flex justify-end border-t border-gray-100 pt-4">
                            <button
                                type="button"
                                onclick="document.getElementById('edit-acara-{{ $session->acara_id }}').classList.remove('hidden')"
                                class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700"
                            >
                                Edit Jadwal
                            </button>
                            
                        </div>
                    @endif
                </div>
            </div>
            
<div id="edit-acara-{{ $session->acara_id }}"
     class="hidden fixed inset-0 z-50 items-center justify-center bg-black/40 p-4">

    <div class="w-full max-w-md rounded-xl bg-white p-6">
        <h3 class="mb-4 text-lg font-semibold text-gray-900">
            Edit Jadwal Sesi
        </h3>

        <form action="{{ route('fotografer.acara.update', $session->acara_id) }}"
              method="POST"
              class="space-y-4">

            @csrf
            @method('PATCH')

            <div>
                <label class="mb-1 block text-sm text-gray-600">Tanggal</label>
                <input type="date" name="tanggal"
                       value="{{ $session->tanggal?->format('Y-m-d') }}"
                       required
                       class="w-full rounded-lg border border-gray-300 px-3 py-2">
            </div>

            <div>
                <label class="mb-1 block text-sm text-gray-600">Jam</label>
                <input type="time" name="jam"
                       value="{{ $session->jam ? substr($session->jam, 0, 5) : '' }}"
                       class="w-full rounded-lg border border-gray-300 px-3 py-2">
            </div>

            <div>
                <label class="mb-1 block text-sm text-gray-600">Lokasi</label>
                <input type="text" name="lokasi"
                       value="{{ $session->lokasi }}"
                       class="w-full rounded-lg border border-gray-300 px-3 py-2">
            </div>

            <div>
                <label class="mb-1 block text-sm text-gray-600">Status</label>
                <select name="status" required
                        class="w-full rounded-lg border border-gray-300 px-3 py-2">
                    <option value="upcoming" @selected($session->status === 'upcoming')>Upcoming</option>
                    <option value="ongoing" @selected($session->status === 'ongoing')>Ongoing</option>
                    <option value="completed" @selected($session->status === 'completed')>Completed</option>
                </select>
            </div>

            <div class="flex justify-end gap-2">
                <button type="button"
                        onclick="document.getElementById('edit-acara-{{ $session->acara_id }}').classList.add('hidden')"
                        class="rounded-lg border px-4 py-2 text-sm">
                    Batal
                </button>

                <button type="submit"
                        class="rounded-lg bg-blue-600 px-4 py-2 text-sm text-white hover:bg-blue-700">
                    Simpan
                </button>
            </div>
        </form>

        <form action="{{ route('fotografer.acara.destroy', $session->acara_id) }}"
              method="POST" class="mt-3"
              onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">
            @csrf
            @method('DELETE')

            <button type="submit"
                    class="text-sm text-red-600 hover:text-red-700">
                Hapus Jadwal
            </button>
        </form>
    </div>
</div>

    @empty
        <div class="rounded-2xl border border-dashed border-gray-300 bg-white px-6 py-14 text-center">
            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-50">
                <x-lucide-calendar-days class="h-7 w-7 text-blue-600" />
            </div>

            <h3 class="mt-4 font-semibold text-gray-900">
                Belum ada jadwal sesi
            </h3>

            <p class="mx-auto mt-2 max-w-sm text-sm text-gray-500">
                Booking dari customer akan muncul di sini setelah terhubung dengan paket fotografer kamu.
            </p>
        </div>
    @endforelse

</div>