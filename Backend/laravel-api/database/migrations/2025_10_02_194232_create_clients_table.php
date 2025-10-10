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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_id')->unique();
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->string('address')->nullable();;
            $table->date('birth_date')->nullable();
            $table->integer('age')->nullable();;
            $table->char('gender')->nullable();;
            $table->float('weight')->nullable();;
            $table->integer('height')->nullable();;
            $table->string('emergency_contact_number')->nullable();;
            $table->string('health_objective')->nullable();;

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
