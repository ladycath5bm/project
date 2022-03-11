<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('customerName')->nullable();
            $table->string('customerEmail')->nullable();
            $table->string('customerDocument')->nullable();
            $table->char('reference', 15)->nullable();
            $table->integer('total')->nullable();
            $table->string('status')->nullable();
            $table->string('description')->nullable();
            $table->foreignId('customer_id')->nullable();
            $table->foreign('customer_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
}
