<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-extrabold text-3xl text-[#1A1A1A] tracking-tight">
                    Bonjour, {{ Auth::user()->first_name }} 
                </h2>
                <p class="text-sm font-medium text-gray-500 mt-1">
                    Voici un aperçu de votre espace sur Fair-Nest.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="bg-white overflow-hidden shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)] sm:rounded-[2rem] border border-gray-100 p-8 flex flex-col md:flex-row items-start md:items-center justify-between gap-6 relative">
                <div class="absolute top-0 right-0 w-32 h-32 bg-[#FAF9F6] rounded-bl-full -z-10 opacity-50"></div>
                
                <div class="z-10">
                    <h3 class="text-xl font-bold text-[#1A1A1A]">Bienvenue dans votre nouvel espace !</h3>
                    <p class="text-gray-500 mt-2 text-sm max-w-lg">
                        Gérez vos dépenses, invitez vos colocataires et suivez votre budget en toute simplicité. Tout commence ici.
                    </p>
                </div>
                
                <div class="z-10 shrink-0">
                    <button class="bg-[#1A1A1A] text-[#FAF9F6] px-6 py-3 rounded-full text-sm font-semibold hover:bg-gray-800 transition-all shadow-md">
                        Créer une colocation
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <div class="bg-white p-6 rounded-[2rem] shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)] border border-gray-100 hover:border-gray-200 transition-colors group cursor-pointer">
                    <div class="w-12 h-12 bg-[#F9F8F6] rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-[#1A1A1A]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h4 class="text-lg font-bold text-[#1A1A1A]">Mes Dépenses</h4>
                    <p class="text-sm font-medium text-gray-400 mt-1">0 MAD ce mois-ci</p>
                </div>

                <div class="bg-white p-6 rounded-[2rem] shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)] border border-gray-100 hover:border-gray-200 transition-colors group cursor-pointer">
                    <div class="w-12 h-12 bg-[#F9F8F6] rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-[#1A1A1A]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <h4 class="text-lg font-bold text-[#1A1A1A]">Colocataires</h4>
                    <p class="text-sm font-medium text-gray-400 mt-1">Aucun colocataire actif</p>
                </div>

                <div class="bg-white p-6 rounded-[2rem] shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)] border border-gray-100 hover:border-gray-200 transition-colors group cursor-pointer">
                    <div class="w-12 h-12 bg-[#F9F8F6] rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-[#1A1A1A]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                    </div>
                    <h4 class="text-lg font-bold text-[#1A1A1A]">Réputation</h4>
                    <p class="text-sm font-medium text-orange-400 mt-1">Nouveau membre</p>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>