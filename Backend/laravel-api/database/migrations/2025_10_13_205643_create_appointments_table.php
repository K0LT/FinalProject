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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('patient_id')
                ->constrained()->cascadeOnDelete();
            $table->foreignId('profile_id')
                ->nullable()->constrained();

            $table->dateTime('appointment_date_time');
            $table->integer('duration')->nullable();
            $table->string('type')->nullable();
            $table->text('notes')->nullable();
            $table->enum('status', ['Pendente', 'Confirmado', 'Cancelado', 'Concluído']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
