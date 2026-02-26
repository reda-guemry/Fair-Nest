<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - {{ config('app.name') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>body { font-family: 'Outfit', sans-serif; }</style>
</head>
<body class="bg-[#FAF9F6] text-[#1A1A1A] antialiased">
    <div class="flex min-h-screen">
        <aside class="w-72 bg-white border-r border-gray-100 flex flex-col sticky top-0 h-screen z-50">
            <div class="p-8">
                <a href="/" class="flex items-center space-x-3 group">
                    <div class="w-10 h-10 bg-[#1A1A1A] rounded-full flex items-center justify-center group-hover:scale-105 transition-transform">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    </div>
                    <span class="text-2xl font-black tracking-tight">Fair-Nest<span class="text-orange-400">.</span></span>
                </a>
            </div>

            <nav class="flex-1 px-4 space-y-2">
                <p class="px-4 text-[10px] font-black uppercase tracking-widest text-gray-400 mb-4">Menu Principal</p>
                
                <a href="{{ route('dashboard.admin') }}" class="flex items-center space-x-3 px-4 py-4 rounded-2xl bg-orange-50 text-orange-500 font-bold transition-all shadow-sm shadow-orange-100/50">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    <span>Utilisateurs</span>
                </a>

                <a href="{{ route('admin.categories') }}" class="flex items-center space-x-3 px-4 py-4 rounded-2xl text-gray-500 hover:bg-gray-50 hover:text-[#1A1A1A] transition-all font-semibold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                    <span>Catégories</span>
                </a>
            </nav>

            <div class="p-6 mt-auto border-t border-gray-50">
                <a href="/dashboard" class="flex items-center space-x-3 px-4 py-3 text-sm font-medium text-gray-500 hover:text-orange-400 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z"></path></svg>
                    <span>Retour Site</span>
                </a>
            </div>
        </aside>

        <main class="flex-1 p-10 overflow-y-auto relative">
            <div class="absolute top-0 right-0 w-64 h-64 bg-orange-100 rounded-full mix-blend-multiply filter blur-3xl opacity-30 -z-10 animate-blob"></div>
            
            <header class="mb-10">
                {{ $header }}
            </header>

            {{ $slot }}
        </main>
    </div>
</body>
</html>