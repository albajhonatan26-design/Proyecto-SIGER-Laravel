<nav
    class="relative z-10 flex flex-col md:flex-row justify-between items-center px-6 sm:px-12 py-4 bg-slate-900 border-b border-slate-800 gap-4 shadow-xl shadow-black/40 text-slate-100">

    <!-- Logo -->
    <a href="{{ url('/') }}" class="group flex items-center gap-3 no-underline">
        <div
            class="w-9 h-9 bg-cyan-500 rounded-xl flex items-center justify-center text-slate-950 font-black text-sm shadow-md shadow-cyan-500/20 group-hover:scale-105 transition-transform duration-200">
            S
        </div>
        <span class="text-xl font-black tracking-wider text-white">SIGER</span>
    </a>

    <!-- Enlaces Dinámicos según Rol -->
    <div class="flex flex-wrap items-center gap-2 text-xs sm:text-sm font-semibold">
        @can('is-client')
            <a href="{{ route('client.requirements.history') }}"
                class="px-4 py-2 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800 border border-slate-800 hover:border-slate-700 transition duration-150 no-underline flex items-center gap-2">
                📋 Historial de Requerimientos
            </a>
            <a href="{{ Route::has('requirements.create') ? route('requirements.create') : url('/requirements/create') }}"
                class="px-4 py-2 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800 border border-slate-800 hover:border-slate-700 transition duration-150 no-underline flex items-center gap-2">
                ➕ Crear Nuevo Requerimiento
            </a>
        @endcan

        @can('is-developer')
            <a href="{{ route('requirements.assigned') }}"
                class="px-4 py-2 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800 border border-slate-800 hover:border-slate-700 transition duration-150 no-underline flex items-center gap-2">
                💻 Mis Asignaciones
            </a>
            <a href="{{ route('developer.requirements.history') }}"
                class="px-4 py-2 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800 border border-slate-800 hover:border-slate-700 transition duration-150 no-underline flex items-center gap-2">
                📜 Historial
            </a>
        @endcan

        @can('is-leader')
            <a href="{{ route('requirements.manage') }}"
                class="px-4 py-2 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800 border border-slate-800 hover:border-slate-700 transition duration-150 no-underline flex items-center gap-2">
                🎯 Asignar Requerimientos
            </a>
        @endcan

        @can('is-admin')
            <a href="{{ route('users.index') }}"
                class="px-4 py-2 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800 border border-slate-800 hover:border-slate-700 transition duration-150 no-underline flex items-center gap-2">
                👥 Gestión Usuarios
            </a>
        @endcan
    </div>

    <!-- Usuario / Sesión -->
    <div class="flex items-center gap-3">
        <span
            class="text-xs font-semibold text-slate-300 px-3.5 py-2 rounded-xl bg-slate-800 border border-slate-700/60">
            {{ Auth::user()->name }}
        </span>

        <form method="POST" action="{{ route('logout') }}" class="m-0">
            @csrf
            <button type="submit"
                class="bg-red-500/10 text-red-400 hover:bg-red-500 hover:text-white border border-red-500/30 hover:border-red-500 px-3 py-2 rounded-xl font-semibold text-xs cursor-pointer transition duration-200">
                SALIR
            </button>
        </form>
    </div>
</nav>
