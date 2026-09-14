<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    // Mengizinkan penyimpanan data secara otomatis
    protected $guarded = [];

    // Cast the racepack_taken_at column to a datetime instance
    protected $casts = [
        'racepack_taken_at' => 'datetime',
    ];

    /**
     * Generate Nomor BIB otomatis berdasarkan gender
     */
    public function generateBibNumber($silent = false)
    {
        if ($this->bib_number) {
            return $this->bib_number; // Jika sudah ada, jangan di-generate lagi
        }

        $prefix = strtolower($this->gender) === 'male' ? 'M' : 'F';
        $startNumber = strtolower($this->gender) === 'male' ? 1000 : 2000;

        // Cari nomor BIB terbesar dengan prefix M atau F (ambil angkanya saja)
        $latest = self::where('bib_number', 'like', $prefix . '%')
                      ->orderByRaw('CAST(SUBSTRING(bib_number, 2) AS UNSIGNED) DESC')
                      ->first();

        if ($latest && $latest->bib_number) {
            $number = (int) substr($latest->bib_number, 1);
            $newNumber = $number + 1;
        } else {
            $newNumber = $startNumber + 1;
        }

        $this->bib_number = $prefix . $newNumber;
        
        if ($silent) {
            $this->saveQuietly();
        } else {
            $this->save();
        }

        return $this->bib_number;
    }
}