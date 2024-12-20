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
        'id_proceso',
        'clasificacion',
    ];

    public $timestamps = true;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = null;
    
    public function proceso()
    {
        return $this->belongsTo(Proceso::class, 'id_proceso', 'id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
    
}
