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
        'id_usuario',
        'tipo',
        'causa',
        'efecto',
        'probabilidad',
        'impacto',
        'valoracion',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function controles()
    {
        return $this->hasMany(Control::class, 'id_elemento', 'id_elemento');
    }
}