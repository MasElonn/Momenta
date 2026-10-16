@props(['current' => null, 'title' => 'Dashboard'])
<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }} — Momenta</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased">

{{-- Same shell as CustomerDashboard: the x-data keys match so the sidebar's
     tab state is shared with the dashboard through $persist. min-h-screen
     (not h-screen) lets long pages grow while the sidebar stays sticky. --}}
<div class="flex min-h-screen w-full"
     x-data="{
        tab: $persist('overview').as('dashboard_tab'),
        section: $persist('').as('dashboard_section')
     }">

    <x-dashboard.sidebar :user="Auth::user()" :current="$current" />

    <main class="min-w-0 flex-1 p-4 sm:p-6">
        {{ $slot }}
    </main>
</div>

</body>
</html>