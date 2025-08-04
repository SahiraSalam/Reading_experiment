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
        Schema::create('passage_question_options', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('passage_question_id');
            $table->unsignedBigInteger('passage_id');
            $table->string('title',1200);
            $table->string('value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('passage_question_options');
    }
};
