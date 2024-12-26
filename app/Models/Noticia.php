<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    use HasFactory;
    protected $table = 'noticias';
    
    protected $fillable = [
        'foto',
        'seccion_id',
        'autor',
        'fecha',
        'titulo',
        'bajada',
        'nota',
        'usuario',
    ];
    public function seccion()
    {
        return $this->belongsTo(Seccion::class);
    }
}
