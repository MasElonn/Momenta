
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

<div x-show="tab === 'booking'" x-cloak class="space-y-6">

    {{-- HEADER --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">
                Upcoming Sessions
            </h1>
        </div>

        <div class="flex items-center gap-2 rounded-xl border border-gray-200 bg-white px-4 py-3 shadow-sm">
            <x-lucide-calendar class="h-5 w-5 text-blue-600" />
            <span class="text-sm text-gray-600">Total sesi</span>
            <span class="font-semibold text-gray-900">
                {{ $upcomingSessions->count() }}
            </span>
        </div>
    </div>

    {{-- GRID BOOKING --}}
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3">

        @forelse ($upcomingSessions as $session)

            @php
                $customer = $session->transaksi?->customer;
                $paket = $session->transaksi?->paket;

                $statusClass = match ($session->status) {
                    'upcoming' => 'border-blue-200 bg-blue-50 text-blue-600',
                    'ongoing' => 'border-yellow-200 bg-yellow-50 text-yellow-600',
                    'completed' => 'border-green-200 bg-green-50 text-green-600',
                    default => 'border-gray-200 bg-gray-50 text-gray-600',
                };
            @endphp

            <div
                x-data="{
                    openEdit: false,
                    expanded: false
                }"
                class="flex flex-col rounded-xl border border-gray-200 bg-white p-4 shadow-sm transition hover:border-blue-300 hover:shadow-md"
            >

                {{-- INFORMASI UTAMA --}}
                <div class="flex items-start gap-3">

                    {{-- TANGGAL --}}
                    <div class="flex h-20 w-20 shrink-0 flex-col items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                        <x-lucide-calendar class="h-5 w-5" />

                        <span class="mt-1 text-xl font-bold leading-none">
                            {{ $session->tanggal?->format('d') ?? '-' }}
                        </span>

                        <span class="mt-1 text-xs">
                            {{ $session->tanggal?->translatedFormat('M Y') ?? '-' }}
                        </span>
                    </div>

                    {{-- JUDUL, LOKASI DAN CUSTOMER --}}
                    <div class="min-w-0 flex-1">

                        <h2 class="truncate font-semibold text-gray-900">
                            {{ $session->judul }}
                        </h2>

                        <div class="mt-3 grid grid-cols-2 gap-3 text-sm text-gray-500">

                            {{-- LOKASI --}}
                            <div class="flex min-w-0 items-center gap-2">
                                <x-lucide-map-pin class="h-4 w-4 shrink-0" />
                                <span class="truncate">
                                    {{ $session->lokasi ?? '-' }}
                                </span>
                            </div>

                            {{-- CUSTOMER --}}
                            <div class="flex min-w-0 items-center gap-2">
                                <x-lucide-user class="h-4 w-4 shrink-0" />
                                <span class="truncate">
                                    {{ $customer->nama ?? 'Customer' }}
                                </span>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- JAM DAN PAKET --}}
                <div class="mt-4 grid grid-cols-2 gap-3 border-t border-gray-100 pt-3 text-sm text-gray-500">

                    {{-- JAM --}}
                    <div class="flex min-w-0 items-center gap-2">
                        <x-lucide-clock class="h-4 w-4 shrink-0" />
                        <span>{{ $session->jam ?? '-' }}</span>
                    </div>

                    {{-- PAKET --}}
                    <div class="flex min-w-0 items-center gap-2">
                        <x-lucide-package class="h-4 w-4 shrink-0" />
                        <span class="truncate">
                            {{ $paket->judul ?? '-' }}
                        </span>
                    </div>

                </div>

                {{-- DESKRIPSI ACCORDION --}}
                <div class="mt-3 border-t border-gray-100 pt-3">

                    <button
                        type="button"
                        @click="expanded = !expanded"
                        :aria-expanded="expanded"
                        class="flex w-full items-start justify-between gap-3 text-left"
                    >

                        <div class="min-w-0 flex-1">
                            <p
                                class="break-words text-sm text-gray-500"
                                :class="expanded ? 'whitespace-pre-line' : 'line-clamp-2'"
                            >
                                {{ $session->deskripsi ?: 'Tidak ada deskripsi acara.' }}
                            </p>

                            <span
                                class="mt-2 block text-xs font-medium text-blue-600"
                                x-text="expanded ? 'Tutup deskripsi' : 'Lihat selengkapnya'"
                            ></span>

                        </div>

                        <div class="shrink-0 rounded-full p-2 text-blue-600 transition hover:bg-blue-50">

                            <x-lucide-chevron-down
                                x-show="!expanded"
                                class="h-4 w-4"
                            />

                            <x-lucide-chevron-up
                                x-show="expanded"
                                x-cloak
                                class="h-4 w-4"
                            />

                        </div>

                    </button>

                </div>

                {{-- STATUS DAN TOMBOL --}}
                <div class="mt-auto mt-4 flex items-center gap-2 border-t border-gray-100 pt-4">

                    {{-- STATUS --}}
                    <span class="inline-flex shrink-0 rounded-full border px-3 py-1 text-xs font-medium {{ $statusClass }}">
                        {{ ucfirst($session->status ?? 'upcoming') }}
                    </span>

                    <div class="ml-auto flex min-w-0 flex-1 items-center gap-2">

                        {{-- EDIT --}}
                        <button
                            type="button"
                            @click="openEdit = true"
                            class="inline-flex flex-1 items-center justify-center gap-2 rounded-lg bg-blue-600 px-2 py-2 text-sm font-medium text-white transition hover:bg-blue-700"
                        >
                            <x-lucide-pencil class="h-4 w-4 shrink-0" />
                            Edit
                        </button>

                        {{-- HAPUS DENGAN SWEETALERT --}}
                        <form
                            action="{{ route('fotografer.acara.destroy', $session->acara_id) }}"
                            method="POST"
                            class="flex flex-1 delete-form"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="inline-flex w-full items-center justify-center gap-2 rounded-lg border border-red-200 px-2 py-2 text-sm font-medium text-red-600 transition hover:bg-red-50"
                            >
                                <x-lucide-trash-2 class="h-4 w-4 shrink-0" />
                                Hapus
                            </button>
                        </form>

                    </div>
                </div>

                {{-- MODAL EDIT --}}
                <div
                    x-show="openEdit"
                    x-cloak
                    x-transition.opacity
                    class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4"
                    @click.self="openEdit = false"
                    @keydown.escape.window="openEdit = false"
                >

                    <div
                        class="w-full max-w-lg rounded-2xl bg-white p-6 shadow-xl"
                        @click.stop
                    >

                        {{-- HEADER MODAL --}}
                        <div class="mb-5 flex items-center justify-between">

                            <div>
                                <h2 class="text-lg font-semibold text-gray-900">
                                    Edit Jadwal Acara
                                </h2>
                            </div>

                            <button
                                type="button"
                                @click="openEdit = false"
                                class="text-gray-400 transition hover:text-gray-700"
                            >
                                <x-lucide-x class="h-5 w-5" />
                            </button>

                        </div>

                        {{-- FORM EDIT --}}
                        <form
                            action="{{ route('fotografer.acara.update', $session->acara_id) }}"
                            method="POST"
                            class="space-y-4"
                        >
                            @csrf
                            @method('PATCH')

                            {{-- TANGGAL --}}
                            <div>
                                <label class="mb-1 block text-sm font-medium text-gray-700">
                                    Tanggal Acara
                                </label>

                                <input
                                    type="date"
                                    name="tanggal"
                                    value="{{ $session->tanggal?->format('Y-m-d') }}"
                                    required
                                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                                >
                            </div>

                            {{-- JAM --}}
                            <div>
                                <label class="mb-1 block text-sm font-medium text-gray-700">
                                    Jam Acara
                                </label>

                                <input
                                    type="time"
                                    name="jam"
                                    value="{{ $session->jam ? substr($session->jam, 0, 5) : '' }}"
                                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                                >
                            </div>

                            {{-- LOKASI --}}
                            <div>
                                <label class="mb-1 block text-sm font-medium text-gray-700">
                                    Lokasi Acara
                                </label>

                                <input
                                    type="text"
                                    name="lokasi"
                                    value="{{ $session->lokasi }}"
                                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                                >
                            </div>

                            {{-- STATUS --}}
                            <div>
                                <label class="mb-1 block text-sm font-medium text-gray-700">
                                    Status Acara
                                </label>

                                <select
                                    name="status"
                                    required
                                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                                >
                                    <option value="upcoming" @selected($session->status === 'upcoming')>
                                        Upcoming
                                    </option>

                                    <option value="ongoing" @selected($session->status === 'ongoing')>
                                        Ongoing
                                    </option>

                                    <option value="completed" @selected($session->status === 'completed')>
                                        Completed
                                    </option>
                                </select>
                            </div>

                            {{-- TOMBOL MODAL --}}
                            <div class="flex items-center justify-end gap-3 border-t border-gray-100 pt-4">

                                <button
                                    type="button"
                                    @click="openEdit = false"
                                    class="rounded-lg border border-gray-300 px-5 py-3 text-sm font-medium text-gray-700 transition hover:bg-gray-50"
                                >
                                    Batal
                                </button>

                                <button
                                    type="submit"
                                    class="rounded-lg bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700"
                                >
                                    Simpan
                                </button>

                            </div>

                        </form>

                    </div>
                </div>

            </div>

        @empty

            {{-- BELUM ADA BOOKING --}}
            <div class="rounded-xl border border-dashed border-gray-300 bg-white px-6 py-12 text-center md:col-span-2 xl:col-span-3">

                <x-lucide-calendar class="mx-auto h-10 w-10 text-gray-400" />

                <h2 class="mt-3 font-medium text-gray-900">
                    Belum ada booking
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Booking acara akan muncul di sini.
                </p>

            </div>

        @endforelse

    </div>
</div>

{{-- ========================================= --}}
{{-- SWEETALERT2 --}}
{{-- ========================================= --}}

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    // KONFIRMASI SEBELUM HAPUS
    document.querySelectorAll('.delete-form').forEach(form => {

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            Swal.fire({
                title: "apakah ingin dihapus?",
                text: "Anda tidak dapat mengembalikan data yang sudah dihapus!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "hapus!",
                cancelButtonText: "Batal",
                reverseButtons: true
            }).then((result) => {

                if (result.isConfirmed) {
                    form.submit();
                }

            });
        });

    });

    // NOTIFIKASI BERHASIL
    @if (session('success'))
        Swal.fire({
            title: "Success!",
            text: @json(session('success')),
            icon: "success",
            confirmButtonColor: "#3085d6"
        });
    @endif

    // NOTIFIKASI ERROR
    @if (session('error'))
        Swal.fire({
            title: "Error!",
            text: @json(session('error')),
            icon: "error",
            confirmButtonColor: "#d33"
        });
    @endif

});
</script>
