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
        Schema::create('diagnostics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained();
            $table->foreignId('profile_id')->constrained();
            $table->date('diagnostic_date');
            $table->string('western_diagnosis')->nullable();
            $table->string('tcm_diagnosis')->nullable();
            $table->string('severity')->nullable();
            $table->string('symptoms')->nullable();
            $table->string('pulse_quality')->nullable();
            $table->text('tongue_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnostics');
    }
};
