<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('exams', function (Blueprint $table) {
            //
            $table->date('date')->after('courseName');
        });
        // Schema::table('students', function (Blueprint $table) {
        //     //
        //     $table->unsignedBigInteger('status')->nullable()->after('gender');
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('exam', function (Blueprint $table) {
            //
        });
    }
};
