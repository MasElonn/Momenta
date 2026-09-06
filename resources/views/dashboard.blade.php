<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard — Momenta</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#FDFFFF] antialiased">
    <nav class="flex items-center justify-between border-b border-gray-200 px-6 py-4">
        <span class="flex items-center gap-2 text-lg font-semibold text-[#1447E6]">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path d="M12 2 3 20h4.2L12 10.5 16.8 20H21L12 2Z" />
            </svg>
            Momenta
        </span>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-sm font-semibold text-[#1447E6] hover:underline">Logout</button>
        </form>
    </nav>

    <main class="mx-auto max-w-3xl px-6 py-16">
        @if (session('status'))
            <x-auth-status :status="session('status')" class="mb-6" />
        @endif

        <h1 class="text-3xl font-bold text-[#1447E6]">Welcome, {{ auth()->user()->name }} 👋</h1>
        <p class="mt-2 text-gray-500">You're signed in and your email is verified.</p>

        <a
            href="{{ route('protected.action') }}"
            class="mt-8 inline-flex h-11 items-center rounded-lg bg-[#1447E6] px-5 text-sm font-semibold text-white hover:bg-[#1138c2]"
        >
            Try a password-confirmed action
        </a>
    </main>
</body>
</html>
