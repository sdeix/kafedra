<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCartTable extends Migration
{
    public function up()
    {
        Schema::create('cart', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

        });
    }

    public function down()
    {
        Schema::dropIfExists('cart');
    }
}