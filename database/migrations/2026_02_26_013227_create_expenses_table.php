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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('description'); // Ej: "Compra de carne a Los Corrales"
            $table->decimal('amount', 10, 2); // Ej: 15000.50
            $table->date('expense_date'); // Cuándo se gastó
            $table->string('category'); // Ej: Proveedores, Servicios, Sueldos, Otros
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
