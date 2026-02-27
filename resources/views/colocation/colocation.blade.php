<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <a href="{{ route('dashboard') }}"
                    class="w-10 h-10 bg-white border border-gray-200 rounded-full flex items-center justify-center text-gray-500 hover:text-[#1A1A1A] hover:border-gray-300 transition-colors shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
                <div>
                    <div class="flex items-center gap-3">
                        <h2 class="font-extrabold text-3xl text-[#1A1A1A] tracking-tight">
                            {{ $colocation->name }}
                        </h2>
                        <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-green-500"></span> Active
                        </span>
                    </div>
                    <p class="text-sm font-medium text-gray-500 mt-1 italic">{{ $colocation->description }}</p>
                </div>
            </div>

            @if ($colocation && Auth::user()->isOwner($colocation->id))
                <a href="{{ route('colocation.settings', $colocation->id) }}"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-bold rounded-xl transition-all border border-gray-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    {{ __('Paramètres') }}
                </a>
            @endif
        </div>
    </x-slot>

    <div x-data="{ showExpenseModal: false, showAddMemberModal: false }" class="py-10 relative">
        
        <div class="fixed top-5 right-5 z-[100] space-y-3 w-full max-w-sm">
            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                    class="flex items-center gap-4 p-5 bg-white border border-green-100 rounded-[2rem] shadow-xl transform transition-all">
                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-green-800">C'est fait !</h4>
                        <p class="text-xs text-green-600">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if($errors->any() || session('error'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                    class="flex items-center gap-4 p-5 bg-white border border-red-100 rounded-[2rem] shadow-xl">
                    <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-sm font-bold text-red-800">Attention</h4>
                        <p class="text-xs text-red-600">{{ session('error') ?? $errors->first() }}</p>
                    </div>
                </div>
            @endif
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100 flex items-center gap-5">
                    <div class="w-14 h-14 bg-gray-50 rounded-full flex items-center justify-center shrink-0">
                        <svg class="w-7 h-7 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-400">Total Maison (Ce mois)</p>
                        <h4 class="text-2xl font-bold text-[#1A1A1A]">1 450 MAD</h4>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100 flex items-center gap-5">
                    <div class="w-14 h-14 bg-orange-50 rounded-full flex items-center justify-center shrink-0">
                        <svg class="w-7 h-7 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-400">Ma Part Financière</p>
                        <h4 class="text-2xl font-bold text-[#1A1A1A]">483 MAD</h4>
                    </div>
                </div>

                <div class="p-6 rounded-[2rem] shadow-sm border flex items-center gap-5 relative overflow-hidden {{ $monSold >= 0 ? 'bg-green-50 border-green-100' : 'bg-red-50 border-red-100' }}">
                    <div class="w-14 h-14 rounded-full flex items-center justify-center shrink-0 z-10 {{ $monSold >= 0 ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                        @if($monSold >= 0)
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                        @else
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path></svg>
                        @endif
                    </div>
                    <div class="z-10">
                        <p class="text-sm font-semibold {{ $monSold >= 0 ? 'text-green-500' : 'text-red-400' }}">Mon Solde</p>
                        <h4 class="text-2xl font-bold {{ $monSold >= 0 ? 'text-green-700' : 'text-red-600' }}">
                            {{ $monSold >= 0 ? '+' : '' }}{{ $monSold }} MAD
                        </h4>
                        <p class="text-xs mt-0.5 {{ $monSold >= 0 ? 'text-green-600' : 'text-red-500' }}">
                            {{ $monSold >= 0 ? 'On me doit de l\'argent' : 'Je dois de l\'argent' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 space-y-6">
                    <div class="flex items-center justify-between bg-white p-5 rounded-3xl shadow-sm border border-gray-100">
                        <h3 class="text-xl font-bold text-[#1A1A1A] ml-2">Dépenses Récentes</h3>
                        <button @click="showExpenseModal = true"
                            class="bg-[#1A1A1A] text-white px-6 py-3 rounded-full text-sm font-bold hover:bg-gray-800 transition-all shadow-md flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                            Ajouter une dépense
                        </button>
                    </div>

                    <div class="space-y-4">
                        @foreach ($colocation->expenses as $expense)
                            <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100 flex items-center justify-between hover:border-orange-200 transition-all group">
                                <div class="flex items-center gap-5">
                                    <div class="w-14 h-14 bg-blue-50 text-blue-500 rounded-2xl flex items-center justify-center group-hover:bg-orange-50 group-hover:text-orange-500 transition-colors">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="text-lg font-bold text-[#1A1A1A] group-hover:text-orange-600 transition-colors">{{ $expense->title }}</h4>
                                        <p class="text-sm text-gray-500 mt-0.5">
                                            Payé par <span class="font-bold text-gray-700">{{ $expense->payername }}</span> 
                                            <span class="mx-1">•</span> 
                                            {{ \Carbon\Carbon::parse($expense->createdAt)->translatedFormat('d M Y à H:i') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <h4 class="text-2xl font-black text-[#1A1A1A]">{{ $expense->amount }} <span class="text-sm font-medium">MAD</span></h4>
                                    <span class="inline-block px-3 py-1 bg-gray-50 text-gray-400 rounded-full text-[10px] font-bold uppercase tracking-tight mt-1">
                                        Divisé par {{ count($expense->participants) + 1 }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100">
                        <h3 class="text-lg font-bold text-[#1A1A1A] mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                            Équilibres
                        </h3>

                        <div class="space-y-3">
                            @foreach ($WhoPaysWhos as $debt)
                                <div class="flex flex-col bg-red-50 p-4 rounded-2xl border border-red-100">
                                    <div class="flex items-center justify-between mb-3">
                                        <p class="text-xs font-semibold text-red-700">
                                            <span class="font-bold uppercase">{{ $debt->userA_name }}</span> doit à {{ $debt->userB_name }}
                                        </p>
                                        <span class="font-bold text-red-700">{{ $debt->amount }} MAD</span>
                                    </div>
                                    <form action="{{ route('settlements.pay') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="user_a" value="{{ $debt->userA_Id }}">
                                        <input type="hidden" name="user_b" value="{{ $debt->userB_Id }}">
                                        <button type="submit" class="w-full py-2 bg-white text-red-600 text-xs font-bold rounded-xl border border-red-200 hover:bg-red-600 hover:text-white transition-all">
                                            Confirmer le paiement
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-bold text-[#1A1A1A]">Colocataires</h3>
                            @if (Auth::user()->isOwner($colocation->id))
                                <button @click="showAddMemberModal = true"
                                    class="text-[10px] font-bold text-orange-500 bg-orange-50 hover:bg-orange-100 px-3 py-1 rounded-full transition-colors border border-orange-100 uppercase">
                                    + Ajouter
                                </button>
                            @endif
                        </div>
                        <ul class="space-y-3">
                            @foreach ($colocation->membership as $member)
                                <li class="flex items-center justify-between p-2 hover:bg-gray-50 rounded-xl transition-colors">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-orange-100 flex items-center justify-center text-orange-600 font-bold text-sm">
                                            {{ substr($member->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-[#1A1A1A]">{{ $member->name }}</p>
                                            <p class="text-[10px] text-gray-400 font-bold uppercase">{{ $member->role }}</p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        </div>
</x-app-layout>