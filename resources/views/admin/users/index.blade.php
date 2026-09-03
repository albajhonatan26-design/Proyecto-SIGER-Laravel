<x-guest-layout>
    <div class="min-h-screen w-full flex flex-col justify-between bg-slate-950 text-slate-100 font-sans relative overflow-x-hidden">

        <!-- Efectos de Fondo -->
        <div class="absolute -top-40 -left-40 w-96 h-96 bg-cyan-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-purple-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <!-- Navbar Header -->
        <header class="relative z-10 flex flex-col md:flex-row justify-between items-center px-6 sm:px-12 py-4 bg-slate-900/60 backdrop-blur-xl border-b border-slate-800/80 gap-4 shadow-lg shadow-black/20">
            <a class="group flex items-center gap-3 no-underline">
                <div class="w-9 h-9 bg-gradient-to-br from-cyan-400 via-teal-400 to-emerald-500 rounded-xl flex items-center justify-center text-slate-950 font-black text-sm shadow-md shadow-cyan-500/20 group-hover:scale-105 transition-transform duration-200">
                    S
                </div>
                <span class="text-xl font-black tracking-wider text-white">SIGER <span class="text-xs text-cyan-400 font-normal">| Admin</span></span>
            </a>

            <nav class="flex items-center gap-3 text-xs sm:text-sm font-semibold">
                <a href="{{ route('admin.dashboard') }}" class="px-3 py-1.5 rounded-lg text-slate-300 hover:text-white transition">Panel General</a>
                <a href="{{ route('users.index') }}" class="px-3 py-1.5 rounded-lg text-white bg-slate-800 border border-slate-700 transition">Gestión Usuarios</a>
            </nav>

            <div class="flex items-center gap-4">
                <span class="text-xs font-semibold text-slate-200">{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="bg-red-500/10 text-red-400 hover:bg-red-500 hover:text-white border border-red-500/30 px-3 py-1 rounded-lg text-xs font-semibold transition">
                        CERRAR SESIÓN
                    </button>
                </form>
            </div>
        </header>

        <!-- Contenido Principal -->
        <main class="relative z-10 max-w-7xl mx-auto px-6 py-10 w-full flex-grow flex flex-col">

            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-black text-white tracking-tight">Gestión Única de Usuarios</h1>
                    <p class="text-slate-400 text-sm">Administra los roles y accesos desde un solo panel dinámico.</p>
                </div>

                <button onclick="openCreateModal()" class="px-4 py-2 bg-gradient-to-r from-cyan-500 to-teal-500 hover:from-cyan-400 hover:to-teal-400 text-slate-950 font-black text-xs uppercase tracking-wider rounded-xl shadow-lg shadow-cyan-500/20 transition-all transform hover:scale-105">
                    + Nuevo Usuario
                </button>
            </div>

            <!-- Notificaciones -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 rounded-xl text-sm font-semibold">
                    ✓ {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 bg-red-500/10 border border-red-500/30 text-red-400 rounded-xl text-sm font-semibold">
                    ✕ {{ session('error') }}
                </div>
            @endif

            <!-- Buscador -->
            <div class="mb-6">
                <form method="GET" action="{{ route('users.index') }}" class="flex gap-2">
                    <input type="text" name="search" value="{{ $search }}" placeholder="Buscar por nombre, correo o rol..." 
                           class="w-full sm:w-80 px-4 py-2 bg-slate-900 border border-slate-800 rounded-xl text-sm text-slate-200 focus:outline-none focus:border-cyan-500">
                    <button type="submit" class="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-bold rounded-xl border border-slate-700">
                        BUSCAR
                    </button>
                </form>
            </div>

            <!-- Tabla de Usuarios -->
            <div class="bg-slate-900/60 border border-slate-800/80 rounded-xl overflow-hidden shadow-xl backdrop-blur-xl">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-300">
                        <thead class="bg-slate-950/80 text-slate-400 uppercase text-xs border-b border-slate-800">
                            <tr>
                                <th class="px-6 py-4">ID</th>
                                <th class="px-6 py-4">Usuario</th>
                                <th class="px-6 py-4">Correo</th>
                                <th class="px-6 py-4">Rol</th>
                                <th class="px-6 py-4 text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800/60">
                            @forelse($users as $user)
                                <tr class="hover:bg-slate-800/40 transition">
                                    <td class="px-6 py-4 font-mono text-xs text-slate-500">#{{ $user->id }}</td>
                                    <td class="px-6 py-4 font-bold text-white">{{ $user->name }}</td>
                                    <td class="px-6 py-4 text-slate-400">{{ $user->email }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2.5 py-1 text-xs font-bold uppercase rounded-lg border 
                                            @if($user->role === 'admin') bg-purple-500/10 text-purple-400 border-purple-500/30
                                            @elseif($user->role === 'leader') bg-blue-500/10 text-blue-400 border-blue-500/30
                                            @elseif($user->role === 'developer') bg-emerald-500/10 text-emerald-400 border-emerald-500/30
                                            @else bg-slate-800 text-slate-400 border-slate-700 @endif">
                                            {{ $user->role ?? 'client' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right space-x-2">
                                        <button onclick='openEditModal(@json($user))' class="text-cyan-400 hover:text-cyan-300 font-bold text-xs uppercase">
                                            Editar
                                        </button>
                                        
                                        @if(auth()->id() !== $user->id)
                                            <button onclick='openDeleteModal(@json($user))' class="text-red-400 hover:text-red-300 font-bold text-xs uppercase">
                                                Eliminar
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-slate-500">No se encontraron usuarios.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="p-4 border-t border-slate-800">
                    {{ $users->links() }}
                </div>
            </div>

        </main>

        <!-- Modal CREAR USUARIO -->
        <div id="createModal" class="fixed inset-0 bg-slate-950/80 backdrop-blur-sm hidden z-50 flex items-center justify-center p-4">
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 w-full max-w-md shadow-2xl relative">
                <h3 class="text-lg font-bold text-white mb-4">Crear Nuevo Usuario</h3>
                <form method="POST" action="{{ route('users.store') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 mb-1">Nombre Completo</label>
                        <input type="text" name="name" required class="w-full px-3 py-2 bg-slate-950 border border-slate-800 rounded-xl text-white text-sm focus:outline-none focus:border-cyan-500">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 mb-1">Correo Electrónico</label>
                        <input type="email" name="email" required class="w-full px-3 py-2 bg-slate-950 border border-slate-800 rounded-xl text-white text-sm focus:outline-none focus:border-cyan-500">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 mb-1">Rol</label>
                        <select name="role" class="w-full px-3 py-2 bg-slate-950 border border-slate-800 rounded-xl text-white text-sm focus:outline-none focus:border-cyan-500">
                            <option value="client">Cliente</option>
                            <option value="developer">Desarrollador</option>
                            <option value="leader">Líder de Proyecto</option>
                            <option value="admin">Administrador</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 mb-1">Contraseña</label>
                        <input type="password" name="password" required class="w-full px-3 py-2 bg-slate-950 border border-slate-800 rounded-xl text-white text-sm focus:outline-none focus:border-cyan-500">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 mb-1">Confirmar Contraseña</label>
                        <input type="password" name="password_confirmation" required class="w-full px-3 py-2 bg-slate-950 border border-slate-800 rounded-xl text-white text-sm focus:outline-none focus:border-cyan-500">
                    </div>
                    <div class="flex justify-end gap-2 pt-4">
                        <button type="button" onclick="closeModal('createModal')" class="px-4 py-2 bg-slate-800 text-slate-300 rounded-xl text-xs font-bold">Cancelar</button>
                        <button type="submit" class="px-4 py-2 bg-cyan-500 text-slate-950 rounded-xl text-xs font-black uppercase">Guardar</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal EDITAR USUARIO -->
        <div id="editModal" class="fixed inset-0 bg-slate-950/80 backdrop-blur-sm hidden z-50 flex items-center justify-center p-4">
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 w-full max-w-md shadow-2xl relative">
                <h3 class="text-lg font-bold text-white mb-4">Editar Usuario</h3>
                <form id="editForm" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 mb-1">Nombre Completo</label>
                        <input type="text" id="edit_name" name="name" required class="w-full px-3 py-2 bg-slate-950 border border-slate-800 rounded-xl text-white text-sm focus:outline-none focus:border-cyan-500">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 mb-1">Correo Electrónico</label>
                        <input type="email" id="edit_email" name="email" required class="w-full px-3 py-2 bg-slate-950 border border-slate-800 rounded-xl text-white text-sm focus:outline-none focus:border-cyan-500">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 mb-1">Rol</label>
                        <select id="edit_role" name="role" class="w-full px-3 py-2 bg-slate-950 border border-slate-800 rounded-xl text-white text-sm focus:outline-none focus:border-cyan-500">
                            <option value="client">Cliente</option>
                            <option value="developer">Desarrollador</option>
                            <option value="leader">Líder de Proyecto</option>
                            <option value="admin">Administrador</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 mb-1">Nueva Contraseña (Opcional)</label>
                        <input type="password" name="password" class="w-full px-3 py-2 bg-slate-950 border border-slate-800 rounded-xl text-white text-sm focus:outline-none focus:border-cyan-500">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 mb-1">Confirmar Nueva Contraseña</label>
                        <input type="password" name="password_confirmation" class="w-full px-3 py-2 bg-slate-950 border border-slate-800 rounded-xl text-white text-sm focus:outline-none focus:border-cyan-500">
                    </div>
                    <div class="flex justify-end gap-2 pt-4">
                        <button type="button" onclick="closeModal('editModal')" class="px-4 py-2 bg-slate-800 text-slate-300 rounded-xl text-xs font-bold">Cancelar</button>
                        <button type="submit" class="px-4 py-2 bg-cyan-500 text-slate-950 rounded-xl text-xs font-black uppercase">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal ELIMINAR USUARIO -->
        <div id="deleteModal" class="fixed inset-0 bg-slate-950/80 backdrop-blur-sm hidden z-50 flex items-center justify-center p-4">
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 w-full max-w-sm shadow-2xl relative">
                <h3 class="text-lg font-bold text-white mb-2">¿Eliminar Usuario?</h3>
                <p class="text-xs text-slate-400 mb-6">Esta acción no se puede deshacer. Se eliminará a <span id="delete_name" class="font-bold text-white"></span>.</p>
                
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="flex justify-end gap-2">
                        <button type="button" onclick="closeModal('deleteModal')" class="px-4 py-2 bg-slate-800 text-slate-300 rounded-xl text-xs font-bold">Cancelar</button>
                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-xl text-xs font-black uppercase">Eliminar</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <!-- Scripts para Modales -->
   <script>
    function openCreateModal() {
        document.getElementById('createModal').classList.remove('hidden');
    }

    function openEditModal(user) {
        document.getElementById('edit_name').value = user.name;
        document.getElementById('edit_email').value = user.email;
        document.getElementById('edit_role').value = user.role || 'client';
        
        // Usamos la ruta base actual para evitar romper la URL de subcarpeta de Apache
        document.getElementById('editForm').action = `users/${user.id}`;
        document.getElementById('editModal').classList.remove('hidden');
    }

    function openDeleteModal(user) {
        document.getElementById('delete_name').innerText = user.name;
        
        // Usamos la ruta base actual
        document.getElementById('deleteForm').action = `users/${user.id}`;
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }
</script>
</x-guest-layout>