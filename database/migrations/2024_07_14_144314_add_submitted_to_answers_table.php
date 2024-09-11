<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubmittedToAnswersTable extends Migration
{
    public function up()
    {
        Schema::table('answers1', function (Blueprint $table) {
            $table->boolean('submitted')->default(false);
        });
    }

    public function down()
    {
        Schema::table('answers1', function (Blueprint $table) {
            $table->dropColumn('submitted');
        });
    }
}
