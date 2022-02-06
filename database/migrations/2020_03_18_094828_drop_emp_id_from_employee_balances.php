<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropEmpIdFromEmployeeBalances extends Migration
{

    public function up()
    {
        Schema::table('employee_balances', function (Blueprint $table) {
            $table->dropColumn('emp_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_balances', function (Blueprint $table) {
            //
        });
    }
}
