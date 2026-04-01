<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Le damos permiso a Laravel para guardar estos datos desde el formulario
    protected $fillable = [
        'total_price',
        'payment_method',
        'status',
        'notes',
    ];
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}