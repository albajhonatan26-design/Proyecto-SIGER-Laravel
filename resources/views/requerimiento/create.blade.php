<x-guest-layout>
    <div class="min-h-screen w-full flex flex-col justify-between bg-slate-950 text-slate-100 font-sans relative overflow-x-hidden">
        
        <!-- Efectos de Fondo Luminosos (Glows) -->
        <div class="absolute -top-40 -left-40 w-96 h-96 bg-cyan-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <!-- Navbar Superior -->
        <header class="relative z-10 flex flex-col md:flex-row justify-between items-center px-6 sm:px-12 py-4 bg-slate-900/60 backdrop-blur-xl border-b border-slate-800/80 gap-4 shadow-lg shadow-black/20">
            
            <!-- Logo / Identidad del Sistema -->
            <a class="group flex items-center gap-3 no-underline">
                <div class="w-9 h-9 bg-gradient-to-br from-cyan-400 via-teal-400 to-emerald-500 rounded-xl flex items-center justify-center text-slate-950 font-black text-sm shadow-md shadow-cyan-500/20 group-hover:scale-105 transition-transform duration-200">
                    S
                </div>
                <span class="text-xl font-black tracking-wider text-white">SIGER</span>
            </a>

            <!-- Menú de Navegación Central -->
            <nav class="flex items-center gap-1 sm:gap-2 text-xs sm:text-sm font-semibold">
                <a href="{{ Route::has('requirements.index') ? route('requirements.index') : url('/index.php/requirements') }}" 
                   class="px-4 py-2 rounded-lg text-slate-300 hover:text-white hover:bg-slate-800/70 border border-transparent hover:border-slate-700/50 transition duration-150 flex items-center gap-2 no-underline">
                    <span>📋</span>
                    <span>Requerimientos</span>
                </a>

                <a href="{{ Route::has('requirements.create') ? route('requirements.create') : url('/index.php/requirements/create') }}" 
                   class="px-4 py-2 rounded-lg text-white bg-slate-800/90 border border-slate-700/80 transition duration-150 flex items-center gap-2 no-underline">
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
                <div class="flex items-center gap-2 px-3 py-1.5 rounded-full bg-slate-800/40 border border-slate-700/50">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span class="text-xs font-semibold text-slate-200">
                        {{ Auth::user()->name }}
                    </span>
                </div>

                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="bg-red-500/10 text-red-400 hover:bg-red-500 hover:text-white border border-red-500/30 hover:border-red-500 px-4 py-1.5 rounded-lg font-semibold text-xs cursor-pointer transition-all duration-200">
                        CERRAR SESIÓN
                    </button>
                </form>
            </div>
        </header>

        <!-- Contenido Principal -->
        <main class="relative z-10 max-w-2xl mx-auto px-6 py-10 w-full flex-grow flex flex-col justify-center">

            <!-- Tarjeta del Formulario -->
            <div class="bg-slate-900/60 backdrop-blur-2xl border border-slate-800/80 rounded-2xl p-6 sm:p-10 shadow-2xl shadow-black/50 relative overflow-hidden">
                
                <!-- Linea Decorativa Superior -->
                <div class="absolute top-0 left-1/4 w-1/2 h-1 bg-gradient-to-r from-transparent via-cyan-500/50 to-transparent"></div>

                <div class="mb-8">
                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold text-cyan-300 bg-cyan-950/60 border border-cyan-800/60 mb-3">
                        <span class="w-2 h-2 rounded-full bg-cyan-400"></span> Formulario de Registro
                    </span>
                    <h2 class="text-2xl sm:text-3xl font-black text-white tracking-tight">
                        Crear Nuevo Requerimiento
                    </h2>
                </div>

                <form method="POST" action="{{ Route::has('requirements.store') ? route('requirements.store') : url('/index.php/requirements') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Descripción -->
                    <div>
                        <label class="block text-xs sm:text-sm font-semibold text-slate-300 mb-2">
                            Descripción del Requerimiento
                        </label>
                        <textarea name="Descripcion" 
                                  rows="4"
                                  class="w-full bg-slate-950/80 border border-slate-700/80 rounded-xl px-4 py-3 text-sm text-slate-100 placeholder-slate-500 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition resize-y" 
                                  placeholder="Ej. Sistema de facturación..." 
                                  required></textarea>
                    </div>

                    <!-- Prioridad -->
                    <div>
                        <label class="block text-xs sm:text-sm font-semibold text-slate-300 mb-2">
                            Prioridad
                        </label>
                        <select name="Prioridad" 
                                class="w-full bg-slate-950/80 border border-slate-700/80 rounded-xl px-4 py-3 text-sm text-slate-100 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition cursor-pointer" 
                                required>
                            <option value="Alta" class="bg-slate-900 text-slate-100">Alta</option>
                            <option value="Media" class="bg-slate-900 text-slate-100">Media</option>
                            <option value="Baja" class="bg-slate-900 text-slate-100">Baja</option>
                        </select>
                    </div>

                    <!-- Medio de Recepción -->
                    <div>
                        <label class="block text-xs sm:text-sm font-semibold text-slate-300 mb-2">
                            Medio de Recepción
                        </label>
                        <select name="MedioRecepcion" 
                                class="w-full bg-slate-950/80 border border-slate-700/80 rounded-xl px-4 py-3 text-sm text-slate-100 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition cursor-pointer" 
                                required>
                            <option value="Correo" class="bg-slate-900 text-slate-100">Correo</option>
                            <option value="Presencial" class="bg-slate-900 text-slate-100">Presencial</option>
                            <option value="Whatsap" class="bg-slate-900 text-slate-100">WhatsApp</option>
                            <option value="Telefono" class="bg-slate-900 text-slate-100">Teléfono</option>
                        </select>
                    </div>

                    <!-- Archivo Adjunto -->
                    <div>
                        <label class="block text-xs sm:text-sm font-semibold text-slate-300 mb-2">
                            Archivo Adjunto
                        </label>
                        <input type="file" 
                               name="ArchivoAdjunto" 
                               class="w-full bg-slate-950/80 border border-slate-700/80 rounded-xl px-4 py-2.5 text-xs sm:text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-slate-800 file:text-cyan-400 hover:file:bg-slate-700 transition cursor-pointer">
                    </div>

                    <!-- Acciones del Formulario -->
                    <div class="flex items-center justify-between pt-4 border-t border-slate-800/80">
                        <a href="{{ Route::has('dashboard') ? route('dashboard') : url('/index.php/dashboard') }}" 
                           class="bg-transparent hover:bg-slate-800/70 text-slate-400 hover:text-white border border-slate-700/80 px-6 py-3 rounded-xl font-bold text-xs uppercase tracking-wider transition duration-200 no-underline">
                            CANCELAR
                        </a>

                        <button type="submit" 
                                class="bg-gradient-to-r from-cyan-500 to-emerald-500 hover:from-cyan-400 hover:to-emerald-400 text-slate-950 font-extrabold text-xs uppercase tracking-wider px-8 py-3.5 rounded-xl shadow-lg shadow-cyan-500/20 hover:shadow-cyan-500/35 transition duration-200 cursor-pointer">
                            GUARDAR
                        </button>
                    </div>
                </form>
            </div>
        </main>

        <!-- Pie de página -->
        <footer class="relative z-10 text-center py-5 text-xs font-medium text-slate-500 border-t border-slate-800/80 bg-slate-950/80 backdrop-blur-md">
            &copy; {{ date('Y') }} SIGER - Todos los derechos reservados.
        </footer>

    </div>
</x-guest-layout>