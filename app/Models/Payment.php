<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | goblan variables
    |--------------------------------------------------------------------------
    */
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

    /*
    |--------------------------------------------------------------------------
    | functions
    |--------------------------------------------------------------------------
    */
    

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function users(){
        return $this->belongsTo(User::class, 'id');
    }
}
