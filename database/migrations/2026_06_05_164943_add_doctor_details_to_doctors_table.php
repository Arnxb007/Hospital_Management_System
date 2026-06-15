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
        Schema::table('doctors', function (Blueprint $table) {

           // $table->foreignId('specialization_id')->nullable();

           // $table->string('qualification')->nullable();

           // $table->integer('experience_years')->nullable();

           // $table->decimal('consultation_fee',8,2)->nullable();

           // $table->text('about')->nullable();

           // $table->boolean('profile_completed')->default(false);

           // $table->string('profile_image')->nullable();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('doctors', function (Blueprint $table) {
            //
        });
    }
};
