<?php

use Livewire\Component;

new class extends Component {

    public $search = '' ;
    public $colocationId ; 

    public function mount($colocationId)
    {
        $this ->colocationId = $colocationId ;
    }

    public function render()
    {
        $users = [] ; 
        
        if(strlen($this->search) < 1) return view('components.add-member-search' , compact('users')) ; 

        $users = app('App\Services\UserService')->getFilteredUsers($this->search) ;

        // dd($users) ;
        
        return view('components.add-member-search' , compact('users')) ;
        
    }


};
?>

<div class="space-y-4">
    <div class="relative">
        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>
        <input wire:model.live="search" type="text" placeholder="Rechercher par nom..." 
            class="w-full pl-11 pr-4 py-3 rounded-2xl border-gray-200 shadow-sm focus:border-orange-400 focus:ring focus:ring-orange-400/20 text-sm transition-all bg-gray-50 focus:bg-white">
    </div>

    <div class="border border-gray-100 rounded-2xl overflow-hidden bg-white shadow-sm mt-4">
        @forelse($users as $user)
        @if ($user->userId === Auth::id())
            @continue
        @endif
        <div
            class="p-3 hover:bg-gray-50 transition-colors flex items-center justify-between border-b border-gray-50 last:border-0">
            <div class="flex items-center gap-3">
                <div
                    class="w-9 h-9 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-xs">
                    S</div>
                <div>
                    <p class="text-sm font-bold text-[#1A1A1A]">{{ $user->name }}</p>
                    <p class="text-xs text-gray-400">{{ $user->email }}</p>
                </div>
            </div>

            <form action="{{ route('invitation.store' , $colocationId) }}" method="POST" >
                @csrf

                <input type="hidden" name="user_id" value="{{ $user->userId }}">
                <input type="hidden" name="colocation_id" value="{{ $colocationId }}" >

                <button type="submit"
                    class="text-xs font-bold text-[#1A1A1A] bg-gray-100 hover:bg-gray-200 px-3 py-1.5 rounded-full transition-colors">
                    Ajouter
                </button>
            </form>

    

        </div>        
        @empty
            <p class="p-4 text-center text-gray-400">Aucun utilisateur trouvé.</p>
        @endempty

    </div>

</div>