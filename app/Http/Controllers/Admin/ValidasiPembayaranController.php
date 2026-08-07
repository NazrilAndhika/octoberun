<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ValidasiPembayaranController extends Controller
{
    public function index(Request $request)
    {
        $query = Participant::whereNotNull('payment_proof'); // Hanya yang sudah upload bukti

        // Filter tab: semua | pending | paid
        $tab = $request->input('tab', 'semua');
        if ($tab === 'pending') {
            $query->where('payment_status', 'pending');
        } elseif ($tab === 'lunas') {
            $query->where('payment_status', 'paid');
        }

        // Filter tanggal (berdasarkan created_at)
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Hitung badge tab
        $totalSemua  = Participant::whereNotNull('payment_proof')->count();
        $totalPending = Participant::whereNotNull('payment_proof')->where('payment_status', 'pending')->count();
        $totalLunas  = Participant::whereNotNull('payment_proof')->where('payment_status', 'paid')->count();

        $perPage = $request->input('per_page', 10);
        $participants = $query->latest()->paginate($perPage)->appends($request->query());

        return view('admin.validasi_pembayaran', compact(
            'participants',
            'tab',
            'totalSemua',
            'totalPending',
            'totalLunas',
            'perPage'
        ));
    }

    /**
     * Verifikasi → status = paid (LUNAS)
     */
    public function verifikasi($id)
    {
        $participant = Participant::findOrFail($id);
        $participant->update(['payment_status' => 'paid']);
        return back()->with('success', "Pembayaran {$participant->order_id} berhasil diverifikasi sebagai LUNAS ✅");
    }

    /**
     * Tolak → status = failed
     */
    public function tolak($id)
    {
        $participant = Participant::findOrFail($id);
        $participant->update(['payment_status' => 'failed']);
        return back()->with('error', "Pembayaran {$participant->order_id} telah ditolak ❌");
    }
}
