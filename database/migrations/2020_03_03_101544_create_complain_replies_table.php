<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComplainRepliesTable extends Migration
{
    public function up()
    {
        Schema::create('complain_replies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->bigInteger('complain_id')->unsigned();
            $table->string("reply");
            $table->foreign('complain_id')->references('id')->on('complains')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('complain_replies');
    }
}
