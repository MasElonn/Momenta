<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0,
          maximum-scale=1.0, minimum-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <link rel="stylesheet"
          href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
          integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
          crossorigin="" />

    <script
        src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin="">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body class="bg-gray-50 text-gray-900 font-sans antialiased">

<div class="w-screen h-screen flex bg-gray-50 overflow-hidden" x-data="{
    tab: $persist('overview').as('fotografer_dashboard_tab'),
    section: $persist('').as('fotografer_dashboard_section')}">

    <x-fotografer.sidebar :user="$user ?? Auth::user()" />

    <main class="static flex-1 p-6 lg:p-8 overflow-y-auto">
        <div x-show="tab === 'overview'" x-cloak>
            <x-fotografer.overview
                :user="$user ?? Auth::user()"
                :totalPaket="$totalPaket ?? 0"
                :totalTransaksi="$totalTransaksi ?? 0"
                :totalBooking="$totalBooking ?? 0"
                :totalFoto="$totalFoto ?? 0"
                :totalPendapatan="$totalPendapatan ?? 0"
                :revenueLabels="$revenueLabels ?? []"
                :revenueData="$revenueData ?? []"
                :filterPeriode="$filterPeriode ?? []"
                :rekapTransaksi="$rekapTransaksi ?? []"
                :riwayatTransaksi="$riwayatTransaksi ?? collect()"
                :upcomingSessions="$upcomingSessions ?? collect()"
                :paketSaya="$paketSaya ?? collect()"
            />
        </div>
        <div x-show="tab === 'paket'" x-cloak>
            <x-fotografer.paket  :transaksis="$transaksis"/>
        </div>
        <div x-show="tab === 'booking'" x-cloak>
            <x-fotografer.booking  :transaksis="$transaksis"/>
        </div>
        <div x-show="tab === 'gallery'" x-cloak>
            <x-fotografer.gallery  :transaksis="$transaksis"/>
        </div>
        <div x-show="tab === 'transaksi'" x-cloak>
            <x-fotografer.transaksi  :transaksis="$transaksis"/>
        </div>
        <div x-show="tab === 'account'" x-cloak>
            <x-fotografer.account :user="$user ?? Auth::user()"  :transaksis="$transaksis"/>
        </div>
        <x-alert />
    </main>
</div>

</body>

</html>
