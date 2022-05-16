<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShoppingcartTable extends Migration
{
    public function up(): void
    {
        Schema::create(config('cart.database.table'), function (Blueprint $table) {
            $table->string('identifier', 100);
            $table->string('instance', 100);
            $table->longText('content');
            $table->nullableTimestamps();

            $table->primary(['identifier', 'instance']);
        });
    }

    public function down(): void
    {
        Schema::drop(config('cart.database.table'));
    }
}
