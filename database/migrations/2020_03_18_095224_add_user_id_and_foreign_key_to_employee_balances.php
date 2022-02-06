<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdAndForeignKeyToEmployeeBalances extends Migration
{

    public function up()
    {
        Schema::table('employee_balances', function (Blueprint $table) {
            $table->bigInteger('emp_id')->unsigned();
            $table->foreign('emp_id')->references('id')->on('users')->onDelete('cascade');
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
            Schema::dropIfExists('complain_replies');
        });
    }
}
