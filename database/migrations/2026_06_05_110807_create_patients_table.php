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
        Schema::create('patients', function (Blueprint $table) {

        $table->id();

        $table->foreignId('user_id')
            ->constrained()
            ->onDelete('cascade');

        $table->date('date_of_birth')->nullable();

        $table->enum('gender', [
            'male',
            'female',
            'other'
        ])->nullable();

        $table->string('blood_group')->nullable();

        $table->decimal('height', 5, 2)->nullable();

        $table->decimal('weight', 5, 2)->nullable();

        $table->text('address')->nullable();

        $table->string('emergency_contact')->nullable();

        $table->text('allergies')->nullable();

        $table->text('medical_history')->nullable();

        $table->boolean('profile_completed')->default(false);

        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
