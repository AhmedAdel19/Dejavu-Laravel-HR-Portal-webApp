<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropEmpIdFromEmployeeNotes extends Migration
{

    public function up()
    {
        Schema::table('employee_notes', function (Blueprint $table) {
            $table->dropColumn('emp_id');

        });
    }

  
    public function down()
    {
        Schema::table('employee_notes', function (Blueprint $table) {
            
        });
    }
}
