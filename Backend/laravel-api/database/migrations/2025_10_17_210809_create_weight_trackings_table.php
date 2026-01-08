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
        Schema::create('weight_trackings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('patient_id')
            ->constrained()->cascadeOnDelete();

            $table->integer('weight');
            $table->decimal('body_fat_percentage')->nullable();
            $table->date('measurement_date');
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weight_trackings');
    }
};
