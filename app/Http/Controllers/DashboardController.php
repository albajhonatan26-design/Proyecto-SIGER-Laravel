<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 1. Redirecciones para roles con dashboards o vistas dedicadas
        if ($user->can('is-admin')) {
            return redirect()->route('admin.dashboard');
        }

        if ($user->can('is-developer')) {
            return redirect()->route('requirements.assigned');
        }

        if ($user->can('is-leader')) {
            return redirect()->route('requirements.manage');
        }else {

        // 2. Para clientes u otros roles, se muestra directamente la vista Blade sin redirigir
        return view('dashboard');
    }
}
}