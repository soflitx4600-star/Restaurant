<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderItem; // Importamos el modelo

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       

        OrderItem::insert([
          
            [
                'reservation_id' => 1, 
                'product_id' => 1,     
                'quantity' => 2,       
                'note' => 'Una bien cocida, la otra a punto',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'reservation_id' => 1, 
                'product_id' => 3,     
                'quantity' => 2,       
                'note' => 'Con hielo',
                'created_at' => now(),
                'updated_at' => now(),
            ],

           
            [
                'reservation_id' => 2, 
                'product_id' => 2,     
                'quantity' => 1,
                'note' => 'Sin pepinos',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}