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
            $table->string('customerName');
            $table->string('customerEmail');
            $table->string('customerDocument');
            $table->string('customerPhone');
            $table->string('customerAddress');
            $table->json('transactions')->nullable();
            $table->char('reference', 20)->nullable();
            $table->char('requestId')->nullable();
            $table->string('processUrl')->nullable();
            $table->integer('total')->nullable();
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
