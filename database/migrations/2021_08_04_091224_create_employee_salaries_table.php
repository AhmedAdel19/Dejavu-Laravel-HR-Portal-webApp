<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_salaries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->string('emp_name');
            $table->string('emp_email');
            $table->string('emp_mobile');
            $table->string('emp_code');
            $table->string('month');
            $table->integer('basic_salary');
            $table->integer('t_allowence');
            $table->double('other_exempt');
            $table->double('s_commission');
            $table->integer('day_off');
            $table->double('acting_allow');
            $table->double('overtime');
            $table->double('late');
            $table->double('absense');
            $table->double('card');
            $table->double('other_deduct');
            $table->integer('unpaid_leave');
            $table->integer('penalty_day');
            $table->integer('advance');
            $table->integer('loan');
            $table->integer('emp_insu');
            $table->integer('net_salary');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_salaries');
    }
}
