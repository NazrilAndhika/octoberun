<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketPackage extends Model
{
    protected $fillable = [
        'nama_paket',
        'harga',
        'deskripsi',
        'gambar_benefit',
        'benefits',
        'is_active',
    ];

    protected $casts = [
        'benefits' => 'array',
        'is_active' => 'boolean',
    ];
}
