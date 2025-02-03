<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\http\Models\Accion;

class Seguimiento extends Model
{
    use HasFactory;

    protected $table = 'seguimiento';

    protected $fillable = [
        'control_actual',
        'p1',
        'p2',
        'p3',
        'p4',
        'accion_id',
        'probabilidad',
        'fecha',
        'impacto',
        'valoracion_riesgo',
        'valoracion_control',
        'valoracion_total',
        'justificacion',
    ];

    public function accion()
    {
        return $this->belongsTo(Accion::class, 'accion_id');
    }
}
