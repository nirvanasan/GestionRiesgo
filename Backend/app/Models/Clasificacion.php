<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clasificacion extends Model
{
    use HasFactory;

    // Definir la tabla asociada
    protected $table = 'clasificacion';

    // Columnas permitidas para asignación masiva
    protected $fillable = [
        'id_elemento',
        'tipo',
        'causa',
        'efecto',
        'probabilidad',
        'impacto',
        'valoracion',
    ];
}
