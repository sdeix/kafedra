<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('token')->nullable();
            $table->string('fio');
            $table->string('role')->default('client');

        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}