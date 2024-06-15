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
        Schema::create('quize_answers', function (Blueprint $table) {
            $table->id();
            $table->string('question_text')->nullable();
            $table->string('mark')->nullable();
            $table->string('answer_a')->nullable();
            $table->string('answer_b')->nullable();
            $table->string('answer_c')->nullable();
            $table->string('correct_answer');
            $table->unsignedBigInteger('quize_id')->index()->nullable();
            $table->timestamps();
            $table->foreign('quize_id')->references('id')->on('quizes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quize_answers');
    }
};
