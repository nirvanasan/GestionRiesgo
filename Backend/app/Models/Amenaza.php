<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amenaza extends Model
{
    use HasFactory;

    protected $table = 'amenazas';

    protected $fillable = ['codigo_debilidad', 'descripcion', 'tipo']; 

    public $timestamps = true;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = null;
    
    public function dofa()
    {
        return $this->belongsTo(Dofa::class, 'codigo_amenaza', 'Codigo');
    }
}
