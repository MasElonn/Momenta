<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-900 font-sans">
<h1 hidden>{{$status = ucfirst(session('status'))}}</h1>
<h1 hidden>{{$trans_id = session('trans_id')}}</h1>
<h1 hidden>{{$total_harga = Number::currency(session('total_harga'), in: 'IDR', locale: 'id')}}</h1>
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

                <div class="flex-1 h-px bg-blue-600 mx-6"></div>

                <div class="flex flex-col items-center gap-2">
                    <div class="size-10 rounded-full bg-blue-600 text-white font-semibold text-sm flex items-center justify-center ring-4 ring-blue-100 shadow-xs">
                        2
                    </div>
                    <span class="font-semibold text-sm text-blue-600">Payment</span>
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

        <div class="flex gap-6 items-start">
            <div class="w-2/3 flex flex-col bg-white border border-gray-200 shadow-sm rounded-xl p-6">
                <div class="pb-3 border-b border-gray-200 mb-4">
                    <h1 class="font-bold text-xl text-gray-800">Payment Details</h1>
                    <span class="text-xs text-gray-400">Choose payment method & upload receipt</span>
                </div>

                <div class="border border-gray-200 rounded-xl p-4 flex justify-between items-center mb-4 bg-gray-50/50">
                    <div>
                        <span class="text-xs text-gray-400 block uppercase font-semibold">Bank BCA</span>
                        <span class="font-mono font-bold text-lg text-gray-800">8830-1928-3491</span>
                        <span class="text-xs text-gray-500 block">PT Momenta</span>
                    </div>
                    <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Bank Transfer</span>
                </div>

                <form action="{{route('pembayaran.upload')}}" method="post" enctype="multipart/form-data" class="flex flex-col gap-4">
                    @csrf
                    <input name="trans_id" value="{{$trans_id}}" hidden>
                    <div class="flex flex-col gap-1">
                        <h5 class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Upload Payment Receipt</h5>
                        <input name="bukti" type="file" class="block w-full border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none file:bg-gray-50 file:border-0 file:me-4 file:py-3 file:px-4">
                    </div>

                    <button type="submit" class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden disabled:opacity-50 disabled:pointer-events-none mt-2">
                        Submit Payment
                    </button>
                </form>
            </div>

            <div class="w-1/3 flex flex-col gap-3">
                <div class="flex flex-col bg-white border border-gray-200 shadow-sm rounded-xl p-6 gap-4">
                    <div class="pb-3 border-b border-gray-200">
                        <h1 class="font-bold text-xl text-gray-800">Payment Summary</h1>
                    </div>

                    <div class="flex justify-between items-center text-sm">
                        <span class="text-gray-500">Booking ID</span>
                        <span class="font-semibold text-gray-800">#{{$trans_id}}</span>
                    </div>

                    <div class="flex justify-between items-center text-sm">
                        <span class="text-gray-500">Status</span>
                        <span class="inline-flex items-center gap-x-1.5 py-1 px-3 rounded-full text-xs font-medium bg-blue-100 text-blue-800">{{$status}}</span>
                    </div>

                    <div class="border-t border-gray-200 pt-3 flex justify-between items-center">
                        <span class="font-semibold text-gray-800">Total Price</span>
                        <span class="font-bold text-xl text-blue-600">{{$total_harga}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
