<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Requirement;
use App\Models\DesarrolloRequerimiento;

class AdminController extends Controller
{
    public function index()
    {
        // Estadísticas generales para el panel
        $totalUsers = User::count();
        $totalClients = User::where('role', 'client')->count();
        $totalDevelopers = User::where('role', 'developer')->count();
        $totalRequirements = Requirement::count();
        
        $pendingRequirements = Requirement::doesntHave('desarrollo')->count();
        $completedRequirements = DesarrolloRequerimiento::where('Estado', 'Finalizado')->count();

        // Últimos usuarios e historial reciente
        $recentUsers = User::latest()->take(5)->get();
        $recentRequirements = Requirement::with(['client', 'desarrollo'])->latest('FechaCreacion')->take(5)->get();

        return view('admin.dashboard', compact(
            'totalUsers', 
            'totalClients', 
            'totalDevelopers', 
            'totalRequirements', 
            'pendingRequirements', 
            'completedRequirements',
            'recentUsers',
            'recentRequirements'
        ));
    }

    public function allRequirements()
    {
        $requirements = Requirement::with(['client', 'desarrollo.user'])->latest('FechaCreacion')->paginate(15);
        return view('admin.users.index', compact('requirements'));
    }
}
