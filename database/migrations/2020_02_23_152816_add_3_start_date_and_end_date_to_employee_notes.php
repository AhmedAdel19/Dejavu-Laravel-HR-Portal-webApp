<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add3StartDateAndEndDateToEmployeeNotes extends Migration
{

    public function up()
    {
        Schema::table('employee_notes', function (Blueprint $table) {
            $table->date('start_date');
            $table->time('start_time');

            $table->date('end_date');
            $table->time('end_time');
        });
    }


    public function down()
    {
        Schema::table('employee_notes', function (Blueprint $table) {
            Schema::dropIfExists('employee_notes');

        });
    }
}
