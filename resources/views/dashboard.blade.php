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

    <div x-data="{ showModal: false }" class="py-10 relative">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8"> @if ($errors->has('colocation'))
            <div
                class="p-4 bg-red-50 text-red-600 text-sm font-medium rounded-2xl border border-red-100 flex items-center gap-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                {{ $errors->first('colocation') }}
            </div>
        @endif

            <div
                class="bg-white overflow-hidden shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)] sm:rounded-[2rem] border border-gray-100 p-8 flex flex-col md:flex-row items-start md:items-center justify-between gap-6 relative">
                <div class="absolute top-0 right-0 w-32 h-32 bg-[#FAF9F6] rounded-bl-full -z-10 opacity-50"></div>

                <div class="z-10">
                    <h3 class="text-xl font-bold text-[#1A1A1A]">Bienvenue dans votre nouvel espace !</h3>
                    <p class="text-gray-500 mt-2 text-sm max-w-lg">
                        Gérez vos dépenses, invitez vos colocataires et suivez votre budget en toute simplicité. Tout
                        commence ici.
                    </p>
                </div>

                @if (Auth::user()->is_global_admin || Auth::user()->isFree())
                    
                        <div class="z-10 shrink-0">
                            <button @click="showModal = true"
                                class="bg-[#1A1A1A] text-[#FAF9F6] px-6 py-3 rounded-full text-sm font-semibold hover:bg-gray-800 transition-all shadow-md hover:-translate-y-0.5 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                                    </path>
                                </svg>
                                Créer une colocation
                            </button>
                        </div>
                @endif

            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div
                    class="bg-white p-6 rounded-[2rem] shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)] border border-gray-100 hover:border-gray-200 transition-colors group cursor-pointer">
                    <div
                        class="w-12 h-12 bg-[#F9F8F6] rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-[#1A1A1A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                    <h4 class="text-lg font-bold text-[#1A1A1A]">Mes Dépenses</h4>
                    <p class="text-sm font-medium text-gray-400 mt-1">0 MAD ce mois-ci</p>
                </div>
            </div>

            <div>
                <h3 class="text-xl font-bold text-[#1A1A1A] mb-5">Mes Colocations</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($userColocation->colocations as $colocation)
                        @php
                            $role = $colocation->membership[0]->role ?? 'membre';
                            $isOwner = $role === 'owner';
                        @endphp

                        <a href="{{ route('colocation.show', $colocation->id) }}"
                            class="block bg-white p-6 rounded-[2rem] shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)] border border-gray-100 hover:border-orange-400 hover:shadow-lg transition-all group">

                            <div class="flex justify-between items-start mb-4">
                                <div
                                    class="w-10 h-10 bg-orange-50 rounded-full flex items-center justify-center text-orange-500 group-hover:bg-orange-500 group-hover:text-white transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                        </path>
                                    </svg>
                                </div>

                                <span
                                    class="px-3 py-1 text-xs font-bold rounded-full {{ $isOwner ? 'bg-orange-100 text-orange-700' : 'bg-gray-100 text-gray-600' }}">
                                    {{ ucfirst($role) }}
                                </span>
                            </div>

                            <h4 class="text-lg font-bold text-[#1A1A1A] line-clamp-1">{{ $colocation->name }}</h4>
                            <p class="text-sm text-gray-500 mt-2 line-clamp-2">
                                {{ $colocation->description ?? 'Aucune description fournie.' }}
                            </p>

                            <div class="mt-4 pt-4 border-t border-gray-50 flex items-center justify-between text-sm">
                                <span class="text-gray-400 font-medium flex items-center gap-1">
                                    <span
                                        class="w-2 h-2 rounded-full {{ $colocation->status === 'active' ? 'bg-green-400' : 'bg-gray-300' }}"></span>
                                    {{ ucfirst($colocation->status) }}
                                </span>

                                <span
                                    class="text-orange-500 font-semibold group-hover:translate-x-1 transition-transform inline-block">
                                    Voir →
                                </span>
                            </div>
                        </a>
                    @empty
                        <div
                            class="col-span-full bg-[#F9F8F6] border-2 border-dashed border-gray-200 rounded-[2rem] p-10 text-center flex flex-col items-center justify-center">
                            <div
                                class="w-16 h-16 bg-white rounded-full flex items-center justify-center text-gray-300 mb-4 shadow-sm">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                    </path>
                                </svg>
                            </div>
                            <h4 class="text-lg font-bold text-[#1A1A1A]">Aucune colocation trouvée</h4>
                            <p class="text-sm text-gray-500 mt-2 max-w-sm">Vous ne faites partie d'aucune colocation pour le
                                moment. Créez-en une pour commencer !</p>
                            <button @click="showModal = true"
                                class="mt-4 text-orange-500 font-semibold hover:text-orange-600">
                                + Créer ma première colocation
                            </button>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div x-show="showModal" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto"
            aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div x-show="showModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-gray-900/40 backdrop-blur-sm transition-opacity"></div>

            <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0">
                <div x-show="showModal" @click.away="showModal = false" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="relative transform overflow-hidden rounded-[2rem] bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-gray-100 p-8">
                    <button @click="showModal = false"
                        class="absolute top-6 right-6 text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <div class="mb-8">
                        <div class="w-12 h-12 bg-orange-50 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-[#1A1A1A]" id="modal-title">Nouvelle Colocation</h3>
                        <p class="text-sm text-gray-500 mt-1">Donnez un nom à votre maison et commencez à inviter vos
                            colocataires.</p>
                    </div>

                    <form method="POST" action="{{ route('create.colocation') }}" class="space-y-5">
                        @csrf
                        <div>
                            <label for="name" class="block text-sm font-semibold text-[#1A1A1A] mb-1.5">Nom de la
                                maison</label>
                            <input type="text" name="name" id="name" placeholder="ex: La Villa des Potes"
                                class="w-full rounded-2xl border-gray-200 shadow-sm focus:border-orange-400 focus:ring focus:ring-orange-400/20 text-sm py-3 px-4 transition-all">
                        </div>
                        <div>
                            <label for="description" class="block text-sm font-semibold text-[#1A1A1A] mb-1.5">Petite
                                description (Optionnel)</label>
                            <textarea name="description" id="description" rows="3"
                                placeholder="Règles de base, ambiance..."
                                class="w-full rounded-2xl border-gray-200 shadow-sm focus:border-orange-400 focus:ring focus:ring-orange-400/20 text-sm py-3 px-4 transition-all resize-none"></textarea>
                        </div>
                        <div class="mt-8 flex items-center justify-end gap-3">
                            <button type="button" @click="showModal = false"
                                class="px-5 py-2.5 text-sm font-semibold text-gray-600 hover:bg-gray-50 rounded-full transition-colors">Annuler</button>
                            <button type="submit"
                                class="bg-[#1A1A1A] text-[#FAF9F6] px-6 py-2.5 rounded-full text-sm font-bold hover:bg-gray-800 transition-all shadow-md hover:-translate-y-0.5">Créer
                                la maison</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>