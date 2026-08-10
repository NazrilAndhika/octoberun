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
        Schema::table('participants', function (Blueprint $table) {
            $table->boolean('is_racepack_taken')->default(false)->after('payment_status');
            $table->timestamp('racepack_taken_at')->nullable()->after('is_racepack_taken');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('participants', function (Blueprint $table) {
            $table->dropColumn(['is_racepack_taken', 'racepack_taken_at']);
        });
    }
};
