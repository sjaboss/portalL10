<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seccion extends Model
{
    use HasFactory;
    // Definir el nombre de la tabla correspondiente en la base de datos
    protected $table = 'secciones'; // Especifica que este modelo está relacionado con la tabla 'secciones'

     // Campos que se pueden asignar en masa
     protected $fillable = [
        'seccion',
        'orden',
        'color',
        'icon',
        'icon_thumb',
        'icon_medium',
        'icon_large',
        'font_awesome_icon'
    ]; // Solo el campo 'name' es asignable en masa

     public function noticias(){
        return $this->hasMany(Noticia::class);
    }
}
