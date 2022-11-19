<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Usuarios;

class Directorio extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nombre',
        'surname',
        'especialidad',
        'universidad',
        'ano',
        'org',
        'website',
        'email',
        'direccion',
        'direccion1',
        'estado',
        'ciudad',
        'telefonos',
        'tel1',
        'telhome',
        'telmovil',
        'telprincipal',
        'facebook',
        'instagram',
        'twitter',
        'linkedin',
        'image',
        'vcard',
        'created_at',
    ];

    // Relacion de uno a muchos
    public function users(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function usuarios(){
        return $this->belongsTo('App\Models\Usuarios', 'id');
    }
}
