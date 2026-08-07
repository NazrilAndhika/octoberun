<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Scope: hanya yang aktif, urut berdasarkan order
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }
}
