<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png" href="{{ asset('iconweb.png') }}">
    <title>{{ config('app.name', 'Project Showcase') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-[#0f0f1a] text-gray-100">

    {{-- Top Navigation (fixed) --}}
    @include('layouts.navigation')

    <div class="min-h-screen flex flex-col pt-16">

        {{-- Optional Page Header --}}
        @isset($header)
            <header class="border-b border-white/10 bg-[#141428]">
                <div class="max-w-7xl mx-auto px-6 py-5">
                    <h1 class="text-xl font-semibold tracking-tight">
                        {{ $header }}
                    </h1>
                </div>
            </header>
        @endisset

        {{-- Main Content --}}
        <main class="flex-1">
            <div class="max-w-7xl mx-auto px-6 py-10">
                @yield('content')
            </div>
        </main>

        {{-- Footer --}}
        <footer class="border-t border-white/10 bg-[#0f0f1a]">
            <div class="max-w-7xl mx-auto px-6 py-4 text-xs text-gray-500">
                © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
            </div>
        </footer>

    </div>

</body>
</html>
