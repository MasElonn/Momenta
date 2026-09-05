<div x-show="tab === 'booking'">
    <div :class="section === 'booking' ? 'hidden' : ''">
        <div class="flex flex-col my-3 mb-4">
            <span class="text-2xl font-semibold">My Booking</span>
            <span class="text-gray-500">Manage All Your Sessions</span>
        </div>

        <div @click="section = 'booking'"
             :class="section === 'booking' ? 'hidden' : ''"
             class="w-full rounded-lg border border-gray-200 shadow-sm p-4 cursor-pointer">

            <div class="flex items-center justify-between pb-3 mb-3 border-b border-gray-100">
                <div class="flex items-center gap-2">
                    <x-lucide-calendar-1 class="w-5 h-5" />
                    <span class="font-semibold">Booking</span>
                    <span class="text-gray-400 text-sm">ID Booking:</span>
                    <span class="text-gray-500 text-sm">1234567</span>
                </div>
                <span class="text-gray-400 text-sm">31 Des 2024</span>
            </div>

            <div class="flex items-start gap-4">
                <img class="rounded-lg w-25 h-25" src="https://picsum.photos/150/150" alt="gambar">

                <div class="flex-1">
                    <div class="flex items-start justify-between">
                        <h1 class="font-semibold text-lg">Fotoshoot Perpisahan SMP</h1>
                        <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-medium">
                            Upcoming
                        </span>
                    </div>

                    <div class="flex items-center gap-6 mt-2 text-sm text-gray-600">
                        <span class="flex items-center gap-1">
                            <x-lucide-circle-dollar-sign class="w-4 h-4 rounded-full" />
                            Harga: Rp 145000
                        </span>

                        <span class="flex items-center gap-1">
                            <x-lucide-package-2 class="w-4 h-4 rounded-full" />
                            Paket: Standard
                        </span>
                    </div>

                    <div class="flex items-center gap-2 mt-3">
                        <x-lucide-user class="w-6 h-6 rounded-full" />
                        <span class="text-sm text-gray-600">iwan - Fotografer</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div x-show="section === 'booking'">
        <div class="flex justify-between">
            <div class="flex items-center gap-2">
                <div @click="section = ''"
                     class="border border-gray-200 flex items-center justify-center shadow w-12 h-12 rounded-full cursor-pointer">
                    <x-lucide-arrow-left class="w-6 h-6" />
                </div>

                <div class="flex flex-col">
                    <span class="flex-row text-xl font-semibold">Manage Booking</span>
                    <span class="text-xs text-gray-400">ID Booking: 1234567</span>
                </div>
            </div>
            <div class="mr-5">
                <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-medium">
                    Upcoming
                </span>
            </div>
        </div>

        <div class="items-start gap-4 p-5 flex flex-row">
            <div class="w-full">
                <div class="flex items-center flex-row w-full mt-2 p-3 border border-gray-200 shadow rounded-xl">
                    <div class="text-white text-2xl w-17 h-17 flex items-center justify-center shadow rounded-full bg-primary">
                        M
                    </div>
                    <div class="ml-3 flex-1">
                        <h1 class="text-blue-500 font-semibold">Your Fotografer</h1>
                        <h1 class="font-bold text-xl">Muhammad ATIEF</h1>
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
                                <h1 class="font-semibold">Thursday, Nov 12, 2026</h1>
                            </div>
                        </div>

                        <div class="flex gap-2">
                            <div class="text-primary-500 bg-primary/15 w-fit border-gray-200 shadow h-fit p-2 rounded-full">
                                <x-lucide-pin class="w-6 h-6" />
                            </div>
                            <div>
                                <h5 class="text-xs font-semibold text-gray-500">Meeting Point</h5>
                                <h1 class="font-semibold">SMK PGRI 3 Malang</h1>
                            </div>
                        </div>

                        <div id="map" style="height: 400px" class="map rounded-xl w-full"></div>
                        <script>
                            document.addEventListener('DOMContentLoaded', () => {
                                fetch('/get-coordinates', {
                                    method: 'POST',
                                    headers: { 'Content-Type': 'application/json' },
                                    body: JSON.stringify({ address: "SMK PGRI 3 Malang" })
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

                                        L.marker([lat, lng]).addTo(map)
                                            .bindPopup('A pretty CSS popup.<br> Easily customizable.')
                                            .openPopup();
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
                            Paid
                        </span>
                    </div>

                    <div class="text-white border-b border-b-white/15 pb-2">
                        <h1 class="font-bold mt-2 text-xl">Paket Letter C</h1>
                        <h2 class="text-gray-300 text-sm">90 Menit - 25 Foto</h2>
                    </div>

                    <div class="text-white flex justify-between mt-2">
                        <h1 class="text-gray-300 text-sm">Total Harga</h1>
                        <h1 class="text-xl font-bold">Rp 212.000</h1>
                    </div>
                </div>

                <div class="mt-3 border border-gray-200 shadow rounded-xl p-4">
                    <h1 class="text-xl font-semibold">Description</h1>
                    <p class="mt-1 text-gray-500">
                        Lorem ipsum dolor it amet lorem ipsum dolor
                        sit amet lorem Lorem ipsum dolor it amet lorem
                        ipsum dolor sit amet lorem Lorem ipsum dolor
                        it amet lorem ipsum dolor sit amet lorem Lorem
                        ipsum dolor it amet lorem ipsum dolor sit amet lorem
                    </p>
                </div>

                <div class="flex flex-col mt-3 gap-2">
                    <button type="button" class="text-center py-3 px-full items-center gap-x-2 text-sm font-medium rounded-lg bg-primary border border-primary-line text-primary-foreground hover:bg-primary-hover focus:outline-hidden focus:bg-primary-focus disabled:opacity-50 disabled:pointer-events-none">
                        Contact
                    </button>
                    <button type="button" class="text-red-400 text-center py-3 px-full border-red-400 items-center gap-x-2 text-sm font-medium rounded-lg border hover:border-red-600 hover:text-red-600 focus:outline-hidden focus:text-red-400 disabled:opacity-50 disabled:pointer-events-none">
                        Cancel Booking
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
