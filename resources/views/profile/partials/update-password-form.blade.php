<section>
    <header>
        <h2 class="text-xl font-bold text-white">
            Actualizar Contraseña
        </h2>

        <p class="mt-2 text-sm sm:text-base text-slate-300 font-medium">
            Asegúrate de que tu cuenta utilice una contraseña larga y aleatoria para mantenerla segura.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-sm sm:text-base font-bold text-slate-200 mb-2">
                Contraseña Actual
            </label>
            <input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password"
                class="w-full bg-slate-950 border border-slate-700 focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 rounded-xl px-4 py-2.5 text-slate-100 text-sm sm:text-base font-semibold shadow-inner transition duration-150">
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password" class="block text-sm sm:text-base font-bold text-slate-200 mb-2">
                Nueva Contraseña
            </label>
            <input id="update_password_password" name="password" type="password" autocomplete="new-password"
                class="w-full bg-slate-950 border border-slate-700 focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 rounded-xl px-4 py-2.5 text-slate-100 text-sm sm:text-base font-semibold shadow-inner transition duration-150">
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-sm sm:text-base font-bold text-slate-200 mb-2">
                Confirmar Contraseña
            </label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password"
                class="w-full bg-slate-950 border border-slate-700 focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 rounded-xl px-4 py-2.5 text-slate-100 text-sm sm:text-base font-semibold shadow-inner transition duration-150">
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="bg-cyan-500 hover:bg-cyan-400 text-slate-950 font-black px-6 py-2.5 rounded-xl text-sm transition duration-200 shadow-lg shadow-cyan-500/20 uppercase tracking-wider cursor-pointer">
                Guardar Contraseña
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm font-bold text-emerald-400">
                    ✓ Contraseña actualizada.
                </p>
            @endif
        </div>
    </form>
</section>