<nav class="relative z-10 flex flex-col md:flex-row justify-between items-center px-6 sm:px-12 py-4 bg-slate-900 border-b border-slate-800 gap-4 shadow-xl shadow-black/40 text-slate-100">

    <!-- Logo / Marca -->
    <a href="{{ url('/') }}" class="group flex items-center gap-3 no-underline">
        <div class="w-9 h-9 bg-cyan-500 rounded-xl flex items-center justify-center text-slate-950 font-black text-sm shadow-md shadow-cyan-500/20 group-hover:scale-105 transition-transform duration-200">
            S
        </div>
        <span class="text-xl font-black tracking-wider text-white">SIGER</span>
    </a>

    <!-- Enlaces Dinámicos según Rol + Botón Volver al Inicio -->
    <div class="flex flex-wrap items-center gap-2 text-xs sm:text-sm font-semibold">
        <!-- Botón Volver al Inicio Pro -->
        <a href="{{ route('dashboard') }}" 
           class="px-4 py-2 rounded-xl text-slate-300 hover:text-white bg-slate-800/80 hover:bg-slate-800 border border-slate-700/60 hover:border-cyan-500/50 transition duration-200 no-underline flex items-center gap-2 group shadow-sm">
            <svg class="w-4 h-4 text-cyan-400 group-hover:-translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            <span>Volver al Inicio</span>
        </a>

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
                🎯 Asignación de Requerimientos
            </a>
        @endcan

        @can('is-admin')
            <a href="{{ route('users.index') }}"
                class="px-4 py-2 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800 border border-slate-800 hover:border-slate-700 transition duration-150 no-underline flex items-center gap-2">
                👥 Gestión Usuarios
            </a>
        @endcan
    </div>

    <!-- Usuario Dinámico Clickeable para Perfil y Salir -->
    <div class="flex items-center gap-3">
        <!-- Nombre del usuario como Botón de Perfil Dinámico -->
        <a href="{{ route('profile.edit') }}" 
           title="Clic para ver tu perfil"
           class="inline-flex items-center gap-2.5 px-4 py-2 rounded-xl bg-slate-800/90 border border-slate-700/60 hover:border-cyan-500/50 hover:bg-slate-800 text-slate-200 hover:text-cyan-400 transition duration-200 group no-underline shadow-sm">
            
            <!-- Indicador verde de sesión activa -->
            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 shadow-sm shadow-emerald-500/50"></span>
            
            <!-- Nombre Real del Usuario Logueado (Cualquiera) -->
            <span class="text-xs font-bold tracking-wide">
                {{ Auth::user()->name }}
            </span>

            <!-- Icono sutil de configuración/perfil al hacer hover -->
            <span class="text-[10px] text-slate-400 group-hover:text-cyan-400 transition duration-150">
                ⚙️
            </span>
        </a>

        <!-- Botón Cerrar Sesión -->
        <form method="POST" action="{{ route('logout') }}" class="m-0">
            @csrf
            <button type="submit"
                class="bg-red-500/10 text-red-400 hover:bg-red-500 hover:text-white border border-red-500/30 hover:border-red-500 px-3.5 py-2 rounded-xl font-bold text-xs uppercase cursor-pointer transition duration-200 tracking-wider">
                Cerrar Sesión
            </button>
        </form>
    </div>
</nav>