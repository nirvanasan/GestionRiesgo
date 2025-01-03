<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Control extends Model
{
    use HasFactory;

    /**
     * Campos que se pueden asignar de manera masiva.
     */

    protected $table = 'controles';

    protected $fillable = [
        'id_elemento',
        'usuario',
        'tipo',
        'descripcion',
        'probabilidad',
        'impacto',
    ];

    public function clasificacion()
    {
        return $this->belongsTo(Clasificacion::class, 'id_elemento', 'id_elemento');
    }
}
