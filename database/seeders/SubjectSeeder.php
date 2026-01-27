<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject; // Usamos el modelo que ya creaste en el video
use Illuminate\Support\Carbon;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        // En vez de materias de escuela, ponemos tus categorías del restaurante
        Subject::insert([
            [
                'name' => 'Bebidas',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Entradas',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Platos Principales',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Postres',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Cafetería',
                'created_at' => $now,
                'updated_at' => $now
            ],
        ]);
    }
}