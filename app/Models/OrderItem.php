<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_id',
        'product_id',
        'quantity',
        'note',
    ];

    public function reservation(): BelongsTo
    {
        return $this->belongsTo(Reservation::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    // --- 👇 ACÁ ESTÁ LA MAGIA DEL STOCK 👇 ---
    protected static function booted()
    {
        // Cuando se CREA un pedido nuevo en la comanda, RESTAMOS el stock
        static::created(function ($item) {
            if ($item->product) {
                $item->product->decrement('stock', $item->quantity);
            }
        });

        // Cuando se BORRA un pedido (porque te equivocaste), SUMAMOS el stock de vuelta
        static::deleted(function ($item) {
            if ($item->product) {
                $item->product->increment('stock', $item->quantity);
            }
        });
    }
}