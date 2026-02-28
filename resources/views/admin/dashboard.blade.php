<x-admin>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6 mb-8">
                <div class="flex items-center gap-5">
                    <div class="w-14 h-14 bg-orange-50 rounded-2xl flex items-center justify-center shrink-0 border border-orange-100 shadow-sm">
                        <svg class="w-7 h-7 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-3xl font-extrabold text-[#1A1A1A] tracking-tight">
                            {{ __('Gestion des Utilisateurs') }}
                        </h2>
                        <p class="text-sm font-medium text-gray-500 mt-1">
                            {{ __('Gérez les membres, leurs rôles et l\'état de leurs comptes.') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-[2rem] shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)] border border-gray-100 overflow-hidden">
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/80 border-b border-gray-100">
                                <th class="px-8 py-5 text-xs font-extrabold uppercase tracking-wider text-gray-400">{{ __('Utilisateur') }}</th>
                                <th class="px-8 py-5 text-xs font-extrabold uppercase tracking-wider text-gray-400">{{ __('Rôle') }}</th>
                                <th class="px-8 py-5 text-xs font-extrabold uppercase tracking-wider text-gray-400">{{ __('Date d\'inscription') }}</th>
                                <th class="px-8 py-5 text-xs font-extrabold uppercase tracking-wider text-gray-400">{{ __('Statut') }}</th>
                                <th class="px-8 py-5 text-xs font-extrabold uppercase tracking-wider text-gray-400 text-right">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            
                            @for($i = 0; $i < 6; $i++)
                            @php $isBanned = $i % 2 != 0; @endphp

                            <tr class="group hover:bg-orange-50/30 transition-colors duration-200">
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-4">
                                        <div class="relative">
                                            <div class="w-10 h-10 {{ $isBanned ? 'bg-gray-100 text-gray-400' : 'bg-orange-100 text-orange-700' }} rounded-full flex items-center justify-center font-bold text-sm border-2 border-white shadow-sm">
                                                JD
                                            </div>
                                            <span class="absolute bottom-0 right-0 w-3 h-3 {{ $isBanned ? 'bg-gray-300' : 'bg-green-400' }} border-2 border-white rounded-full"></span>
                                        </div>
                                        <div>
                                            <div class="font-bold {{ $isBanned ? 'text-gray-500 line-through decoration-gray-300' : 'text-[#1A1A1A]' }} text-sm group-hover:text-orange-600 transition-colors">John Doe</div>
                                            <div class="text-xs text-gray-400 font-medium">john.doe@example.com</div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-8 py-5">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-600 border border-gray-200">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                        Client
                                    </span>
                                </td>

                                <td class="px-8 py-5 text-sm text-gray-500 font-medium">
                                    24 Fév 2026
                                </td>

                                <td class="px-8 py-5">
                                    @if($isBanned)
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-red-50 text-red-700 border border-red-100 text-[10px] font-black uppercase tracking-wide rounded-full">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                                            Banni
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-green-50 text-green-700 border border-green-100 text-[10px] font-black uppercase tracking-wide rounded-full">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                            Actif
                                        </span>
                                    @endif
                                </td>

                                <td class="px-8 py-5 text-right">
                                    <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                        
                                        @if($isBanned)
                                            <form method="POST" action="#">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="w-8 h-8 rounded-full bg-white border border-green-200 flex items-center justify-center text-green-500 hover:bg-green-500 hover:text-white shadow-sm transition-all" title="Débannir l'utilisateur">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        @else
                                            <form method="POST" action="#">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="w-8 h-8 rounded-full bg-white border border-gray-200 flex items-center justify-center text-gray-400 hover:text-orange-600 hover:border-orange-200 hover:bg-orange-50 shadow-sm transition-all" title="Bannir l'utilisateur">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif

                                        <form method="POST" action="#" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer définitivement cet utilisateur ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-8 h-8 rounded-full bg-white border border-gray-200 flex items-center justify-center text-gray-400 hover:text-red-500 hover:border-red-200 hover:bg-red-50 shadow-sm transition-all" title="Supprimer définitivement">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>

                <div class="bg-gray-50/50 px-8 py-5 border-t border-gray-100 flex items-center justify-between">
                    <p class="text-xs text-gray-500 font-medium">Affichage de <span class="font-bold text-[#1A1A1A]">1</span> à <span class="font-bold text-[#1A1A1A]">10</span> sur <span class="font-bold text-[#1A1A1A]">24</span> résultats</p>
                    <div class="flex gap-2">
                        <button class="px-4 py-2 bg-white border border-gray-200 rounded-xl text-xs font-bold text-gray-600 hover:bg-gray-50 transition-colors disabled:opacity-50">Précédent</button>
                        <button class="px-4 py-2 bg-[#1A1A1A] text-white rounded-xl text-xs font-bold shadow-md hover:bg-gray-800 transition-colors">Suivant</button>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</x-admin>