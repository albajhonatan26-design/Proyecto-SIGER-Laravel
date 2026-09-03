<x-app-layout>
    <style>
        /* Forzar el color azul en el navbar superior y sus bordes */
        nav, .bg-gray-800, .bg-slate-800 {
            background-color: #0f172a !important; /* Ajusta el tono azul según prefieras: #0b1329, #0f172a o #1e293b */
        }
    </style>

    <div class="py-12 bg-[#030712] min-h-screen text-slate-100 font-sans">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Navegación de pestañas -->
            <div class="flex items-center space-x-3 bg-slate-900/60 p-2 rounded-2xl border border-slate-800 w-fit">
                <a href="{{ route('requirements.assigned') }}"
                    class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('requirements.assigned') ? 'bg-slate-800 text-white border border-slate-700 shadow-lg' : 'text-slate-400 hover:text-white hover:bg-slate-800/50' }}">
                    💻 Mis Asignaciones
                </a>
                <a href="{{ route('developer.requirements.history') }}"
                    class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 bg-slate-800 text-white border border-slate-700 shadow-lg">
                    📜 Historial de Requerimientos
                </a>
            </div>

            <!-- Encabezado -->
            <div class="flex items-center space-x-3">
                <span class="text-xs bg-emerald-500/10 text-emerald-400 px-3 py-1 rounded-full border border-emerald-500/20 font-semibold">
                    Área de Desarrollo
                </span>
            </div>
            <h1 class="text-3xl font-bold text-white tracking-tight">Historial de Requerimientos Finalizados</h1>

            <!-- Tabla de Requerimientos Finalizados -->
            <div class="bg-slate-900/80 border border-slate-800 rounded-2xl overflow-hidden shadow-2xl backdrop-blur-xl">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-sm">
                        <thead>
                            <tr class="border-b border-slate-800 text-xs font-semibold text-slate-400 uppercase tracking-wider bg-slate-950/40">
                                <th class="p-4">Requerimiento</th>
                                <th class="p-4">Fecha Inicio</th>
                                <th class="p-4">Estado</th>
                                <th class="p-4">Observación / Novedad</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800/60">
                            @forelse($historyRequirements as $item)
                            <tr class="hover:bg-slate-800/30 transition-colors">
                                <td class="p-4 font-bold text-white">
                                    {{ $item->requerimiento->Descripcion ?? $item->requerimiento->descripcion ?? 'Sin descripción' }}
                                </td>
                                <td class="p-4 text-slate-400 font-mono">
                                    {{ $item->FechaInicio }}
                                </td>
                                <td class="p-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                        {{ $item->Estado }}
                                    </span>
                                </td>
                                <td class="p-4 text-slate-300">
                                    {{ $item->Observacion ?? 'Sin observaciones' }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="p-8 text-center text-slate-500">
                                    No tienes requerimientos finalizados en el historial.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>