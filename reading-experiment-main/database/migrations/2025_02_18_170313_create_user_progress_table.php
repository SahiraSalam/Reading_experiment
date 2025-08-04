<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::create('user_progress', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('passage_id');
            $table->unsignedBigInteger('passage_style_id');
            $table->text('back_times')->nullable();
            $table->text('p_start_times')->nullable();
            $table->text('start_time');
            $table->text('p_end_time')->nullable();
            $table->text('created_at');
            $table->text('updated_at')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_progress');
    }
};
