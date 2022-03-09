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
            $table->string('name', 15);
            $table->integer('code')->unique();
            $table->decimal('price');
            $table->string('description')->nullable();
            $table->unsignedDecimal('discount')->default(0);
            $table->unsignedInteger('stock');
            $table->boolean('status')->nullable();

            $table->foreignId('category_id')->nullable();
            $table->foreignId('user_id')->nullable();

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
}
