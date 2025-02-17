<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Primero eliminamos la tabla si existe
        Schema::dropIfExists('orders');

        // Luego creamos la tabla con la estructura completa
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->enum('order_type', ['dine-in', 'takeaway']);
            $table->json('items');
            $table->decimal('total', 10, 2);
            $table->decimal('subtotal', 10, 2)->default(0);
            $table->enum('status', ['pending', 'preparing', 'completed', 'cancelled'])->default('pending');
            $table->text('special_instructions')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
}; 