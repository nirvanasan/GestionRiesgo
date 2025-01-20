<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accion extends Model
{
    use HasFactory;

    protected $table = 'acciones'; 

    protected $fillable = [
        'id_elemento',
        'tipo',
        'informacion',
        'accion',
        'responsable',
        'acciones',
        'proceso',
        'fecha_seguimiento',
        'fecha_cierre',
    ];
}
