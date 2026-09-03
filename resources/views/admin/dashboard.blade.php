<x-guest-layout>
    <div class="min-h-screen w-full flex flex-col justify-between bg-slate-950 text-slate-100 font-sans relative overflow-x-hidden">

        <!-- Efectos de Fondo -->
        <div class="absolute -top-40 -left-40 w-96 h-96 bg-cyan-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-purple-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <!-- Navbar -->
        <header class="relative z-10 flex flex-col md:flex-row justify-between items-center px-6 sm:px-12 py-4 bg-slate-900/60 backdrop-blur-xl border-b border-slate-800/80 gap-4 shadow-lg shadow-black/20">
            <a class="group flex items-center gap-3 no-underline">
                <div class="w-9 h-9 bg-gradient-to-br from-cyan-400 via-teal-400 to-emerald-500 rounded-xl flex items-center justify-center text-slate-950 font-black text-sm shadow-md shadow-cyan-500/20 group-hover:scale-105 transition-transform duration-200">
                    S
                </div>
                <span class="text-xl font-black tracking-wider text-white">SIGER <span class="text-xs text-cyan-400 font-normal">| Admin</span></span>
            </a>

            <nav class="flex items-center gap-3 text-xs sm:text-sm font-semibold">
                <a href="{{ route('admin.dashboard') }}" class="px-3 py-1.5 rounded-lg text-white bg-slate-800 border border-slate-700 transition">Panel General</a>
                <a href="{{ route('users.index') }}" class="px-3 py-1.5 rounded-lg text-slate-300 hover:text-white transition">Gestión Usuarios</a>
                <a href="{{ route('admin.requirements.index') }}" class="px-3 py-1.5 rounded-lg text-slate-300 hover:text-white transition">Todos los Requerimientos</a>
            </nav>

            <div class="flex items-center gap-4">
                <span class="text-xs font-semibold text-slate-200">{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="bg-red-500/10 text-red-400 hover:bg-red-500 hover:text-white border border-red-500/30 px-3 py-1 rounded-lg text-xs font-semibold transition">
                        CERRAR SESIÓN
                    </button>
                </form>
            </div>
        </header>

        <!-- Contenido Principal -->
        <main class="relative z-10 max-w-7xl mx-auto px-6 py-10 w-full flex-grow flex flex-col">

            <div class="mb-8">
                <h1 class="text-2xl sm:text-3xl font-black text-white tracking-tight">Panel de Administración</h1>
                <p class="text-slate-400 text-sm">Resumen general del estado del sistema y control de cuentas.</p>
            </div>

            <!-- Tarjetas de Métricas Globales -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <div class="bg-slate-900/60 backdrop-blur-xl border border-slate-800 p-5 rounded-xl shadow-lg">
                    <span class="text-xs font-semibold text-slate-400 uppercase">Total Usuarios</span>
                    <p class="text-3xl font-black text-white mt-2">{{ $totalUsers }}</p>
                    <span class="text-xs text-slate-500">{{ $totalClients }} Clientes | {{ $totalDevelopers }} Devs</span>
                </div>

                <div class="bg-slate-900/60 backdrop-blur-xl border border-slate-800 p-5 rounded-xl shadow-lg">
                    <span class="text-xs font-semibold text-slate-400 uppercase">Total Requerimientos</span>
                    <p class="text-3xl font-black text-cyan-400 mt-2">{{ $totalRequirements }}</p>
                </div>

                <div class="bg-slate-900/60 backdrop-blur-xl border border-slate-800 p-5 rounded-xl shadow-lg">
                    <span class="text-xs font-semibold text-slate-400 uppercase">Sin Asignar</span>
                    <p class="text-3xl font-black text-amber-400 mt-2">{{ $pendingRequirements }}</p>
                </div>

                <div class="bg-slate-900/60 backdrop-blur-xl border border-slate-800 p-5 rounded-xl shadow-lg">
                    <span class="text-xs font-semibold text-slate-400 uppercase">Finalizados</span>
                    <p class="text-3xl font-black text-emerald-400 mt-2">{{ $completedRequirements }}</p>
                </div>
            </div>

            <!-- Sección de Acceso Rápido -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Gestión de Usuarios -->
                <div class="bg-slate-900/60 border border-slate-800/80 rounded-xl p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-bold text-white">Usuarios Recientes</h2>
                        <a href="{{ route('users.index') }}" class="text-xs text-cyan-400 hover:underline">Ver Todos →</a>
                    </div>
                    <div class="divide-y divide-slate-800">
                        @foreach ($recentUsers as $user)
                        <div class="py-2 flex justify-between items-center text-xs">
                            <div>
                                <p class="font-semibold text-white">{{ $user->name }}</p>
                                <p class="text-slate-400">{{ $user->email }}</p>
                            </div>
                            <span class="px-2 py-0.5 rounded-full bg-slate-800 border border-slate-700 text-slate-300 font-bold uppercase">
                                {{ $user->role ?? 'Cliente' }}
                            </span>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Histórico Reciente de Requerimientos -->
                <div class="bg-slate-900/60 border border-slate-800/80 rounded-xl p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-bold text-white">Actividad Reciente</h2>
                        <a href="{{ route('admin.requirements.index') }}" class="text-xs text-cyan-400 hover:underline">Ver Histórico →</a>
                    </div>
                    <div class="divide-y divide-slate-800">
                        @foreach ($recentRequirements as $req)
                        <div class="py-2 flex justify-between items-center text-xs">
                            <div>
                                <p class="font-semibold text-white">{{ Str::limit($req->Descripcion, 35) }}</p>
                                <p class="text-slate-400">Creado por: {{ $req->client->name ?? 'N/A' }}</p>
                            </div>
                            <span class="text-slate-400 font-mono">{{ $req->FechaCreacion }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </main>

        <footer class="text-center py-4 text-xs text-slate-500 border-t border-slate-800/80 bg-slate-950">
            &copy; {{ date('Y') }} SIGER - Módulo Administrativo.
        </footer>
    </div>
</x-guest-layout>