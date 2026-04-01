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
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        // Acá guardamos el total de la cuenta
        $table->decimal('total_price', 10, 2)->nullable();
        
        // Efectivo, Tarjeta, Mercado Pago, etc.
        $table->string('payment_method')->nullable();
        
        // Pendiente, Pagado, Cancelado
        $table->string('status')->default('Pendiente');
        
        // Notas para la cocina o el cajero
        $table->text('notes')->nullable();
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
