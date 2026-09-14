<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateBibExisting extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:bib-existing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate BIB numbers for existing participants with paid status and null bib_number';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Mencari data peserta Lunas yang belum memiliki Nomor BIB...');

        $participants = \App\Models\Participant::where('payment_status', 'paid')
                            ->whereNull('bib_number')
                            ->orderBy('created_at', 'asc')
                            ->get();

        if ($participants->isEmpty()) {
            $this->info('Semua peserta Lunas sudah memiliki Nomor BIB. Tidak ada yang perlu diupdate.');
            return;
        }

        $this->info('Ditemukan ' . $participants->count() . ' peserta. Mulai memproses...');

        $bar = $this->output->createProgressBar($participants->count());
        $bar->start();

        foreach ($participants as $participant) {
            $participant->generateBibNumber(true); // Pass true to save quietly
            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);
        $this->info('Selesai! Semua peserta Lunas kini telah memiliki Nomor BIB.');
    }
}
