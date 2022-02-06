<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdAndForeignKeyToEmployeeNotes extends Migration
{

    public function up()
    {
        Schema::table('employee_notes', function (Blueprint $table) {
            $table->bigInteger('emp_id')->unsigned();
            $table->foreign('emp_id')->references('id')->on('users')->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::table('employee_notes', function (Blueprint $table) {
            Schema::dropIfExists('employee_notes');

        });
    }
}
