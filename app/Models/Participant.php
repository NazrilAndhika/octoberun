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
}