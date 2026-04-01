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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();

            // 1. ¿A qué reserva pertenece? (La Mesa)
            // Esto es clave: vincula este pedido con la reserva específica.
            $table->foreignId('reservation_id')->nullable()->constrained()->onDelete('cascade');

            
            $table->foreignId('product_id')->constrained()->onDelete('cascade');

            // 3. Cantidad
            // Por si piden 2 cervezas juntas.
            $table->integer('quantity')->default(1);

            // 4. Notas opcionales
            // Ej: "Sin hielo", "A punto", "Sin cebolla".
            $table->text('note')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
