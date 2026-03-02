<x-admin>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6 mb-8">
                <div class="flex items-center gap-5">
                    
                    <div>
                        <h2 class="text-3xl font-extrabold text-[#1A1A1A] tracking-tight">
                            {{ __('Transférer la Propriété') }}
                        </h2>
                        <p class="text-sm font-medium text-gray-500 mt-1">
                            {{ __('Choisissez un nouveau propriétaire pour') }} <span class="text-orange-600 font-bold">{{ $colocation->name }}</span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="mb-8 bg-orange-50 border border-orange-100 rounded-[2rem] p-6 flex items-start gap-4">
                <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center shrink-0 text-orange-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <h4 class="text-orange-900 font-bold text-sm">Action Requise</h4>
                    <p class="text-orange-700 text-xs mt-1 leading-relaxed">
                        Avant de pouvoir supprimer votre compte ou quitter cette colocation, vous devez désigner un membre comme nouveau propriétaire. Ce dernier aura le contrôle total de la colocation.
                    </p>
                </div>
            </div>

            <div class="bg-white rounded-[2rem] shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)] border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/80 border-b border-gray-100">
                                <th class="px-8 py-5 text-xs font-extrabold uppercase tracking-wider text-gray-400">
                                    {{ __('Membre') }}
                                </th>
                                <th class="px-8 py-5 text-xs font-extrabold uppercase tracking-wider text-gray-400">
                                    {{ __('Rôle Actuel') }}
                                </th>
                                <th class="px-8 py-5 text-xs font-extrabold uppercase tracking-wider text-gray-400 text-right">
                                    {{ __('Action') }}
                                </th>
                            </tr>
                        </thead>

                        @php 
                            $oldOwnerId = collect($colocation->membership)->firstWhere('role', 'owner')->userId;
                        @endphp

                        <tbody class="divide-y divide-gray-50">
                            @foreach($colocation->membership as $member)
                                    <tr class="group hover:bg-orange-50/30 transition-colors duration-200">
                                        <td class="px-8 py-5">
                                            <div class="flex items-center gap-4">
                                                <div class="w-10 h-10 bg-orange-100 text-orange-700 rounded-full flex items-center justify-center font-bold text-sm border-2 border-white shadow-sm overflow-hidden">
                                                    {{ strtoupper(substr($member->name, 0, 2)) }}
                                                </div>
                                                <div>
                                                    <div class="font-bold text-[#1A1A1A] text-sm group-hover:text-orange-600 transition-colors">
                                                        {{ $member->name }}
                                                    </div>
                                                    <div class="text-xs text-gray-400 font-medium">{{ $member->email }}</div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-8 py-5">
                                            <span class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-600 text-[10px] font-bold uppercase tracking-wide rounded-full">
                                                {{ $member->role }}
                                            </span>
                                        </td>

                                        <td class="px-8 py-5 text-right">
                                            <form method="POST" action="{{ route('colocation.transfer-ownership', $colocation->id) }}">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="old_owner_id" value="{{ $oldOwnerId }}">
                                                <input type="hidden" name="new_owner_id" value="{{ $member->userId }}">
                                                <input type="hidden" name="colocation_id" value="{{ $colocation->id }}">
                                                
                                                <button type="submit" 
                                                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#1A1A1A] hover:bg-orange-600 text-white text-xs font-bold rounded-xl transition-all shadow-md hover:shadow-orange-200">
                                                    {{ __('Nommer Propriétaire') }}
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                            @endforeach

                            @if(count($colocation->membership) <= 1)
                                <tr>
                                    <td colspan="3" class="px-8 py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center text-gray-300 mb-4">
                                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                                </svg>
                                            </div>
                                            <p class="text-gray-400 font-medium">{{ __('Aucun autre membre n\'est disponible pour reprendre la colocation.') }}</p>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin>