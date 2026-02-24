<nav x-data="{ open: false }" class="bg-[#FAF9F6] border-b border-gray-100 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20"> 
            
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 group">
                        <div class="w-9 h-9 bg-[#1A1A1A] rounded-full flex items-center justify-center group-hover:scale-105 transition-transform duration-300 shadow-sm">
                            <svg class="w-5 h-5 text-[#FAF9F6]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                        </div>
                        <span class="text-xl font-extrabold tracking-tight text-[#1A1A1A]">
                            Fair-Nest<span class="text-orange-400">.</span>
                        </span>
                    </a>
                </div>

                <div class="hidden space-x-10 sm:-my-px sm:ms-12 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" 
                        class="text-sm font-medium text-gray-600 hover:text-[#1A1A1A] transition-colors border-none">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    
                    <x-nav-link href="#" class="text-sm font-medium text-gray-600 hover:text-[#1A1A1A] transition-colors border-none">
                        {{ __('Dépenses') }}
                    </x-nav-link>
                    <x-nav-link href="#" class="text-sm font-medium text-gray-600 hover:text-[#1A1A1A] transition-colors border-none">
                        {{ __('Colocataires') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-4">
                
                <div class="flex items-center space-x-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-1 py-2 border border-transparent text-sm leading-4 font-semibold text-[#1A1A1A] hover:opacity-70 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</div>
                                
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>

                    <a href="#" class="bg-[#1A1A1A] text-white px-6 py-2.5 rounded-full text-sm font-medium hover:bg-gray-800 transition-all shadow-sm">
                        Nouvelle Dépense
                    </a>
                </div>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="p-2 rounded-md text-gray-500 hover:bg-[#E5E3DB] transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>