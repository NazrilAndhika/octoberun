<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Participant;
use App\Models\EventSetting;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\ETicketMail;

class VerificationController extends Controller
{
    public function index()
    {
        // Ambil data peserta yang status pembayarannya sedang diverifikasi
        $participants = Participant::where('payment_status', 'verifying')->latest()->paginate(10);
        return view('admin.verifikasi', compact('participants'));
    }

    public function terima($id)
    {
        $participant = Participant::findOrFail($id);
        $settings = EventSetting::first() ?? new EventSetting();

        $participant->payment_status = 'paid';
        $participant->save();

        // Kirim E-Ticket via Email
        try {
            Mail::to($participant->email)->send(new ETicketMail($participant, $settings));
            Log::info("Manual Verification: E-Ticket sent to {$participant->email} for Order ID: {$participant->order_id}");
        } catch (\Exception $e) {
            Log::error("Manual Verification: Failed to send E-Ticket for Order ID: {$participant->order_id}. Error: " . $e->getMessage());
            // Kita tidak perlu membatalkan status lunas jika email gagal, karena bisa dikirim ulang dari halaman data pendaftar.
        }

        return back()->with('success', 'Pembayaran berhasil diverifikasi & dilunaskan. E-Ticket dikirim.');
    }

    public function tolak($id)
    {
        $participant = Participant::findOrFail($id);
        
        // Ubah menjadi rejected
        $participant->payment_status = 'rejected';
        // Hapus path payment proof agar bisa upload lagi
        $participant->payment_proof = null;
        $participant->save();

        return back()->with('success', 'Pembayaran ditolak. Status dikembalikan menjadi ditolak agar pendaftar bisa upload ulang.');
    }
}
