<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    use HasFactory;

    protected $table = 'Requerimiento';
    protected $primaryKey = 'IdRequerimiento'; 

    public $timestamps = false;
    const CREATED_AT = 'FechaCreacion';

    protected $fillable = [
        'Idusers',
        'Descripcion',
        'ArchivoAdjunto',
        'Prioridad',
        'FechaCreacion',
        'MedioRecepcion',
        'developer_id',
        'Estado',
    ];

    // Relación con el cliente/usuario que creó el requerimiento (Solicitante)
    public function client()
    {
        return $this->belongsTo(User::class, 'Idusers', 'id');
    }

    // Alias para la relación del solicitante (garantiza compatibilidad con $requerimiento->usuario)
    public function usuario()
    {
        return $this->belongsTo(User::class, 'Idusers', 'id');
    }

    // Relación con el desarrollador asignado
    public function developer()
    {
        return $this->belongsTo(User::class, 'developer_id', 'id');
    }

    // Relación con la tabla de desarrollo del requerimiento
    public function desarrollo()
    {
        return $this->hasOne(DesarrolloRequerimiento::class, 'IdRequerimiento', 'IdRequerimiento');
    }
}