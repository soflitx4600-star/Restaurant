<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Importante para la relación

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
    'subject_id',
    'name',
    'price',
    'description',
    'image', 
    'is_active',
];

    /**
     * Relación: Un Producto PERTENECE a una Categoría (Subject).
     * Esto es clave para que después puedas filtrar "Solo Bebidas" o "Solo Postres".
     */
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }
}