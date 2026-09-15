<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0,
          maximum-scale=1.0, minimum-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Dashboard</title>

    {{-- Vite --}}
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    {{-- Alpine x-cloak --}}
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    {{-- Leaflet CSS --}}
    <link rel="stylesheet"
          href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
          integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
          crossorigin="" />

    {{-- Leaflet JS --}}
    <script
        src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin="">
    </script>

</head>

<body>

<div
    class="w-screen h-screen flex"
    x-data="{
        tab: '{{ old('tab', request('tab', 'overview')) }}',
        section: ''
    }"
>

    {{-- SIDEBAR --}}
    <x-fotografer.sidebar :user="$user ?? Auth::user()" />


    {{-- MAIN CONTENT --}}
    <main class="static flex-1 p-4">

        {{-- ========================= --}}
        {{-- OVERVIEW --}}
        {{-- ========================= --}}
        <div
            x-show="tab === 'overview'"
            x-cloak
        >
            <x-fotografer.overview
                :user="$user ?? Auth::user()"
            />
        </div>


        {{-- ========================= --}}
        {{-- BOOKING --}}
        {{-- ========================= --}}
        <div
            x-show="tab === 'booking'"
            x-cloak
        >
            <x-fotografer.booking />
        </div>


        {{-- ========================= --}}
        {{-- GALLERY --}}
        {{-- ========================= --}}
        <div
            x-show="tab === 'gallery'"
            x-cloak
        >
            <x-fotografer.gallery />
        </div>


        {{-- ========================= --}}
        {{-- EVENT --}}
        {{-- ========================= --}}
        <div
            x-show="tab === 'event'"
            x-cloak
        >
            <x-fotografer.event />
        </div>


        {{-- ========================= --}}
        {{-- TRANSAKSI --}}
        {{-- ========================= --}}
        <div
            x-show="tab === 'transaksi'"
            x-cloak
        >
            <x-fotografer.transaksi />
        </div>


        {{-- ========================= --}}
        {{-- MY ACCOUNT --}}
        {{-- ========================= --}}
        <div
            x-show="tab === 'account'"
            x-cloak
        >
            <x-fotografer.account
                :user="$user ?? Auth::user()"
            />
        </div>


        {{-- ALERT --}}
        <x-alert />

    </main>

</div>

</body>

</html>