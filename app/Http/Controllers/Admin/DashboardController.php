<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Participant; // Pastikan memanggil model pendaftar buatan Annisa
use App\Models\EventSetting;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Tangkap parameter tahun dari dropdown filter, default ke tahun saat ini
        $selectedYear = $request->query('year', date('Y'));

        // Ambil daftar tahun unik dari data pendaftar untuk opsi dropdown
        $availableYears = Participant::select(DB::raw('YEAR(created_at) as year'))
                            ->distinct()
                            ->orderBy('year', 'desc')
                            ->pluck('year')
                            ->toArray();
                            
        // Pastikan tahun saat ini ada di dalam list meskipun belum ada data
        if (!in_array(date('Y'), $availableYears)) {
            $availableYears[] = date('Y');
            rsort($availableYears);
        }

        // 1. Ambil target kuota dari pengaturan website
        $settings = EventSetting::first();
        $kuotaTotal = $settings ? (int) $settings->target_runners : 0;

        // 2. Hitung statistik dari tabel participants (Bisa difilter per tahun jika mau, tapi biasanya total pendaftar dihitung keseluruhan atau sesuai logika awal)
        $totalPendaftar = Participant::count();
        $sisaKuota = $kuotaTotal - $totalPendaftar;
        
        $lunas = Participant::where('payment_status', 'paid')->count();
        $pending = Participant::where('payment_status', 'pending')->count();

        // 3. Hitung Total Pendapatan berdasarkan Tahun
        $totalPendapatan = Participant::where('payment_status', 'paid')
                                ->whereYear('created_at', $selectedYear)
                                ->sum('gross_amount');

        // 4. Hitung Pendapatan per Bulan untuk Grafik
        $monthlyIncomeRaw = Participant::select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(gross_amount) as total'))
                                ->where('payment_status', 'paid')
                                ->whereYear('created_at', $selectedYear)
                                ->groupBy('month')
                                ->pluck('total', 'month')
                                ->toArray();

        // Siapkan array data 12 bulan (Jan - Des)
        $monthlyIncomeData = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyIncomeData[] = $monthlyIncomeRaw[$i] ?? 0;
        }

        // 5. Ambil 5 data terbaru untuk tabel ringkasan
        $recentParticipants = Participant::orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.dashboard', compact(
            'kuotaTotal', 'totalPendaftar', 'sisaKuota', 'lunas', 'pending', 
            'recentParticipants', 'totalPendapatan', 'monthlyIncomeData', 
            'selectedYear', 'availableYears'
        ));
    }
}