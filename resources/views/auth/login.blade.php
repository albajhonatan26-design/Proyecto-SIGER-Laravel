<x-guest-layout>
    <div class="relative min-h-screen w-full flex flex-col justify-between bg-[#030712] text-gray-100 font-sans antialiased bg-[radial-gradient(at_0%_0%,rgba(14,165,233,0.12)_0px,transparent_50%),radial-gradient(at_100%_100%,rgba(16,185,129,0.08)_0px,transparent_50%),radial-gradient(at_50%_50%,rgba(30,41,59,0.5)_0px,transparent_100%)] before:content-[''] before:absolute before:inset-0 before:bg-[linear-gradient(rgba(255,255,255,0.03)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.03)_1px,transparent_1px)] before:bg-[size:40px_40px] before:pointer-events-none before:z-10 [&>*]:relative [&>*]:z-20">

        <!-- Header / Navbar -->
        <header class="relative z-10 flex items-center justify-between px-6 lg:px-20 py-5 bg-gray-950/80 backdrop-blur-md border-b border-gray-800/80">
            <a href="{{ url('/') }}" class="flex items-center gap-3 text-2xl font-extrabold tracking-wider text-white">
                <span class="w-8 h-8 rounded-lg bg-gradient-to-br from-emerald-500 to-cyan-500 text-gray-950 flex items-center justify-center font-black text-sm shadow-lg shadow-emerald-500/20">
                    S
                </span>
                SIGER
            </a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-4 py-2 rounded-lg text-sm font-semibold text-gray-300 bg-gray-900 border border-gray-700 hover:bg-gray-800 hover:border-gray-600 hover:text-white transition-all duration-200 shadow-sm">
                    REGISTRARSE
                </a>
            @endif
        </header>

        <!-- Formulario Login -->
        <main class="relative z-10 flex-grow flex items-center justify-center px-4 py-12">
            <div class="w-full max-w-md bg-gray-900/90 border border-gray-800 rounded-2xl p-8 shadow-2xl backdrop-blur-xl">
                
                <div class="text-center mb-8">
                    <h1 class="text-2xl font-extrabold text-white tracking-tight">Iniciar Sesión</h1>
                    <p class="text-sm text-gray-400 mt-1">Ingresa tus credenciales para acceder a SIGER</p>
                </div>

                <!-- Mensaje de Status / Éxito -->
                @if (session('status'))
                    <div class="mb-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-sm font-medium">
                        ✓ {{ session('status') }}
                    </div>
                @endif

                @if (session('success'))
                    <div class="mb-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-sm font-medium">
                        ✓ {{ session('success') }}
                    </div>
                @endif

                <!-- Mensaje de Errores -->
                @if ($errors->any())
                    <div class="mb-6 p-4 rounded-xl bg-red-500/10 border border-red-500/30 text-red-400 text-sm font-medium">
                        <ul class="space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>⚠ {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="sr-only">Correo electrónico</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-500">
                                ✉
                            </span>
                            <input type="email" 
                                   id="email"
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   placeholder="Correo electrónico" 
                                   required 
                                   autofocus 
                                   class="w-full pl-10 pr-4 py-3 bg-gray-950 border border-gray-800 rounded-xl text-gray-100 placeholder-gray-500 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 text-sm transition duration-200" />
                        </div>
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="sr-only">Contraseña</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-500">
                                🔒
                            </span>
                            <input type="password" 
                                   id="password"
                                   name="password" 
                                   placeholder="Contraseña" 
                                   required 
                                   class="w-full pl-10 pr-4 py-3 bg-gray-950 border border-gray-800 rounded-xl text-gray-100 placeholder-gray-500 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 text-sm transition duration-200" />
                        </div>
                    </div>

                    <!-- Botón Ingresar -->
                    <button type="submit" class="w-full py-3 px-4 bg-emerald-500 hover:bg-emerald-600 text-gray-950 font-bold text-sm rounded-xl transition duration-200 shadow-lg shadow-emerald-500/20 active:scale-[0.98]">
                        INGRESAR
                    </button>
                </form>

                <!-- Footer Links -->
                <div class="mt-6 text-center space-y-2 text-xs">
                    @if (Route::has('password.request'))
                        <div>
                            <a href="{{ route('password.request') }}" class="text-gray-400 hover:text-emerald-400 transition-colors">
                                ¿Olvidaste tu contraseña?
                            </a>
                        </div>
                    @endif

                    @if (Route::has('register'))
                        <div>
                            <a href="{{ route('register') }}" class="text-gray-400 hover:text-emerald-400 transition-colors">
                                ¿No tienes cuenta? <span class="font-semibold text-emerald-500">Regístrate aquí</span>
                            </a>
                        </div>
                    @endif
                </div>

            </div>
        </main>

        <!-- Footer -->
        <footer class="relative z-10 py-6 text-center text-xs text-gray-600 border-t border-gray-900 bg-gray-950">
            &copy; {{ date('Y') }} SIGER - Todos los derechos reservados.
        </footer>

    </div>
</x-guest-layout>