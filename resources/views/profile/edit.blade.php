<x-guest-layout>
    <div class="min-h-screen w-full flex flex-col justify-between bg-slate-950 text-slate-100 font-sans relative overflow-x-hidden">

        <!-- Efectos de Fondo Luminosos -->
        <div class="absolute -top-40 -left-40 w-96 h-96 bg-cyan-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <!-- Navbar Superior -->
        <header class="relative z-10 flex flex-col md:flex-row justify-between items-center px-6 sm:px-12 py-5 bg-slate-900/80 backdrop-blur-xl border-b border-slate-800 gap-4 shadow-lg shadow-black/20">
            <a class="group flex items-center gap-3 no-underline">
                <div class="w-10 h-10 bg-gradient-to-br from-cyan-400 via-teal-400 to-emerald-500 rounded-xl flex items-center justify-center text-slate-950 font-black text-base shadow-md shadow-cyan-500/20 group-hover:scale-105 transition-transform duration-200">
                    S
                </div>
                <span class="text-2xl font-black tracking-wider text-white">SIGER</span>
            </a>

            <!-- Navegación -->
            @php
            $backRoute = route('dashboard');

            if (Auth::user()->can('is-leader')) {
            $backRoute = route('requirements.manage');
            } elseif (Auth::user()->can('is-developer')) {
            $backRoute = route('requirements.assigned');
            } elseif (Auth::user()->can('is-client')) {
            $backRoute = route('dashboard');
            } elseif (Auth::user()->can('is-admin')) {
            $backRoute = route('admin.dashboard');
            }
            @endphp

            <a href="{{ $backRoute }}"
                class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-slate-200 bg-slate-800 hover:bg-slate-700 hover:text-white border border-slate-700 transition duration-150 font-semibold text-sm no-underline shadow-md">
                <span>⬅️</span>
                <span>Volver al Inicio</span>
            </a>
            <a href="{{ Route::has('profile.edit') ? route('profile.edit') : url('/index.php/profile') }}" class="px-4 py-2.5 rounded-xl text-white bg-slate-800 border border-cyan-500/40 shadow-md shadow-cyan-500/10 transition flex items-center gap-2 no-underline">
                <span>⚙️</span>
                <span>Perfil</span>
            </a>
            </nav>

            <div class="flex items-center gap-4">
                <div class="flex items-center gap-2.5 px-4 py-2 rounded-full bg-slate-800/80 border border-slate-700">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span class="text-sm font-bold text-slate-100">{{ Auth::user()->name }}</span>
                </div>

                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="bg-red-500/10 text-red-400 hover:bg-red-500 hover:text-white border border-red-500/40 hover:border-red-500 px-4 py-2 rounded-xl font-bold text-xs sm:text-sm cursor-pointer transition duration-200">
                        CERRAR SESIÓN
                    </button>
                </form>
            </div>
        </header>

        <!-- Contenido Principal -->
        <main class="relative z-10 max-w-7xl mx-auto px-6 py-10 w-full flex-grow flex flex-col">

            <!-- Encabezado de la Sección -->
            <div class="mb-8">
                <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-sm font-bold text-cyan-300 bg-cyan-950/90 border border-cyan-700/80 mb-3 shadow-sm">
                    <span class="w-2.5 h-2.5 rounded-full bg-cyan-400"></span> Configuración de la Cuenta
                </span>
                <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight">
                    Perfil de Usuario
                </h1>
            </div>

            <!-- Secciones de Formulario -->
            <div class="space-y-8">

                <!-- Información del Perfil -->
                <div class="p-6 sm:p-8 bg-slate-900/90 backdrop-blur-2xl border border-slate-800 rounded-2xl shadow-2xl shadow-black/60">
                    <div class="max-w-2xl text-slate-100">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <!-- Actualizar Contraseña -->
                <div class="p-6 sm:p-8 bg-slate-900/90 backdrop-blur-2xl border border-slate-800 rounded-2xl shadow-2xl shadow-black/60">
                    <div class="max-w-2xl text-slate-100">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <!-- Eliminar Cuenta -->
                <div class="p-6 sm:p-8 bg-slate-900/90 backdrop-blur-2xl border border-red-900/40 rounded-2xl shadow-2xl shadow-black/60">
                    <div class="max-w-2xl text-slate-100">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>

            </div>
        </main>

        <!-- Pie de página -->
        <footer class="relative z-10 text-center py-6 text-sm font-semibold text-slate-400 border-t border-slate-800 bg-slate-950/90 backdrop-blur-md">
            &copy; {{ date('Y') }} SIGER - Todos los derechos reservados.
        </footer>

    </div>
</x-guest-layout>