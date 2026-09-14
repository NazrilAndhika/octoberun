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
            if (!Schema::hasColumn('participants', 'birth_place')) {
                $table->string('birth_place', 100)->nullable();
            }
            if (!Schema::hasColumn('participants', 'birth_date')) {
                $table->date('birth_date')->nullable();
            }
            if (!Schema::hasColumn('participants', 'blood_type')) {
                $table->string('blood_type', 20)->nullable();
            }
            if (!Schema::hasColumn('participants', 'emergency_contact_name')) {
                $table->string('emergency_contact_name', 255)->nullable();
            }
            if (!Schema::hasColumn('participants', 'emergency_contact_phone')) {
                $table->string('emergency_contact_phone', 20)->nullable();
            }
            if (!Schema::hasColumn('participants', 'emergency_contact_relation')) {
                $table->string('emergency_contact_relation', 50)->nullable();
            }
            if (!Schema::hasColumn('participants', 'medical_history')) {
                $table->text('medical_history')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('participants', function (Blueprint $table) {
            $columns = [
                'birth_place', 
                'birth_date', 
                'blood_type', 
                'emergency_contact_name', 
                'emergency_contact_phone', 
                'emergency_contact_relation', 
                'medical_history'
            ];
            
            foreach ($columns as $column) {
                if (Schema::hasColumn('participants', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
