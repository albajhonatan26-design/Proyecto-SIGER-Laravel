<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DesarrolloRequerimiento extends Model
{
    protected $table = 'desarrollorequerimiento';
    protected $primaryKey = 'IdDesarrolloRequerimiento';
    public $timestamps = false;

    protected $fillable = [
        'Idusers',
        'IdRequerimiento',
        'FechaInicio',
        'FechaFin',
        'Estado',
        'Observacion',
    ];

    public function requerimiento()
    {
        return $this->belongsTo(Requirement::class, 'IdRequerimiento', 'IdRequerimiento');
    }
}