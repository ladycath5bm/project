<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('code')->unique();
            $table->string('name');
            $table->decimal('price');
            $table->decimal('discount')->nullable();
            $table->integer('stock');
            //$table->boolean('status');

            $table->unsignedBigInteger('category_id');
            //$table->unsignedBigInteger('user_id');
            //$table->unsignedBigInteger('image_id');

            $table->foreign('category_id')->references('id')->on('categories');
            //$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
}
