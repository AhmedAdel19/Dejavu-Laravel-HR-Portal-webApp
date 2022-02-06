<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStartDateAndEndDateToGeneralNotes extends Migration
{

    public function up()
    {
        Schema::table('general_notes', function (Blueprint $table) {
            $table->date('start_date');
            $table->date('end_date');
        });
    }


    public function down()
    {
        Schema::table('general_notes', function (Blueprint $table) {
            Schema::dropIfExists('general_notes');

        });
    }
}
