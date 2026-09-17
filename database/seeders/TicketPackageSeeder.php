<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $packages = [
            [
                'nama_paket' => 'REGULER',
                'harga' => 75000,
                'deskripsi' => 'Paket dasar untuk pengalaman lari yang menyenangkan.',
                'benefits' => json_encode(['Jersey Event', 'Nomor BIB']),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_paket' => 'PREMIUM',
                'harga' => 125000,
                'deskripsi' => 'Pengalaman lari yang lebih berkesan dengan benefit tambahan.',
                'benefits' => json_encode(['Jersey Event', 'Nomor BIB', 'Medali Finisher', 'Goodie Bag']),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_paket' => 'EKSEKUTIF',
                'harga' => 165000,
                'deskripsi' => 'Paket terlengkap untuk pengalaman lari tak terlupakan.',
                'benefits' => json_encode(['Jersey Event', 'Nomor BIB', 'Medali Finisher', 'Goodie Bag Premium', 'Akses VIP Lounge', 'Refreshment Ekstra']),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        \Illuminate\Support\Facades\DB::table('ticket_packages')->insert($packages);
    }
}
