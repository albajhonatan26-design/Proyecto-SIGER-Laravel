<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesarrolloRequerimiento extends Model
{
    use HasFactory;

    protected $table = 'DesarrolloRequerimiento';
    protected $primaryKey = 'IdDesarrolloRequerimiento';
    public $timestamps = false;

    protected $fillable = [
        'IdRequerimiento',
        'Idusers',
        'FechaInicio',
        'FechaFin',
        'Estado',
        'Observacion',
    ];

    // Relación con el Requerimiento asociado
    public function requerimiento()
    {
        return $this->belongsTo(Requirement::class, 'IdRequerimiento', 'IdRequerimiento');
    }

    // Relación con el desarrollador asignado en DesarrolloRequerimiento
    public function developer()
    {
        return $this->belongsTo(User::class, 'Idusers', 'id');
    }

    // Alias 'user' o 'usuario' para el desarrollador
    public function user()
    {
        return $this->belongsTo(User::class, 'Idusers', 'id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'Idusers', 'id');
    }
}