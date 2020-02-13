<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropEmpIdColumnToComplains extends Migration
{

    public function up()
    {
        Schema::table('complains', function (Blueprint $table) {
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
        Schema::table('complains', function (Blueprint $table) {
            //
        });
    }
}
