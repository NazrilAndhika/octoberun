<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventSetting extends Model
{
    use HasFactory;

    // Tambahkan baris ini untuk menonaktifkan blokir keamanan (mengizinkan form disubmit)
    protected $guarded = [];

    protected $casts = [
        'racepack_benefits' => 'array',
    ];
}