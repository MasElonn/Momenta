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

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
          integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
          crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
            crossorigin=""></script>



</head>
<body>

<div class="w-screen h-screen flex" x-data="{tab: '{{ old('tab', request('tab', 'overview')) }}', section: ''}">

    <aside class="sticky overflow-y-auto top-0 shadow-xl w-64 h-screen border-r border-gray-200 flex flex-col items-center py-10 px-4 ">

        <div class=" flex flex-col items-center mb-10">
            <div class="uppercase w-16 h-16 rounded-full bg-primary text-white flex items-center justify-center text-2xl font-medium mb-3">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <h2 class="mt-1 text-xl font-bold ">{{ Auth::user()->name }}</h2>
            <span class="text-xs text-gray-500 uppercase font-semibold mt-0.5">{{ $user->role ?? 'customer' }}</span>
        </div>


        <nav class=" w-full flex flex-col justify-between h-full">
            <div class="space-y-3">

                <button @click="tab = 'overview'"
                        :class="tab === 'overview' ? 'bg-primary text-primary-foreground' : 'bg-primary-100 text-primary-800 hover:bg-primary-200 dark:bg-primary-500/20 dark:text-primary-400 dark:hover:bg-primary-500/30 dark:focus:bg-primary-500/30'"
                        class=" w-full flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg">
                    <x-lucide-layout-grid class="w-5 h-5" />
                    Overview
                </button>

                <button @click="tab = 'booking'"
                        :class="tab === 'booking' ? 'bg-primary text-primary-foreground' : 'bg-primary-100 text-primary-800 hover:bg-primary-200 dark:bg-primary-500/20 dark:text-primary-400 dark:hover:bg-primary-500/30 dark:focus:bg-primary-500/30'"
                        class=" w-full flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg ">
                    <x-lucide-calendar class="w-5 h-5" />
                    My Booking
                </button>

                <button @click="tab = 'gallery'"
                        :class="tab === 'gallery' ? 'bg-primary text-primary-foreground' : 'bg-primary-100 text-primary-800 hover:bg-primary-200 dark:bg-primary-500/20 dark:text-primary-400 dark:hover:bg-primary-500/30 dark:focus:bg-primary-500/30'"
                        class="w-full flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg" >
                    <x-lucide-image class="w-5 h-5"></x-lucide-image>
                    My Gallery
                </button>
                <br>

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


    <main class="static flex-1  p-4 justify-between">
        <div class="" x-show="tab === 'overview'">
            <h1 class="pt-5 text-4xl font-semibold"  >Hello, {{ Auth::user()->name }}!</h1>
            <h2>Welcome back to your Momenta dashboard. Your next session is coming up soon.</h2>

            <div class="mt-5 flex  justify justify-between">

                <!--booking-->
                <div class="flex-auto w-full p-2">
                    <h2 class="py-2 text-xl font-semibold">Bookings</h2>

                    {{--                card            --}}
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

                                <div class="flex  justify-between mt-3">
                                    <div class="flex gap-1">
                                        <x-lucide-user class="w-6 h-6 rounded-full"></x-lucide-user>

                                        <span class="text-sm text-gray-600">iwan - Fotografer</span>
                                    </div>

                                    <div class="flex gap-2">
                                        <button type="button" @click="section = 'booking', tab = 'booking'"
                                                class="py-1.5 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-primary border border-primary-line text-primary-foreground hover:bg-primary-hover focus:outline-hidden  disabled:opacity-50 disabled:pointer-events-none" >
                                            Manage
                                        </button>

                                        <button type="button" @click="section = 'gallery', tab = 'gallery'"
                                                class="py-1.5 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-primary border border-primary-line text-primary-foreground hover:bg-primary-hover focus:outline-hidden  disabled:opacity-50 disabled:pointer-events-none" >
                                            Gallery
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--galeri-->
                <div class="w-70 flex-auto  p-2">
                    <h2 class="py-2 text-xl font-semibold">Gallery</h2>
                    <div class="  w-full h-40 rounded-lg ">
                        <img class="rounded-lg" src="https://picsum.photos/210/160" alt="foto">
                    </div>
                    <div class=" mt-2 shadow w-full h-40 rounded-lg ">
                        <img class="rounded-lg" src="https://picsum.photos/210/160" alt="foto">
                    </div>
                    <div class=" mt-2  shadow w-full h-40 rounded-lg ">
                        <img class="rounded-lg" src="https://picsum.photos/210/160" alt="foto">
                    </div>
                </div>
            </div>

        </div>

        {{--booking section--}}
        <div x-show="tab === 'booking'">

            <div :class="section === 'booking' ? 'hidden' : ''">
                <!--header-->
                <div class="flex flex-col my-3 mb-4">
                    <span class=" text-2xl font-semibold">My Booking</span>

                    <span class="text-gray-500">Manage All Your Sessions</span>

                </div>

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


                                    <div id="map" class="map rounded-xl w-full h-75"></div>
                                    <script>
                                        var map = L.map('map').setView([51.505, -0.09], 13);

                                        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                                        }).addTo(map);

                                        L.marker([51.5, -0.09]).addTo(map)
                                            .bindPopup('A pretty CSS popup.<br> Easily customizable.')
                                            .openPopup();
                                    </script>

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
                            <button type="button" class="text-red-400 text-center py-3 px-full  border-red-400 items-center gap-x-2 text-sm font-medium rounded-lg border hover:border-red-600 hover:text-red-600 focus:outline-hidden focus:text-red-400 disabled:opacity-50 disabled:pointer-events-none">
                                Cancel Booking
                            </button>
                        </div>
                    </div>
                </div>
            </div>


        </div>


        <div x-show="tab === 'gallery'" x-data="{ modalOpen: false, selectedImage: null }" class="space-y-6">


            <div :class="section === 'gallery' ? 'hidden' : ''">
                <!--header-->
                <div class="flex flex-col my-3 mb-4">
                    <span class=" text-2xl font-semibold">My Gallery</span>

                    <span class="text-gray-500">See All Your Compleated Sessions</span>

                </div>

                <div @click="section = 'gallery'"
                    :class="section === 'gallery' ? 'hidden' : ''"
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


            <!-- Gallery Header & Actions -->
            <div x-show="section === 'gallery'">

                <div class="flex justify-between">
                    <div class=" flex items-center gap-2">
                        <div @click="section = ''"
                             class="border border-gray-200 flex items-center justify-center shadow w-12 h-12 rounded-full">
                            <x-lucide-arrow-left class="w-6 h-6"></x-lucide-arrow-left>
                        </div>

                        <div class="flex flex-col">
                            <span class="flex-row text-xl font-semibold">My Gallery</span>
                            <span class="text-xs text-gray-400">ID Booking: 1234567</span>
                        </div>


                    </div>
                    <div class="mr-5">
                            <span class=" px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-medium">
                                    Upcoming
                            </span>
                    </div>
                </div>

                <div class="mt-2 mb-3 flex  justify-end gap-4 mr-5">
                    <button type="button" class="py-2 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-primary border border-primary-line text-primary-foreground hover:bg-primary-hover focus:outline-hidden focus:bg-primary-focus  disabled:opacity-50 disabled:pointer-events-none" >
                        Download All
                    </button>


                </div>

                <!-- Pinterest Grid -->
                <div class="columns-1 sm:columns-2 md:columns-3 lg:columns-4 gap-4 space-y-4">

                    <!--Tall-->
                    <div class="break-inside-avoid relative group rounded-2xl overflow-hidden bg-white border border-gray-200 shadow-sm hover:shadow-xl transition-all duration-300">
                        <img src="https://picsum.photos/400/600?random=1"
                             alt="Session Photo"
                             loading="lazy"
                             class="w-full h-auto object-cover block">


                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-200 p-4 flex flex-col justify-between">
                            <div class="flex justify-end gap-2">
                                <button class="p-2 bg-white/80 hover:bg-white rounded-full text-gray-700 transition-colors shadow">
                                    <x-lucide-download class="w-4 h-4" />
                                </button>
                                <button class="p-2 bg-white/80 hover:bg-red-500 hover:text-white rounded-full text-gray-700 transition-colors shadow">
                                    <x-lucide-trash-2 class="w-4 h-4" />
                                </button>
                            </div>
                            <div class="flex items-center justify-end text-white">

                                <button @click="modalOpen = true; selectedImage = 'https://picsum.photos/800/1200?random=1'"
                                        class="text-xs bg-white text-gray-800 font-semibold px-3 py-1.5 rounded-full hover:bg-gray-100 transition-colors shadow">
                                    View
                                </button>
                            </div>
                        </div>
                    </div>

                    <!--landscape-->
                    <div class="break-inside-avoid relative group rounded-2xl overflow-hidden bg-white border border-gray-200 shadow-sm hover:shadow-xl transition-all duration-300">
                        <img src="https://picsum.photos/400/300?random=2"
                             alt="Session Photo"
                             loading="lazy"
                             class="w-full h-auto object-cover block">

                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-200 p-4 flex flex-col justify-between">
                            <div class="flex justify-end gap-2">
                                <button class="p-2 bg-white/80 hover:bg-white rounded-full text-gray-700 transition-colors shadow">
                                    <x-lucide-download class="w-4 h-4" />
                                </button>
                                <button class="p-2 bg-white/80 hover:bg-red-500 hover:text-white rounded-full text-gray-700 transition-colors shadow">
                                    <x-lucide-trash-2 class="w-4 h-4" />
                                </button>
                            </div>
                            <div class="flex items-center justify-end text-white">
                                <button @click="modalOpen = true; selectedImage = 'https://picsum.photos/1200/800?random=2'"
                                        class="text-xs bg-white text-gray-800 font-semibold px-3 py-1.5 rounded-full hover:bg-gray-100 transition-colors shadow">
                                    View
                                </button>
                            </div>
                        </div>
                    </div>

                    <!--medium-->
                    <div class="break-inside-avoid relative group rounded-2xl overflow-hidden bg-white border border-gray-200 shadow-sm hover:shadow-xl transition-all duration-300">
                        <img src="https://picsum.photos/400/500?random=3"
                             alt="Session Photo"
                             loading="lazy"
                             class="w-full h-auto object-cover block">

                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-200 p-4 flex flex-col justify-between">
                            <div class="flex justify-end gap-2">
                                <button class="p-2 bg-white/80 hover:bg-white rounded-full text-gray-700 transition-colors shadow">
                                    <x-lucide-download class="w-4 h-4" />
                                </button>
                                <button class="p-2 bg-white/80 hover:bg-red-500 hover:text-white rounded-full text-gray-700 transition-colors shadow">
                                    <x-lucide-trash-2 class="w-4 h-4" />
                                </button>
                            </div>
                            <div class="flex items-center justify-end text-white">

                                <button @click="modalOpen = true; selectedImage = 'https://picsum.photos/800/1000?random=3'"
                                        class="text-xs bg-white text-gray-800 font-semibold px-3 py-1.5 rounded-full hover:bg-gray-100 transition-colors shadow">
                                    View
                                </button>
                            </div>
                        </div>
                    </div>

                    {{--Tall one--}}
                    <div class="break-inside-avoid relative group rounded-2xl overflow-hidden bg-white border border-gray-200 shadow-sm hover:shadow-xl transition-all duration-300">
                        <img src="https://picsum.photos/400/700?random=4"
                             alt="Session Photo"
                             loading="lazy"
                             class="w-full h-auto object-cover block">

                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-200 p-4 flex flex-col justify-between">
                            <div class="flex justify-end gap-2">
                                <button class="p-2 bg-white/80 hover:bg-white rounded-full text-gray-700 transition-colors shadow">
                                    <x-lucide-download class="w-4 h-4" />
                                </button>
                                <button class="p-2 bg-white/80 hover:bg-red-500 hover:text-white rounded-full text-gray-700 transition-colors shadow">
                                    <x-lucide-trash-2 class="w-4 h-4" />
                                </button>
                            </div>
                            <div class="flex items-center justify-end text-white">

                                <button @click="modalOpen = true; selectedImage = 'https://picsum.photos/800/1400?random=4'"
                                        class="text-xs bg-white text-gray-800 font-semibold px-3 py-1.5 rounded-full hover:bg-gray-100 transition-colors shadow">
                                    View
                                </button>
                            </div>
                        </div>
                    </div>

                </div>

                <!--modal popup-->
                <div x-show="modalOpen"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     @keydown.escape.window="modalOpen = false"
                     class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm"
                     x-cloak>

                    <!--Modal Card-->
                    <div @click.away="modalOpen = false" class="relative max-w-4xl max-h-[90vh] bg-white rounded-2xl overflow-hidden shadow-2xl flex flex-col">
                        <!--Close Button-->
                        <button @click="modalOpen = false" class="absolute top-4 right-4 z-10 p-2 bg-black/50 hover:bg-black/70 text-white rounded-full transition-colors">
                            <x-lucide-x class="w-5 h-5" />
                        </button>

                        <!--Image View-->
                        <div class="overflow-auto max-h-[85vh]">
                            <img :src="selectedImage" alt="Expanded view" class="w-full h-auto object-contain">
                        </div>
                    </div>
                </div>

            </div>

        </div>



        <div x-show="tab === 'account'" x-data="{ editMode: false, modalConfirm: false }">

            <!--header-->
            <div class="flex flex-col my-3 mb-4">
                <span class="text-2xl font-semibold">My Account</span>
                <span class="text-gray-500">Manage Your Profile and Account Settings</span>
            </div>

            <div class="flex flex-col lg:flex-row gap-4">


                <div class="w-full lg:w-2/3 flex flex-col gap-4">

                    <!-- profile info -->
                    <div class="rounded-lg border border-gray-200 shadow-sm p-5">
                        <div class="flex items-center justify-between pb-4 mb-4 border-b border-gray-100">
                            <div class="flex items-center gap-4">
                                <div class="uppercase w-16 h-16 rounded-full bg-primary text-white flex items-center justify-center text-2xl font-medium">
                                    {{substr(Auth::user()->name, 0, 1)}}
                                </div>
                                <div>
                                    <h1 class="font-bold text-xl">{{Auth::user()->name}}</h1>
                                    <span class="text-xs uppercase font-semibold text-gray-500"></span>
                                </div>
                            </div>

                            <button @click="editMode = !editMode" type="button"
                                    class="py-1.5 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-primary border border-primary-line text-primary-foreground hover:bg-primary-hover focus:outline-hidden disabled:opacity-50 disabled:pointer-events-none">
                                <x-lucide-pencil class="w-4 h-4"></x-lucide-pencil>
                                <span x-text="editMode ? 'Cancel' : 'Edit Profile'"></span>
                            </button>
                        </div>


                        <form action="{{route('dashboard.updateProfile')}}" method="POST" class="space-y-4">
                            @csrf
                            @method('PATCH')

                            <div>
                                <label for="nama" class="block text-sm font-medium text-foreground mb-1.5">Full Name</label>
                                <div class="relative">
                                    <input type="text" id="name" name="name" value="{{Auth::user()->name}}" :disabled="!editMode"
                                           class="peer py-2.5 sm:py-3 px-4 ps-11 block w-full bg-surface border-transparent rounded-lg sm:text-sm text-foreground placeholder:text-muted-foreground-1 focus:bg-layer focus:border-primary-focus focus:ring-primary-focus disabled:opacity-50 disabled:pointer-events-none"
                                           placeholder="Enter name">
                                    <div class="absolute inset-y-0 inset-s-0 flex items-center pointer-events-none ps-4 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                                        <x-lucide-user class="shrink-0 size-4 text-muted-foreground-1"></x-lucide-user>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-foreground mb-1.5">Email Address</label>
                                <div class="relative">
                                    <input type="email" id="email" name="email" value="{{Auth::user()->email}}" :disabled="!editMode"
                                           class="peer py-2.5 sm:py-3 px-4 ps-11 block w-full bg-surface border-transparent rounded-lg sm:text-sm text-foreground placeholder:text-muted-foreground-1 focus:bg-layer focus:border-primary-focus focus:ring-primary-focus disabled:opacity-50 disabled:pointer-events-none"
                                           placeholder="Enter email">
                                    <div class="absolute inset-y-0 inset-s-0 flex items-center pointer-events-none ps-4 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                                        <x-lucide-mail class="shrink-0 size-4 text-muted-foreground-1"></x-lucide-mail>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label for="no_hp" class="block text-sm font-medium text-foreground mb-1.5">Phone Number</label>
                                <div class="relative">
                                    <input type="text" id="no_hp" name="no_hp" value="{{Auth::user()->no_hp}}" :disabled="!editMode"
                                           class="peer py-2.5 sm:py-3 px-4 ps-11 block w-full bg-surface border-transparent rounded-lg sm:text-sm text-foreground placeholder:text-muted-foreground-1 focus:bg-layer focus:border-primary-focus focus:ring-primary-focus disabled:opacity-50 disabled:pointer-events-none"
                                           placeholder="Enter phone number">
                                    <div class="absolute inset-y-0 inset-s-0 flex items-center pointer-events-none ps-4 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                                        <x-lucide-phone class="shrink-0 size-4 text-muted-foreground-1"></x-lucide-phone>
                                    </div>
                                </div>
                            </div>

                            <div x-show="editMode" class="flex justify-end gap-2 pt-2">
                                <button type="button" @click="editMode = false"
                                        class="py-2 px-4 text-sm font-medium rounded-lg border border-gray-200 hover:bg-gray-50 focus:outline-hidden">
                                    Discard
                                </button>
                                <button type="submit"
                                        class="py-2 px-4 text-sm font-medium rounded-lg bg-primary border border-primary-line text-primary-foreground hover:bg-primary-hover focus:outline-hidden">
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>


                    <div class="rounded-lg border border-gray-200 shadow-sm p-5">
                        <div class="flex items-center gap-2 pb-4 mb-4 border-b border-gray-100">
                            <x-lucide-lock class="w-5 h-5"></x-lucide-lock>
                            <h1 class="font-semibold text-lg">Change Password</h1>
                        </div>

                        <form action="{{route('dashboard.updatePassword')}}" method="POST" class="space-y-4">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="tab" value="account">


                            <div class="flex gap-4">
                                <div class="flex-1">
                                    <label class="text-sm font-medium text-gray-600">New Password</label>
                                    <input type="password" name="new_password" placeholder="••••••••"
                                           class="mt-1 w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-hidden focus:border-primary">
                                    <x-input-error :messages="$errors->get('new_password')" class="mt-2" />
                                </div>
                                <div class="flex-1">
                                    <label class="text-sm font-medium text-gray-600">Confirm New Password</label>
                                    <input type="password" name="new_password_confirmation" placeholder="••••••••"
                                           class="mt-1 w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-hidden focus:border-primary"
                                           autocomplete="new-password">
                                    <x-input-error :messages="$errors->get('new_password_confirmation')" class="mt-2" />
                                </div>
                            </div>

                            <div class="flex justify-end pt-2">
                                <button type="submit"
                                        class="py-2 px-4 text-sm font-medium rounded-lg bg-primary border border-primary-line text-primary-foreground hover:bg-primary-hover focus:outline-hidden">
                                    Update Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>


                <div class="w-full lg:w-1/3 flex flex-col gap-4">

                    <div class="rounded-lg border border-gray-200 shadow-sm p-5">
                        <h1 class="font-semibold text-lg pb-4 mb-4 border-b border-gray-100">Account Information</h1>

                        <div class="flex flex-col gap-4">
                            <div class="flex items-center gap-3">
                                <div class="text-primary-500 bg-primary/15 p-2 rounded-full">
                                    <x-lucide-shield class="w-5 h-5"></x-lucide-shield>
                                </div>
                                <div>
                                    <h5 class="text-xs font-semibold text-gray-500">Role</h5>
                                    <h1 class="font-semibold capitalize">{{Auth::user()->role}}</h1>
                                </div>
                            </div>

                            <div class="flex items-center gap-3">
                                <div class="text-primary-500 bg-primary/15 p-2 rounded-full">
                                    <x-lucide-calendar class="w-5 h-5"></x-lucide-calendar>
                                </div>
                                <div>
                                    <h5 class="text-xs font-semibold text-gray-500">Member Since</h5>
                                    <h1 class="font-semibold">{{Auth::user()->created_at->format('Y-m-d')}}</h1>
                                </div>
                            </div>

                            <div class="flex items-center gap-3">
                                <div class="text-primary-500 bg-primary/15 p-2 rounded-full">
                                    <x-lucide-hash class="w-5 h-5"></x-lucide-hash>
                                </div>
                                <div>
                                    <h5 class="text-xs font-semibold text-gray-500">User ID</h5>
                                    <h1 class="font-semibold">#{{Auth::user()->user_id}}</h1>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="rounded-lg border border-red-200 shadow-sm p-5">
                        <h1 class="font-semibold text-lg text-red-500 pb-4 mb-4 border-b border-red-100">Danger Zone</h1>
                        <p class="text-sm text-gray-500 mb-4">
                            Once you delete your account, there is no going back. Please be certain.
                        </p>
                        <button type="button"
                                class="w-full py-2.5 px-4 text-sm font-medium rounded-lg border border-red-500 text-red-500 hover:bg-red-50 focus:outline-hidden">
                            Delete Account
                        </button>
                    </div>
                </div>
            </div>

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

                <!--Modal Card-->
                <div @click.away="modalConfirm = false" class="relative max-w-4xl max-h-[90vh] bg-white rounded-2xl overflow-hidden shadow-2xl flex flex-col">
                    <!--Close Button-->
                    <button @click="modalConfirm = false" class="absolute top-4 right-4 z-10 p-2 bg-black/50 hover:bg-black/70 text-white rounded-full transition-colors">
                        <x-lucide-x class="w-5 h-5" />
                    </button>

                    <!--Image View-->
                    <div class="overflow-auto max-h-[85vh]">
                        <img :src="selectedImage" alt="Expanded view" class="w-full h-auto object-contain">
                    </div>
                </div>
            </div>

        </div>




        @if (session('success'))
            <!--Alert-->
            <div class="absolute flex justify-end m-6  bottom-0 right-0">
                <div id="dismiss-alert" class="justify-end w-fit hs-removing:translate-x-5 hs-removing:opacity-0 transition duration-300 bg-teal-50 border border-teal-200 text-sm text-teal-800 rounded-lg p-4 dark:bg-teal-500/20 dark:border-teal-900 dark:text-teal-400" role="alert" tabindex="-1" aria-labelledby="hs-dismiss-button-label">
                    <div class="flex">
                        <div class="shrink-0">
                            <svg class="shrink-0 size-4 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/><path d="m9 12 2 2 4-4"/></svg>
                        </div>
                        <div class="ms-2">
                            <h3 id="hs-dismiss-button-label" class="text-sm font-medium">
                                {{session('success')}}
                            </h3>
                        </div>
                        <div class="ps-3 ms-auto">
                            <div class="-mx-1.5 -my-1.5">
                                <button type="button" class="inline-flex bg-teal-50 rounded-lg p-1.5 text-teal-500 hover:bg-teal-100 focus:outline-hidden focus:bg-teal-100 dark:bg-transparent dark:text-teal-600 dark:hover:bg-teal-800/50 dark:focus:bg-teal-800/50" data-hs-remove-element="#dismiss-alert">
                                    <span class="sr-only">Dismiss</span>
                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Alert-->
       @endif
    </main>
</div>


</body>
</html>

