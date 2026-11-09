<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Booking</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-900 font-sans">

    <x-navbar />

    <div class="max-w-6xl mx-auto p-5 md:p-6">
        <x-booking-steps :step="1" />

        <div
            class="flex flex-col md:flex-row gap-5 items-start"
            x-data="bookingForm({
                fotograferId: @js($fid),
                pakets: @js($pakets),
                checkUrl: @js(route('booking.availability.check')),
                initialPackage: @js(request('paket') ? (string) request('paket') : '')
            })"
        >
            <div class="w-full md:w-2/3 bg-white border border-gray-200 rounded-xl p-5 md:p-6">
                <div class="pb-3 border-b border-gray-200 mb-4">
                    <h1 class="font-bold text-xl text-gray-800">Booking Session</h1>
                    <p class="text-xs text-gray-400 mt-1">Isi detail sesi pemotretan Anda</p>
                </div>

                <form action="{{ route('booking.create') }}" method="POST" class="flex flex-col gap-3">
                    @csrf

                    <input name="fotografer_id" value="{{ $fid }}" type="hidden">

                    <div class="flex flex-col gap-1">
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Event Name</label>
                        <input name="judul_acara" type="text" required maxlength="255"
                            placeholder="Acara Sekolah / Wisuda"
                            class="py-2.5 px-3.5 w-full border border-gray-200 rounded-lg text-sm focus:border-[#1447E6] focus:ring-[#1447E6]">
                    </div>

                    <div class="flex flex-col gap-1">
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Select Package</label>
                        <select name="paket_id" x-model="selectedPackage"
                            @change="checkAvailability()"
                            required
                            class="py-2.5 px-3.5 w-full border border-gray-200 rounded-lg text-sm focus:border-[#1447E6] focus:ring-[#1447E6]">
                            @foreach($pakets as $paket)
                                <option value="{{ $paket->paket_id }}">
                                    {{ $paket->judul }} - {{ Number::currency($paket->harga, in: 'IDR', locale: 'id') }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div x-show="currentPackage" class="rounded-xl border border-gray-200 bg-gray-50/70 p-4 text-xs">
                        <div class="flex items-start justify-between gap-3 border-b border-gray-200/70 pb-3">
                            <div>
                                <h3 class="font-bold text-sm text-gray-900" x-text="currentPackage?.judul"></h3>
                                <p class="mt-1 text-gray-500 line-clamp-2 leading-relaxed" x-show="currentPackage?.deskripsi" x-text="currentPackage?.deskripsi"></p>
                            </div>
                            <span class="shrink-0 font-bold text-sm text-[#1447E6]" x-text="'Rp ' + formatPrice()"></span>
                        </div>

                        <div class="mt-3 grid grid-cols-2 gap-2 sm:grid-cols-4">
                            <div class="rounded-lg border border-gray-200 bg-white p-2.5">
                                <span class="block text-[10px] font-semibold text-gray-400 uppercase tracking-wider">Durasi</span>
                                <span class="mt-0.5 block font-bold text-gray-800" x-text="currentPackage?.durasi || '-'"></span>
                            </div>
                            <div class="rounded-lg border border-gray-200 bg-white p-2.5">
                                <span class="block text-[10px] font-semibold text-gray-400 uppercase tracking-wider">Jumlah Foto</span>
                                <span class="mt-0.5 block font-bold text-gray-800" x-text="currentPackage?.jumlah_foto || '-'"></span>
                            </div>
                            <div class="rounded-lg border border-gray-200 bg-white p-2.5">
                                <span class="block text-[10px] font-semibold text-gray-400 uppercase tracking-wider">Fotografer</span>
                                <span class="mt-0.5 block font-bold text-gray-800" x-text="currentPackage?.jumlah_fotografer || '-'"></span>
                            </div>
                            <div class="rounded-lg border border-gray-200 bg-white p-2.5">
                                <span class="block text-[10px] font-semibold text-gray-400 uppercase tracking-wider">Galeri Online</span>
                                <span class="mt-0.5 block font-bold text-gray-800" x-text="currentPackage?.durasi_galeri || '-'"></span>
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-3">
                        <div class="flex flex-col gap-1 w-1/2">
                            <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Date</label>
                            <input name="tanggal" type="date" x-model="tanggal"
                                @change="checkAvailability()"
                                min="{{ now()->toDateString() }}"
                                required
                                class="py-2.5 px-3.5 w-full border border-gray-200 rounded-lg text-sm focus:border-[#1447E6] focus:ring-[#1447E6]">
                        </div>

                        <div class="flex flex-col gap-1 w-1/2">
                            <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Start Time</label>
                            <input name="jam" type="time" x-model="jam"
                                @change="checkAvailability()"
                                required
                                class="py-2.5 px-3.5 w-full border border-gray-200 rounded-lg text-sm focus:border-[#1447E6] focus:ring-[#1447E6]">
                        </div>
                    </div>

                    <div class="flex flex-col gap-1">
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Meeting Point</label>
                        <input name="lokasi" type="text" required maxlength="255"
                            placeholder="Lokasi Sesi Foto"
                            class="py-2.5 px-3.5 w-full border border-gray-200 rounded-lg text-sm focus:border-[#1447E6] focus:ring-[#1447E6]">
                    </div>

                    <div class="flex flex-col gap-1">
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Description</label>
                        <textarea name="deskripsi" rows="3"
                            placeholder="Deskripsi Acara..."
                            class="py-2.5 px-3.5 w-full border border-gray-200 rounded-lg text-sm focus:border-[#1447E6] focus:ring-[#1447E6]"></textarea>
                    </div>

                    <button type="submit"
                        :disabled="loading || !checked || !tersedia"
                        class="py-3 px-4 w-full text-sm font-semibold rounded-lg bg-[#1447E6] text-white hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed mt-1">
                        Continue to Payment
                    </button>
                </form>
            </div>

            <div class="w-full md:w-1/3">
                <div class="bg-white border border-gray-200 rounded-xl p-4 shadow-sm">
                    <h2 class="text-lg font-bold text-gray-900">Booking Summary</h2>

                    <div class="mt-3 space-y-2.5 text-sm">
                        <div class="flex justify-between items-center gap-3">
                            <span class="text-gray-500">Status</span>
                            <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-blue-50 text-[#1447E6]">Pending</span>
                        </div>

                        <div class="flex justify-between gap-3">
                            <span class="text-gray-500">Fotografer</span>
                            <span class="font-medium text-gray-800 text-right">{{ $fname }}</span>
                        </div>

                        <div class="flex justify-between gap-3">
                            <span class="text-gray-500">Paket</span>
                            <span class="font-medium text-gray-800 text-right" x-text="currentPackage ? currentPackage.judul : '-'"></span>
                        </div>

                        <div class="flex justify-between gap-3">
                            <span class="text-gray-500">Durasi</span>
                            <span class="font-medium text-gray-800" x-text="currentPackage ? currentPackage.durasi : '-'"></span>
                        </div>

                        <div class="flex justify-between gap-3" x-show="currentPackage?.jumlah_foto">
                            <span class="text-gray-500">Jumlah Foto</span>
                            <span class="font-medium text-gray-800 text-right" x-text="currentPackage?.jumlah_foto"></span>
                        </div>

                        <div class="flex justify-between gap-3" x-show="currentPackage?.jumlah_fotografer">
                            <span class="text-gray-500">Fotografer</span>
                            <span class="font-medium text-gray-800 text-right" x-text="currentPackage?.jumlah_fotografer"></span>
                        </div>

                        <div class="flex justify-between gap-3" x-show="currentPackage?.durasi_galeri">
                            <span class="text-gray-500">Durasi Galeri</span>
                            <span class="font-medium text-gray-800 text-right" x-text="currentPackage?.durasi_galeri"></span>
                        </div>
                    </div>

                    <div class="mt-3 border-t border-gray-100 pt-3 flex justify-between items-center">
                        <span class="text-sm font-semibold text-gray-700">Total Price</span>
                        <span class="text-lg font-bold text-[#1447E6]" x-text="'Rp ' + formatPrice()"></span>
                    </div>

                    <div class="mt-4 border-t border-gray-100 pt-3">
                        <h3 class="text-sm font-bold text-gray-900">Jadwal Fotografer</h3>

                        <div class="mt-2.5 space-y-2 text-sm">
                            <div class="flex justify-between gap-3">
                                <span class="text-gray-500">Tanggal</span>
                                <span class="font-medium text-gray-800" x-text="tanggal || '-'"></span>
                            </div>

                            <div class="flex justify-between gap-3">
                                <span class="text-gray-500">Jam Mulai</span>
                                <span class="font-medium text-gray-800" x-text="jam || '--:--'"></span>
                            </div>

                            <div class="flex justify-between gap-3">
                                <span class="text-gray-500">Jam Selesai</span>
                                <span class="font-medium text-gray-800" x-text="jamSelesai || '--:--'"></span>
                            </div>
                        </div>

                        <div class="mt-3 rounded-lg px-3 py-2 text-xs"
                            :class="{
                                'bg-gray-50 text-gray-500': !checked && !loading,
                                'bg-blue-50 text-blue-700': loading,
                                'bg-green-50 text-green-700': checked && tersedia,
                                'bg-red-50 text-red-700': checked && !tersedia
                            }"
                            x-text="loading ? 'Memeriksa jadwal...' : checked ? message : 'Pilih tanggal dan jam untuk memeriksa jadwal.'">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>