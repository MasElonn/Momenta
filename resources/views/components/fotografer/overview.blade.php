@props(['user' => Auth::user()])

<div x-show="tab === 'overview'">
    <h1 class="pt-5 text-4xl font-semibold">Hello, {{ $user->name ?? Auth::user()->name }}!</h1>
    <h2>Welcome back to your Momenta dashboard. Your next photo session is about to begin.</h2>

    @props(['user' => Auth::user()])

    {{--STATISTIK DASHBOARD--}}
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mt-6 mb-6">

        {{-- Total Paket --}}
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
            <div class="flex items-center gap-4">

                <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center text-xl">
                    <x-lucide-package-2 class="w-6 h-6 text-blue-600" />
                </div>

                <div>
                    <p class="text-sm text-gray-500">
                        Total Paket
                    </p>

                    <h2 class="text-2xl font-bold text-gray-800">
                        5
                    </h2>

                    <p class="text-xs text-gray-400">
                        Paket aktif
                    </p>
                </div>

            </div>
        </div>


        {{--Total Transaksi--}}
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
            <div class="flex items-center gap-4">

                <div @click="tab = 'event', section = ''"
                class="w-12 h-12 rounded-xl bg-green-50 flex items-center justify-center text-xl">
                    <x-lucide-circle-dollar-sign class="w-6 h-6 text-green-600" />
                </div>

                <div>
                    <p class="text-sm text-gray-500">
                        Total Transaksi
                    </p>

                    <h2 class="text-2xl font-bold text-gray-800">
                        12
                    </h2>

                    <p class="text-xs text-gray-400">
                        Semua transaksi
                    </p>
                </div>

            </div>
        </div>


        {{-- Upcoming Session --}}
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
            <div class="flex items-center gap-4">

                <div class="w-12 h-12 rounded-xl bg-orange-50 flex items-center justify-center text-xl">
                    <x-lucide-calendar-1 class="w-6 h-6 text-orange-600" />
                </div>

                <div>
                    <p class="text-sm text-gray-500">
                        Upcoming Session
                    </p>

                    <h2 class="text-2xl font-bold text-gray-800">
                        3
                    </h2>

                    <p class="text-xs text-gray-400">
                        Acara mendatang
                    </p>
                </div>

            </div>
        </div>


        {{--Total Foto--}}
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
            <div class="flex items-center gap-4">

                <div class="w-12 h-12 rounded-xl bg-purple-50 flex items-center justify-center text-xl">
                    <x-lucide-image class="w-6 h-6 text-purple-600" />
                </div>

                <div>
                    <p class="text-sm text-gray-500">
                        Total Foto
                    </p>

                    <h2 class="text-2xl font-bold text-gray-800">
                        120
                    </h2>

                    <p class="text-xs text-gray-400">
                        Foto di gallery
                    </p>
                </div>
            </div>
        </div>

                <div>
                     lokasi crud hasil transaksi
                </div>
    </div>
        </div>
    </div>
    
    <div