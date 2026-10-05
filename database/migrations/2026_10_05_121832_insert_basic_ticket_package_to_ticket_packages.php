<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('ticket_packages')->insert([
            'nama_paket' => 'BASIC',
            'harga' => 35000,
            'deskripsi' => 'Paket dasar untuk bergabung dan berlari bersama kami.',
            'benefits' => json_encode(['Nomor BIB', 'Refreshment']),
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('ticket_packages')->where('nama_paket', 'BASIC')->where('harga', 35000)->delete();
    }
};
