<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\Requirement;
use App\Models\User;
use App\Models\DesarrolloRequerimiento;
use App\Models\EntregaRequerimiento;
use App\Mail\RequerimientoFinalizadoMail;
use Illuminate\Support\Facades\Gate;


class RequirementController extends Controller
{

public function history()
{
    if (!Gate::allows('is-client')) {
        abort(403);
    }

    // Filtra los requerimientos por la clave foránea del cliente (ej. IdUsuario o cliente_id)
    $requirements = Requirement::where('Idusers', Auth::id())->get();

    return view('client.history', compact('requirements'));
}

    public function create()
    {
        return view('requerimiento.create');
    }

    /**
     * Almacena un nuevo requerimiento en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Descripcion'    => 'required|string',
            'Prioridad'      => 'required|string',
            'MedioRecepcion' => 'required|string',
            'ArchivoAdjunto' => 'nullable|file|mimes:pdf,doc,docx,xlsx,png,jpg|max:2048',
        ]);

        $nombreArchivo = null;

        if ($request->hasFile('ArchivoAdjunto')) {
            $file = $request->file('ArchivoAdjunto');
            $nombreArchivo = time() . '_' . $file->getClientOriginalName();
            // Guarda explícitamente en el disco público dentro de 'adjuntos'
            $file->storeAs('adjuntos', $nombreArchivo, 'public');
        }

        DB::table('Requerimiento')->insert([
            'Idusers'        => Auth::id(),
            'Descripcion'    => $request->Descripcion,
            'ArchivoAdjunto' => $nombreArchivo,
            'Prioridad'      => $request->Prioridad,
            'FechaCreacion'  => now()->toDateString(),
            'MedioRecepcion' => $request->MedioRecepcion,
        ]);

        session()->flash('success', '¡El requerimiento ha sido registrado exitosamente!');
        session()->save();

        return redirect()->to(url('/dashboard'));
    }

    /**
     * Muestra el panel de gestión para líderes/administradores (Requerimientos Sin Asignar).
     */
    public function manageIndex()
    {
        $requirements = Requirement::with(['client', 'developer'])
            ->whereDoesntHave('desarrollo')
            ->latest('FechaCreacion')
            ->get();

        $developers = User::where('role', 'developer')->get();

        return view('manage', compact('requirements', 'developers'));
    }

    /**
     * Muestra el historial completo de requerimientos asignados para el Líder.
     */
    public function leaderHistoryIndex()
    {
        $assignedRequirements = DesarrolloRequerimiento::with(['requerimiento.client', 'user'])
            ->orderBy('FechaInicio', 'desc')
            ->get();

        return view('leader.history', compact('assignedRequirements'));
    }

    /**
     * Muestra únicamente los requerimientos pendientes o en progreso asignados al desarrollador.
     */
    public function assignedIndex()
    {
        $assignedRequirements = DesarrolloRequerimiento::with(['requerimiento.client', 'user'])
            ->where('Idusers', Auth::id())
            ->where('Estado', '!=', 'Finalizado')
            ->get();

        return view('assigned', compact('assignedRequirements'));
    }

    /**
     * Muestra únicamente el historial de requerimientos finalizados del desarrollador.
     */
    public function historyIndex()
    {
        $historyRequirements = DesarrolloRequerimiento::with(['requerimiento.client', 'user'])
            ->where('Idusers', Auth::id())
            ->where('Estado', 'Finalizado')
            ->get();

        return view('developer.history', compact('historyRequirements'));
    }


    /**
     * Métodos alias para asignación de desarrollador.
     */
    public function assign(Request $request, $id)
    {
        return $this->assignDeveloper($request, $id);
    }

    public function assignDeveloper(Request $request, $id)
    {
        $request->validate([
            'Idusers' => 'required|exists:users,id',
        ]);

        DesarrolloRequerimiento::updateOrCreate(
            ['IdRequerimiento' => $id],
            [
                'Idusers'     => $request->Idusers,
                'FechaInicio' => now()->toDateString(),
                'FechaFin'    => now()->toDateString(),
                'Estado'      => 'En Progreso',
                'Observacion' => 'Asignación inicial',
            ]
        );

        return back()->with('success', 'Desarrollador asignado exitosamente al requerimiento.');
    }

    /**
     * Actualiza el estado del requerimiento y procesa el envío de correo si finaliza.
     */
    public function updateStatus(Request $request, $id)
    {
        $desarrollo = DesarrolloRequerimiento::where('IdDesarrolloRequerimiento', $id)
            ->orWhere('IdRequerimiento', $id)
            ->firstOrFail();

        $estado = $request->Estado ?? $request->status;

        if (in_array($estado, ['Completado', 'Finalizado', 'Terminado'])) {
            $estado = 'Finalizado';
        } elseif (in_array($estado, ['En Proceso', 'En Progreso'])) {
            $estado = 'En Progreso';
        }

        $observacion = $request->Observacion ?? $desarrollo->Observacion;

        // 1. Actualizar el registro en DesarrolloRequerimiento
        $desarrollo->update([
            'Estado'      => $estado,
            'Observacion' => $observacion,
        ]);

        // 2. Si el estado es Finalizado, registrar la entrega y enviar el correo al cliente
        if ($estado === 'Finalizado') {

            EntregaRequerimiento::create([
                'Idusers'                   => Auth::id() ?? $desarrollo->Idusers,
                'IdDesarrolloRequerimiento' => $desarrollo->IdDesarrolloRequerimiento,
                'FechaEntrega'              => now()->toDateString(),
                'MedioEntrega'              => 'Sistema Web / Correo',
                'Estado'                    => 'Entregado',
                'Novedad'                   => $observacion,
            ]);

            // Obtener el correo del cliente desde la relación o consultando la BD directamente
            $recipientEmail = optional(optional($desarrollo->requerimiento)->client)->email
                ?? optional($desarrollo->user)->email;

            if (!$recipientEmail) {
                $requerimiento = DB::table('Requerimiento')->where('IdRequerimiento', $desarrollo->IdRequerimiento)->first();
                if ($requerimiento && isset($requerimiento->Idusers)) {
                    $user = User::find($requerimiento->Idusers);
                    $recipientEmail = $user ? $user->email : null;
                }
            }

            if ($recipientEmail) {
                Mail::to($recipientEmail)->send(
                    new RequerimientoFinalizadoMail($desarrollo, $observacion)
                );
            }
        }

        return back()->with('success', 'Estado actualizado y correo enviado exitosamente al cliente.');
    }
}
