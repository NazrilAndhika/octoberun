<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Participant;
use App\Models\EventSetting;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class RegistrationController extends Controller
{
    // Harga flat 5K (bisa diubah dari sini nanti)
    const HARGA_TIKET  = 150000;
    const BIAYA_ADMIN  = 5000;
    const TOTAL_BAYAR  = self::HARGA_TIKET + self::BIAYA_ADMIN;

    // -------------------------------------------------------
    // GET /daftar  → tampilkan form
    // -------------------------------------------------------
    public function index()
    {
        $settings = EventSetting::first();
        return view('user.daftar', compact('settings'));
    }

    // -------------------------------------------------------
    // POST /daftar  → simpan data, redirect ke pembayaran
    // -------------------------------------------------------
    public function store(Request $request)
    {
        $request->validate([
            'bib_name'   => 'required|string|max:10',
            'full_name'  => 'required|string|max:255',
            'id_number'  => 'required|string|max:50',
            'jersey_size'=> 'required|in:XS,S,M,L,XL,XXL',
            'email'      => 'required|email|max:255',
            'whatsapp'   => 'required|string|max:20',
            'address'    => 'required|string',
            'gender'     => 'required|in:male,female',
            'city'       => 'required|string|max:100',
        ], [
            'bib_name.required'    => 'Nama BIB wajib diisi.',
            'bib_name.max'         => 'Nama BIB maksimal 10 huruf.',
            'full_name.required'   => 'Nama lengkap wajib diisi.',
            'id_number.required'   => 'Nomor KTP/Passport wajib diisi.',
            'jersey_size.required' => 'Pilih ukuran jersey.',
            'email.required'       => 'Email wajib diisi.',
            'email.email'          => 'Format email tidak valid.',
            'whatsapp.required'    => 'Nomor WhatsApp wajib diisi.',
            'address.required'     => 'Alamat wajib diisi.',
            'gender.required'      => 'Jenis kelamin wajib dipilih.',
            'city.required'        => 'Kota wajib diisi.',
        ]);

        // Generate Order ID unik
        $orderId = 'ORD-' . now()->format('Ymd') . '-' . strtoupper(Str::random(6));

        // Simpan ke database dengan status PENDING
        $participant = Participant::create([
            'order_id'           => $orderId,
            'kategori'           => '5K',
            'gross_amount'       => self::TOTAL_BAYAR,
            'payment_status'     => 'pending',
            'payment_method'     => 'manual_transfer',
            'bib_name'           => strtoupper($request->bib_name),
            'full_name'          => $request->full_name,
            'id_number'          => $request->id_number,
            'jersey_size'        => $request->jersey_size,
            'email'              => $request->email,
            'whatsapp'           => $request->whatsapp,
            'address'            => $request->address,
            'gender'             => $request->gender,
            'city'               => $request->city,
            'payment_expired_at' => now()->addHours(24),
        ]);

        // Redirect ke halaman pembayaran dengan order_id
        return redirect()->route('pembayaran.show', $participant->order_id)
                         ->with('registered', true);
    }

    // -------------------------------------------------------
    // GET /pembayaran/{order_id}  → tampilkan halaman bayar
    // -------------------------------------------------------
    public function showPembayaran($order_id)
    {
        $participant = Participant::where('order_id', $order_id)->firstOrFail();
        return view('user.pembayaran', compact('participant'));
    }

    // -------------------------------------------------------
    // POST /pembayaran/upload-bukti  → terima foto bukti
    // -------------------------------------------------------
    public function uploadBukti(Request $request)
    {
        $request->validate([
            'order_id'      => 'required|exists:participants,order_id',
            'payment_proof' => 'required|image|mimes:jpg,jpeg,png|max:3072',
        ], [
            'payment_proof.required' => 'Foto bukti transfer wajib diupload.',
            'payment_proof.image'    => 'File harus berupa gambar (JPG/PNG).',
            'payment_proof.max'      => 'Ukuran foto maksimal 3MB.',
        ]);

        $participant = Participant::where('order_id', $request->order_id)->firstOrFail();

        // Tolak jika sudah paid
        if ($participant->payment_status === 'paid') {
            return back()->with('error', 'Pembayaran ini sudah dikonfirmasi sebagai LUNAS.');
        }

        // Hapus bukti lama jika ada
        if ($participant->payment_proof && Storage::disk('public')->exists($participant->payment_proof)) {
            Storage::disk('public')->delete($participant->payment_proof);
        }

        // Simpan bukti baru
        $path = $request->file('payment_proof')->store('bukti-bayar', 'public');

        $participant->update([
            'payment_proof'  => $path,
            'payment_status' => 'pending', // tetap pending sampai admin konfirmasi
        ]);

        return redirect()->route('pembayaran.sukses', $participant->order_id);
    }

    // -------------------------------------------------------
    // GET /pembayaran/sukses/{order_id}
    // -------------------------------------------------------
    public function sukses($order_id)
    {
        $participant = Participant::where('order_id', $order_id)->firstOrFail();
        return view('user.sukses', compact('participant'));
    }

    // -------------------------------------------------------
    // GET /cek-status
    // -------------------------------------------------------
    public function cekStatus(Request $request)
    {
        $participant = null;
        $settings = EventSetting::first();
        
        if ($request->filled('order_id')) {
            $orderId = trim($request->order_id);
            $participant = Participant::where('order_id', 'like', '%' . $orderId)->first();
        }

        return view('user.cek-status', compact('participant', 'settings'));
    }

    // Legacy method (kept for compatibility)
    public function payment()
    {
        return redirect()->route('daftar');
    }
}