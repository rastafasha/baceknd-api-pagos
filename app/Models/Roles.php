<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    public function usuarios(){
        return $this->belongsTo('App\Models\Usuarios', 'id');
    }
}
