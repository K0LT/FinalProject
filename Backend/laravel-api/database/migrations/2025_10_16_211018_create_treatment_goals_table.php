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

            $table->foreignId('patient_id')
                ->constrained()->cascadeOnDelete();

            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('priority', ['Mínima', 'Média', 'Alta'])->default('Media');
            $table->enum('status', ['Em progresso', 'Concluído', 'Cancelado'])->default('Em progresso');
            $table->integer('progress_percentage')->default(0);
            $table->date('target_date')->nullable();
            $table->string('treatment_methods')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
