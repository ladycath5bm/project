<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVisitsTable extends Migration
{
    public function up(): void
    {
        Schema::create('product_visits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('ip', 150);
            $table->string('browser', 150);
            $table->string('os', 150);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_visits');
    }
}
