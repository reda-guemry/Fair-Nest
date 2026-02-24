<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Fair-Nest') }} - La Colocation sans stress</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="bg-[#FAF9F6] text-[#1A1A1A] antialiased selection:bg-orange-400 selection:text-white">

    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex justify-between items-center relative z-50">
        <a href="/" class="flex items-center space-x-3 group">
            <div class="w-10 h-10 bg-[#1A1A1A] rounded-full flex items-center justify-center group-hover:scale-105 transition-transform duration-300 shadow-sm">
                <svg class="w-5 h-5 text-[#FAF9F6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
            </div>
            <span class="text-2xl font-black tracking-tight text-[#1A1A1A]">
                Fair-Nest<span class="text-orange-400">.</span>
            </span>
        </a>

        @if (Route::has('login'))
            <div class="flex items-center space-x-6">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm font-bold hover:text-orange-400 transition-colors">Aller au Dashboard &rarr;</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-600 hover:text-[#1A1A1A] transition-colors hidden sm:block">Se connecter</a>
                    
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="bg-[#1A1A1A] text-[#FAF9F6] px-6 py-2.5 rounded-full text-sm font-semibold hover:bg-gray-800 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                            Créer un compte
                        </a>
                    @endif
                @endauth
            </div>
        @endif
    </nav>

    <main class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 pb-32 text-center">
        <div class="absolute top-10 left-10 w-64 h-64 bg-orange-100 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob"></div>
        <div class="absolute top-10 right-10 w-64 h-64 bg-gray-200 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob animation-delay-2000"></div>

        <div class="relative z-10">
            <h1 class="text-5xl md:text-7xl font-black tracking-tighter mb-6 leading-tight">
                La colocation, <br />
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-[#1A1A1A]">sans les embrouilles.</span>
            </h1>
            
            <p class="text-lg md:text-xl text-gray-500 max-w-2xl mx-auto mb-10 font-medium">
                Gérez vos dépenses communes, organisez votre espace et vivez en parfaite harmonie. Fair-Nest est l'outil ultime pour les colocataires modernes.
            </p>
            
            <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
                <a href="{{ route('register') }}" class="w-full sm:w-auto bg-[#1A1A1A] text-[#FAF9F6] px-8 py-4 rounded-full text-lg font-bold hover:bg-gray-800 transition-all shadow-xl hover:shadow-2xl hover:-translate-y-1">
                    Commencer gratuitement
                </a>
                <a href="#features" class="w-full sm:w-auto bg-white text-[#1A1A1A] px-8 py-4 rounded-full text-lg font-bold border border-gray-200 hover:border-gray-300 hover:bg-gray-50 transition-all shadow-sm">
                    Découvrir les fonctionnalités
                </a>
            </div>
        </div>
    </main>

    <section id="features" class="bg-white py-24 border-t border-gray-100 rounded-t-[3rem] shadow-[0_-10px_40px_-15px_rgba(0,0,0,0.02)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-extrabold text-[#1A1A1A]">Tout ce dont vous avez besoin</h2>
                <p class="text-gray-500 mt-4 font-medium">Pour une cohabitation saine et transparente.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-8 rounded-[2rem] bg-[#FAF9F6] border border-gray-100 hover:border-gray-200 transition-all group">
                    <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center shadow-sm mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7 text-[#1A1A1A]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Comptes clairs</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Ajoutez vos tickets de caisse et dépenses. Fair-Nest calcule automatiquement qui doit combien à qui. Fini les calculs savants à la fin du mois.</p>
                </div>

                <div class="p-8 rounded-[2rem] bg-[#FAF9F6] border border-gray-100 hover:border-gray-200 transition-all group">
                    <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center shadow-sm mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7 text-[#1A1A1A]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Communication</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Centralisez toutes les discussions liées à la maison. Un espace dédié pour éviter que les messages importants se perdent dans d'autres apps.</p>
                </div>

                <div class="p-8 rounded-[2rem] bg-[#FAF9F6] border border-gray-100 hover:border-gray-200 transition-all group">
                    <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center shadow-sm mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7 text-[#1A1A1A]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Fiabilité prouvée</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Un système de réputation unique pour bâtir un historique solide de bon payeur et de colocataire respectueux.</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-white pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center border-t border-gray-100 pt-8">
            <p class="text-sm text-gray-400 font-medium">&copy; {{ date('Y') }} Fair-Nest. Tous droits réservés.</p>
        </div>
    </footer>

</body>
</html>