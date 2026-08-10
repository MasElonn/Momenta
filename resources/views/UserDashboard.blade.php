<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Dashboard</title>

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body>
<div class=" w-screen flex flex-row" x-data="{tab: '{{request('tab', 'overview')}}' }">
    <aside class="w-64 h-screen border-r border-gray-200 flex flex-col items-center py-10 px-4 ">

        <div class="flex flex-col items-center mb-10">
            <div class="w-16 h-16 rounded-full bg-primary text-white flex items-center justify-center text-2xl font-medium mb-3">
                B
            </div>
            <h2 class="mt-1 text-xl font-bold ">{{$user}}</h2>
            <span class="text-xs text-gray-500 uppercase font-semibold mt-0.5">{{$role}}</span>
        </div>


        <nav  class="w-full space-y-3" >

            <button @click="tab = 'overview'"
                    :class="tab === 'overview' ? 'bg-primary text-primary-foreground' : 'bg-primary-100 text-primary-800 hover:bg-primary-200 dark:bg-primary-500/20 dark:text-primary-400 dark:hover:bg-primary-500/30 dark:focus:bg-primary-500/30'"
                    class="w-full flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg">
                <x-lucide-layout-grid class="w-5 h-5" />
                Overview
            </button>


            <button @click="tab = 'booking'"
                    :class="tab === 'booking' ? 'bg-primary text-primary-foreground' : 'bg-primary-100 text-primary-800 hover:bg-primary-200 dark:bg-primary-500/20 dark:text-primary-400 dark:hover:bg-primary-500/30 dark:focus:bg-primary-500/30'"
                    class="w-full flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg ">
                <x-lucide-calendar class="w-5 h-5" />
                My Booking
            </button>


            <button @click="tab = 'gallery'"
                    :class="tab === 'gallery' ? 'bg-primary text-primary-foreground' : 'bg-primary-100 text-primary-800 hover:bg-primary-200 dark:bg-primary-500/20 dark:text-primary-400 dark:hover:bg-primary-500/30 dark:focus:bg-primary-500/30'"
                    class="w-full flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg" >

                <x-lucide-image class="w-5 h-5"></x-lucide-image>
                My Galerry
            </button>
            <br>


            <button @click="tab = 'account'"
                    :class="tab === 'account' ? 'bg-primary text-primary-foreground' : 'bg-primary-100 text-primary-800 hover:bg-primary-200 dark:bg-primary-500/20 dark:text-primary-400 dark:hover:bg-primary-500/30 dark:focus:bg-primary-500/30'"
                    class="w-full flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg" >

            <x-lucide-user class="w-5 h-5"></x-lucide-user>
                My Account
            </button>
        </nav>
    </aside>


    <main class="flex-1 p-4">
        <div class="" x-show="tab === 'overview'">
            <h1 class="pt-5 text-4xl font-semibold"  >Hello, {{$user}}!</h1>
            <h2>Welcome back to your Momenta dashboard. Your next session is coming up soon.</h2>

            <div class="mt-5 flex  justify justify-between">

                <!--booking-->
                <div class="flex-auto w-full p-2">
                    <h2 class="py-2 text-xl font-semibold">Bookings</h2>

                    {{--card--}}
                    <div class="w-full rounded-lg border border-gray-200 shadow-sm p-4">

                        {{--info--}}
                        <div class="flex items-center justify-between pb-3 mb-3 border-b border-gray-100">
                            <div class="flex items-center gap-2">
                                <x-lucide-calendar-1 class="w-5 h-5"></x-lucide-calendar-1>
                                <span class="font-semibold">Booking</span>
                                <span class="text-gray-400 text-sm">ID Booking:</span>
                                <span class="text-gray-500 text-sm">1234567</span>
                            </div>
                            <span class="text-gray-400 text-sm">31 Des 2024</span>
                        </div>

                        {{--isi--}}
                        <div class="flex items-start gap-4">
                            <img class="rounded-lg w-25 h-25 "
                                 src="https://picsum.photos/150/150" alt="gambar">

                            <div class="flex-1">
                                <div class="flex items-start justify-between">
                                    <h1 class="font-semibold text-lg">Fotoshoot Perpisahan SMP</h1>
                                    <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-medium">
                                        Upcoming
                                    </span>
                                </div>

                                <div class="flex items-center gap-6 mt-2 text-sm text-gray-600">
                                    <span class="flex items-center gap-1">
                                        <x-lucide-circle-dollar-sign class="w-4 h-4 rounded-full"></x-lucide-circle-dollar-sign>
                                        Harga: Rp 145000
                                    </span>

                                    <span class="flex items-center gap-1">
                                        <x-lucide-package-2 class="w-4 h-4 rounded-full"></x-lucide-package-2>
                                        Paket: Standard
                                    </span>
                                </div>

                                <div class="flex items-center gap-2 mt-3">

                                    <x-lucide-user class="w-6 h-6 rounded-full"></x-lucide-user>

                                    <span class="text-sm text-gray-600">iwan - Fotografer</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--galeri-->
                <div class="w-70 flex-auto  p-2">
                    <h2 class="py-2 text-xl font-semibold">Galleery</h2>
                    <div class="border-2 shadow w-full h-40 rounded-lg ">
                        <img class="rounded-lg" src="https://picsum.photos/210/160" alt="foto">
                    </div>
                    <div class="mt-2 border-2 shadow w-full h-40 rounded-lg ">
                        <img class="rounded-lg" src="https://picsum.photos/210/160" alt="foto">
                    </div>
                    <div class="mt-2 border-2 shadow w-full h-40 rounded-lg ">
                        <img class="rounded-lg" src="https://picsum.photos/210/160" alt="foto">
                    </div>
                </div>
            </div>

        </div>

        <div x-show="tab === 'booking'">
            booking
        </div>

        <div x-show="tab === 'gallery'">
            gallery
        </div>

        <div x-show="tab === 'account'">
            account
        </div>

    </main>


</div>



</body>
</html>
