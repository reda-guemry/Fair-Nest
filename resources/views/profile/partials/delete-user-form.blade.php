<section class="space-y-6">
    <p class="text-sm text-red-600/80 font-medium">
        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
    </p>

    <button x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="bg-white border-2 border-red-100 text-red-600 px-6 py-3 rounded-full text-sm font-bold hover:bg-red-600 hover:text-white hover:border-red-600 transition-all duration-300 shadow-sm flex items-center gap-2"
    >
        {{ __('Delete Account') }}
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-8">
            @csrf
            @method('delete')

            <h2 class="text-2xl font-extrabold text-[#1A1A1A]">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-3 text-sm text-gray-500 font-medium leading-relaxed">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-8">
                <label for="password" class="sr-only">{{ __('Password') }}</label>

                <input
                    id="password"
                    name="password"
                    type="password"
                    class="w-full rounded-2xl border-gray-200 shadow-sm focus:border-red-500 focus:ring focus:ring-red-500/20 text-sm py-3 px-4 transition-all placeholder:text-gray-400"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-8 flex justify-end gap-3">
                <button type="button" 
                        x-on:click="$dispatch('close')" 
                        class="bg-white text-gray-700 border border-gray-200 px-6 py-3 rounded-full text-sm font-bold hover:bg-gray-50 transition-all">
                    {{ __('Cancel') }}
                </button>

                <button type="submit" 
                        class="bg-red-600 text-white px-6 py-3 rounded-full text-sm font-bold hover:bg-red-700 transition-all shadow-lg shadow-red-200 hover:-translate-y-0.5">
                    {{ __('Delete Account') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>