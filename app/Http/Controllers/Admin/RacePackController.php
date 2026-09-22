<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Participant;

class RacePackController extends Controller
{
    /**
     * Tampilkan halaman utama loket Distribusi Race Pack
     */
    public function index(Request $request)
    {
        $participants = [];
        $searchPerformed = false;
        $kode = trim($request->query('kode'));

        $totalDistributed = Participant::where('is_racepack_taken', true)->count();
        $totalPaid = Participant::where('payment_status', 'paid')->count();

        // Lakukan pencarian jika panitia memasukkan kode
        if (!empty($kode)) {
            $searchPerformed = true;
            // Cari data berdasarkan order_id, nama_lengkap, nik, atau email, dan pastikan sudah lunas
            $participants = Participant::with('ticketPackage')
                                      ->where(function ($query) use ($kode) {
                                          $query->where('order_id', 'LIKE', '%' . $kode . '%')
                                                ->orWhere('full_name', 'LIKE', '%' . $kode . '%')
                                                ->orWhere('id_number', 'LIKE', '%' . $kode . '%')
                                                ->orWhere('email', 'LIKE', '%' . $kode . '%');
                                      })
                                      ->where('payment_status', 'paid')
                                      ->get();
        }

        return view('admin.racepack.index', compact('participants', 'searchPerformed', 'kode', 'totalDistributed', 'totalPaid'));
    }

    /**
     * Proses konfirmasi pengambilan Race Pack
     */
    public function confirm($id)
    {
        $participant = Participant::findOrFail($id);

        // Validasi ekstra (untuk keamanan ganda)
        if ($participant->payment_status !== 'paid') {
            return back()->with('error', 'GAGAL: Status pembayaran peserta ini belum Lunas.');
        }

        if ($participant->is_racepack_taken) {
            return back()->with('error', 'GAGAL: Race Pack untuk tiket ini SUDAH DIAMBIL pada ' . ($participant->racepack_taken_at ? $participant->racepack_taken_at->format('d M Y H:i') : 'waktu yang lalu') . '.');
        }

        // Tandai sebagai sudah diambil
        $participant->update([
            'is_racepack_taken' => true,
            'racepack_taken_at' => now(),
        ]);

        return back()->with('success', 'BERHASIL! Race Pack atas nama ' . $participant->full_name . ' (' . $participant->jersey_size . ') telah diserahkan.');
    }
}
