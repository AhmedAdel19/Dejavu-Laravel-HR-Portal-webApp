<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEmpCodeToComplainReplies extends Migration
{

    public function up()
    {
        Schema::table('complain_replies', function (Blueprint $table) 
        {
            $table->string('employee_code');
        });
    }

    public function down()
    {
        Schema::table('complain_replies', function (Blueprint $table) {
            Schema::dropIfExists('complain_replies');

        });
    }
}
