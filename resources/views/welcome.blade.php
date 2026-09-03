<x-guest-layout>
    <!-- Contenedor Principal con Malla de Fondo -->
    <div class="relative min-h-screen w-full flex flex-col justify-between bg-[#030712] text-slate-100 font-sans antialiased bg-[radial-gradient(at_0%_0%,rgba(14,165,233,0.12)_0px,transparent_50%),radial-gradient(at_100%_100%,rgba(16,185,129,0.08)_0px,transparent_50%),radial-gradient(at_50%_50%,rgba(30,41,59,0.5)_0px,transparent_100%)] before:content-[''] before:absolute before:inset-0 before:bg-[linear-gradient(rgba(255,255,255,0.03)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.03)_1px,transparent_1px)] before:bg-[size:40px_40px] before:pointer-events-none before:z-10 [&>*]:relative [&>*]:z-20">

        <!-- Navbar Superior -->
        <nav class="sticky top-0 z-50 flex items-center justify-between border-b border-slate-800/80 bg-slate-950/70 px-6 py-4 backdrop-blur-xl md:px-16">
            <a href="{{ url('/') }}" class="flex items-center gap-3 text-xl font-extrabold tracking-widest text-white transition hover:opacity-90 no-underline">
                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-gradient-to-br from-emerald-500 to-cyan-500 text-sm font-black text-slate-950 shadow-lg shadow-emerald-500/20">
                    S
                </div>
                SIGER
            </a>
            <div class="flex items-center gap-3">
                @auth
               
                
                @else
                <a href="{{ url('/index.php/login') }}" class="inline-flex items-center justify-center rounded-lg border border-slate-700/80 bg-slate-900/60 px-5 py-2.5 text-xs font-semibold tracking-wider text-slate-200 backdrop-blur-md transition hover:border-slate-500 hover:bg-slate-800 hover:text-white no-underline">
                    INICIAR SESIÓN
                </a>

                <a href="{{ url('/index.php/register') }}" class="inline-flex items-center justify-center rounded-lg bg-gradient-to-r from-emerald-500 to-emerald-600 px-5 py-2.5 text-xs font-bold tracking-wider text-slate-950 shadow-md shadow-emerald-500/20 transition hover:from-emerald-400 hover:to-emerald-500 no-underline">
                    REGISTRARSE
                </a>
                @endauth
            </div>
        </nav>

        <!-- Sección Principal -->
        <main class="relative z-10 mx-auto grid max-w-7xl flex-1 items-center gap-12 px-6 py-12 md:px-12 lg:grid-cols-12 lg:gap-8 lg:py-20">

            <!-- Columna Texto -->
            <div class="lg:col-span-7">
                <div class="mb-6 inline-flex items-center gap-2 rounded-full border border-emerald-500/30 bg-emerald-500/10 px-3.5 py-1.5 text-xs font-bold uppercase tracking-wider text-emerald-400 shadow-sm shadow-emerald-500/10">
                    <span class="h-2 w-2 rounded-full bg-emerald-400 shadow-[0_0_8px_rgba(52,211,153,0.8)]"></span>
                    Plataforma Empresarial
                </div>

                <h1 class="mb-6 text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">
                    Sistema de Gestión de <span class="bg-gradient-to-r from-emerald-400 to-sky-400 bg-clip-text text-transparent">Requerimientos</span>
                </h1>

                <p class="mb-8 max-w-2xl text-base text-slate-400 sm:text-lg">
                    Optimiza el registro, seguimiento y control de requerimientos de tu empresa.
                    Una plataforma integral centralizada para gestionar solicitudes de manera eficiente.
                </p>

                <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
                    {{-- CORRECTO --}}
                    <a href="{{ url('/index.php/login') }}" class="inline-flex items-center justify-center rounded-lg bg-gradient-to-r from-emerald-500 to-emerald-600 px-8 py-3.5 text-sm font-bold tracking-wider text-slate-950 shadow-lg shadow-emerald-500/25 transition hover:from-emerald-400 hover:to-emerald-500 hover:shadow-emerald-500/40 no-underline">
                        INICIAR SESIÓN
                    </a>

                    <a href="{{ url('/index.php/register') }}" class="inline-flex items-center justify-center rounded-lg border border-slate-700 bg-slate-900/60 px-8 py-3.5 text-sm font-semibold tracking-wider text-slate-200 backdrop-blur-md transition hover:border-slate-500 hover:bg-slate-800 hover:text-white no-underline">
                        CREAR CUENTA
                    </a>
                    
                </div>
            </div>

            <!-- Columna Tarjeta Visual -->
            <div class="flex justify-center lg:col-span-5">
                <div class="w-full max-w-md rounded-2xl border border-slate-800/80 bg-slate-900/50 p-8 shadow-2xl backdrop-blur-xl">

                    <div class="mb-6 border-b border-slate-800/80 pb-4">
                        <h2 class="text-xs font-bold uppercase tracking-widest text-sky-400">
                            Módulos del Sistema
                        </h2>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-start gap-4 rounded-xl border border-slate-800/60 bg-slate-950/40 p-4 transition hover:border-sky-500/30 hover:bg-slate-900/80">
                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-lg border border-sky-500/30 bg-sky-500/10 text-xl text-sky-400 shadow-sm shadow-sky-500/10">
                                📋
                            </div>
                            <div>
                                <h3 class="text-sm font-bold text-slate-100">Gestión de Solicitudes</h3>
                                <p class="mt-0.5 text-xs text-slate-400">Crea y clasifica tus requerimientos en tiempo real.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 rounded-xl border border-slate-800/60 bg-slate-950/40 p-4 transition hover:border-sky-500/30 hover:bg-slate-900/80">
                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-lg border border-sky-500/30 bg-sky-500/10 text-xl text-sky-400 shadow-sm shadow-sky-500/10">
                                ⚡
                            </div>
                            <div>
                                <h3 class="text-sm font-bold text-slate-100">Seguimiento Ágil</h3>
                                <p class="mt-0.5 text-xs text-slate-400">Monitorea el estado y asignaciones al instante.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 rounded-xl border border-slate-800/60 bg-slate-950/40 p-4 transition hover:border-sky-500/30 hover:bg-slate-900/80">
                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-lg border border-sky-500/30 bg-sky-500/10 text-xl text-sky-400 shadow-sm shadow-sky-500/10">
                                🔒
                            </div>
                            <div>
                                <h3 class="text-sm font-bold text-slate-100">Acceso Seguro</h3>
                                <p class="mt-0.5 text-xs text-slate-400">Autenticación robusta y control de permisos.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </main>

        <!-- Pie de página -->
        <footer class="relative z-10 border-t border-slate-800/60 bg-slate-950/90 py-6 text-center text-xs text-slate-500">
            &copy; {{ date('Y') }} SIGER - Todos los derechos reservados.
        </footer>

    </div>
</x-guest-layout>