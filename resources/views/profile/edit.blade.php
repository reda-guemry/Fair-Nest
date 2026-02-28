<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('dashboard') }}" 
               class="w-10 h-10 bg-white border border-gray-200 rounded-full flex items-center justify-center text-gray-500 hover:text-[#1A1A1A] hover:border-gray-300 transition-colors shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            
            <div>
                <h2 class="font-extrabold text-3xl text-[#1A1A1A] tracking-tight">
                    {{ __('Mon Profil') }}
                </h2>
                <p class="text-sm font-medium text-gray-500 mt-1">
                    Gérez vos informations personnelles et la sécurité.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            @include('profile.partials.update-profile-information-form')

            <div class="bg-white p-8 rounded-[2rem] shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)] border border-gray-100 relative overflow-hidden">
                <div class="flex items-start gap-5 mb-6">
                    <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center shrink-0 border border-blue-100">
                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-[#1A1A1A]">{{ __('Sécurité') }}</h3>
                        <p class="text-sm text-gray-500 mt-1">{{ __('Mettez à jour votre mot de passe pour rester en sécurité.') }}</p>
                    </div>
                </div>
                
                @include('profile.partials.update-password-form')
            </div>

            <div class="bg-red-50 p-8 rounded-[2rem] shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)] border border-red-100 relative overflow-hidden">
                <div class="flex items-start gap-5 mb-6">
                    <div class="w-12 h-12 bg-red-100 rounded-2xl flex items-center justify-center shrink-0 border border-red-200">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-red-800">{{ __('Zone Danger') }}</h3>
                        <p class="text-sm text-red-600/80 mt-1">{{ __('Supprimer définitivement votre compte.') }}</p>
                    </div>
                </div>

                @include('profile.partials.delete-user-form')
            </div>

        </div>
    </div>
</x-app-layout>