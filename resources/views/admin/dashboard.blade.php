<x-admin>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6 mb-8">
                <div class="flex items-center gap-5">
                    <div
                        class="w-14 h-14 bg-orange-50 rounded-2xl flex items-center justify-center shrink-0 border border-orange-100 shadow-sm">
                        <svg class="w-7 h-7 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
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

            <div
                class="bg-white rounded-[2rem] shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)] border border-gray-100 overflow-hidden">

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/80 border-b border-gray-100">
                                <th class="px-8 py-5 text-xs font-extrabold uppercase tracking-wider text-gray-400">
                                    {{ __('Utilisateur') }}</th>
                                <th class="px-8 py-5 text-xs font-extrabold uppercase tracking-wider text-gray-400">
                                    {{ __('Date d\'inscription') }}</th>
                                <th class="px-8 py-5 text-xs font-extrabold uppercase tracking-wider text-gray-400">
                                    {{ __('Statut') }}</th>
                                <th
                                    class="px-8 py-5 text-xs font-extrabold uppercase tracking-wider text-gray-400 text-right">
                                    {{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">

                            @foreach($users as $user)
                                <tr class="group hover:bg-orange-50/30 transition-colors duration-200">
                                    <td class="px-8 py-5">
                                        <div class="flex items-center gap-4">
                                            <div class="relative">
                                                <div
                                                    class="w-10 h-10 {{ $user->isBanned ? 'bg-gray-100 text-gray-400' : 'bg-orange-100 text-orange-700' }} rounded-full flex items-center justify-center font-bold text-sm border-2 border-white shadow-sm overflow-hidden">
                                                    @if($user->profilePhoto)
                                                        <img src="{{ asset('storage/profiles/' . $user->profilePhoto) }}" alt=""
                                                            class="w-full h-full object-cover">
                                                    @else
                                                        {{ strtoupper(substr($user->name, 0, 2)) }}
                                                    @endif
                                                </div>
                                                <span
                                                    class="absolute bottom-0 right-0 w-3 h-3 {{ $user->isBanned ? 'bg-gray-300' : 'bg-green-400' }} border-2 border-white rounded-full"></span>
                                            </div>
                                            <div>
                                                <div
                                                    class="font-bold {{ $user->isBanned ? 'text-gray-500 line-through decoration-gray-300' : 'text-[#1A1A1A]' }} text-sm group-hover:text-orange-600 transition-colors">
                                                    {{ $user->name }}
                                                </div>
                                                <div class="text-xs text-gray-400 font-medium">{{ $user->email }}</div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-8 py-5 text-sm text-gray-500 font-medium">
                                        {{ $user->createdAt }}
                                    </td>

                                    <td class="px-8 py-5">
                                        @if($user->isBanned)
                                            <span
                                                class="inline-flex items-center gap-1.5 px-3 py-1 bg-red-50 text-red-700 border border-red-100 text-[10px] font-black uppercase tracking-wide rounded-full">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636">
                                                    </path>
                                                </svg>
                                                Banned
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center gap-1.5 px-3 py-1 bg-green-50 text-green-700 border border-green-100 text-[10px] font-black uppercase tracking-wide rounded-full">
                                                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                                Actif
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-8 py-5 text-right">
                                        <div
                                            class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">

                                            @if($user->isBanned)
                                                <form method="POST" action="{{ route('admin.users.unban') }}">
                                                    @csrf @method('PATCH')
                                                    <input type="hidden" name="user_id" value="{{ $user->userId }}">
                                                    <button type="submit"
                                                        class="w-8 h-8 rounded-full bg-white border border-green-200 flex items-center justify-center text-green-500 hover:bg-green-500 hover:text-white shadow-sm transition-all"
                                                        title="Débannir">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z">
                                                            </path>
                                                        </svg>
                                                    </button>
                                                </form>
                                            @else
                                                <div x-data="{ confirming: false }">
                                                    <button x-show="!confirming" @click="confirming = true"
                                                        class="w-8 h-8 rounded-full bg-white border border-gray-200 flex items-center justify-center text-gray-400 hover:text-orange-600 hover:border-orange-200 shadow-sm transition-all"
                                                        title="Bannir">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636">
                                                            </path>
                                                        </svg>
                                                    </button>

                                                    <form x-show="confirming" x-transition method="POST"
                                                        action="{{ route('admin.users.ban') }}"
                                                        class="flex items-center gap-2 bg-gray-50 p-1 rounded-xl border border-orange-200 shadow-inner">
                                                        @csrf
                                                        @method('PATCH')

                                                        <input type="hidden" name="user_id" value="{{ $user->userId }}">
                                                        <input type="text" name="ban_reason"
                                                            placeholder="Raison du ban..."
                                                            class="text-[10px] px-2 py-1 border-none focus:ring-0 bg-transparent w-32 font-medium"
                                                            @keydown.escape="confirming = false">

                                                        <button type="submit"
                                                            class="bg-orange-600 text-white text-[10px] px-2 py-1 rounded-lg font-bold hover:bg-orange-700 transition-colors">
                                                            Confirmer
                                                        </button>

                                                        <button type="button" @click="confirming = false"
                                                            class="text-gray-400 hover:text-red-500">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="bg-gray-50/50 px-8 py-5 border-t border-gray-100 flex items-center justify-between">
                    <p class="text-xs text-gray-500 font-medium">
                        Affichage de <span class="font-bold text-[#1A1A1A]">{{ $users->firstItem() }}</span>
                        à <span class="font-bold text-[#1A1A1A]">{{ $users->lastItem() }}</span>
                        sur <span class="font-bold text-[#1A1A1A]">{{ $users->total() }}</span> résultats
                    </p>

                    <div class="flex gap-2">
                        @if($users->onFirstPage())
                            <button disabled
                                class="px-4 py-2 bg-white border border-gray-100 rounded-xl text-xs font-bold text-gray-300 cursor-not-allowed">Précédent</button>
                        @else
                            <a href="{{ $users->previousPageUrl() }}"
                                class="px-4 py-2 bg-white border border-gray-200 rounded-xl text-xs font-bold text-gray-600 hover:bg-gray-50 transition-colors">Précédent</a>
                        @endif

                        @if($users->hasMorePages())
                            <a href="{{ $users->nextPageUrl() }}"
                                class="px-4 py-2 bg-[#1A1A1A] text-white rounded-xl text-xs font-bold shadow-md hover:bg-gray-800 transition-colors">Suivant</a>
                        @else
                            <button disabled
                                class="px-4 py-2 bg-gray-100 text-gray-400 rounded-xl text-xs font-bold cursor-not-allowed">Suivant</button>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="fixed top-5 right-5 z-[100] space-y-3 w-full max-w-sm">
            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                    x-transition.duration.500ms
                    class="flex items-center gap-4 p-5 bg-green-50 border border-green-100 rounded-[2rem] shadow-sm">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-md font-bold text-green-800">C'est fait !</h4>
                        <p class="text-sm text-green-600">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if($errors->any() || session('error'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                    x-transition.duration.500ms
                    class="flex items-center gap-4 p-5 bg-red-50 border border-red-100 rounded-[2rem] shadow-sm">
                    <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                            </path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-md font-bold text-red-800">Attention</h4>
                        <ul class="text-sm text-red-600 list-disc list-inside">
                            @if(session('error'))
                                <li>{{ session('error') }}</li>
                            @endif
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
        </div>

</x-admin>