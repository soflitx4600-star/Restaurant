<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;                    // <--- Faltaba importar el Modelo
use Illuminate\Support\Facades\Hash;    // <--- Faltaba importar Hash
use Illuminate\Support\Carbon;          // <--- Faltaba importar Carbon

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now(); // Corregido "Carboon"

        User::insert([
            [
                'id' => 1,              // Corregido "->" por "=>"
                'name' => 'Admin Mg Mg',
                'email' => 'admin@mail.com',
                'password' => Hash::make('12345678'),
                'role_id' => 1,         // Admin
                'created_at' => $now,
                'updated_at' => $now,   // Corregido "update_at" por "updated_at"
            ],
            [
                'id' => 2,
                'name' => 'Cheff Aye Aye',
                'email' => 'cheff@mail.com',
                'password' => Hash::make('12345678'),
                'role_id' => 2,         // Chef
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 3,
                'name' => 'Mozo Carlitos',
                'email' => 'mozo@mail.com',
                'password' => Hash::make('12345678'),
                'role_id' => 3,         // Mesero
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 4,
                'name' => 'Mozo Zigueña',
                'email' => 'mozo2@mail.com', // CAMBIADO: El email debe ser único
                'password' => Hash::make('12345678'),
                'role_id' => 3,         // CAMBIADO: Rol 3 (Mesero) porque el Rol 4 no existe
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 5,
                'name' => 'Cheff Morgan Kigman',
                'email' => 'zorro@mail.com',
                'password' => Hash::make('12345678'),
                'role_id' => 2,         // CAMBIADO: Rol 2 (Chef) porque el Rol 5 no existe
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}