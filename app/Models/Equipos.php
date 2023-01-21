<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class equipos extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'fundacion',
        'promediado',
        'id_usuarios',
        'id_deportes',
        'id_entrenador',
    ];

}
