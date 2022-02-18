<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    public function up(): void
    {
        Schema::create('images', function (Blueprint $table) {

            $table->id();
            $table->string('url')->nullable();

            $table->foreignId('product_id')->nullable();

            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('images');
    }
}
