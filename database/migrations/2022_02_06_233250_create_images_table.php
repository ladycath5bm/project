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
            $table->unsignedBigInteger('imageable_id');
            $table->string('imageable_type');
            $table->timestamps();

            //$table->primary(['imageable_id', 'imageable_type']);

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('images');
    }
}
