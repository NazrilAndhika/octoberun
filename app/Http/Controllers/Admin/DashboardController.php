<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Participant;
use App\Models\EventSetting;
use App\Models\TicketPackage;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // 1. Auto-Expire Logic (Real-time trigger)
        Participant::where('payment_status', 'pending')
            ->where('created_at', '<=', now()->subHours(24))
            ->update(['payment_status' => 'expired']);

        $settings = EventSetting::first();
        $kuotaTotal = $settings ? (int) $settings->target_runners : 0;

        // Tangkap parameter filter
        $filterPaket = $request->query('paket_id', 'semua');
        $filterWaktu = $request->query('waktu', 'tahun_ini'); // default tahun ini biar grafik jalan
        
        $startDate = null;
        $endDate = null;

        if ($filterWaktu === 'hari_ini') {
            $startDate = Carbon::today();
            $endDate = Carbon::today()->endOfDay();
        } elseif ($filterWaktu === 'bulan_ini') {
            $startDate = Carbon::now()->startOfMonth();
            $endDate = Carbon::now()->endOfMonth();
        } elseif ($filterWaktu === 'tahun_ini') {
            $startDate = Carbon::now()->startOfYear();
            $endDate = Carbon::now()->endOfYear();
        } elseif ($filterWaktu === 'custom') {
            $startDate = $request->query('start_date') ? Carbon::parse($request->query('start_date'))->startOfDay() : null;
            $endDate = $request->query('end_date') ? Carbon::parse($request->query('end_date'))->endOfDay() : null;
        }

        // Base Query untuk filter
        $query = Participant::query();

        if ($filterPaket !== 'semua') {
            $query->where('ticket_package_id', $filterPaket);
        }

        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        } elseif ($startDate) {
            $query->where('created_at', '>=', $startDate);
        } elseif ($endDate) {
            $query->where('created_at', '<=', $endDate);
        }

        // Hitung statistik menggunakan base query
        $totalPendaftar = (clone $query)->whereIn('payment_status', ['paid', 'pending', 'verifying'])->count();
        $lunas = (clone $query)->where('payment_status', 'paid')->count();
        $pending = (clone $query)->where('payment_status', 'pending')->count();
        $expired = (clone $query)->where('payment_status', 'expired')->count();
        
        $totalPendapatan = (clone $query)->where('payment_status', 'paid')->sum('gross_amount');

        // Sisa kuota tetap global, dikurangi total peserta aktif global (bukan yang difilter)
        $totalPesertaAktifGlobal = Participant::whereIn('payment_status', ['paid', 'pending', 'verifying'])->count();
        $sisaKuota = $kuotaTotal - $totalPesertaAktifGlobal;

        // Breakdown Pendapatan per Paket Tiket
        $breakdownQuery = (clone $query)->where('payment_status', 'paid')
                                ->select('ticket_package_id', DB::raw('COUNT(id) as total_orang'), DB::raw('SUM(gross_amount) as total_uang'))
                                ->groupBy('ticket_package_id')
                                ->get();
                                
        // Mapping package name
        $packages = TicketPackage::all()->keyBy('id');
        $breakdownData = [];
        foreach($breakdownQuery as $row) {
            $pkgName = isset($packages[$row->ticket_package_id]) ? $packages[$row->ticket_package_id]->nama_paket : 'Early Bird';
            $breakdownData[] = [
                'nama' => $pkgName,
                'orang' => $row->total_orang,
                'uang' => $row->total_uang,
                'persentase' => $totalPendapatan > 0 ? round(($row->total_uang / $totalPendapatan) * 100, 1) : 0
            ];
        }

        // Grafik Pendapatan Bulanan (Filter waktu tidak mempengaruhi grafik ini, hanya filter Paket)
        $chartYear = date('Y');
        if ($filterWaktu === 'custom' && $startDate) {
            $chartYear = $startDate->format('Y');
        }

        $monthlyQuery = Participant::where('payment_status', 'paid')
                                 ->whereYear('created_at', $chartYear);
        
        if ($filterPaket !== 'semua') {
            $monthlyQuery->where('ticket_package_id', $filterPaket);
        }

        $monthlyIncomeRaw = $monthlyQuery->select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(gross_amount) as total'))
                                ->groupBy('month')
                                ->pluck('total', 'month')
                                ->toArray();

        $monthlyIncomeData = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyIncomeData[] = $monthlyIncomeRaw[$i] ?? 0;
        }

        $recentParticipants = (clone $query)->orderBy('created_at', 'desc')->take(5)->get();

        $ticketPackages = TicketPackage::all();

        return view('admin.dashboard', compact(
            'kuotaTotal', 'totalPendaftar', 'sisaKuota', 'lunas', 'pending', 'expired',
            'recentParticipants', 'totalPendapatan', 'monthlyIncomeData', 
            'filterPaket', 'filterWaktu', 'ticketPackages', 'breakdownData', 'chartYear',
            'startDate', 'endDate'
        ));
    }
}