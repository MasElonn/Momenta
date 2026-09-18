<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
          integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
          crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
            crossorigin=""></script>

    <script src="https://unpkg.com/dropzone@6/dist/dropzone-min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@6/dist/dropzone.css" type="text/css" />


</head>
<body>

<div class="w-screen h-screen flex" x-data="{
    tab: $persist('overview').as('dashboard_tab'),
    section: $persist('').as('dashboard_section')}">

    <x-dashboard.sidebar :user="$user ?? Auth::user()" />

    <main class="static flex-1 p-4 justify-between">
        <x-dashboard.overview :user="$user ?? Auth::user()" :transaksis="$transaksis"/>
        <x-dashboard.booking  :transaksis="$transaksis"/>
        <x-dashboard.gallery  :transaksis="$transaksis"/>
        <x-dashboard.account :user="$user ?? Auth::user()" />
        <x-alert />


        {{--<form action="{{ route('foto.upload') }}" method="post" class="dropzone" id="my-dropzone">
            @csrf
            <input type="number" name="acara_id" id="acara_id" value="1" hidden>

        </form>--}}


    </main>

</div>

</body>
</html>
