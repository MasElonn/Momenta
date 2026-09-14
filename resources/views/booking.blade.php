<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-900 font-sans">

    <x-navbar />

    <div class="p-6 max-w-6xl mx-auto">
        <div class="bg-white border border-gray-200 shadow-sm rounded-xl p-5 mb-6">
            <div class="flex items-center justify-between px-10">
                <div class="flex flex-col items-center gap-2">
                    <div class="size-10 rounded-full bg-blue-600 text-white font-semibold text-sm flex items-center justify-center shadow-xs">
                        1
                    </div>
                    <span class="font-semibold text-sm text-blue-600">Booking</span>
                </div>

                <div class="flex-1 h-px bg-gray-200 mx-6"></div>

                <div class="flex flex-col items-center gap-2">
                    <div class="size-10 rounded-full bg-gray-100 border border-gray-200 text-gray-400 font-semibold text-sm flex items-center justify-center">
                        2
                    </div>
                    <span class="text-gray-400 font-medium text-sm">Payment</span>
                </div>

                <div class="flex-1 h-px bg-gray-200 mx-6"></div>

                <div class="flex flex-col items-center gap-2">
                    <div class="size-10 rounded-full bg-gray-100 border border-gray-200 text-gray-400 font-semibold text-sm flex items-center justify-center">
                        3
                    </div>
                    <span class="text-gray-400 font-medium text-sm">Finish</span>
                </div>
            </div>
        </div>

        <div class="flex gap-6 items-start" x-data="{
         selectedPackage: '{{ $pakets->first()->paket_id ?? '' }}',
         pakets: {{ Js::from($pakets) }},
         get currentPrice() {
             let item = this.pakets.find(p => p.paket_id == this.selectedPackage);
             return item ? item.harga : 0;
         }
     }">
            <div class="w-2/3 flex flex-col bg-white border border-gray-200 shadow-sm rounded-xl p-6">
                <div class="pb-3 border-b border-gray-200 mb-4">
                    <h1 class="font-bold text-xl text-gray-800">Booking Session</h1>
                    <span class="text-xs text-gray-400">Fill in your session details</span>
                </div>

                <form action="{{route('booking.create')}}" method="post" class="flex flex-col gap-4">
                    @csrf
                    <input name="customer_id" value="{{Auth::id()}}" hidden>
                    <input name="fotografer_id" value="{{$fid}}" hidden>


                    <div class="flex flex-col gap-1">
                        <h5 class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Event Name</h5>
                        <input name="judul_acara" type="text" placeholder="Acara Sekolah / Wisuda" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                    </div>

                    <div class="flex flex-col gap-1">
                        <h5 class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Select Package</h5>
                        <select
                            name="paket_id"
                            class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                            x-model="selectedPackage"
                        >
                            @foreach($pakets as $paket)
                                <option value="{{ $paket->paket_id }}">
                                    {{ $paket->judul . ' - ' . Number::currency($paket->harga, in: 'IDR', locale: 'id') }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <input id="total_harga" name="total_harga"  hidden>
                    <script>
                        document.getElementById("total_harga").value = Number(currentPrice).toLocaleString('id-ID');
                    </script>

                    <div class="flex gap-4">
                        <div class="flex flex-col gap-1 w-1/2">
                            <h5 class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Date</h5>
                            <input name="tanggal" type="date" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                        </div>

                        <div class="flex flex-col gap-1 w-1/2">
                            <h5 class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Time</h5>
                            <input name="jam" type="time" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                        </div>
                    </div>

                    <div class="flex flex-col gap-1">
                        <h5 class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Meeting Point</h5>
                        <input name="lokasi" type="text" placeholder="Lokasi Sesi Foto" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                    </div>

                    <div class="flex flex-col gap-1">
                        <h5 class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Description</h5>
                        <textarea name="deskripsi" rows="3" placeholder="Deskripsi Acara..." class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"></textarea>
                    </div>

                    <button type="submit" class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden disabled:opacity-50 disabled:pointer-events-none mt-2">
                        Continue to Payment
                    </button>
                </form>
            </div>

            <div class="w-1/3 flex flex-col gap-3">
                <div class="flex flex-col bg-white border border-gray-200 shadow-sm rounded-xl p-6 gap-4">
                    <div class="pb-3 border-b border-gray-200">
                        <h1 class="font-bold text-xl text-gray-800">Booking Summary</h1>
                    </div>

                    <div class="flex justify-between items-center text-sm">
                        <span class="text-gray-500">Status</span>
                        <span class="inline-flex items-center gap-x-1.5 py-1 px-3 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Pending</span>
                    </div>

                    <div class="flex justify-between items-center text-sm">
                        <span class="text-gray-500">Fotografer</span>
                        <span class="font-semibold text-gray-800">{{$fname}}</span>
                    </div>

                    <div class="border-t border-gray-200 pt-3 flex justify-between items-center">
                        <span class="font-semibold text-gray-800">Total Price</span>
                        <span class="font-bold text-xl text-blue-600"
                              x-text="'Rp ' + Number(currentPrice).toLocaleString('id-ID')"
                        >Rp 0</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
