<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @keyframes draw-circle {
            to { stroke-dashoffset: 0; }
        }
        @keyframes draw-check {
            to { stroke-dashoffset: 0; }
        }
        @keyframes check-bounce {
            0%, 60% { transform: scale(1); }
            75% { transform: scale(1.15); }
            100% { transform: scale(1); }
        }
        @keyframes ripple {
            0% { transform: scale(1); opacity: 0.5; }
            100% { transform: scale(1.6); opacity: 0; }
        }
        @keyframes fade-up {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .success-wrap {
            position: relative;
        }
        .success-ripple {
            position: absolute;
            inset: 0;
            border-radius: 9999px;
            background: theme('colors.green.400');
            animation: ripple 0.8s 0.7s ease-out both;
        }
        .success-ring {
            position: relative;
            animation: check-bounce 0.6s 0.75s ease-out both;
        }
        .success-circle {
            stroke-dasharray: 88;
            stroke-dashoffset: 88;
            animation: draw-circle 0.5s ease-out forwards;
        }
        .success-check path {
            stroke-dasharray: 30;
            stroke-dashoffset: 30;
            animation: draw-check 0.35s 0.5s ease-out forwards;
        }
        .fade-up-1 { animation: fade-up 0.5s 0.9s ease-out both; }
        .fade-up-2 { animation: fade-up 0.5s 1.05s ease-out both; }
        .fade-up-3 { animation: fade-up 0.5s 1.2s ease-out both; }
        .fade-up-4 { animation: fade-up 0.5s 1.35s ease-out both; }

        @media (prefers-reduced-motion: reduce) {
            .success-ripple { display: none; }
            .success-ring, .success-circle, .success-check path,
            .fade-up-1, .fade-up-2, .fade-up-3, .fade-up-4 {
                animation: none !important;
                opacity: 1 !important;
                transform: none !important;
                stroke-dashoffset: 0 !important;
            }
        }
    </style>
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

            <div class="flex-1 h-px bg-blue-600 mx-6"></div>

            <div class="flex flex-col items-center gap-2">
                <div class="size-10 rounded-full bg-blue-600 text-white font-semibold text-sm flex items-center justify-center shadow-xs">
                    2
                </div>
                <span class="font-semibold text-sm text-blue-600">Payment</span>
            </div>

            <div class="flex-1 h-px bg-blue-600 mx-6"></div>

            <div class="flex flex-col items-center gap-2">
                <div class="size-10 rounded-full bg-blue-600 text-white font-semibold text-sm flex items-center justify-center ring-4 ring-blue-100 shadow-xs">
                    3
                </div>
                <span class="font-semibold text-sm text-blue-600">Finish</span>
            </div>
        </div>
    </div>

    <div class="border border-b-gray-200 bg-white p-5 rounded-xl flex justify-center items-center h-full shadow-sm overflow-hidden">
        <div class="w-full max-w-lg flex flex-col items-center text-center py-8">

            <!-- Success icon -->
            <div class="success-wrap size-16 mb-4">
                <div class="success-ripple"></div>
                <div class="success-ring size-16 rounded-full bg-green-100 flex items-center justify-center">
                    <svg class="size-9" viewBox="0 0 36 36" fill="none">
                        <circle class="success-circle" cx="18" cy="18" r="14" stroke="#16A34A" stroke-width="2" stroke-linecap="round"/>
                        <svg class="success-check" x="9" y="9" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#16A34A" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 6 9 17l-5-5"/>
                        </svg>
                    </svg>
                </div>
            </div>

            <h1 class="fade-up-1 font-bold text-2xl text-gray-800 mb-1">Booking Confirmed</h1>
            <p class="fade-up-1 text-sm text-gray-500 mb-6">Your payment has been received and your session is booked.</p>

            <!-- Booking summary -->
            <div class="fade-up-2 w-full border border-gray-200 rounded-xl p-5 text-left flex flex-col gap-3 mb-6">
                <div class="flex justify-between items-center text-sm">
                    <span class="text-gray-500">Booking ID</span>
                    <span class="font-semibold text-gray-800">#{{session('trans_id')}}</span>
                </div>
                <div class="flex justify-between items-center text-sm">
                    <span class="text-gray-500">Package</span>
                    <span class="font-semibold text-gray-800">{{ucfirst(session('paket'))}}</span>
                </div>
                <div class="flex justify-between items-center text-sm">
                    <span class="text-gray-500">Date & Time</span>
                    <span class="font-semibold text-gray-800">{{session('date_time')}}</span>
                </div>
                <div class="flex justify-between items-center text-sm">
                    <span class="text-gray-500">Location</span>
                    <span class="font-semibold text-gray-800">{{session('lokasi')}}</span>
                </div>
                <div class="border-t border-gray-200 pt-3 flex justify-between items-center">
                    <span class="font-semibold text-gray-800">Total Paid</span>
                    <span class="font-bold text-lg text-blue-600">{{ Number::currency(session('total_harga'), in: 'IDR', locale: 'id') }}</span>
                </div>
            </div>

            <p class="fade-up-3 text-xs text-gray-400 mb-6">{{__('Please Note that the Fotografer can change the Date if the schecdule is taken, if it taken Fotografer will notify you')}}</p>

            <div class="fade-up-4 flex gap-3">
                <a onclick="{{{Session::forget(['trans_id','total_hara','status','paket','date_time','lokasi'])}}}"
                    href="/" class="py-3 px-5 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-gray-200 text-gray-700 hover:bg-gray-50 transition-colors">
                    Back to Home
                </a>
                <a href="" class="py-3 px-5 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 transition-colors">
                    View My Bookings
                </a>
            </div>

        </div>
    </div>

</div>

</body>
</html>
