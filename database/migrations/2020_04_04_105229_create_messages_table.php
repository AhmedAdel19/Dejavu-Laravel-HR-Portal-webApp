<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{

    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('from')->comment('Own Id');
            $table->unsignedBigInteger('to')->comment('Other Id');
            $table->text('message');
            $table->boolean('type');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
