<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dofa extends Model
{
    use HasFactory;

    protected $table = 'dofa';

    protected $fillable = [
        'codigo',
        'id_usuario',
    ];
}
