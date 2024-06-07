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
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->string('courseName')->nullable();
            $table->dateTime('startDate');
            $table->dateTime('endDate')->nullable();
            $table->string('topic')->nullable(false);
            $table->text('description')->nullable();
            $table->text('instruction')->nullable(true)->default(null);
            $table->unsignedBigInteger('created_by')->index()->nullable();
            $table->foreign('created_by')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete()
                ->restrictOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};
