<section class="space-y-6">
    <header>
        <h2 class="text-xl font-bold text-red-400">
            Eliminar Cuenta
        </h2>

        <p class="mt-2 text-sm sm:text-base text-slate-300 font-medium">
            Una vez eliminada tu cuenta, todos sus recursos y datos se borrarán permanentemente. Antes de eliminar tu cuenta, descarga cualquier información que desees conservar.
        </p>
    </header>

    <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')" class="bg-red-500/20 hover:bg-red-500 text-red-300 hover:text-white border border-red-500/40 hover:border-red-500 px-6 py-2.5 rounded-xl font-bold text-sm transition duration-200 cursor-pointer">
        ELIMINAR CUENTA
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 bg-slate-900 border border-slate-800 text-slate-100 rounded-2xl">
            @csrf
            @method('delete')

            <h2 class="text-lg font-bold text-white">
                ¿Estás seguro de que deseas eliminar tu cuenta?
            </h2>

            <p class="mt-2 text-sm text-slate-300">
                Una vez eliminada tu cuenta, todos sus recursos y datos se borrarán de forma permanente. Por favor, ingresa tu contraseña para confirmar la eliminación definitiva.
            </p>

            <div class="mt-6">
                <label for="password" class="sr-only">Contraseña</label>
                <input id="password" name="password" type="password" placeholder="Ingresa tu contraseña"
                    class="w-3/4 bg-slate-950 border border-slate-700 focus:border-red-500 focus:ring-1 focus:ring-red-500 rounded-xl px-4 py-2.5 text-slate-100 text-sm font-semibold">
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close')" class="bg-slate-800 hover:bg-slate-700 text-slate-300 px-4 py-2 rounded-xl font-semibold text-sm transition">
                    Cancelar
                </button>

                <button type="submit" class="bg-red-600 hover:bg-red-500 text-white font-bold px-4 py-2 rounded-xl text-sm transition">
                    Eliminar Cuenta
                </button>
            </div>
        </form>
    </x-modal>
</section>