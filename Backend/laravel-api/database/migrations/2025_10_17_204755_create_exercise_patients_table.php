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
        Schema::create('exercise_patients', function (Blueprint $table) {
            $table->id();

            $table->foreignId('patient_id')
                ->constrained()->cascadeOnDelete();
            $table->foreignId('exercise_id')
                ->constrained();

            $table->date('prescribed_date')->useCurrent();
            $table->string('frequency')->nullable();
            $table->string('status');
            $table->integer('compliance_rate')->default(0);
            $table->date('last_performed')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercise_patients');
    }
};
