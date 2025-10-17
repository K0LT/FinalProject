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
        Schema::create('treatments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('diagnostic_id')->constrained();
            $table->foreignId('patient_id')->constrained();
            $table->foreignId('profile_id')->constrained();
            $table->date('session_date');
            $table->string('treatment_methods')->nullable();
            $table->string('acupoints_used')->nullable();
            $table->integer('duration');
            $table->text('notes')->nullable();
            $table->date('next_session')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treatments');
    }
};
