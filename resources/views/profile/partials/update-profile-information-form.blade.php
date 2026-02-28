<section
    class="bg-white p-8 rounded-[2rem] shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)] border border-gray-100 relative overflow-hidden">


    <header class="relative z-10 mb-8 flex items-start gap-5">
        <div
            class="w-16 h-16 bg-orange-50 rounded-2xl flex items-center justify-center shrink-0 border border-orange-100">
            <svg class="w-8 h-8 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
        </div>
        <div>
            <h2 class="text-2xl font-extrabold text-[#1A1A1A]">
                {{ __('Informations du Profil') }}
            </h2>
            <p class="mt-1 text-sm text-gray-500 font-medium">
                {{ __("Mettez à jour les informations de votre compte et votre adresse email.") }}
            </p>
        </div>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="relative z-10 space-y-6"
        enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="flex items-center gap-6 pb-6 border-b border-gray-100" x-data="{ 
        photoName: null,
        photoPreview: null,
        updatePhotoPreview() {
            const file = this.$refs.photo.files[0];
            if (! file) return;

            const reader = new FileReader();
            reader.onload = (e) => {
                this.photoPreview = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }">

            <div class="relative group">

                <img :src="photoPreview ? photoPreview : '{{ asset('storage/profiles/' . $user->profile_photo) }}'"
                    alt="Avatar"
                    class="w-20 h-20 rounded-full object-cover border-4 border-white shadow-lg transition-all duration-300">

                <div
                    class="absolute inset-0 bg-black/40 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer z-20">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>

                <input type="file" name="profile_photo" x-ref="photo" @change="updatePhotoPreview()"
                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-30">
            </div>

            <div>
                <h4 class="text-sm font-bold text-[#1A1A1A]">{{ __('Photo de profil') }}</h4>
                <p class="text-xs text-orange-600 font-medium mt-1 " x-show="photoPreview" style="display: none;">
                    Nouvelle image sélectionnée (Sauvegarder pour valider)
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="first_name" class="block text-sm font-semibold text-[#1A1A1A] mb-1.5">
                    {{ __('Prénom') }}
                </label>
                <input id="first_name" name="first_name" type="text"
                    class="w-full rounded-2xl border-gray-200 shadow-sm focus:border-orange-400 focus:ring focus:ring-orange-400/20 text-sm py-3 px-4 transition-all"
                    value="{{ old('first_name', $user->first_name) }}" required autofocus autocomplete="given-name" />
                <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
            </div>

            <div>
                <label for="last_name" class="block text-sm font-semibold text-[#1A1A1A] mb-1.5">
                    {{ __('Nom') }}
                </label>
                <input id="last_name" name="last_name" type="text"
                    class="w-full rounded-2xl border-gray-200 shadow-sm focus:border-orange-400 focus:ring focus:ring-orange-400/20 text-sm py-3 px-4 transition-all"
                    value="{{ old('last_name', $user->last_name) }}" required autocomplete="family-name" />
                <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
            </div>
        </div>

        <div>
            <label for="email" class="block text-sm font-semibold text-[#1A1A1A] mb-1.5">
                {{ __('Adresse Email') }}
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                        </path>
                    </svg>
                </div>
                <input id="email" name="email" type="email"
                    class="w-full rounded-2xl border-gray-200 shadow-sm focus:border-orange-400 focus:ring focus:ring-orange-400/20 text-sm py-3 pl-11 pr-4 transition-all"
                    value="{{ old('email', $user->email) }}" required autocomplete="username" />
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div class="mt-4 p-4 bg-orange-50 rounded-2xl border border-orange-100 flex items-start gap-3">
                    <svg class="w-5 h-5 text-orange-500 shrink-0 mt-0.5" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                        </path>
                    </svg>
                    <div>
                        <p class="text-sm text-orange-800 font-medium">
                            {{ __('Votre adresse email n\'est pas vérifiée.') }}
                        </p>
                        <button form="send-verification"
                            class="text-sm font-bold text-orange-600 hover:text-orange-800 underline mt-1">
                            {{ __('Cliquez ici pour renvoyer l\'email de vérification.') }}
                        </button>
                    </div>
                </div>

                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 text-sm font-medium text-green-600 bg-green-50 px-4 py-2 rounded-xl inline-block">
                        {{ __('Un nouveau lien de vérification a été envoyé.') }}
                    </p>
                @endif
            @endif
        </div>

        <div class="pt-4 flex items-center justify-end gap-4 border-t border-gray-50 mt-8">
            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm font-medium text-green-600 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    {{ __('Enregistré.') }}
                </p>
            @endif

            <button type="submit"
                class="bg-[#1A1A1A] text-[#FAF9F6] px-8 py-3 rounded-full text-sm font-bold hover:bg-gray-800 transition-all shadow-md hover:-translate-y-0.5 flex items-center gap-2">
                {{ __('Sauvegarder') }}
            </button>
        </div>
    </form>
</section>