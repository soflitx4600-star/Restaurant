<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            
            // 1. Quién hace la reserva (El cliente o el usuario registrado)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // 2. Cuándo es la reserva (Fecha y Hora completas)
            // Esto reemplaza al "enum day" del video.
            $table->dateTime('reservation_date'); 
            
            // 3. Para cuántas personas es la mesa
            $table->integer('guests')->default(1);
            
            // 4. Qué número de mesa le asignas (Puede estar vacío al principio)
            $table->string('table_number')->nullable();
            
            // 5. Estado de la reserva (Pendiente, Confirmada, Cancelada)
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
            
            // 6. Notas opcionales (Ej: "Alergia al maní", "Cumpleaños")
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
