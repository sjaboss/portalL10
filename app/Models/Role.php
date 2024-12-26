<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // Campos que se pueden asignar en masa
    protected $fillable = ['name']; // Solo el campo 'name' es asignable en masa

    // Relación uno a muchos con usuarios
    public function users()
    {
        // Relación con el modelo 'User', usando 'rol_id' como clave foránea
        return $this->hasMany(User::class, 'rol_id');
    }
}
