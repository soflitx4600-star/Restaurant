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
    Schema::table('reservations', function (Blueprint $table) {
        
        // Verificamos si la columna 'total' no existe antes de crearla
        if (!Schema::hasColumn('reservations', 'total')) {
            $table->decimal('total', 10, 2)->nullable(); 
        }
        
        // Verificamos si 'payment_method' no existe antes de crearla
        if (!Schema::hasColumn('reservations', 'payment_method')) {
            $table->string('payment_method')->nullable(); 
        }
        
        // BORRAMOS o COMENTAMOS la línea de status porque ¡ya existe!
        // $table->string('status')->default('pendiente'); 
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            //
        });
    }
};
