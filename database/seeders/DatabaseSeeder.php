<?php

namespace Database\Seeders;

// use App\Models\User; // No lo usas aquí, así que puedes dejarlo o quitarlo
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    // use WithoutModelEvents; // Esto es opcional, si no lo necesitas puedes comentarlo

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Llamamos a los seeders directamente pasando el array
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            SubjectSeeder::class
        ]);
    }
}