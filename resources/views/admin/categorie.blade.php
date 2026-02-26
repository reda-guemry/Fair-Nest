<x-admin>
    <x-slot name="header">
        <div class="flex justify-between items-end">
            <div>
                <h2 class="text-3xl font-black text-[#1A1A1A] tracking-tight">Catégories</h2>
                <p class="text-gray-500 font-medium">Gérez les types de dépenses de la plateforme.</p>
            </div>
            <button class="bg-[#1A1A1A] text-white px-6 py-3 rounded-full text-sm font-bold hover:bg-orange-400 transition-all shadow-lg">+ Ajouter</button>
        </div>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)] flex flex-col justify-between">
            <div class="flex items-start justify-between">
                <div class="w-12 h-12 bg-orange-50 rounded-2xl flex items-center justify-center text-orange-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <div class="flex gap-2">
                    <button class="p-2 hover:bg-blue-50 text-blue-500 rounded-xl transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </button>
                    <button class="p-2 hover:bg-red-50 text-red-500 rounded-xl transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                </div>
            </div>
            <div class="mt-6">
                <h4 class="text-xl font-bold text-[#1A1A1A]">Courses Alimentaires</h4>
                <p class="text-sm text-gray-400 mt-1 font-medium italic">Slug: courses-alim</p>
            </div>
        </div>
        </div>
</x-admin>