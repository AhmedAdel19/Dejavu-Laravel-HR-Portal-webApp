<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Edit2StartDateAndEndDateToEmployeeNotes extends Migration
{

    public function up()
    {
        Schema::table('employee_notes', function (Blueprint $table) {
            $table->dropColumn('start_date');
            $table->dropColumn('end_date');

        });
    }


    public function down()
    {
        Schema::table('employee_notes', function (Blueprint $table) {
          
        });
    }
}
