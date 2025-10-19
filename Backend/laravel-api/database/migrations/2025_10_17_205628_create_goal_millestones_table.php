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
        Schema::create('goal_millestones', function (Blueprint $table) {
            $table->id();

            $table->foreignId('treatment_goal_id')
                ->constrained()->cascadeOnDelete();

            $table->text('description')->nullable();
            $table->date('target_date');
            $table->boolean('completed')->default(false);
            $table->date('completion_date')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goal_millestones');
    }
};
