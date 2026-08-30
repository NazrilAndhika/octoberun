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
        Schema::table('event_settings', function (Blueprint $table) {
            $table->enum('payment_mode', ['otomatis', 'manual'])->default('otomatis');
            $table->string('manual_bank_name')->nullable();
            $table->string('manual_bank_account')->nullable();
            $table->string('manual_bank_owner')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('event_settings', function (Blueprint $table) {
            $table->dropColumn([
                'payment_mode',
                'manual_bank_name',
                'manual_bank_account',
                'manual_bank_owner'
            ]);
        });
    }
};
