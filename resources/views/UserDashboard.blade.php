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
<div class=" w-screen flex flex-row" x-data="{tab: '{{request('tab', 'overview')}}', section: ''}">
    <aside class=" shadow-xl w-64 h-screen border-r border-gray-200 flex flex-col items-center py-10 px-4 ">

        <div class="flex flex-col items-center mb-10">
            <div class="w-16 h-16 rounded-full bg-primary text-white flex items-center justify-center text-2xl font-medium mb-3">
                B
            </div>
            <h2 class="mt-1 text-xl font-bold ">{{$user}}</h2>
            <span class="text-xs text-gray-500 uppercase font-semibold mt-0.5">{{$role}}</span>
        </div>


        <nav class="w-full flex flex-col justify-between h-full">
            <div class="space-y-3">

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
                    My Gallery
                </button>

                <button @click="tab = 'account'"
                        :class="tab === 'account' ? 'bg-primary text-primary-foreground' : 'bg-primary-100 text-primary-800 hover:bg-primary-200 dark:bg-primary-500/20 dark:text-primary-400 dark:hover:bg-primary-500/30 dark:focus:bg-primary-500/30'"
                        class="w-full flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg" >
                    <x-lucide-user class="w-5 h-5"></x-lucide-user>
                    My Account
                </button>
            </div>

            <form action="{{ route('logout') }}" method="POST" class="w-full">
                @csrf
                <button type="submit" class="flex w-full py-3 px-4 items-center gap-x-2 text-sm font-medium rounded-lg border border-red-500 text-red-500 hover:border-red-400 hover:text-red-400 focus:outline-hidden disabled:opacity-50 disabled:pointer-events-none">
                    <x-lucide-log-out class="w-5 h-5" />
                    Logout
                </button>
            </form>

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

                    {{--                card            --}}
                    <div @click="section = 'booking', tab = 'booking'"
                        class="w-full rounded-lg border border-gray-200 shadow-sm p-4">

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
                    <h2 class="py-2 text-xl font-semibold">Gallery</h2>
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

        {{--booking section--}}
        <div x-show="tab === 'booking'"

        >
            <!--booking card-->
            <div @click="section = 'booking'"
                 :class="section === 'booking' ? 'hidden' : ''"
                 class="w-full rounded-lg border border-gray-200 shadow-sm p-4">

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


            <div x-show="section === 'booking'">

                <!--header-->
                <div class="flex justify-between">
                    <div class=" flex items-center gap-2">
                        <div @click="section = ''"
                             class="border border-gray-200 flex items-center justify-center shadow w-12 h-12 rounded-full">
                            <x-lucide-arrow-left class="w-6 h-6"></x-lucide-arrow-left>
                        </div>

                        <div class="flex flex-col">
                            <span class="flex-row text-xl font-semibold">Manage Booking</span>
                            <span class="text-xs text-gray-400">ID Booking: 1234567</span>
                        </div>


                    </div>
                        <div class="mr-5">
                            <span class=" px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-medium">
                                    Upcoming
                            </span>
                        </div>
                </div>


                <div class=" items-start gap-4 p-5 flex flex-row">
                        <div class="w-full">
                            <div class=" flex items-center flex-row w-full mt-2 p-3 border border-gray-200 shadow rounded-xl">
                                <div class="text-white text-2xl w-17 h-17 flex items-center justify-center shadow rounded-full bg-primary">
                                    M
                                </div>
                                <div class="ml-3 flex-1">
                                    <h1 class=" text-blue-500 font-semibold">Your Fotografer</h1>
                                    <h1 class="font-bold text-xl">Muhammad ATIEF</h1>
                                </div>

                            </div>

                            <div class="rounded-xl p-3  mt-3 border border-gray-200 shadow ">
                                <div class="pb-3  border-b border-b-black/20 ">
                                    <h1 class="font-bold text-xl">Session Schedule & Location</h1>
                                </div>

                                <div class="flex flex-col  m-2 gap-3">
                                    <div class="flex gap-2 mt-2">
                                        <div class="text-primary-500 bg-primary/15 w-fit border-gray-200 shadow h-fit p-2 rounded-full">
                                            <x-lucide-calendar class="w-6 h-6"></x-lucide-calendar>
                                        </div>
                                        <div>
                                            <h5 class="text-xs font-semibold text-gray-500">Date</h5>
                                            <h1 class="font-semibold">Thursday, Nov 12, 2026</h1>
                                        </div>
                                    </div>

                                    <div class="flex gap-2">
                                        <div class="text-primary-500 bg-primary/15 w-fit border-gray-200 shadow h-fit p-2 rounded-full">
                                            <x-lucide-pin class="w-6 h-6"></x-lucide-pin>
                                        </div>
                                        <div>
                                            <h5 class="text-xs font-semibold text-gray-500">Meeting Point</h5>
                                            <h1 class="font-semibold">SMK PGRI 3 Malang</h1>
                                        </div>
                                    </div>

                                    {{--placeholder for maps--}}
                                    <iframe class="rounded-xl w-full" height="400"  src="https://google.com" title="Example Page"></iframe>


                                </div>
                            </div>
                        </div>




                    <div class="w-full flex flex-col">

                        <div class="bg-[#123ABB] mt-2 p-5 border border-gray-200 shadow rounded-xl">
                            <div class="flex justify-between">
                                <h1 class="text-amber-300 font-semibold">Selected Package</h1>
                                <span class=" px-3 py-1 rounded-full bg-white/20 text-white text-xs font-medium">
                                        Paid
                                </span>
                            </div>

                            <div class=" text-white border-b border-b-white/15 pb-2 ">
                                <h1 class="font-bold mt-2 text-xl">Paket Letter C</h1>
                                <h2 class="text-gray-300 text-sm">90 Menit - 25 Foto</h2>
                            </div>

                            <div class=" text-white flex justify-between mt-2">
                                <h1 class="text-gray-300 text-sm">Total Harga</h1>
                                <h1 class="text-xl font-bold ">Rp 212.000</h1>
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

                        <div class="flex flex-col mt-3 <!--px-8--> gap-2">
                            <button type="button" class="text-center py-3 px-full  items-center gap-x-2 text-sm font-medium rounded-lg bg-primary border border-primary-line text-primary-foreground hover:bg-primary-hover focus:outline-hidden focus:bg-primary-focus  disabled:opacity-50 disabled:pointer-events-none" >
                                Contact
                            </button>
                            <button type="button" class="text-center py-3 px-full  items-center gap-x-2 text-sm font-medium rounded-lg border border-red-500 text-red-500 hover:border-red-400 hover:text-red-400 focus:outline-hidden focus:border-red-400 focus:text-red-400 disabled:opacity-50 disabled:pointer-events-none">
                                Cancel Booking
                            </button>
                        </div>
                    </div>
                </div>
            </div>


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

