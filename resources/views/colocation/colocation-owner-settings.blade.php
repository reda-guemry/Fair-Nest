<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <div class="flex items-center gap-2 text-gray-400 mb-1">
                    <a href="{{ route('colocation.show', $colocation->id) }}"
                        class="hover:text-orange-500 transition-colors text-xs font-bold uppercase tracking-widest flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7">
                            </path>
                        </svg>
                        Retour à la maison
                    </a>
                </div>
                <h2 class="font-extrabold text-3xl text-[#1A1A1A] tracking-tight">
                    Configuration de {{ $colocation->name }}
                </h2>
                <p class="text-sm font-medium text-gray-500 mt-1">
                    Gérez les catégories de dépenses et les préférences de votre colocation.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <div
                class="bg-white shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)] sm:rounded-[2rem] border border-gray-100 overflow-hidden">
                <div class="p-8 border-b border-gray-50 flex items-center justify-between bg-[#FAF9F6]/30">
                    <div>
                        <h3 class="text-xl font-bold text-[#1A1A1A]">Catégories de Dépenses</h3>
                        <p class="text-sm text-gray-500">Ajoutez ou modifiez les catégories pour mieux organiser vos
                            comptes.</p>
                    </div>
                    <div class="w-12 h-12 bg-orange-50 rounded-2xl flex items-center justify-center text-orange-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                            </path>
                        </svg>
                    </div>
                </div>

                <div class="p-8">
                    <form action="{{ route('colocation.categories.store', $colocation->id) }}" method="POST"
                        class="flex flex-wrap items-end gap-4 mb-10 bg-gray-50/50 p-6 rounded-3xl border border-dashed border-gray-200">
                        @csrf
                        <div class="flex-1 min-w-[250px]">
                            <label
                                class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2 ml-1">Nouvelle
                                Catégorie</label>
                            <input type="text" name="name" placeholder="ex: Courses, Internet, Loyer..."
                                class="w-full rounded-2xl border-gray-200 shadow-sm focus:border-orange-400 focus:ring focus:ring-orange-400/20 text-sm py-3 px-4 transition-all">
                        </div>
                        <button type="submit"
                            class="bg-[#1A1A1A] text-[#FAF9F6] px-8 py-3 rounded-2xl text-sm font-bold hover:bg-gray-800 transition-all shadow-md flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Ajouter
                        </button>
                    </form>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($colocation->categories as $category)

                            <form action="{{ route('colocation.categories.update', [$colocation->id, $category->id]) }}"
                                method="POST" x-data="{ editing: false, name: '{{ $category->name }}' }"
                                class="flex items-center justify-between p-4 rounded-2xl border border-gray-100 bg-white hover:border-orange-200 transition-all group">

                                @csrf

                                <input type="hidden" name="category_id" value="{{ $category->id }}">

                                <div class="flex items-center gap-4 flex-1">
                                    <div
                                        class="w-10 h-10 bg-gray-50 rounded-xl flex items-center justify-center text-gray-400 group-hover:bg-orange-50 group-hover:text-orange-500 transition-colors font-bold shrink-0">
                                        {{ substr($category->name, 0, 1) }}
                                    </div>

                                    <div x-show="!editing" class="font-bold text-[#1A1A1A] truncate">
                                        {{ $category->name }}
                                    </div>

                                    <input x-show="editing" x-model="name" type="text" name="name"
                                        value="{{ $category->name }}"
                                        class="text-sm font-bold text-[#1A1A1A] border-none focus:ring-2 focus:ring-orange-400/20 p-0 m-0 w-full bg-orange-50 rounded-lg px-3 py-1.5 transition-all">
                                </div>

                                <div class="flex items-center gap-2 pl-2">

                                    <button type="button" x-show="!editing"
                                        @click="editing = true; $nextTick(() => $el.closest('form').querySelector('input[type=text]').focus())"
                                        class="text-xs font-bold text-gray-400 hover:text-[#1A1A1A] hover:bg-gray-50 py-2 px-4 rounded-xl transition-all">
                                        Modifier
                                    </button>

                                    <button type="submit" x-show="editing"
                                        class="text-xs font-bold bg-orange-500 text-white shadow-md py-2 px-4 rounded-xl transition-all hover:bg-orange-600">
                                        Sauvegarder
                                    </button>

                                    <button type="button" x-show="editing"
                                        @click="editing = false; name = '{{ $category->name }}'"
                                        class="text-xs font-bold text-gray-400 hover:text-red-500 px-2 transition-colors">
                                        Annuler
                                    </button>
                                </div>
                            </form>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="bg-blue-50/50 border border-blue-100 rounded-[2rem] p-6 flex items-start gap-4">
                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center shrink-0 text-blue-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <h4 class="text-blue-900 font-bold text-sm">Pourquoi ne pas supprimer ?</h4>
                    <p class="text-blue-700 text-xs mt-1 leading-relaxed">
                        Pour garantir l'intégrité de vos comptes, une catégorie ne peut pas être supprimée si elle
                        contient déjà des dépenses. Vous pouvez cependant la renommer à tout moment.
                    </p>
                </div>
            </div>
            <div
            class="bg-white shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)] sm:rounded-[2rem] border border-red-100 overflow-hidden mt-12">
            <div class="p-8 border-b border-red-50 flex items-center justify-between bg-red-50/30">
                <div>
                    <h3 class="text-xl font-bold text-red-600">Zone de Danger</h3>
                    <p class="text-sm text-red-500/80">Faites attention, ces actions sont irréversibles.</p>
                </div>
                <div class="w-12 h-12 bg-red-100 rounded-2xl flex items-center justify-center text-red-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                        </path>
                    </svg>
                </div>
            </div>

            <div class="p-8 flex items-center justify-between gap-6">
                <div class="max-w-xl">
                    <h4 class="font-bold text-[#1A1A1A]">Supprimer définitivement la colocation</h4>
                    <p class="text-sm text-gray-500 mt-1">
                        Une fois supprimée, toutes les données (dépenses, catégories, membres) seront effacées à jamais.
                        Il n'y a pas de retour en arrière possible.
                    </p>
                </div>

                <form action="{{ route('colocation.destroy', $colocation->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                        class="bg-red-600 text-white px-8 py-3 rounded-2xl text-sm font-bold hover:bg-red-700 transition-all shadow-md shadow-red-200 flex items-center gap-2 whitespace-nowrap">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                            </path>
                        </svg>
                        Supprimer la colocation
                    </button>
                </form>
            </div>
        </div>
        
        </div>

        

    </div>
</x-app-layout>