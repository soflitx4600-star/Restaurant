<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product; 

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::insert([
            // --- PLATOS PRINCIPALES (Tu categoría ID 3) ---
            [
                'subject_id' => 3, // ID 3 = Platos Principales
                'name' => 'Milanesa Napolitana',
                'price' => 12500.00,
                'description' => 'Con papas fritas.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subject_id' => 3, // ID 3 = Platos Principales
                'name' => 'Hamburguesa Completa',
                'price' => 9800.00,
                'description' => 'Doble carne y cheddar.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // --- BEBIDAS (Tu categoría ID 1) ---
            [
                'subject_id' => 1, // ID 1 = Bebidas
                'name' => 'Coca Cola 1.5L',
                'price' => 4500.00,
                'description' => 'Botella.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // --- ENTRADAS (Tu categoría ID 2) ---
            [
                'subject_id' => 2, // ID 2 = Entradas
                'name' => 'Empanada de Carne',
                'price' => 1500.00,
                'description' => 'Frita, cortada a cuchillo.',
                'is_active' => true, 
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}