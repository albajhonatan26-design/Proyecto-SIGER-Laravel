<!-- VISTA PARA EL LIDER -->
<x-guest-layout>
    <div class="min-h-screen w-full flex flex-col justify-between bg-slate-950 text-slate-100 font-sans relative overflow-x-hidden">

        <!-- Efectos de Fondo Luminosos -->
        <div class="absolute -top-40 -left-40 w-96 h-96 bg-cyan-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <!-- Navbar Superior -->
        <header class="relative z-10 flex flex-col md:flex-row justify-between items-center px-6 sm:px-12 py-4 bg-slate-900/60 backdrop-blur-xl border-b border-slate-800/80 gap-4 shadow-lg shadow-black/20">
            <a  class="group flex items-center gap-3 no-underline">
                <div class="w-9 h-9 bg-gradient-to-br from-cyan-400 via-teal-400 to-emerald-500 rounded-xl flex items-center justify-center text-slate-950 font-black text-sm shadow-md shadow-cyan-500/20 group-hover:scale-105 transition-transform duration-200">
                    S
                </div>
                <span class="text-xl font-black tracking-wider text-white">SIGER</span>
            </a>

            <!-- Navegación según Rol -->
            <nav class="flex items-center gap-1 sm:gap-2 text-xs sm:text-sm font-semibold">
                <a href="{{ route('requirements.manage') }}" class="px-4 py-2 rounded-lg text-white bg-slate-800/90 border border-slate-700/80 transition flex items-center gap-2 no-underline">
                    <span>🎯</span>
                    <span>Gestión y Asignación</span>
                </a>
                </a>
                <!-- Cambia 'requirements.history' por 'leader.requirements.history' -->
                <a href="{{ route('leader.requirements.history') }}"
                    class="px-4 py-2.5 rounded-xl text-slate-200 hover:text-white hover:bg-slate-800 border border-transparent hover:border-slate-700 transition duration-150 flex items-center gap-2 no-underline">
                    <span>📜</span>
                    <span>Historial</span>
                </a>
                <a href="{{ Route::has('profile.edit') ? route('profile.edit') : url('/index.php/profile') }}"
                    class="px-4 py-2.5 rounded-xl text-slate-200 hover:text-white hover:bg-slate-800 border border-transparent hover:border-slate-700 transition duration-150 flex items-center gap-2 no-underline">
                    <span>⚙️</span>
                    <span>Perfil</span>
                </a>
            </nav>

            <div class="flex items-center gap-4">
                <div class="flex items-center gap-2 px-3 py-1.5 rounded-full bg-slate-800/40 border border-slate-700/50">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span class="text-xs font-semibold text-slate-200">{{ Auth::user()->name }}</span>
                </div>

                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="bg-red-500/10 text-red-400 hover:bg-red-500 hover:text-white border border-red-500/30 hover:border-red-500 px-4 py-1.5 rounded-lg font-semibold text-xs cursor-pointer transition duration-200">
                        CERRAR SESIÓN
                    </button>
                </form>
            </div>
        </header>

        <!-- Contenido Principal -->
        <main class="relative z-10 max-w-7xl mx-auto px-6 py-10 w-full flex-grow flex flex-col">

            <!-- Encabezado de la Sección -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                <div>
                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold text-cyan-300 bg-cyan-950/60 border border-cyan-800/60 mb-2">
                        <span class="w-2 h-2 rounded-full bg-cyan-400"></span> Control de Proyectos
                    </span>
                    <h1 class="text-2xl sm:text-3xl font-black text-white tracking-tight">
                        Asignación de Requerimientos
                    </h1>
                </div>
            </div>

            <!-- Alerta de Notificación de Éxito -->
            @if (session('success'))
            <div class="flex items-center gap-3 bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 px-5 py-4 rounded-xl mb-6 font-semibold text-sm backdrop-blur-md shadow-lg shadow-emerald-500/5">
                <span>✓</span>
                <span>{{ session('success') }}</span>
            </div>
            @endif

            <!-- Tabla de Requerimientos -->
            <div class="bg-slate-900/60 backdrop-blur-2xl border border-slate-800/80 rounded-2xl shadow-2xl shadow-black/50 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-950/60 border-b border-slate-800/80 text-xs font-bold text-slate-400 uppercase tracking-wider">
                                <th class="px-6 py-4">Solicitante</th>
                                <th class="px-6 py-4">Descripción</th>
                                <th class="px-6 py-4">Prioridad</th>
                                <th class="px-6 py-4">Estado</th>
                                <th class="px-6 py-4">Desarrollador Asignado</th>
                                <th class="px-6 py-4 text-right">Acción</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800/60 text-xs sm:text-sm text-slate-300">
                            @forelse ($requirements as $req)
                            <tr class="hover:bg-slate-800/40 transition duration-150">

                                <td class="px-6 py-4 font-semibold text-white">
                                    {{ $req->client->name ?? 'Cliente Desconocido' }}
                                </td>

                                <td class="px-6 py-4 max-w-xs truncate" title="{{ $req->Descripcion ?? $req->description }}">
                                    {{ $req->Descripcion ?? $req->description }}
                                </td>

                                <td class="px-6 py-4">
                                    @php
                                    $priority = $req->Prioridad ?? $req->priority ?? 'Baja';
                                    $pColors = [
                                    'Alta' => 'bg-red-500/10 border-red-500/30 text-red-400',
                                    'Media' => 'bg-amber-500/10 border-amber-500/30 text-amber-400',
                                    'Baja' => 'bg-emerald-500/10 border-emerald-500/30 text-emerald-400',
                                    ];
                                    @endphp
                                    <span class="px-2.5 py-1 rounded-full text-xs font-bold border {{ $pColors[$priority] ?? $pColors['Baja'] }}">
                                        {{ $priority }}
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    @php
                                    $status = $req->status ?? $req->Estado ?? 'pending';
                                    $statusMap = [
                                    'pending' => ['label' => 'Sin Asignar', 'class' => 'bg-slate-800 text-slate-400 border-slate-700'],
                                    'in_progress' => ['label' => 'En Proceso', 'class' => 'bg-cyan-500/10 text-cyan-400 border-cyan-500/30'],
                                    'testing' => ['label' => 'En Pruebas', 'class' => 'bg-purple-500/10 text-purple-400 border-purple-500/30'],
                                    'completed' => ['label' => 'Resuelto', 'class' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/30'],
                                    ];
                                    @endphp
                                    <span class="px-2.5 py-1 rounded-full text-xs font-bold border {{ $statusMap[$status]['class'] ?? $statusMap['pending']['class'] }}">
                                        {{ $statusMap[$status]['label'] ?? $status }}
                                    </span>
                                </td>

                                <!-- Formulario Integrado por Fila -->
                                <td class="px-6 py-4" colspan="2">
                                    <form method="POST" action="{{ route('requirements.assign', $req->IdRequerimiento ?? $req->id) }}" class="flex items-center gap-3 m-0">
                                        @csrf

                                        <div class="flex-grow">
                                            <select name="Idusers" required class="w-full bg-slate-950 border border-slate-700 rounded-xl px-3 py-1.5 text-xs text-slate-200 focus:outline-none focus:border-cyan-500 cursor-pointer">
                                                <option value="" disabled {{ !optional($req->developer)->id ? 'selected' : '' }}>-- Seleccionar Desarrollador --</option>
                                                @foreach ($developers as $dev)
                                                <option value="{{ $dev->id }}" {{ optional($req->developer)->id == $dev->id ? 'selected' : '' }} class="bg-slate-900 text-slate-100">
                                                    {{ $dev->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <button type="submit" class="bg-gradient-to-r from-cyan-500 to-emerald-500 hover:from-cyan-400 hover:to-emerald-400 text-slate-950 font-extrabold text-xs tracking-wider uppercase px-4 py-2 rounded-xl shadow-md shadow-cyan-500/15 transition duration-200 cursor-pointer whitespace-nowrap">
                                            ASIGNAR
                                        </button>
                                    </form>
                                </td>

                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-slate-500 font-medium">
                                    No hay requerimientos registrados en la plataforma.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>

        <!-- Pie de página -->
        <footer class="relative z-10 text-center py-5 text-xs font-medium text-slate-500 border-t border-slate-800/80 bg-slate-950/80 backdrop-blur-md">
            &copy; {{ date('Y') }} SIGER - Todos los derechos reservados.
        </footer>

    </div>
</x-guest-layout>