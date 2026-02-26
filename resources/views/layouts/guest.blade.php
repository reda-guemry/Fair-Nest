<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Fair-Nest') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        @vite(['resources/js/app.js'])

        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

        <style>
            body { font-family: 'Outfit', sans-serif; }
        </style>
    </head>
    <body class="bg-[#FAF9F6] text-[#1A1A1A] antialiased min-h-screen flex flex-col justify-center items-center py-10">

        <div class="mb-10 text-center">
            <a href="/" class="inline-flex flex-col items-center group">
                <div class="w-16 h-16 bg-[#1A1A1A] rounded-full flex items-center justify-center mb-4 group-hover:scale-105 transition-transform duration-300 shadow-lg">
                    <svg class="w-8 h-8 text-[#FAF9F6]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                </div>
                <span class="text-4xl font-extrabold tracking-tight text-[#1A1A1A]">
                    Fair-Nest<span class="text-orange-400">.</span>
                </span>
            </a>
        </div>

        <div class="w-full sm:max-w-md px-10 py-12 bg-white shadow-[0_20px_60px_-15px_rgba(0,0,0,0.05)] sm:rounded-[2rem] border border-gray-100/50 relative overflow-hidden">
            
            <div class="absolute top-0 right-0 w-32 h-32 bg-[#FAF9F6] rounded-bl-full -z-10 opacity-50"></div>

            <div class="relative z-10">
                {{ $slot }}
            </div>
        </div>

        <div class="mt-12 text-center text-sm font-medium text-gray-400">
            <p>&copy; {{ date('Y') }} Fair-Nest. Tous droits réservés.</p>
            <div class="mt-3 flex justify-center space-x-6">
                <a href="#" class="hover:text-[#1A1A1A] transition-colors">Confidentialité</a>
                <a href="#" class="hover:text-[#1A1A1A] transition-colors">Conditions</a>
                <a href="#" class="hover:text-[#1A1A1A] transition-colors">Contact</a>
            </div>
        </div>

    </body>
</html>