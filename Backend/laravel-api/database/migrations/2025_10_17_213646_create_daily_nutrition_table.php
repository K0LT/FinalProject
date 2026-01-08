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
        Schema::create('daily_nutrition', function (Blueprint $table) {
            $table->id();

            $table->foreignId('patient_id')
                ->constrained()->cascadeOnDelete();

            $table->date('date');
            $table->integer('calories_consumed')->nullable();
            $table->integer('protein_consumed')->nullable();
            $table->integer('carbs_consumed')->nullable();
            $table->integer('fat_consumed')->nullable();
            $table->float('water_intake')->nullable();
            $table->integer('steps')->nullable();
            $table->integer('sleep_hours')->nullable();
            $table->integer('calories_burned')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_nutrition');
    }
};
