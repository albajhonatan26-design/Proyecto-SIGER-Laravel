<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntregaRequerimiento extends Model
{
    use HasFactory;

    protected $table = 'EntregaRequerimiento';
    protected $primaryKey = 'IdEntregaRequerimiento';
    public $timestamps = false;

    protected $fillable = [
        'Idusers',
        'IdDesarrolloRequerimiento',
        'FechaEntrega',
        'MedioEntrega',
        'Estado',
        'Novedad',
    ];

    public function desarrolloRequerimiento()
    {
        return $this->belongsTo(DesarrolloRequerimiento::class, 'IdDesarrolloRequerimiento', 'IdDesarrolloRequerimiento');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'Idusers', 'id');
    }
}