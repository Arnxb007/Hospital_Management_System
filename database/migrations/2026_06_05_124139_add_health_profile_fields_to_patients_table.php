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
        Schema::table('patients', function (Blueprint $table) {

            $table->boolean('has_diabetes')->default(false);
            $table->boolean('has_hypertension')->default(false);
            $table->boolean('has_heart_disease')->default(false);
            $table->boolean('has_asthma')->default(false);

            $table->text('current_medications')->nullable();

            $table->text('past_surgeries')->nullable();

            $table->date('last_health_checkup')->nullable();

            $table->boolean('smoker')->default(false);

            $table->boolean('alcohol_consumer')->default(false);

            $table->text('family_medical_history')->nullable();

            $table->text('additional_notes')->nullable();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            //
        });
    }
};
