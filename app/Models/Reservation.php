<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany; // <--- Agregamos esto para la nueva relación

class Reservation extends Model
{
    use HasFactory;

    /**
     * Los campos que permitimos guardar masivamente.
     * Estos tienen que coincidir con tu migración.
     */
    protected $fillable = [
        'user_id',          
        'reservation_date',  
        'guests',           
        'table_number',     
        'status',           
        'notes',            
        'total',           
        'payment_method',
        'client_name',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación: Una reserva (mesa) TIENE MUCHOS pedidos (ítems).
     * Esto es lo que necesita el botón "Cobrar" para sumar todo.
     */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}