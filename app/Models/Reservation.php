<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    // Campos que se pueden asignar en masa
    protected $fillable = [
        'user_id',               // ID del usuario que realiza la reserva
        'consultant_id',          // ID del consultor asignado a la reserva
        'reservation_date',       // Fecha de la reserva
        'start_time',             // Hora de inicio de la reserva
        'end_time',               // Hora de finalización de la reserva
        'reservation_status',     // Estado de la reserva (pendiente, confirmada, cancelada)
        'total_amount',           // Monto total de la reserva
        'payment_status',         // Estado del pago (pendiente, pagado, fallido)
        'cancellation_reason',    // Razón de la cancelación, si aplica
    ];

    // Relación muchos a uno con el modelo 'User'
    public function user()
    {
        // La reserva pertenece a un usuario (user_id)
        return $this->belongsTo(User::class);
    }

    // Relación muchos a uno con el consultor (consultant_id)
    public function consultant()
    {
        // La reserva pertenece a un consultor (consultant_id)
        return $this->belongsTo(User::class, 'consultant_id');
    }

    // Relación uno a uno con 'ReservationDetail'
    public function reservationDetail()
    {
        // Una reserva tiene un detalle asociado
        return $this->hasOne(ReservationDetail::class);
    }
}
