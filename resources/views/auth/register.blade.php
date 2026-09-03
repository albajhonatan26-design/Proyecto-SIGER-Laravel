<x-guest-layout>
    <!-- Hero / Layout Principal con Malla de Fondo -->
    <div class="relative min-h-screen w-full flex flex-col justify-between bg-[#030712] text-[#f9fafb] font-sans antialiased bg-[radial-gradient(at_0%_0%,rgba(14,165,233,0.12)_0px,transparent_50%),radial-gradient(at_100%_100%,rgba(16,185,129,0.08)_0px,transparent_50%),radial-gradient(at_50%_50%,rgba(30,41,59,0.5)_0px,transparent_100%)] before:content-[''] before:absolute before:inset-0 before:bg-[linear-gradient(rgba(255,255,255,0.03)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.03)_1px,transparent_1px)] before:bg-[size:40px_40px] before:pointer-events-none before:z-10 [&>*]:relative [&>*]:z-20">

        <!-- Navbar Superior -->
        <nav class="flex justify-between items-center px-6 sm:px-20 py-5 bg-[#030712]/80 backdrop-blur-md border-b border-gray-800/80">
            <a href="{{ url('/') }}" class="text-2xl font-extrabold tracking-widest text-white no-underline flex items-center gap-2.5">
                <div class="w-7 h-7 bg-gradient-to-br from-[#10b981] to-[#06b6d4] rounded-md flex items-center justify-center text-xs font-black text-[#030712] shadow-[0_0_12px_rgba(16,185,129,0.3)]">
                    S
                </div>
                SIGER
            </a>

            <div class="flex items-center gap-4">
                @if (Route::has('login'))
                    <a href="{{ route('login') }}" class="text-gray-300 border border-gray-700 bg-gray-900 px-5 py-2.5 rounded-md font-semibold text-sm transition-all hover:bg-gray-800 hover:border-gray-600 hover:text-white inline-flex items-center justify-center no-underline">
                        INICIAR SESIÓN
                    </a>
                @endif
            </div>
        </nav>

        <!-- Sección del Formulario Registro -->
        <main class="flex items-center justify-center px-6 py-12 flex-grow">
            <div class="bg-[#0b1120] border border-[#1e293b] rounded-xl p-7 sm:p-10 w-full max-w-[440px] shadow-[0_20px_25px_-5px_rgba(0,0,0,0.5),0_8px_10px_-6px_rgba(0,0,0,0.5)]">

                <div class="text-center mb-8">
                    <h1 class="text-3xl font-extrabold text-white mb-2 tracking-tight">Crear Cuenta</h1>
                    <p class="text-sm text-gray-400">Ingresa tus datos para registrarte en SIGER</p>
                </div>

                <!-- Mensaje de Éxito -->
                @if (session('success'))
                    <div class="p-3 px-4 rounded-md text-xs font-medium mb-6 leading-relaxed bg-emerald-500/10 border border-emerald-500/30 text-emerald-400">
                        ✓ {{ session('success') }}
                    </div>
                @endif

                <!-- Resumen General de Errores -->
                @if ($errors->any())
                    <div class="p-3 px-4 rounded-md text-xs font-medium mb-6 leading-relaxed bg-red-500/10 border border-red-500/30 text-red-400">
                        <ul class="m-0 p-0 list-none space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>⚠ {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Campo Nombre -->
                    <div class="relative mb-5">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-lg pointer-events-none flex items-center">👤</span>
                        <input type="text" 
                               name="name" 
                               value="{{ old('name') }}" 
                               placeholder="Nombre completo" 
                               required 
                               autofocus 
                               class="w-full py-3 pr-4 pl-11 rounded-md border border-gray-800 bg-gray-900 text-sm text-[#f9fafb] outline-none transition-all placeholder:text-gray-600 focus:border-[#10b981] focus:ring-2 focus:ring-[#10b981]/15 focus:bg-[#0b1120]" />
                        @error('name')
                            <p class="text-red-400 text-xs mt-1.5 ml-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Campo Correo -->
                    <div class="relative mb-5">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-lg pointer-events-none flex items-center">✉</span>
                        <input type="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               placeholder="Correo electrónico" 
                               required 
                               class="w-full py-3 pr-4 pl-11 rounded-md border border-gray-800 bg-gray-900 text-sm text-[#f9fafb] outline-none transition-all placeholder:text-gray-600 focus:border-[#10b981] focus:ring-2 focus:ring-[#10b981]/15 focus:bg-[#0b1120]" />
                        @error('email')
                            <p class="text-red-400 text-xs mt-1.5 ml-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Campo Contraseña -->
                    <div class="relative mb-5">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-lg pointer-events-none flex items-center">🔒</span>
                        <input type="password" 
                               name="password" 
                               placeholder="Contraseña" 
                               required 
                               class="w-full py-3 pr-4 pl-11 rounded-md border border-gray-800 bg-gray-900 text-sm text-[#f9fafb] outline-none transition-all placeholder:text-gray-600 focus:border-[#10b981] focus:ring-2 focus:ring-[#10b981]/15 focus:bg-[#0b1120]" />
                        @error('password')
                            <p class="text-red-400 text-xs mt-1.5 ml-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Campo Confirmar Contraseña -->
                    <div class="relative mb-5">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-lg pointer-events-none flex items-center">🔑</span>
                        <input type="password" 
                               name="password_confirmation" 
                               placeholder="Confirmar contraseña" 
                               required 
                               class="w-full py-3 pr-4 pl-11 rounded-md border border-gray-800 bg-gray-900 text-sm text-[#f9fafb] outline-none transition-all placeholder:text-gray-600 focus:border-[#10b981] focus:ring-2 focus:ring-[#10b981]/15 focus:bg-[#0b1120]" />
                        @error('password_confirmation')
                            <p class="text-red-400 text-xs mt-1.5 ml-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Botón Enviar -->
                    <button type="submit" class="w-full bg-[#10b981] text-[#030712] border border-[#10b981] py-3 px-5 rounded-md font-bold text-sm cursor-pointer transition-all hover:bg-[#059669] hover:border-[#059669] hover:text-white inline-flex items-center justify-center mt-2 font-sans">
                        REGISTRARSE
                    </button>
                </form>

                <!-- Enlace a Login -->
                <div class="mt-6 text-center flex flex-col gap-3 text-xs">
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="text-gray-400 transition-colors hover:text-emerald-400 hover:underline">
                            ¿Ya tienes cuenta? Inicia sesión aquí
                        </a>
                    @endif
                </div>

            </div>
        </main>

        <!-- Pie de página -->
        <footer class="text-center p-6 text-xs text-gray-600 border-t border-gray-950 bg-[#030712]">
            &copy; {{ date('Y') }} SIGER - Todos los derechos reservados.
        </footer>

    </div>
</x-guest-layout>