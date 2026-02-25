<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Fair-Nest') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    @vite(['resources/js/app.js'])

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    

    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>

<body class="font-sans antialiased text-[#1A1A1A] bg-[#FAF9F6]">
    <div class="min-h-screen">

        @include('layouts.navigation')

        @isset($header)
            <header class="bg-transparent pt-8 pb-2">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    {{ $header }}
            </header>
        @endisset

        <main>
            {{ $slot }}
        </main>

    </div>

</body>

</html>