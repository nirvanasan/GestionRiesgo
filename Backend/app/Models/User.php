<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'area',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */

    public $timestamps = true;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = null;
    
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function oportunidades()
    {
        return $this->hasMany(Oportunidad::class, 'id_usuario');
    }

    public function amenazas()
    {
        return $this->hasMany(Amenaza::class, 'id_usuario');
    }

    public function debilidades()
    {
        return $this->hasMany(Debilidad::class, 'id_usuario');
    }

    public function fortalezas()
    {
        return $this->hasMany(Fortaleza::class, 'id_usuario');
    }
}
