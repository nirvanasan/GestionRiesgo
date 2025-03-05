<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Notificacion extends Model
{
    use HasFactory;

    protected $table = 'notificaciones';

    protected $fillable = [
        'id_usuario',
        'mensaje',
        'leida',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
