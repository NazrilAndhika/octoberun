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
            $table->dropColumn([
                'benefit_1_title', 'benefit_1_desc',
                'benefit_2_title', 'benefit_2_desc',
                'benefit_3_title', 'benefit_3_desc',
                'benefit_4_title', 'benefit_4_desc',
            ]);
            $table->json('racepack_benefits')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('event_settings', function (Blueprint $table) {
            $table->dropColumn('racepack_benefits');
            $table->string('benefit_1_title')->nullable();
            $table->string('benefit_1_desc')->nullable();
            $table->string('benefit_2_title')->nullable();
            $table->string('benefit_2_desc')->nullable();
            $table->string('benefit_3_title')->nullable();
            $table->string('benefit_3_desc')->nullable();
            $table->string('benefit_4_title')->nullable();
            $table->string('benefit_4_desc')->nullable();
        });
    }
};
