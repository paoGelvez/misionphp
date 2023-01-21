<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jugadores extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'edad',
        'calificacion',
        'posicion',
        'id_equipos',
    ];

}
