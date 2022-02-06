<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropUserIdFromComplains extends Migration
{

    public function up()
    {
        Schema::table('complains', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }

    public function down()
    {
        Schema::table('complains', function (Blueprint $table) {
            
        });
    }
}
