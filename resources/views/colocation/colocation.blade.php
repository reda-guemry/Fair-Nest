<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <a href="{{ route('dashboard') }}"
                    class="w-10 h-10 bg-white border border-gray-200 rounded-full flex items-center justify-center text-gray-500 hover:text-[#1A1A1A] hover:border-gray-300 transition-colors shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
                <div>
                    <div class="flex items-center gap-3">
                        <h2 class="font-extrabold text-3xl text-[#1A1A1A] tracking-tight">
                            {{ $colocation->name }}
                        </h2>
                        <span
                            class="px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-green-500"></span> Active
                        </span>
                    </div>
                    <p class="text-sm font-medium text-gray-500 mt-1">
                        {{ $colocation->description }}
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                @if ($colocation && Auth::user()->isOwner($colocation->id))
                    <a href="{{ route('colocation.settings', $colocation->id) }}"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-bold rounded-xl transition-all border border-gray-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        {{ __('Paramètres') }}
                    </a>
                @else
                    <form method="POST" action="{{ route('colocation.leave', $colocation->id) }}"
                        onsubmit="return confirm('Voulez-vous vraiment quitter cette colocation ?');">
                        @csrf

                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                        <input type="hidden" name="colocation_id" value="{{ $colocation->id }}">

                        <button type="submit"
                            class="inline-flex items-center gap-2 px-4 py-2 bg-red-50 hover:bg-red-600 text-red-600 hover:text-white text-sm font-bold rounded-xl transition-all border border-red-100 shadow-sm group">
                            <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                </path>
                            </svg>
                            {{ __('Quitter') }}
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </x-slot>

    <div x-data="{ showExpenseModal: false, showAddMemberModal: false }" class="py-10 relative">

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

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div
                    class="bg-white p-6 rounded-[2rem] shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)] border border-gray-100 flex items-center gap-5">
                    <div class="w-14 h-14 bg-gray-50 rounded-full flex items-center justify-center shrink-0">
                        <svg class="w-7 h-7 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-400">Total Maison (Ce mois)</p>
                        <h4 class="text-2xl font-bold text-[#1A1A1A]">1 450 MAD</h4>
                    </div>
                </div>

                <div
                    class="bg-white p-6 rounded-[2rem] shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)] border border-gray-100 flex items-center gap-5">
                    <div class="w-14 h-14 bg-orange-50 rounded-full flex items-center justify-center shrink-0">
                        <svg class="w-7 h-7 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-400">Ma Part Financière</p>
                        <h4 class="text-2xl font-bold text-[#1A1A1A]">483 MAD</h4>
                    </div>
                </div>

                <div
                    class="{{ $monSold >= 0 ? 'bg-green-50 border-green-100' : 'bg-red-50 border-red-100' }} p-6 rounded-[2rem] shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)] border flex items-center gap-5 relative overflow-hidden">
                    <div
                        class="w-14 h-14 {{ $monSold >= 0 ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }} rounded-full flex items-center justify-center shrink-0 z-10">
                        @if($monSold >= 0)
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                                </path>
                            </svg>
                        @else
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                            </svg>
                        @endif
                    </div>
                    <div class="z-10">
                        <p class="text-sm font-semibold {{ $monSold >= 0 ? 'text-green-500' : 'text-red-400' }}">Mon
                            Solde</p>
                        <h4 class="text-2xl font-bold {{ $monSold >= 0 ? 'text-green-600' : 'text-red-600' }}">
                            {{ $monSold >= 0 ? '+' : '- ' }} {{ abs($monSold) }} MAD
                        </h4>
                        <p class="text-xs font-semibold mt-0.5 {{ $monSold >= 0 ? 'text-green-500' : 'text-red-500' }}">
                            {{ $monSold >= 0 ? 'On me doit de l\'argent' : 'Je dois de l\'argent' }}
                        </p>
                    </div>
                    <svg class="absolute -bottom-4 -right-4 w-32 h-32 opacity-50 {{ $monSold >= 0 ? 'text-green-100' : 'text-red-100' }}"
                        fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm.31-8.86c-1.77-.45-2.34-.94-2.34-1.67 0-.84.79-1.43 2.1-1.43 1.38 0 1.9.66 1.94 1.64h1.71c-.05-1.34-.87-2.57-2.49-2.97V5H10.9v1.69c-1.51.32-2.72 1.3-2.72 2.81 0 1.79 1.49 2.69 3.66 3.21 1.95.46 2.34 1.15 2.34 1.87 0 .53-.39 1.64-2.25 1.64-1.74 0-2.1-.96-2.15-1.92H8.03c.05 1.68 1.15 2.87 2.87 3.25V19h2.36v-1.67c1.68-.34 2.88-1.48 2.88-3.04 0-2.23-1.85-2.92-3.83-3.15z">
                        </path>
                    </svg>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-2 space-y-6">
                    <div
                        class="flex items-center justify-between bg-white p-4 rounded-3xl shadow-sm border border-gray-100">
                        <h3 class="text-xl font-bold text-[#1A1A1A] ml-2">Dépenses Récentes</h3>
                        <button @click="showExpenseModal = true"
                            class="bg-[#1A1A1A] text-[#FAF9F6] px-5 py-2.5 rounded-full text-sm font-bold hover:bg-gray-800 transition-all shadow-md flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4"></path>
                            </svg>
                            Ajouter
                        </button>
                    </div>

                    @foreach ($colocation->expenses as $expenses)
                        <div
                            class="bg-white p-6 rounded-[2rem] shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)] border border-gray-100 flex items-center justify-between hover:border-orange-200 transition-colors group cursor-pointer">
                            <div class="flex items-center gap-5">
                                <div
                                    class="w-14 h-14 bg-blue-50 text-blue-500 rounded-2xl flex items-center justify-center group-hover:bg-orange-50 group-hover:text-orange-500 transition-colors">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-lg font-extrabold text-[#1A1A1A]">{{ $expenses->title }}</h4>
                                    <p class="text-sm text-gray-500 mt-1">Payé par <span
                                            class="font-bold text-gray-700">{{ $expenses->payername }}</span> •
                                        {{ \Carbon\Carbon::parse($expenses->createdAt)->format('d/m/Y à H\hi') }}
                                    </p>
                                </div>
                            </div>
                            <div class="text-right">
                                <h4 class="text-2xl font-black text-[#1A1A1A]">{{ $expenses->amount }} MAD</h4>
                                <span class="text-xs font-bold text-gray-400 uppercase tracking-tighter mt-1 block">Pour
                                    {{ count($expenses->participants) + 1 }} personnes</span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="space-y-6">

                    <div
                        class="bg-white p-6 rounded-[2rem] shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)] border border-gray-100">
                        <h3 class="text-lg font-bold text-[#1A1A1A] mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                            </svg>
                            Équilibres
                        </h3>

                        <div class="space-y-3">
                            @foreach ($WhoPaysWhos as $debt)
                                <div
                                    class="flex items-center justify-between bg-red-50 p-3 rounded-2xl border border-red-100">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 rounded-full bg-red-200 flex items-center justify-center text-red-700 font-bold text-xs">
                                            {{ substr($debt->userA_name, 0, 1) }}
                                        </div>
                                        <p class="text-sm font-semibold text-red-700">
                                            {{ $debt->userA_Id == Auth::id() ? 'Vous' : $debt->userA_name }} doit à
                                            {{ $debt->userB_Id == Auth::id() ? 'Vous' : $debt->userB_name }}
                                        </p>
                                    </div>
                                    <span class="font-bold text-red-700">{{ $debt->amount }} MAD</span>

                                    @if ($debt->userB_Id == Auth::id())
                                        <form action="{{ route('settlements.pay') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="user_a" value="{{ $debt->userA_Id }}">
                                            <input type="hidden" name="user_b" value="{{ $debt->userB_Id }}">
                                            <input type="hidden" name='colocation_id' value="{{ $colocation->id }}">
                                            <button type="submit"
                                                class="text-xs font-bold bg-white text-red-600 px-2 py-1 rounded-lg border border-red-200 hover:bg-red-600 hover:text-white transition-colors">Payé</button>
                                        </form>

                                    @endif

                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div
                        class="bg-white p-6 rounded-[2rem] shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)] border border-gray-100">
                        @if (Auth::user()->isOwner($colocation->id))
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-bold text-[#1A1A1A]">Colocataires</h3>
                                <button @click="showAddMemberModal = true"
                                    class="text-sm font-bold text-orange-500 bg-orange-50 hover:bg-orange-100 px-3 py-1.5 rounded-full transition-colors flex items-center gap-1.5 border border-orange-100">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    Ajouter
                                </button>
                            </div>
                        @endif

                       <ul class="space-y-3">
    @foreach ($colocation->membership as $member)
        <li class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-orange-100 flex items-center justify-center text-orange-600 font-bold text-sm">
                    {{ substr($member->name, 0, 1) }}
                </div>

                <div>
                    <p class="text-sm font-bold text-[#1A1A1A]">{{ $member->name }}</p>
                    <div class="flex items-center gap-2">
                        <p class="text-xs text-gray-400 font-semibold">{{ $member->role }}</p>
                        
                        <span class="inline-flex items-center gap-0.5 px-1.5 py-0.5 bg-orange-50 text-orange-600 text-[10px] font-bold rounded-md border border-orange-100">
                            <svg class="w-2.5 h-2.5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            {{ $member->reputation ?? 0 }}
                        </span>
                    </div>
                </div>
            </div>

            @if(auth()->user()->isOwner($colocation->id) && $member->userId != auth()->id())
                <form method="POST" action="{{ route('colocations.kick', [$colocation->id, $member->userId]) }}">
                    @csrf
                    <input type="hidden" name="colocation_id" value="{{ $colocation->id }}">
                    <input type="hidden" name="member_id" value="{{ $member->userId }}">

                    <button type="submit"
                        class="w-8 h-8 rounded-full bg-white border border-gray-200 flex items-center justify-center text-gray-400 hover:text-red-600 hover:border-red-200 hover:bg-red-50 shadow-sm transition-all"
                        title="Expulser immédiatement">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                    </button>
                </form>
            @endif
        </li>
    @endforeach
</ul>
                    </div>
                </div>
            </div>
        </div>

        <div x-show="showExpenseModal" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto"
            aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div x-show="showExpenseModal" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-gray-900/40 backdrop-blur-sm transition-opacity"></div>

            <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0">
                <div x-show="showExpenseModal" @click.away="showExpenseModal = false"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="relative transform overflow-hidden rounded-[2rem] bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-md border border-gray-100 p-8">

                    <button @click="showExpenseModal = false"
                        class="absolute top-6 right-6 text-gray-400 hover:text-[#1A1A1A] transition-colors">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <div class="mb-6">
                        <h3 class="text-2xl font-extrabold text-[#1A1A1A]" id="modal-title">Nouvelle Dépense</h3>
                        <p class="text-sm text-gray-500 mt-1">Saisissez les détails de l'achat.</p>
                    </div>

                    <form method="POST" action="{{ route('expenses.store') }}" class="space-y-5">
                        @csrf

                        <input type="hidden" name="colocation_id" value="{{ $colocation->id }}">

                        <div>
                            <label class="block text-sm font-semibold text-[#1A1A1A] mb-1.5">Qu'avez-vous acheté
                                ?</label>
                            <input type="text" name="title" placeholder="ex: Courses de la semaine"
                                class="w-full rounded-2xl border-gray-200 shadow-sm focus:border-orange-400 focus:ring focus:ring-orange-400/20 text-sm py-3 px-4 transition-all">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-[#1A1A1A] mb-1.5">Catégorie</label>
                            <select name="category_id"
                                class="w-full rounded-2xl border-gray-200 shadow-sm focus:border-orange-400 focus:ring focus:ring-orange-400/20 text-sm py-3 px-4 transition-all bg-white">
                                @foreach ($colocation->categories as $categorie)
                                    <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-[#1A1A1A] mb-1.5">Montant (MAD)</label>
                            <div class="relative">
                                <input type="number" step="0.01" name="amount" placeholder="0.00"
                                    class="w-full rounded-2xl border-gray-200 shadow-sm focus:border-orange-400 focus:ring focus:ring-orange-400/20 text-lg font-bold py-3 pl-4 pr-16 transition-all">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                    <span class="text-gray-400 font-semibold">MAD</span>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-[#1A1A1A] mb-1.5">Qui a payé ?</label>
                            <select name="payer_id"
                                class="w-full rounded-2xl border-gray-200 shadow-sm focus:border-orange-400 focus:ring focus:ring-orange-400/20 text-sm py-3 px-4 transition-all bg-white">
                                @foreach ($colocation->membership as $member)
                                    <option value="{{ $member->userId }}">{{ $member->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-[#1A1A1A] mb-2">Pour qui ? (Diviser
                                entre)</label>
                            <div class="space-y-2 max-h-40 overflow-y-auto">
                                @foreach ($colocation->membership as $member)
                                    <label
                                        class="flex items-center p-3 border border-orange-200 bg-orange-50 rounded-2xl cursor-pointer hover:bg-orange-100 transition-colors">
                                        <input type="checkbox" name="split_with[]" value="{{ $member->userId }}" checked
                                            class="w-4 h-4 text-orange-500 border-gray-300 rounded focus:ring-orange-500">
                                        <span class="ml-3 text-sm font-semibold text-[#1A1A1A]">{{ $member->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                            <p class="text-xs text-gray-400 mt-2 italic">Le montant sera divisé équitablement entre les
                                personnes sélectionnées.</p>
                        </div>

                        <div class="mt-8 pt-4 border-t border-gray-100 flex items-center justify-end gap-3">
                            <button type="button" @click="showExpenseModal = false"
                                class="px-5 py-2.5 text-sm font-semibold text-gray-500 hover:text-[#1A1A1A] hover:bg-gray-50 rounded-full transition-colors">
                                Annuler
                            </button>
                            <button type="submit"
                                class="bg-[#1A1A1A] text-[#FAF9F6] px-6 py-2.5 rounded-full text-sm font-bold hover:bg-gray-800 transition-all shadow-md hover:-translate-y-0.5">
                                Ajouter la dépense
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div x-show="showAddMemberModal" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto"
            aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div x-show="showAddMemberModal" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-gray-900/40 backdrop-blur-sm transition-opacity"></div>

            <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0">
                <div x-show="showAddMemberModal" @click.away="showAddMemberModal = false"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="relative transform overflow-hidden rounded-[2rem] bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-md border border-gray-100 p-8">

                    <button @click="showAddMemberModal = false"
                        class="absolute top-6 right-6 text-gray-400 hover:text-[#1A1A1A] transition-colors">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <div class="mb-6">
                        <h3 class="text-2xl font-extrabold text-[#1A1A1A]">Ajouter un membre</h3>
                        <p class="text-sm text-gray-500 mt-1">Recherchez un utilisateur pour l'inviter.</p>
                    </div>

                    <livewire:add-member-search :colocationId="$colocation->id" />

                </div>
            </div>
        </div>
    </div>

</x-app-layout>