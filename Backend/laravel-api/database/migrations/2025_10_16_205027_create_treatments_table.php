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

            $table->foreignId('diagnostic_id')
                ->constrained();
            $table->foreignId('patient_id')
                ->constrained()->cascadeOnDelete();

            $table->dateTime('session_date_time');
            $table->string('treatment_methods')->nullable();
            $table->string('acupoints_used')->nullable();
            $table->integer('duration')->nullable();
            $table->text('notes')->nullable();
            $table->date('next_session')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
