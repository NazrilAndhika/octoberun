<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Participant; // Pastikan memanggil model pendaftar buatan Annisa
use App\Models\EventSetting;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil target kuota dari pengaturan website
        $settings = EventSetting::first();
        $kuotaTotal = $settings ? (int) $settings->target_runners : 0;

        // 2. Hitung statistik dari tabel participants
        $totalPendaftar = Participant::count();
        $sisaKuota = $kuotaTotal - $totalPendaftar;
        
 
        // ... kode sebelumnya ...
        $lunas = Participant::where('payment_status', 'paid')->count();
        $pending = Participant::where('payment_status', 'pending')->count();
        // ... kode setelahnya ...

        // 3. Ambil 5 data terbaru untuk tabel ringkasan
        $recentParticipants = Participant::orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.dashboard', compact(
            'kuotaTotal', 'totalPendaftar', 'sisaKuota', 'lunas', 'pending', 'recentParticipants'
        ));
    }
}