<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTwittersTable extends Migration
{
    public function up()
    {
        Schema::create('twitters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('photo')->nullable();
            $table->string('name')->nullable();
            $table->unique('twitterId')->nullable();
            $table->string('description')->nullable();
            $table->integer('tweets')->nullable();
            $table->integer('following')->nullable();
            $table->integer('followers')->nullable();
            $table->integer('likes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('twitters');
    }
}
