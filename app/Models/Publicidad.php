<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicidad extends Model
{
    use HasFactory;

    protected $table = 'publicidades';

    protected $fillable = [
        'nombre',
        'foto',
        'foto_small',
        'foto_medium',
        'foto_large',
        'orden',
        'descripcion',
        'titulo',
        'fecha_inicio',
        'fecha_fin',
        'activo'
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'activo' => 'boolean'
    ];
}
