<div x-show="tab === 'booking'" x-data="{modalConfirm: false}">
    <div :class="section  ? 'hidden' : ''">
        <div class="flex flex-col my-3 mb-4">
            <span class="text-2xl font-semibold">My Booking</span>
            <span class="text-gray-500">Manage All Your Sessions</span>
        </div>

        @foreach(\App\Models\Transaksi::with('acara', 'paket')->where('customer_id', Auth::id())->get() as $transaksi)
            @if($transaksi->acara)
                @php($acara = $transaksi->acara)

                <div @click="section = 'booking-{{$acara->acara_id}}'"
                     :class="section ? 'hidden': ''"
                     class="w-full rounded-lg border border-gray-200 shadow-sm p-4 cursor-pointer">
                    <div class="flex items-center justify-between pb-3 mb-3 border-b border-gray-100">
                        <div class="flex items-center gap-2">
                            <x-lucide-calendar-1 class="w-5 h-5" />
                            <span class="font-semibold">Booking</span>
                            <span class="text-gray-400 text-sm">ID Booking:</span>
                            <span class="text-gray-500 text-sm">#{{ $acara->acara_id }}</span>
                        </div>
                        <span class="text-gray-400 text-sm">{{ $acara->tanggal->translatedFormat('d M Y') }}</span>
                    </div>

                    <div class="flex items-start gap-4">
                        <img class="rounded-lg w-25 h-25" src="https://picsum.photos/150/150" alt="gambar">

                        <div class="flex-1">
                            <div class="flex items-start justify-between">
                                <h1 class="font-semibold text-lg">{{ $acara->judul }}</h1>
                                <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-medium">
                                    {{ ucfirst($acara->status) }}
                                </span>
                            </div>

                            <div class="flex items-center gap-6 mt-2 text-sm text-gray-600">
                                <span class="flex items-center gap-1">
                                    <x-lucide-circle-dollar-sign class="w-4 h-4 rounded-full" />
                                    Harga: Rp {{ number_format($transaksi->paket->harga ?? 0, 0, ',', '.') }}
                                </span>
                                <span class="flex items-center gap-1">
                                    <x-lucide-package-2 class="w-4 h-4 rounded-full" />
                                    Paket: {{ $transaksi->paket->judul ?? '-' }}
                                </span>
                            </div>

                            <div class="flex items-center gap-2 mt-3">
                                <x-lucide-user class="w-6 h-6 rounded-full" />
                                <span class="text-sm text-gray-600">{{ $transaksi->paket->fotografer->name ?? '-' }} - Fotografer</span>
                            </div>
                        </div>
                    </div>
                </div>

    </div>



    <div x-show="section === 'booking-{{$acara->acara_id}}' ">
        <div class="flex justify-between">
            <div class="flex items-center gap-2">
                <div @click="section = ''"
                     class="border border-gray-200 flex items-center justify-center shadow w-12 h-12 rounded-full cursor-pointer">
                    <x-lucide-arrow-left class="w-6 h-6" />
                </div>

                <div class="flex flex-col">
                    <span class="flex-row text-xl font-semibold">Manage Booking</span>
                    <span class="text-xs text-gray-400">ID Booking: #{{$acara->acara_id}}</span>
                </div>
            </div>
            <div class="mr-5">
                <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-medium">
                    {{ ucfirst($acara->status) }}
                </span>
            </div>
        </div>

        <div class="items-start gap-4 p-5 flex flex-row">
            <div class="w-full">
                <div class="flex items-center flex-row w-full mt-2 p-3 border border-gray-200 shadow rounded-xl">
                    <div class="text-white text-2xl w-17 h-17 flex items-center justify-center shadow rounded-full bg-primary">
                        {{ substr($transaksi->paket->fotografer->name,0,1)}}
                    </div>
                    <div class="ml-3 flex-1">
                        <h1 class="text-blue-500 font-semibold">Your Fotografer</h1>
                        <h1 class="font-bold text-xl">{{ $transaksi->paket->fotografer->name ?? '-' }}</h1>
                    </div>
                </div>

                <div class="rounded-xl p-3 mt-3 border border-gray-200 shadow">
                    <div class="pb-3 border-b border-b-black/20">
                        <h1 class="font-bold text-xl">Session Schedule & Location</h1>
                    </div>

                    <div class="flex flex-col m-2 gap-3">
                        <div class="flex gap-2 mt-2">
                            <div class="text-primary-500 bg-primary/15 w-fit border-gray-200 shadow h-fit p-2 rounded-full">
                                <x-lucide-calendar class="w-6 h-6" />
                            </div>
                            <div>
                                <h5 class="text-xs font-semibold text-gray-500">Date</h5>
                                <h1 class="font-semibold">{{$acara->tanggal->translatedFormat('l, d M Y')}}</h1>
                            </div>
                        </div>

                        <div class="flex gap-2">
                            <div class="text-primary-500 bg-primary/15 w-fit border-gray-200 shadow h-fit p-2 rounded-full">
                                <x-lucide-pin class="w-6 h-6" />
                            </div>
                            <div>
                                <h5 class="text-xs font-semibold text-gray-500">Meeting Point</h5>
                                <h1 class="font-semibold">{{$acara->lokasi}}</h1>
                            </div>
                        </div>

                        <div id="map" style="height: 400px" class="map rounded-xl w-full"></div>
                        <script>
                            document.addEventListener('DOMContentLoaded', () => {
                                fetch('/get-coordinates', {
                                    method: 'POST',
                                    headers: { 'Content-Type': 'application/json' },
                                    body: JSON.stringify({ address: "{{$acara->lokasi}}" })
                                })
                                    .then(res => res.json())
                                    .then(data => {
                                        console.log(data);
                                        const lat = parseFloat(data.latitude);
                                        const lng = parseFloat(data.longitude);

                                        var map = L.map('map').setView([lat, lng], 13);

                                        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                                        }).addTo(map);


                                    })
                                    .catch(err => console.error(err));
                            });
                        </script>
                    </div>
                </div>
            </div>

            <div class="w-full flex flex-col">
                <div class="bg-[#123ABB] mt-2 p-5 border border-gray-200 shadow rounded-xl">
                    <div class="flex justify-between">
                        <h1 class="text-amber-300 font-semibold">Selected Package</h1>
                        <span class="px-3 py-1 rounded-full bg-white/20 text-white text-xs font-medium">
                            {{ucfirst($transaksi->status)}}
                        </span>
                    </div>

                    <div class="text-white border-b border-b-white/15 pb-2">
                        <h1 class="font-bold mt-2 text-xl">{{$transaksi->paket->judul}}</h1>
                        <h2 class="text-gray-300 text-sm">{{$transaksi->paket->deskripsi}}</h2>
                    </div>

                    <div class="text-white flex justify-between mt-2">
                        <h1 class="text-gray-300 text-sm">Total Harga</h1>
                        <h1 class="text-xl font-bold">Rp {{ number_format($transaksi->paket->harga ?? 0, 0, ',', '.') }}</h1>
                    </div>
                </div>

                <div class="mt-3 border border-gray-200 shadow rounded-xl p-4">
                    <h1 class="text-xl font-semibold">Description</h1>
                    <p class="mt-1 text-gray-500">
                        {{$acara->deskripsi}}
                    </p>
                </div>

                <div class="flex flex-col mt-3 gap-2">
                    <button type="button" class="text-center py-3 px-full items-center gap-x-2 text-sm font-medium rounded-lg bg-primary border border-primary-line text-primary-foreground hover:bg-primary-hover focus:outline-hidden focus:bg-primary-focus disabled:opacity-50 disabled:pointer-events-none">
                        Contact
                    </button>
                    <button @click="modalConfirm = true"
                        type="button" class="text-red-400 text-center py-3 px-full border-red-400 items-center gap-x-2 text-sm font-medium rounded-lg border hover:border-red-600 hover:text-red-600 focus:outline-hidden focus:text-red-400 disabled:opacity-50 disabled:pointer-events-none">
                        Cancel Booking
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
    @endforeach
    <div x-show="modalConfirm"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @keydown.escape.window="modalConfirm = false"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm"
         x-cloak>
        <div @click.away="modalConfirm = false" class="relative max-w-md w-full bg-white rounded-2xl overflow-hidden shadow-2xl p-6 flex flex-col">
            <button @click="modalConfirm = false" type="button" class="absolute top-4 right-4 z-10 p-2 text-gray-400 hover:text-gray-600 transition-colors">
                <x-lucide-x class="w-5 h-5" />
            </button>

            <div class="flex items-center gap-3 text-red-500 mb-3">
                <x-lucide-alert-triangle class="w-6 h-6 shrink-0" />
                <h3 class="text-lg font-bold text-gray-900">Cancel Booking</h3>
            </div>

            <p class="text-sm text-gray-600 mb-6">
                Are you sure you want to Cancel your Booking? All of your photo will be permanently removed. This action cannot be undone.
            </p>

            <form action="" method="POST" class="flex justify-end gap-3">
                @csrf
                @method('DELETE')
                <button type="button" @click="modalConfirm = false"
                        class="py-2 px-4 text-sm font-medium rounded-lg border border-gray-200 text-gray-700 hover:bg-gray-50 focus:outline-hidden">
                    Cancel
                </button>
                <button type="submit"
                        class="py-2 px-4 text-sm font-medium rounded-lg bg-red-600 text-white hover:bg-red-700 focus:outline-hidden">
                    Confirm Cancel
                </button>
            </form>
        </div>
    </div>
</div>
