<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('products');
            $table->integer('order_price');
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}