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
}