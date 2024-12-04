<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amenaza extends Model
{
    use HasFactory;

    protected $table = 'amenazas';

    protected $fillable = [
       
        'descripcion',
        'tipo',
    ];
}
