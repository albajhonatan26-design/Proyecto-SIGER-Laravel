<x-app-layout>
    @php
        $reqs = $requirements ?? collect();
        $total = is_countable($reqs) ? count($reqs) : 0;
        
        $enDesarrollo = method_exists($reqs, 'whereIn') 
            ? $reqs->whereIn('Estado', ['En Progreso', 'En Proceso'])->count() 
            : 0;
            
        $completados = method_exists($reqs, 'whereIn') 
            ? $reqs->whereIn('Estado', ['Finalizado', 'Completado'])->count() 
            : 0;
            
        $pendientes = method_exists($reqs, 'where') 
            ? $reqs->where('Estado', 'Pendiente')->count() 
            : 0;
    @endphp

    <div class="bg-slate-950 min-h-screen text-slate-100 font-sans pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 space-y-8">

            <!-- Encabezado Principal -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-slate-900/90 p-6 rounded-2xl border border-slate-800 shadow-2xl backdrop-blur-md">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-cyan-400 animate-pulse"></span>
                        <span class="text-xs font-bold uppercase tracking-wider text-cyan-400">Panel de Cliente</span>
                    </div>
                    <h1 class="text-3xl font-extrabold text-white tracking-tight">Historial de Requerimientos</h1>
                    <p class="text-sm text-slate-400 mt-1">Supervisa en tiempo real el estado y avance de tus solicitudes.</p>
                </div>

                <a href="{{ url('/requirements/create') }}" 
                   class="inline-flex items-center justify-center gap-2.5 px-6 py-3 rounded-xl text-white font-bold bg-gradient-to-r from-cyan-600 to-blue-600 hover:from-cyan-500 hover:to-blue-500 border border-cyan-400/30 shadow-lg shadow-cyan-950/50 transition duration-200 no-underline hover:scale-[1.02]">
                    <span>✨</span>
                    <span>Nueva Solicitud</span>
                </a>
            </div>

            <!-- Tarjetas de Métricas -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Total -->
                <div class="bg-slate-900/60 border border-slate-800 p-5 rounded-2xl flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Solicitudes</p>
                        <p class="text-2xl font-black text-white mt-1">{{ $total }}</p>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-slate-800/80 border border-slate-700 flex items-center justify-center text-lg">📁</div>
                </div>

                <!-- En Desarrollo -->
                <div class="bg-slate-900/60 border border-slate-800 p-5 rounded-2xl flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold text-cyan-400 uppercase tracking-wider">En Desarrollo</p>
                        <p class="text-2xl font-black text-cyan-300 mt-1">{{ $enDesarrollo }}</p>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-cyan-500/10 border border-cyan-500/30 flex items-center justify-center text-lg">⚙️</div>
                </div>

                <!-- Completados -->
                <div class="bg-slate-900/60 border border-slate-800 p-5 rounded-2xl flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold text-emerald-400 uppercase tracking-wider">Completados</p>
                        <p class="text-2xl font-black text-emerald-300 mt-1">{{ $completados }}</p>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-emerald-500/10 border border-emerald-500/30 flex items-center justify-center text-lg">✅</div>
                </div>

                <!-- Pendientes -->
                <div class="bg-slate-900/60 border border-slate-800 p-5 rounded-2xl flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold text-amber-400 uppercase tracking-wider">Pendientes</p>
                        <p class="text-2xl font-black text-amber-300 mt-1">{{ $pendientes }}</p>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-amber-500/10 border border-amber-500/30 flex items-center justify-center text-lg">⏳</div>
                </div>
            </div>

            <!-- Tabla de Requerimientos -->
            <div class="bg-slate-900/90 border border-slate-800 rounded-2xl shadow-2xl overflow-hidden backdrop-blur-md">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-800/80 border-b border-slate-800 text-xs font-bold text-slate-400 uppercase tracking-wider">
                                <th class="px-6 py-4">ID</th>
                                <th class="px-6 py-4">Descripción del Requerimiento</th>
                                <th class="px-6 py-4">Prioridad</th>
                                <th class="px-6 py-4">Estado</th>
                                <th class="px-6 py-4">Adjunto</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800/70 text-sm font-medium text-slate-200">
                            @forelse ($reqs as $req)
                            <tr class="hover:bg-slate-800/50 transition duration-150">
                                <td class="px-6 py-4 font-mono font-bold text-cyan-400">
                                    #{{ $req->IdRequerimiento ?? $req->id }}
                                </td>
                                <td class="px-6 py-4 max-w-sm">
                                    <p class="text-white font-semibold line-clamp-2">
                                        {{ $req->Descripcion ?? 'Sin descripción' }}
                                    </p>
                                    <span class="text-xs text-slate-400 block mt-0.5">
                                        Medio: {{ $req->MedioRecepcion ?? 'Portal Web' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $prio = $req->Prioridad ?? 'Media';
                                        $prioColor = match($prio) {
                                            'Alta' => 'bg-red-500/20 text-red-400 border-red-500/40',
                                            'Media' => 'bg-amber-500/20 text-amber-300 border-amber-500/40',
                                            'Baja' => 'bg-emerald-500/20 text-emerald-400 border-emerald-500/40',
                                            default => 'bg-slate-700/40 text-slate-300 border-slate-600/40',
                                        };
                                    @endphp
                                    <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $prioColor }}">
                                        {{ $prio }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $est = $req->Estado ?? 'Pendiente';
                                        $estColor = match($est) {
                                            'En Progreso', 'En Proceso' => 'bg-cyan-500/20 text-cyan-300 border-cyan-500/40',
                                            'Finalizado', 'Completado' => 'bg-emerald-500/20 text-emerald-300 border-emerald-500/40',
                                            'Rechazado' => 'bg-red-500/20 text-red-400 border-red-500/40',
                                            default => 'bg-slate-700/40 text-slate-300 border-slate-600/40',
                                        };
                                    @endphp
                                    <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $estColor }}">
                                        {{ $est }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if (!empty($req->ArchivoAdjunto))
                                        <a href="{{ asset('storage/' . $req->ArchivoAdjunto) }}" 
                                           target="_blank" 
                                           class="inline-flex items-center gap-1.5 text-xs text-cyan-400 hover:text-cyan-300 bg-cyan-500/10 border border-cyan-500/30 px-3 py-1.5 rounded-lg transition no-underline">
                                            <span>📎</span>
                                            <span>Ver Adjunto</span>
                                        </a>
                                    @else
                                        <span class="text-xs text-slate-500 font-normal">Sin adjunto</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-slate-400 font-medium">
                                    <div class="max-w-xs mx-auto space-y-2">
                                        <div class="text-3xl">📭</div>
                                        <p class="text-base font-semibold text-slate-300">No tienes requerimientos registrados</p>
                                        <p class="text-xs text-slate-500">Haz clic en el botón superior para crear tu primera solicitud.</p>
                                    </div>
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