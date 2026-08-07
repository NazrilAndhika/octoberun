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
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            
            // --- DATA TRANSAKSI / PAYMENT GATEWAY ---
            $table->string('order_id')->unique(); // Contoh: INV-2026-XXXXX
            $table->integer('gross_amount'); // Total bayar, misal: 305000
            $table->string('payment_status')->default('pending'); // pending, paid, failed, expired
            $table->string('payment_method')->nullable(); // bank_transfer, gopay, qris, dll
            $table->string('payment_proof')->nullable(); // Kolom untuk upload bukti TF manual jika diperlukan
            $table->string('snap_token')->nullable(); // Token khusus dari Midtrans untuk memunculkan pop-up bayar

            // --- DATA DIRI PESERTA (Sesuai Form) ---
            $table->string('bib_name', 10); // Maksimal 10 huruf sesuai form
            $table->string('full_name');
            $table->string('id_number'); // KTP / Passport
            $table->string('jersey_size');
            $table->string('email');
            $table->string('whatsapp');
            $table->text('address');
            $table->string('gender');
            $table->string('city');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
