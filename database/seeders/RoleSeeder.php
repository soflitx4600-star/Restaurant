<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon; // <--- Importante: Para usar las fechas
use App\Models\Role;           // <--- Importante: Para usar tu modelo Role

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        Role::insert([
            ['id' => 1, 'name' => 'Admin', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 2, 'name' => 'Chef',  'created_at' => $now, 'updated_at' => $now],
            ['id' => 3, 'name' => 'Mesero','created_at' => $now, 'updated_at' => $now],
        ]);
    }
}