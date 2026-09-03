<section>
    <header>
        <h2 class="text-xl font-bold text-white">
            Información del Perfil
        </h2>

        <p class="mt-2 text-sm sm:text-base text-slate-300 font-medium">
            Actualiza la información de tu cuenta y tu dirección de correo electrónico.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="block text-sm sm:text-base font-bold text-slate-200 mb-2">
                Nombre Completo
            </label>
            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name"
                class="w-full bg-slate-950 border border-slate-700 focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 rounded-xl px-4 py-2.5 text-slate-100 text-sm sm:text-base font-semibold shadow-inner transition duration-150">
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <label for="email" class="block text-sm sm:text-base font-bold text-slate-200 mb-2">
                Correo Electrónico
            </label>
            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username"
                class="w-full bg-slate-950 border border-slate-700 focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 rounded-xl px-4 py-2.5 text-slate-100 text-sm sm:text-base font-semibold shadow-inner transition duration-150">
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-amber-400">
                        Tu dirección de correo electrónico no está verificada.

                        <button form="send-verification" class="underline text-sm text-cyan-400 hover:text-cyan-300 font-bold focus:outline-none">
                            Haz clic aquí para reencaminar el correo de verificación.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-bold text-sm text-emerald-400">
                            Se ha enviado un nuevo enlace de verificación a tu correo electrónico.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="bg-cyan-500 hover:bg-cyan-400 text-slate-950 font-black px-6 py-2.5 rounded-xl text-sm transition duration-200 shadow-lg shadow-cyan-500/20 uppercase tracking-wider cursor-pointer">
                Guardar Cambios
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm font-bold text-emerald-400">
                    ✓ Guardado correctamente.
                </p>
            @endif
        </div>
    </form>
</section>