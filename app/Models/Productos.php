<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'imagen',
        'precio',
        'moneda_id',
        'activo',
    ];

    // Relacion de uno a muchos
    public function pagos(){
        return $this->belongsTo('App\Models\Pagos', 'producto_id');
    }
    
    public function usuarios(){
        return $this->belongsTo('App\Models\Usuarios', 'user_id');
    }
}
