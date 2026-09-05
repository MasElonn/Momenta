@props(['user' => Auth::user()])

<div x-show="tab === 'overview'">
    <h1 class="pt-5 text-4xl font-semibold">Hello, {{ $user->name ?? Auth::user()->name }}!</h1>
    <h2>Welcome back to your Momenta dashboard. Your next session is coming up soon.</h2>

    <div class="mt-5 flex justify-between">
        <div class="flex-auto w-full p-2">
            <h2 class="py-2 text-xl font-semibold">Bookings</h2>

            <div class="w-full rounded-lg border border-gray-200 shadow-sm p-4">
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

                        <div class="flex justify-between mt-3">
                            <div class="flex gap-1">
                                <x-lucide-user class="w-6 h-6 rounded-full" />
                                <span class="text-sm text-gray-600">iwan - Fotografer</span>
                            </div>

                            <div class="flex gap-2">
                                <button type="button" @click="section = 'booking', tab = 'booking'"
                                        class="py-1.5 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-primary border border-primary-line text-primary-foreground hover:bg-primary-hover focus:outline-hidden disabled:opacity-50 disabled:pointer-events-none">
                                    Manage
                                </button>

                                <button type="button" @click="section = 'gallery', tab = 'gallery'"
                                        class="py-1.5 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-primary border border-primary-line text-primary-foreground hover:bg-primary-hover focus:outline-hidden disabled:opacity-50 disabled:pointer-events-none">
                                    Gallery
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-70 flex-auto p-2">
            <h2 class="py-2 text-xl font-semibold">Gallery</h2>
            <div class="w-full h-40 rounded-lg">
                <img class="rounded-lg" src="https://picsum.photos/210/160" alt="foto">
            </div>
            <div class="mt-2 shadow w-full h-40 rounded-lg">
                <img class="rounded-lg" src="https://picsum.photos/210/160" alt="foto">
            </div>
            <div class="mt-2 shadow w-full h-40 rounded-lg">
                <img class="rounded-lg" src="https://picsum.photos/210/160" alt="foto">
            </div>
        </div>
    </div>
</div>
