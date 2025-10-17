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
        Schema::create('treatment_goals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('priority')->default('Minima');
            $table->string('status')->default('Em progresso');
            $table->string('progress_percentage')->default(0);
            $table->date('target_date')->nullable();
            $table->string('treatment_methods')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treatment_goals');
    }
};
