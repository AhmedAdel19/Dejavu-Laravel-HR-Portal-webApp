<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add4StartDateAndEndDateToEmployeeNotes extends Migration
{

    public function up()
    {
        Schema::table('employee_notes', function (Blueprint $table) {
            $table->dateTime('start_time');
            $table->dateTime('end_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_notes', function (Blueprint $table) {
            Schema::dropIfExists('employee_notes');
        });
    }
}
