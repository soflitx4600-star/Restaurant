<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; // Importamos esto

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description', // Si le habías puesto descripción
    ];

    /**
     * Relación: Una Categoría (Subject) tiene muchos Productos.
     * Ej: "Bebidas" tiene -> Coca, Pepsi, Agua.
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}