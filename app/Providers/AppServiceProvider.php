<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate; // 
use App\Models\User;                  

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Gates para cada rol
        
    
        // Administrador: SOLO gestiona usuarios y sistema general
        Gate::define('is-admin', fn(User $user) => $user->role === 'admin');
        
        // Líder: SOLO asigna requerimientos y notifica
        Gate::define('is-leader', fn(User $user) => $user->role === 'leader');
        
        // Desarrollador: Trabaja en requerimientos asignados
        Gate::define('is-developer', fn(User $user) => $user->role === 'developer');
        
        // Cliente: Crea requerimientos
        Gate::define('is-client', fn(User $user) => $user->role === 'client');
    }
}