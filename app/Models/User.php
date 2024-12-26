<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes; // Habilita el soporte para eliminaciones suaves (soft deletes)

    /**
     * Atributo para manejar las fechas de soft delete
     *
     * @var array
     */
    protected $dates = ['deleted_at']; // Define el campo 'deleted_at' para el manejo de eliminaciones suaves

    /**
     * The attributes that are mass assignable.
     * Campos que se pueden asignar en masa
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombres',     // Nombre del usuario
        'apellidos',   // Apellido del usuario
        'telefono',    // Teléfono del usuario
        'foto',        // Foto del usuario (opcional)
        'email',       // Correo electrónico del usuario
        'password',    // Contraseña del usuario
        'rol_id',      // ID del rol del usuario
    ];

    /**
     * The attributes that should be hidden for serialization.
     * Atributos que deben estar ocultos en las respuestas JSON
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',         // Oculta la contraseña
        'remember_token',   // Oculta el token de sesión
    ];

    /**
     * The attributes that should be cast.
     * Atributos que deben ser convertidos a tipos específicos
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime', // Convierte 'email_verified_at' a tipo 'datetime'
        'password' => 'hashed', // Indica que la contraseña debe ser tratada como un hash
    ];

    // Relación con la tabla 'roles'
    public function role()
    {
       return $this->belongsTo(Role::class, 'rol_id'); // Relación con el modelo Role basada en 'rol_id'
    }

    // Relación uno a muchos con 'reservations' (reservas hechas por el usuario)
    public function reservations()
    {
        return $this->hasMany(Reservation::class); // Relación uno a muchos con el modelo Reservation
    }

    // Relación uno a muchos con 'reservations' pero como consultor (consultor en las reservas)
    public function consultantReservations()
    {
        return $this->hasMany(Reservation::class, 'consultant_id'); // Relación con reservas donde el usuario es consultor
    }
}
