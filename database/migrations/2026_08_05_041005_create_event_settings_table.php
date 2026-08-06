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
        Schema::create('event_settings', function (Blueprint $table) {
            $table->id();
            
            // --- KELOMPOK HERO SECTION ---
            $table->string('event_name')->default('OCTOBERUN 2026'); 
            $table->string('hero_title')->default('RUN BEYOND LIMITS'); 
            $table->string('hero_image')->nullable(); 
            
            // --- KELOMPOK STATISTIK (BANNER BIRU) ---
            $table->string('target_runners')->default('3.000+');
            $table->string('event_date')->default('18 OKTOBER 2026');
            
            // --- KELOMPOK TENTANG KAMI ---
            $table->string('about_title')->default('LEBIH DARI SEKEDAR LARI, INI TENTANG PERUBAHAN.');
            $table->text('about_text')->nullable(); // Pakai tipe 'text' karena isinya paragraf panjang
            $table->string('about_image')->nullable(); // Kolom khusus untuk foto tentang kami
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_settings');
    }
};
