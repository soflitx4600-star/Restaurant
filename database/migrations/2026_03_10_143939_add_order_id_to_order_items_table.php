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
    Schema::table('order_items', function (Blueprint $table) {
        // Agregamos la columna conectada a la tabla orders. 
        // Le ponemos nullable() para que no rompa si ya tenían datos viejos cargados.
        $table->foreignId('order_id')->nullable()->constrained('orders')->cascadeOnDelete();
    });
}

public function down(): void
{
    Schema::table('order_items', function (Blueprint $table) {
        $table->dropForeign(['order_id']);
        $table->dropColumn('order_id');
    });
}
};
