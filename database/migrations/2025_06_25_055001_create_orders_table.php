<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('delivery_id')->nullable();


            $table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending');
            $table->enum('order_status', ['pending', 'confirmed', 'preparing', 'out_for_delivery', 'delivered', 'cancelled'])->default('pending');
            $table->decimal('total_amount', 10, 2);

            $table->enum('delivery_type', ['delivery', 'pickup', 'dinein'])->default('delivery');
            $table->integer('table_no')->nullable(); // Only used for dine-in
            $table->text('delivery_address')->nullable(); // Only used for delivery

            $table->timestamps();

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // Optional delivery_id FK if there's a deliveries table
            // $table->foreign('delivery_id')->references('id')->on('deliveries')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
}
