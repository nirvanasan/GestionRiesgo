<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debilidad extends Model
{
    use HasFactory;

    protected $table = 'debilidades';

    protected $fillable = [
     
        'descripcion',
        'tipo',
    ];
}
