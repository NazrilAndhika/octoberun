<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('participants', function (Blueprint $table) {
            // Tambah kolom kategori setelah order_id
            $table->string('kategori')->default('5K')->after('order_id');
            // Tambah expired_at untuk auto-expire 24 jam
            $table->timestamp('payment_expired_at')->nullable()->after('snap_token');
        });
    }

    public function down(): void
    {
        Schema::table('participants', function (Blueprint $table) {
            $table->dropColumn(['kategori', 'payment_expired_at']);
        });
    }
};
