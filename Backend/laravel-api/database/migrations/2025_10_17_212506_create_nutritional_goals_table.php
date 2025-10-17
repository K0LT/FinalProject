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
        Schema::create('nutritional_goals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained();
            $table->integer('target_weight')->nullable();
            $table->float('target_body_fat')->nullable();
            $table->integer('daily_calories_goal')->nullable();
            $table->integer('daily_protein_goal')->nullable();
            $table->integer('daily_carbs_goal')->nullable();
            $table->integer('daily_fat_goal')->nullable();
            $table->date('start_date')->nullable();
            $table->date('target_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nutritional_goals');
    }
};
