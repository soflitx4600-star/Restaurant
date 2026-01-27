<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reservation; // Importamos tu modelo Reservation
use Illuminate\Support\Carbon; // Para manejar fechas

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        Reservation::insert([
            [
                'user_id' => 1, 
                'reservation_date' => $now->copy()->addHours(3), 
                'guests' => 2,
                'table_number' => 'Mesa 4',
                'status' => 'confirmed',
                'notes' => 'Es un aniversario. Quieren vino tinto. Porque eze se la coge a herba',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => 3, // Asignada al usuario con ID 3 (Ej: Mesero o Cliente)
                'reservation_date' => $now->copy()->addDays(1)->setHour(13)->setMinute(00), // Mañana a las 13:00
                'guests' => 4,
                'table_number' => null, // Todavía no le asignaron mesa
                'status' => 'pending',
                'notes' => 'Almuerzo de trabajo, zona silenciosa.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => 1,
                'reservation_date' => $now->copy()->addDays(3)->setHour(21)->setMinute(30), // En 3 días a la noche
                'guests' => 6,
                'table_number' => 'Mesa 10',
                'status' => 'confirmed',
                'notes' => 'Cumpleaños sorpresa.',
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ]);
    }
}