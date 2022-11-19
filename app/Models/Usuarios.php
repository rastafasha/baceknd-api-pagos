<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\Usuarios as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Usuarios extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'password',
        'updated_at',
        'created_at',
        'is_active',
        'image',
        'role_id',
    ];

    // Relacion de uno a muchos

    public function directorios(){
        return $this->hasMany('App\Models\Directorio', 'user_id');
    }
    public function pagos(){
        return $this->hasMany('App\Models\Pagos', 'user_id');
    }
}
