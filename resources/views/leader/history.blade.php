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

            <!-- Navegación del Líder -->
            <nav class="flex items-center gap-2 text-sm sm:text-base font-semibold">
                <!-- Enlace a la asignación del Líder -->
                <a href="{{ route('requirements.manage') }}"
                    class="px-4 py-2.5 rounded-xl text-slate-200 hover:text-white hover:bg-slate-800 border border-transparent hover:border-slate-700 transition duration-150 flex items-center gap-2 no-underline">
                    <span>🎯</span>
                    <span>Gestión y Asignación</span>
                </a>

                <!-- Enlace al Historial del Líder (Activo) -->
                <a href="{{ route('leader.requirements.history') }}"
                    class="px-4 py-2.5 rounded-xl text-white bg-slate-800 border border-cyan-500/40 shadow-md shadow-cyan-500/10 transition flex items-center gap-2 no-underline">
                    <span>📜</span>
                    <span>Historial</span>
                </a>

                <!-- Enlace al Perfil -->
                <a href="{{ Route::has('profile.edit') ? route('profile.edit') : url('/index.php/profile') }}"
                    class="px-4 py-2.5 rounded-xl text-slate-200 hover:text-white hover:bg-slate-800 border border-transparent hover:border-slate-700 transition duration-150 flex items-center gap-2 no-underline">
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
                    <span class="w-2.5 h-2.5 rounded-full bg-cyan-400"></span> Seguimiento y Registro
                </span>
                <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight">
                    Historial de Requerimientos Asignados
                </h1>
            </div>

            <!-- Tabla de Historial -->
            <div class="bg-slate-900/90 backdrop-blur-2xl border border-slate-800 rounded-2xl shadow-2xl shadow-black/60 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-950/80 border-b border-slate-800 text-xs sm:text-sm font-bold text-slate-300 uppercase tracking-wider">
                                <th class="px-6 py-4">Solicitante</th>
                                <th class="px-6 py-4">Descripción</th>
                                <th class="px-6 py-4">Desarrollador</th>
                                <th class="px-6 py-4">Prioridad</th>
                                <th class="px-6 py-4">Estado Actual</th>
                                <th class="px-6 py-4">Observaciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800/80 text-sm font-medium text-slate-200">
                            @forelse ($assignedRequirements as $desarrollo)
                            <tr class="hover:bg-slate-800/50 transition duration-150">
                                <!-- SOLICITANTE (Cliente que creó el requerimiento) -->
                                <td class="px-6 py-4 font-bold text-white">
                                    {{ $desarrollo->requerimiento->client->name ?? 'Usuario no encontrado' }}
                                </td>

                                <!-- DESCRIPCIÓN -->
                                <td class="px-6 py-4 text-slate-200">
                                    {{ $desarrollo->requerimiento->Descripcion ?? 'Sin Descripción' }}
                                </td>

                                <!-- DESARROLLADOR ASIGNADO -->
                                <td class="px-6 py-4 font-semibold text-cyan-300">
                                    {{ $desarrollo->developer->name ?? $desarrollo->user->name ?? 'Sin Asignar' }}
                                </td>

                                <!-- PRIORIDAD -->
                                <td class="px-6 py-4">
                                    @php
                                    $prio = $desarrollo->requerimiento->Prioridad ?? 'Media';
                                    $prioClasses = match($prio) {
                                    'Alta' => 'bg-red-500/20 text-red-400 border-red-500/40',
                                    'Media' => 'bg-amber-500/20 text-amber-300 border-amber-500/40',
                                    'Baja' => 'bg-emerald-500/20 text-emerald-400 border-emerald-500/40',
                                    default => 'bg-slate-700/40 text-slate-300 border-slate-600/40',
                                    };
                                    @endphp
                                    <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $prioClasses }}">
                                        {{ $prio }}
                                    </span>
                                </td>

                                <!-- ESTADO ACTUAL -->
                                <td class="px-6 py-4">
                                    @php
                                    $estado = $desarrollo->Estado ?? 'Pendiente';
                                    $badgeClasses = match($estado) {
                                    'En Progreso', 'En Proceso' => 'bg-cyan-500/20 text-cyan-300 border-cyan-500/40',
                                    'En Pruebas' => 'bg-purple-500/20 text-purple-300 border-purple-500/40',
                                    'Finalizado', 'Completado' => 'bg-emerald-500/20 text-emerald-300 border-emerald-500/40',
                                    'Rechazado' => 'bg-red-500/20 text-red-400 border-red-500/40',
                                    default => 'bg-slate-700/40 text-slate-300 border-slate-600/40',
                                    };
                                    @endphp
                                    <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $badgeClasses }}">
                                        {{ $estado }}
                                    </span>
                                </td>

                                <!-- OBSERVACIONES -->
                                <td class="px-6 py-4 text-slate-300 text-xs sm:text-sm">
                                    {{ $desarrollo->Observacion ?? 'Sin observaciones' }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-slate-400 font-semibold text-base">
                                    No hay requerimientos asignados registrados en el historial.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>

        <!-- Pie de página -->
        <footer class="relative z-10 text-center py-6 text-sm font-semibold text-slate-400 border-t border-slate-800 bg-slate-950/90 backdrop-blur-md">
            &copy; {{ date('Y') }} SIGER - Todos los derechos reservados.
        </footer>

    </div>
</x-guest-layout>