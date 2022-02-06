<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStartDateAndEndDateToEmployeeNotes extends Migration
{

    public function up()
    {
        Schema::table('employee_notes', function (Blueprint $table) 
        {
            $table->date('start_date');
            $table->date('end_date');
        });
    }

    public function down()
    {
        Schema::table('employee_notes', function (Blueprint $table) {
            Schema::dropIfExists('employee_notes');

        });
    }
}
