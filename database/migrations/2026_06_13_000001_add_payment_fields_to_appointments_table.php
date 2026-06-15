<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->decimal('consultation_fee', 10, 2)->nullable()->after('reason');
            $table->decimal('payment_amount', 10, 2)->nullable()->after('consultation_fee');
            $table->string('payment_status')->default('paid')->after('payment_amount');
            $table->string('payment_method')->nullable()->after('payment_status');
            $table->string('payment_transaction_id')->nullable()->after('payment_method');
            $table->timestamp('paid_at')->nullable()->after('payment_transaction_id');
        });
    }

    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn([
                'consultation_fee',
                'payment_amount',
                'payment_status',
                'payment_method',
                'payment_transaction_id',
                'paid_at',
            ]);
        });
    }
};
