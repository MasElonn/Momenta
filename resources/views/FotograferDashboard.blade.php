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
    <x-dashboard.sidebar :user="$user ?? Auth::user()" />
    <h2>Fotografer</h2>
    <main class="static flex-1 p-4 justify-between">
        <x-dashboard.overview :user="$user ?? Auth::user()" />
        <x-dashboard.booking />
        <x-dashboard.gallery />
        <x-dashboard.account :user="$user ?? Auth::user()" />
        <x-dashboard.alert />
    </main>
</div>

</body>
</html>
