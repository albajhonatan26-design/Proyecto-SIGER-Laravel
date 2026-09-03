<x-app-layout>
    <div class="py-8 bg-slate-950 min-h-screen text-slate-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Encabezado de la Sección -->
            <div
                class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-slate-900 border border-slate-800 p-6 rounded-2xl shadow-xl">
                <div>
                    <h2 class="text-2xl font-black text-white tracking-wide flex items-center gap-2">
                        📋 Historial de Mis Requerimientos
                    </h2>
                    <p class="text-slate-400 text-sm mt-1">
                        Consulta el estado y avance de los requerimientos que has solicitado.
                    </p>
                </div>
                <div>
                    <a href="{{ route('requirements.create') }}"
                        class="inline-flex items-center gap-2 bg-gradient-to-r from-cyan-500 to-teal-500 hover:from-cyan-400 hover:to-teal-400 text-slate-950 font-bold px-4 py-2.5 rounded-xl shadow-lg shadow-cyan-500/20 transition duration-200 no-underline text-sm">
                        ➕ Crear Nuevo Requerimiento
                    </a>
                </div>
            </div>

            <!-- Tabla de Requerimientos -->
            <div class="bg-slate-900 border border-slate-800 rounded-2xl shadow-xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-300">
                        <thead
                            class="bg-slate-800/80 text-xs uppercase tracking-wider text-slate-400 border-b border-slate-800">
                            <tr>
                                <th scope="col" class="px-6 py-4 font-bold">Descripción</th>
                                <th scope="col" class="px-6 py-4 font-bold">Prioridad</th>
                                <th scope="col" class="px-6 py-4 font-bold">Medio de Recepción</th>
                                <th scope="col" class="px-6 py-4 font-bold">Fecha de Registro</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800">
                            @forelse ($requirements as $requirement)
                                <tr class="hover:bg-slate-800/50 transition duration-150 border-b border-slate-800/60">
                                    
                                    

                                    <!-- Archivo Adjunto -->
                                    {{-- <td class="px-6 py-4 text-slate-400 text-xs font-mono">
                                        @if ($requirement->ArchivoAdjunto)
                                            <span class="inline-flex items-center gap-1 text-teal-400">
                                                📎 {{ Str::limit($requirement->ArchivoAdjunto, 25) }}
                                            </span>
                                        @else
                                            <span class="text-slate-600">Sin archivo</span>
                                        @endif
                                    </td> --}}


                                    <!-- Descripción -->
                                    <td class="px-6 py-4 font-semibold text-white">
                                        {{ $requirement->Descripcion }}
                                    </td>

                                    <!-- Prioridad -->
                                    <td class="px-6 py-4">
                                        @php
                                            $prio = strtolower($requirement->Prioridad);
                                            $prioClass = match ($prio) {
                                                'alta' => 'bg-red-500/10 text-red-400 border-red-500/30',
                                                'media' => 'bg-amber-500/10 text-amber-400 border-amber-500/30',
                                                'baja' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/30',
                                                default => 'bg-slate-700/30 text-slate-300 border-slate-600',
                                            };
                                        @endphp
                                        <span
                                            class="px-3 py-1 text-xs font-semibold rounded-full border {{ $prioClass }}">
                                            {{ $requirement->Prioridad }}
                                        </span>
                                    </td>

                                    <!-- Medio Recepción -->
                                    <td class="px-6 py-4 text-slate-300 text-xs">
                                        <span
                                            class="px-2.5 py-1 rounded-lg bg-slate-800 border border-slate-700 text-slate-300">
                                            {{ $requirement->MedioRecepcion }}
                                        </span>
                                    </td>

                                    <!-- Fecha Creación -->
                                    <td class="px-6 py-4 text-slate-400 text-xs font-mono">
                                        {{ \Carbon\Carbon::parse($requirement->FechaCreacion)->format('d/m/Y') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                        <div class="flex flex-col items-center gap-2">
                                            <span class="text-3xl">📭</span>
                                            <p class="font-semibold text-slate-400">No has registrado ningún
                                                requerimiento aún.</p>
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
