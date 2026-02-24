<x-guest-layout>
    <div class="mb-10 text-center">
        <h2 class="text-3xl font-extrabold text-[#1A1A1A] tracking-tight">Créer un compte</h2>
        <p class="text-sm text-gray-500 mt-2 font-medium">Rejoignez la communauté Fair-Nest</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div class="grid grid-cols-2 gap-5">
            <div class="space-y-1.5">
                <x-input-label for="first_name" :value="__('Prénom')" class="text-sm font-semibold  ml-1" />
                <x-text-input id="first_name" class="block w-full border border-gray-200 text-[#1A1A1A] focus:border-[#1A1A1A] focus:ring-1 focus:ring-[#1A1A1A] rounded-2xl py-3 px-4 transition-colors" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="given-name" placeholder="Ex: Karim" />
                <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
            </div>

            <div class="space-y-1.5">
                <x-input-label for="last_name" :value="__('Nom')" class="text-sm font-semibold text-gray-700 ml-1" />
                <x-text-input id="last_name" class="block w-full border border-gray-200 text-[#1A1A1A] focus:border-[#1A1A1A] focus:ring-1 focus:ring-[#1A1A1A] rounded-2xl py-3 px-4 transition-colors" type="text" name="last_name" :value="old('last_name')" required autocomplete="family-name" placeholder="Ex: Benali" />
                <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
            </div>
        </div>

        <div class="space-y-1.5 mt-2">
            <x-input-label for="email" :value="__('Email')" class="text-sm font-semibold text-gray-700 ml-1" />
            <x-text-input id="email" class="block w-full border border-gray-200 text-[#1A1A1A] focus:border-[#1A1A1A] focus:ring-1 focus:ring-[#1A1A1A] rounded-2xl py-3 px-4 transition-colors" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="karim@exemple.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="space-y-1.5 mt-2">
            <x-input-label for="password" :value="__('Mot de passe')" class="text-sm font-semibold text-gray-700 ml-1" />
            <x-text-input id="password" class="block w-full border border-gray-200 text-[#1A1A1A] focus:border-[#1A1A1A] focus:ring-1 focus:ring-[#1A1A1A] rounded-2xl py-3 px-4 transition-colors"
                            type="password"
                            name="password"
                            required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="space-y-1.5 mt-2">
            <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" class="text-sm font-semibold text-gray-700 ml-1" />
            <x-text-input id="password_confirmation" class="block w-full border border-gray-200 text-[#1A1A1A] focus:border-[#1A1A1A] focus:ring-1 focus:ring-[#1A1A1A] rounded-2xl py-3 px-4 transition-colors"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex flex-col space-y-5 pt-4">
            <button type="submit" class="w-full flex justify-center items-center bg-[#1A1A1A] hover:bg-gray-800 text-[#FAF9F6] py-3.5 rounded-full text-base font-semibold transition-all shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900">
                {{ __('S\'inscrire') }}
            </button>

            <a class="text-center text-sm font-medium text-gray-500 hover:text-[#1A1A1A] transition-colors" href="{{ route('login') }}">
                {{ __('Vous avez déjà un compte ? Connectez-vous') }}
            </a>
        </div>
    </form>
</x-guest-layout>