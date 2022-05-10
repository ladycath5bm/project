<?php

use App\Constants\OrderStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_document');
            $table->string('customer_phone');
            $table->string('customer_address');
            $table->json('transactions')->nullable();
            $table->char('reference', 20);
            $table->char('request_id')->nullable();
            $table->string('process_url')->nullable();
            $table->integer('total');
            $table->enum('status', OrderStatus::toArray());
            $table->string('description')->nullable();

            $table->foreignId('customer_id');
            $table->foreign('customer_id')->references('id')->on('users');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
}
