<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fortaleza extends Model
{
    use HasFactory;

    protected $table = 'fortalezas';

    protected $fillable = [
      
        'descripcion',
        'tipo',
    ];
}
