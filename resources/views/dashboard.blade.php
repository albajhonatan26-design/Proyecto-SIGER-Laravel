<!-- VISTA del cliente -->
<x-guest-layout>
    <div
        class="min-h-screen w-full flex flex-col justify-between bg-slate-950 text-slate-100 font-sans relative overflow-x-hidden">

        <!-- Efectos de Fondo Luminosos (Glows) -->
        <div class="absolute -top-40 -left-40 w-96 h-96 bg-cyan-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none">
        </div>

        <!-- Navbar Superior -->
        <header
            class="relative z-10 flex flex-col md:flex-row justify-between items-center px-6 sm:px-12 py-4 bg-slate-900/60 backdrop-blur-xl border-b border-slate-800/80 gap-4 shadow-lg shadow-black/20">

            <!-- Logo / Identidad del Sistema -->
            <a class="group flex items-center gap-3 no-underline">
                <div
                    class="w-9 h-9 bg-gradient-to-br from-cyan-400 via-teal-400 to-emerald-500 rounded-xl flex items-center justify-center text-slate-950 font-black text-sm shadow-md shadow-cyan-500/20 group-hover:scale-105 transition-transform duration-200">
                    S
                </div>
                <span class="text-xl font-black tracking-wider text-white">SIGER</span>
            </a>

            <!-- Menú de Navegación Central -->
            <nav class="flex items-center gap-1 sm:gap-2 text-xs sm:text-sm font-semibold">
                <!-- Enlace de Historial para Cliente -->
                <a href="{{ route('client.requirements.history') }}"
                    class="px-4 py-2 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800 border border-slate-800 hover:border-slate-700 transition duration-150 no-underline flex items-center gap-2">
                    📋 Historial de Requerimientos
                </a>

                <a href="{{ Route::has('requirements.create') ? route('requirements.create') : url('/index.php/requirements/create') }}"
                    class="px-4 py-2 rounded-lg text-slate-300 hover:text-white hover:bg-slate-800/70 border border-transparent hover:border-slate-700/50 transition duration-150 flex items-center gap-2 no-underline">
                    <span>➕</span>
                    <span>Crear</span>
                </a>

                <a href="{{ Route::has('profile.edit') ? route('profile.edit') : url('/index.php/profile') }}"
                    class="px-4 py-2 rounded-lg text-slate-300 hover:text-white hover:bg-slate-800/70 border border-transparent hover:border-slate-700/50 transition duration-150 flex items-center gap-2 no-underline">
                    <span>⚙️</span>
                    <span>Perfil</span>
                </a>
            </nav>

            <!-- Menú de Usuario & Salida -->
            <div class="flex items-center gap-4">
                <div
                    class="flex items-center gap-2 px-3 py-1.5 rounded-full bg-slate-800/40 border border-slate-700/50">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span class="text-xs font-semibold text-slate-200">
                        {{ Auth::user()->name }}
                    </span>
                </div>

                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit"
                        class="bg-red-500/10 text-red-400 hover:bg-red-500 hover:text-white border border-red-500/30 hover:border-red-500 px-4 py-1.5 rounded-lg font-semibold text-xs cursor-pointer transition-all duration-200">
                        CERRAR SESIÓN
                    </button>
                </form>
            </div>
        </header>

        <!-- Contenido Principal -->
        <main class="relative z-10 max-w-5xl mx-auto px-6 py-12 w-full flex-grow flex flex-col justify-center">

            <!-- Alerta de Éxito de Sesión -->
            @if (session('success'))
                <div
                    class="flex items-center gap-3 bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 px-5 py-4 rounded-xl mb-8 font-semibold text-sm backdrop-blur-md shadow-lg shadow-emerald-500/5">
                    <span class="text-emerald-400 text-base">✓</span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- Tarjeta Central de Bienvenida -->
            <div
                class="bg-slate-900/60 backdrop-blur-2xl border border-slate-800/80 rounded-2xl p-8 sm:p-12 shadow-2xl shadow-black/50 relative overflow-hidden">

                <!-- Destello de Luz Superior dentro de la Tarjeta -->
                <div
                    class="absolute top-0 left-1/4 w-1/2 h-1 bg-gradient-to-r from-transparent via-cyan-500/50 to-transparent">
                </div>

                <div class="max-w-2xl">
                    <span
                        class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold text-cyan-300 bg-cyan-950/60 border border-cyan-800/60 mb-6">
                        <span class="w-2 h-2 rounded-full bg-cyan-400"></span> Panel de Control
                    </span>

                    <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight mb-3">
                        ¡Bienvenido de nuevo, <span
                            class="bg-gradient-to-r from-cyan-400 to-emerald-400 bg-clip-text text-transparent">{{ Auth::user()->name }}</span>!
                    </h1>

                    <p class="text-slate-400 text-base sm:text-lg leading-relaxed mb-8">
                        Te encuentras en el panel principal del <strong class="text-slate-200 font-semibold">Sistema de
                            Gestión de Requerimientos (SIGER)</strong>. Gestiona solicitudes, realiza seguimiento en
                        tiempo real y consulta tus requerimientos activos.
                    </p>

                    <!-- Acciones Rápidas -->
                    <div class="flex flex-wrap items-center gap-4">
                        <a href="{{ Route::has('requirements.create') ? route('requirements.create') : url('/index.php/requirements/create') }}"
                            class="inline-flex items-center gap-2.5 bg-gradient-to-r from-cyan-500 to-emerald-500 hover:from-cyan-400 hover:to-emerald-400 text-slate-950 text-xs sm:text-sm font-extrabold tracking-wider px-7 py-3.5 rounded-xl uppercase shadow-lg shadow-cyan-500/20 hover:shadow-cyan-500/35 transition duration-200 no-underline">
                            <span class="text-base font-black">+</span> NUEVO REQUERIMIENTO
                        </a>

                        <a href="{{ Route::has('requirements.index') ? route('requirements.index') : url('/index.php/requirements') }}"
                            class="inline-flex items-center gap-2 bg-slate-800/80 hover:bg-slate-800 text-slate-200 hover:text-white border border-slate-700/80 hover:border-slate-600 text-xs sm:text-sm font-bold tracking-wider px-6 py-3.5 rounded-xl transition duration-200 no-underline">
                            VER MIS REQUERIMIENTOS
                        </a>
                    </div>
                </div>
            </div>
        </main>

        <!-- Pie de página -->
        <footer
            class="relative z-10 text-center py-5 text-xs font-medium text-slate-500 border-t border-slate-800/80 bg-slate-950/80 backdrop-blur-md">
            &copy; {{ date('Y') }} SIGER - Todos los derechos reservados.
        </footer>

    </div>
</x-guest-layout>
