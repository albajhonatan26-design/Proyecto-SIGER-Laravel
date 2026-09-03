<!-- VISTA PARA EL DESARROLLADOR -->
<x-guest-layout>
    <div
        class="min-h-screen w-full flex flex-col justify-between bg-slate-950 text-slate-100 font-sans relative overflow-x-hidden">

        <!-- Efectos de Fondo Luminosos -->
        <div class="absolute -top-40 -left-40 w-96 h-96 bg-cyan-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none">
        </div>

        <!-- Navbar Superior -->
        <header
            class="relative z-10 flex flex-col md:flex-row justify-between items-center px-6 sm:px-12 py-4 bg-slate-900/60 backdrop-blur-xl border-b border-slate-800/80 gap-4 shadow-lg shadow-black/20">
            <a class="group flex items-center gap-3 no-underline">
                <div
                    class="w-9 h-9 bg-gradient-to-br from-cyan-400 via-teal-400 to-emerald-500 rounded-xl flex items-center justify-center text-slate-950 font-black text-sm shadow-md shadow-cyan-500/20 group-hover:scale-105 transition-transform duration-200">
                    S
                </div>
                <span class="text-xl font-black tracking-wider text-white">SIGER</span>
            </a>

            <!-- Navegación según Rol -->
            <nav class="flex items-center gap-1 sm:gap-2 text-xs sm:text-sm font-semibold">
                <a href="{{ route('requirements.assigned') }}"
                    class="px-4 py-2 rounded-lg text-white bg-slate-800/90 border border-slate-700/80 transition flex items-center gap-2 no-underline">
                    <span>💻</span>
                    <span>Mis Asignaciones</span>
                </a>
                <a href="{{ route('developer.requirements.history') }}"
                    class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('requirements.history') ? 'bg-slate-800 text-white border border-slate-700 shadow-lg' : 'text-slate-400 hover:text-white hover:bg-slate-800/50' }}">
                    📜 Historial de Requerimientos
                </a>
                <a href="{{ Route::has('profile.edit') ? route('profile.edit') : url('/index.php/profile') }}"
                    class="px-4 py-2 rounded-lg text-slate-300 hover:text-white hover:bg-slate-800/70 border border-transparent hover:border-slate-700/50 transition duration-150 flex items-center gap-2 no-underline">
                    <span>⚙️</span>
                    <span>Perfil</span>
                </a>
            </nav>

            <div class="flex items-center gap-4">
                <div
                    class="flex items-center gap-2 px-3 py-1.5 rounded-full bg-slate-800/40 border border-slate-700/50">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span class="text-xs font-semibold text-slate-200">{{ Auth::user()->name }}</span>
                </div>

                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit"
                        class="bg-red-500/10 text-red-400 hover:bg-red-500 hover:text-white border border-red-500/30 hover:border-red-500 px-4 py-1.5 rounded-lg font-semibold text-xs cursor-pointer transition duration-200">
                        CERRAR SESIÓN
                    </button>
                </form>
            </div>
        </header>

        <!-- Contenido Principal -->
        <main class="relative z-10 max-w-7xl mx-auto px-6 py-10 w-full flex-grow flex flex-col">

            <!-- Encabezado de la Sección -->
            <div class="mb-8">
                <span
                    class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold text-cyan-300 bg-cyan-950/60 border border-cyan-800/60 mb-2">
                    <span class="w-2 h-2 rounded-full bg-cyan-400"></span> Área de Desarrollo
                </span>
                <h1 class="text-2xl sm:text-3xl font-black text-white tracking-tight">
                    Requerimientos Asignados
                </h1>
            </div>

            <!-- Alerta de Notificación de Éxito -->
            @if (session('success'))
                <div
                    class="flex items-center gap-3 bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 px-5 py-4 rounded-xl mb-6 font-semibold text-sm backdrop-blur-md shadow-lg shadow-emerald-500/5">
                    <span>✓</span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- Tabla de Tareas del Desarrollador -->
            <div
                class="bg-slate-900/60 backdrop-blur-2xl border border-slate-800/80 rounded-2xl shadow-2xl shadow-black/50 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr
                                class="bg-slate-950/60 border-b border-slate-800/80 text-xs font-bold text-slate-400 uppercase tracking-wider">
                                <th class="px-6 py-4">Requerimiento</th>
                                <th class="px-6 py-4">Archivo</th>
                                <th class="px-6 py-4">Fecha Inicio</th>
                                <th class="px-6 py-4">Estado Actual</th>
                                <th class="px-6 py-4">Observación / Actualizar</th>
                                <th class="px-6 py-4 text-right">Acción</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800/60 text-xs sm:text-sm text-slate-300">
                            @forelse ($assignedRequirements as $desarrollo)
                                <tr class="hover:bg-slate-800/40 transition duration-150">

                                    <!-- Nombre o descripción del requerimiento -->
                                    <td class="px-6 py-4 font-semibold text-white">
                                        {{ $desarrollo->requerimiento->Nombre ?? ($desarrollo->requerimiento->Descripcion ?? 'Requerimiento #' . $desarrollo->IdRequerimiento) }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($desarrollo->requerimiento && $desarrollo->requerimiento->ArchivoAdjunto)
                                            <a href="{{ asset('storage/' . $desarrollo->requerimiento->ArchivoAdjunto) }}"
                                                target="_blank"
                                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-cyan-500/10 hover:bg-cyan-500 text-cyan-400 hover:text-slate-950 font-semibold text-xs transition duration-150">
                                                📄 Ver Adjunto
                                            </a>
                                        @else
                                            <span class="text-slate-500 text-xs italic">Sin archivo</span>
                                        @endif
                                    </td>
                                    <!-- Fecha Inicio -->
                                    <td class="px-6 py-4 text-slate-400">
                                        {{ $desarrollo->FechaInicio ?? 'Pendiente' }}
                                    </td>

                                    <!-- Estado Actual -->
                                    <td class="px-6 py-4">
                                        @php
                                            $estado = $desarrollo->Estado ?? 'Pendiente';
                                            $badgeClasses = match ($estado) {
                                                'En Proceso',
                                                'En Progreso'
                                                    => 'bg-cyan-500/10 text-cyan-400 border-cyan-500/30',
                                                'En Pruebas' => 'bg-purple-500/10 text-purple-400 border-purple-500/30',
                                                'Finalizado',
                                                'Completado',
                                                'Resuelto'
                                                    => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/30',
                                                'Rechazado' => 'bg-red-500/10 text-red-400 border-red-500/30',
                                                default => 'bg-slate-700/30 text-slate-300 border-slate-600/30',
                                            };
                                        @endphp
                                        <span
                                            class="px-2.5 py-1 rounded-full text-xs font-bold border {{ $badgeClasses }}">
                                            {{ $estado }}
                                        </span>
                                    </td>

                                    <!-- Formulario Unificado para Actualizar Estado y Observación -->
                                    <td class="px-6 py-4" colspan="2">
                                        <form method="POST"
                                            action="{{ route('desarrollorequerimiento.update', $desarrollo->IdDesarrolloRequerimiento) }}"
                                            class="m-0 flex items-center justify-between gap-4">
                                            @csrf
                                            @method('PUT')

                                            <div class="flex flex-col sm:flex-row gap-2 w-full max-w-md">
                                                <select name="Estado"
                                                    class="bg-slate-950 border border-slate-800 rounded-lg px-2.5 py-1 text-xs text-slate-300 focus:outline-none focus:border-cyan-500">
                                                    <option value="Pendiente"
                                                        {{ $desarrollo->Estado == 'Pendiente' ? 'selected' : '' }}>
                                                        Pendiente</option>
                                                    <option value="En Progreso"
                                                        {{ $desarrollo->Estado == 'En Progreso' ? 'selected' : '' }}>En
                                                        Progreso</option>
                                                    <option value="Finalizado"
                                                        {{ $desarrollo->Estado == 'Finalizado' ? 'selected' : '' }}>
                                                        Finalizado</option>
                                                </select>

                                                <input type="text" name="Observacion"
                                                    value="{{ $desarrollo->Observacion }}"
                                                    placeholder="Agregar observación..."
                                                    class="w-full bg-slate-950 border border-slate-800 rounded-lg px-2.5 py-1 text-xs text-slate-300 focus:outline-none focus:border-cyan-500">
                                            </div>

                                            <button type="submit"
                                                class="bg-cyan-500/10 hover:bg-cyan-500 text-cyan-400 hover:text-slate-950 border border-cyan-500/30 hover:border-cyan-500 font-bold px-3 py-1.5 rounded-lg text-xs transition duration-200 whitespace-nowrap cursor-pointer">
                                                Actualizar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-slate-500 font-medium">
                                        No tienes requerimientos asignados actualmente.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
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
