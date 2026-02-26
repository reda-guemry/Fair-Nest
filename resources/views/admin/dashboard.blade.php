<x-admin>
    <x-slot name="header">
        <h2 class="text-3xl font-black text-[#1A1A1A] tracking-tight">Gestion des Utilisateurs</h2>
        <p class="text-gray-500 font-medium">Visualisez et gérez tous les membres inscrits sur Fair-Nest.</p>
    </x-slot>

    <div class="bg-white rounded-[2rem] shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)] border border-gray-100 overflow-hidden">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-gray-50/50 border-b border-gray-100">
                    <th class="px-8 py-5 text-xs font-black uppercase tracking-wider text-gray-400">Utilisateur</th>
                    <th class="px-8 py-5 text-xs font-black uppercase tracking-wider text-gray-400">Date d'inscription</th>
                    <th class="px-8 py-5 text-xs font-black uppercase tracking-wider text-gray-400">Status</th>
                    <th class="px-8 py-5 text-xs font-black uppercase tracking-wider text-gray-400 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                <tr class="hover:bg-gray-50/50 transition-colors group">
                    <td class="px-8 py-5">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center text-orange-600 font-bold">JD</div>
                            <div>
                                <div class="font-bold text-[#1A1A1A]">John Doe</div>
                                <div class="text-xs text-gray-400">john@example.com</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-5 text-sm text-gray-500 font-medium">24 Fév 2026</td>
                    <td class="px-8 py-5">
                        <span class="px-3 py-1 bg-green-50 text-green-600 text-[10px] font-black uppercase rounded-full">Actif</span>
                    </td>
                    <td class="px-8 py-5 text-right">
                        <button class="text-gray-400 hover:text-red-500 transition-colors px-2 py-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</x-admin-layout>