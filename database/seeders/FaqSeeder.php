<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faq;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'question'  => 'Kapan event OCTOBERUN 2026 dilaksanakan?',
                'answer'    => 'Event OCTOBERUN 2026 akan dilaksanakan pada hari Minggu, 18 Oktober 2026. Jadwal flag-off akan diinformasikan lebih lanjut mendekati hari H.',
                'order'     => 1,
                'is_active' => true,
            ],
            [
                'question'  => 'Bagaimana Cara Pendaftaran?',
                'answer'    => 'Pendaftaran bisa dilakukan secara online melalui tombol "Daftar Sekarang" di website ini. Silakan isi form dan selesaikan pembayaran.',
                'order'     => 2,
                'is_active' => true,
            ],
            [
                'question'  => 'Dimana lokasi Start & Finish?',
                'answer'    => 'Lokasi Start dan Finish berada di Alun-Alun Kota. Rute lengkap bisa dilihat di bagian info rute pada website.',
                'order'     => 3,
                'is_active' => true,
            ],
            [
                'question'  => 'Apa yang saya dapatkan jika mendaftar?',
                'answer'    => 'Kamu akan mendapatkan Jersey Premium, Nomor Dada (BIB), Medali Finisher, dan donasi 1 bibit pohon atas namamu.',
                'order'     => 4,
                'is_active' => true,
            ],
            [
                'question'  => 'Apakah pendaftaran bisa dibatalkan?',
                'answer'    => 'Pendaftaran yang sudah lunas tidak dapat dibatalkan atau direfund (dikembalikan uangnya) dengan alasan apapun.',
                'order'     => 5,
                'is_active' => true,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
