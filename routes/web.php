<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequirementController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DesarrolloController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Response;

/*
|--------------------------------------------------------------------------
| Rutas Públicas (Acceso para cualquier usuario)
|--------------------------------------------------------------------------
*/

// Página principal de bienvenida
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Vista de inicio de sesión (Login)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Vista de registro de usuario
Route::get('/register', function () {
    return view('auth.register');
})->name('register');


/*
|--------------------------------------------------------------------------
| Rutas Autenticadas (Requieren inicio de sesión)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Panel principal de control (Dashboard para el cliente/usuario general)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Alias para redirigir la URL vieja /requirements/list al historial sin errores
    Route::get('/requirements/list', [RequirementController::class, 'history'])->name('requirements.index');

    // Gestión del perfil del usuario autenticado
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Ruta para la visualización y descarga de archivos adjuntos

Route::middleware(['auth'])->group(function () {

    // Ruta para procesar la descarga del archivo adjunto
    Route::get('/adjuntos/download/{filename}', function ($filename) {
        // Rutas posibles donde Laravel almacena los archivos subidos
        $pathPublicStorage = public_path('storage/' . $filename);
        $pathStorageApp = storage_path('app/public/' . $filename);
        $pathStorageRoot = storage_path('app/' . $filename);

        if (file_exists($pathPublicStorage)) {
            return response()->download($pathPublicStorage);
        }

        if (file_exists($pathStorageApp)) {
            return response()->download($pathStorageApp);
        }

        if (file_exists($pathStorageRoot)) {
            return response()->download($pathStorageRoot);
        }

        abort(404, 'El archivo adjunto no existe en la carpeta del servidor.');
    })->name('adjuntos.download');


});

    /*
    |--------------------------------------------------------------------------
    | 1. Rutas para Clientes
    |--------------------------------------------------------------------------
    */
    Route::middleware(['can:is-client'])->group(function () {
        Route::get('/client/history', [RequirementController::class, 'history'])->name('client.requirements.history');
        Route::get('/requirements/create', [RequirementController::class, 'create'])->name('requirements.create');
        Route::post('/requirements', [RequirementController::class, 'store'])->name('requirements.store');
    });

    /*
    |--------------------------------------------------------------------------
    | 2. Rutas para Desarrolladores
    |--------------------------------------------------------------------------
    */
    Route::middleware(['can:is-developer'])->group(function () {
        Route::get('/developer/assigned', [RequirementController::class, 'assignedIndex'])->name('requirements.assigned');
        Route::get('/developer/history', [RequirementController::class, 'historyIndex'])->name('developer.requirements.history');
        Route::put('/desarrollorequerimiento/{id}', [RequirementController::class, 'updateStatus'])->name('desarrollorequerimiento.update');

        Route::get('/desarrollorequerimiento/{id}', function () {
            return redirect()->route('requirements.assigned');
        });
    });

    /*
    |--------------------------------------------------------------------------
    | 3. Rutas para Líderes de Proyecto / Gestionadores
    |--------------------------------------------------------------------------
    */
    Route::middleware(['can:is-leader'])->group(function () {
        Route::get('/manage/requirements', [RequirementController::class, 'manageIndex'])->name('requirements.manage');
        Route::post('/requirements/{id}/assign', [RequirementController::class, 'assignDeveloper'])->name('requirements.assign');
        Route::get('/requirements-history', [RequirementController::class, 'leaderHistoryIndex'])->name('leader.requirements.history');
    });

    /*
    |--------------------------------------------------------------------------
    | 4. Rutas para Administradores
    |--------------------------------------------------------------------------
    */
    Route::middleware(['can:is-admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/admin/requirements', [AdminController::class, 'allRequirements'])->name('admin.requirements.index');
        Route::resource('users', UserController::class);
    });

});

// Autenticación de Laravel Breeze / Fortify
require __DIR__ . '/auth.php';