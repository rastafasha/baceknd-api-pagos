<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagos extends Model
{
    use HasFactory;

    protected $fillable = [
        'referencia',
        'metodo',
        'bank_name',
        'monto',
        'validacion',
        'moneda_id',
        'moneda_codigo',
        'nombre',
        'email',
        'status',
        'txn_id',
        'user_id',
        'producto_id',
        'updated_at',
        'created_at',
    ];

    // Relacion de uno a muchos
    public function usuarios(){
        return $this->belongsTo('App\Models\Usuarios', 'id');
    }

}
