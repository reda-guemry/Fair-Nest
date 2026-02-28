<section>
    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-sm font-semibold text-[#1A1A1A] mb-1.5">
                {{ __('Mot de passe actuel') }}
            </label>
            <input id="update_password_current_password" name="current_password" type="password" 
                class="w-full rounded-2xl border-gray-200 shadow-sm focus:border-orange-400 focus:ring focus:ring-orange-400/20 text-sm py-3 px-4 transition-all" 
                autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password" class="block text-sm font-semibold text-[#1A1A1A] mb-1.5">
                {{ __('Nouveau mot de passe') }}
            </label>
            <input id="update_password_password" name="password" type="password" 
                class="w-full rounded-2xl border-gray-200 shadow-sm focus:border-orange-400 focus:ring focus:ring-orange-400/20 text-sm py-3 px-4 transition-all" 
                autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-semibold text-[#1A1A1A] mb-1.5">
                {{ __('Confirmer le mot de passe') }}
            </label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" 
                class="w-full rounded-2xl border-gray-200 shadow-sm focus:border-orange-400 focus:ring focus:ring-orange-400/20 text-sm py-3 px-4 transition-all" 
                autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="pt-4 flex items-center gap-4 border-t border-gray-50 mt-8">
            <button type="submit" class="bg-[#1A1A1A] text-[#FAF9F6] px-8 py-3 rounded-full text-sm font-bold hover:bg-gray-800 transition-all shadow-md hover:-translate-y-0.5 flex items-center gap-2">
                {{ __('Sauvegarder') }}
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm font-medium text-green-600 flex items-center gap-1"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    {{ __('Mot de passe modifié.') }}
                </p>
            @endif
        </div>
    </form>
</section>