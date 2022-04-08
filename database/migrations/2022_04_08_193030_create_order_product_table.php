<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductTable extends Migration
{
    public function up(): void
    {
        Schema::create('order_product', function (Blueprint $table) {

            $table->integer('quantity');
            $table->string('price');
            $table->string('subtotal');

            $table->foreignId('order_id');
            $table->foreignId('product_id');

            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('product_id')->references('id')->on('products');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_product');
    }
}
