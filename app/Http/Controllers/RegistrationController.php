<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Participant;
use App\Models\EventSetting;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\ETicketMail;
use Illuminate\Validation\Rule;

class RegistrationController extends Controller
{
    // Konstanta hardcode lama telah dihapus dan diganti dengan database dinamis

    // -------------------------------------------------------
    // GET /daftar  → tampilkan form
    // -------------------------------------------------------
    // -------------------------------------------------------
    // GET /daftar  → tampilkan form
    // -------------------------------------------------------
    public function index()
    {
        $settings = EventSetting::first();
        
        // --- TAMBAHKAN PROTEKSI PENUTUPAN DI SINI ---
        if (!$settings || $settings->is_registration_open == false || now()->greaterThan($settings->registration_deadline)) {
            return redirect('/')->with('error', 'Mohon maaf, pendaftaran OCTOBERUN 2026 saat ini sedang ditutup.');
        }
        // --------------------------------------------

        $kapasitasMaksimal = (int) ($settings->target_runners ?? 0);
        $jumlahPendaftar = Participant::whereIn('payment_status', ['paid', 'pending'])->count();
        
        if ($kapasitasMaksimal - $jumlahPendaftar <= 0) {
            return redirect('/')->with('error', 'Maaf, kuota pendaftaran sudah penuh!');
        }

        return view('user.daftar', compact('settings'));
    }

    // -------------------------------------------------------
    // POST /daftar  → simpan data, redirect ke pembayaran
    // -------------------------------------------------------
    public function store(Request $request)
    {
        $settings = EventSetting::first() ?? new EventSetting();

        // --- UBAH BAGIAN INI MENJADI DEADLINE ---
        if (!$settings || $settings->is_registration_open == false || now()->greaterThan($settings->registration_deadline)) {
            return redirect('/')->with('error', 'Mohon maaf, pendaftaran OCTOBERUN 2026 saat ini sedang ditutup.');
        }
        // ----------------------------------------

        // Cek Kuota
        $kapasitasMaksimal = (int) ($settings->target_runners ?? 0);
        $jumlahPendaftar = Participant::whereIn('payment_status', ['paid', 'pending'])->count();
        
        if ($kapasitasMaksimal - $jumlahPendaftar <= 0) {
            return redirect('/')->with('error', 'Maaf, kuota pendaftaran sudah penuh!');
        }

        // ... (Kodingan validasi dan simpan ke bawahnya tetap sama, biarkan saja) ...

        $request->validate([
            'full_name'  => 'required|string|max:255',
            'nik'        => 'required|numeric|digits:16',
            'jersey_size'=> 'required|in:S,M,L,XL,XXL,3XL,4XL,Custom Size',
            'custom_lebar'   => 'required_if:jersey_size,Custom Size|nullable|numeric',
            'custom_panjang' => 'required_if:jersey_size,Custom Size|nullable|numeric',
            'email'      => 'required|email:rfc,dns|max:255',
            'whatsapp'   => 'required|string|max:20',
            'address'    => 'required|string',
            'gender'     => 'required|in:male,female',
            'city'       => 'required|string|max:100',
        ], [
            'full_name.required'   => 'Nama lengkap wajib diisi.',
            'nik.required'         => 'NIK wajib diisi.',
            'nik.numeric'          => 'NIK harus berupa angka.',
            'nik.digits'           => 'NIK harus tepat 16 digit.',
            'jersey_size.required' => 'Pilih ukuran jersey.',
            'jersey_size.in'       => 'Ukuran jersey tidak valid.',
            'custom_lebar.required_if'   => 'Lebar wajib diisi jika memilih Custom Size.',
            'custom_panjang.required_if' => 'Panjang wajib diisi jika memilih Custom Size.',
            'email.required'       => 'Email wajib diisi.',
            'email.email'          => 'Format email tidak valid.',
            'whatsapp.required'    => 'Nomor WhatsApp wajib diisi.',
            'address.required'     => 'Alamat wajib diisi.',
            'gender.required'      => 'Jenis kelamin wajib dipilih.',
            'city.required'        => 'Kota wajib diisi.',
        ]);

        // Generate Order ID unik
        $orderId = 'ORD-' . now()->format('Ymd') . '-' . strtoupper(Str::random(6));

        $settings = EventSetting::first() ?? new EventSetting();
        $ticketPrice = $settings->ticket_price ?? 150000;
        $adminFee = $settings->admin_fee ?? 5000;
        
        $kodeUnik = 0;
        if (($settings->payment_mode ?? 'otomatis') === 'manual') {
            do {
                $kodeUnik = rand(100, 500);
                // Cek apakah ada order dengan kode unik yang sama dan statusnya gantung (pending/verifying)
                $exists = Participant::where('kode_unik', $kodeUnik)
                                     ->whereIn('payment_status', ['pending', 'verifying'])
                                     ->exists();
            } while ($exists);
        }

        $grossAmount = $ticketPrice + $adminFee + $kodeUnik;

        // Cek NIK manual
        $existingParticipant = Participant::where('id_number', $request->nik)->first();
                                          
        if ($existingParticipant) {
            // Jika transaksi dengan NIK tersebut berstatus "Lunas", "Menunggu Pembayaran", atau "Menunggu Verifikasi"
            if (in_array($existingParticipant->payment_status, ['paid', 'pending', 'verifying'])) {
                return back()->withInput()->withErrors(['nik' => 'Maaf, NIK ini sudah terdaftar dan sedang dalam proses atau sudah lunas.']);
            }
            
            // Jika expired/failed/ditolak, update data lama
            $participant = $existingParticipant;
            
            // Hapus bukti bayar lama jika ada
            if ($participant->payment_proof && Storage::disk('public')->exists($participant->payment_proof)) {
                Storage::disk('public')->delete($participant->payment_proof);
            }

            $participant->update([
                'order_id'           => $orderId,
                'kategori'           => '5K',
                'gross_amount'       => $grossAmount,
                'kode_unik'          => $kodeUnik,
                'payment_status'     => 'pending',
                'payment_method'     => null,
                'payment_proof'      => null, // Reset payment proof
                'bib_name'           => '-', // Generic/empty as requested
                'full_name'          => $request->full_name,
                'id_number'          => $request->nik,
                'jersey_size'        => $request->jersey_size,
                'custom_size_note'   => $request->jersey_size === 'Custom Size' ? 'lebar ' . $request->custom_lebar . ' x panjang ' . $request->custom_panjang : null,
                'email'              => $request->email,
                'whatsapp'           => $request->whatsapp,
                'address'            => $request->address,
                'gender'             => $request->gender,
                'city'               => $request->city,
                'payment_expired_at' => now()->addHours(24),
                'snap_token'         => null,
            ]);
        } else {
            // Simpan ke database dengan status PENDING
            $participant = Participant::create([
                'order_id'           => $orderId,
                'kategori'           => '5K',
                'gross_amount'       => $grossAmount,
                'kode_unik'          => $kodeUnik,
                'payment_status'     => 'pending',
                'payment_method'     => null,
                'bib_name'           => '-', // Generic/empty as requested
                'full_name'          => $request->full_name,
                'id_number'          => $request->nik,
                'jersey_size'        => $request->jersey_size,
                'custom_size_note'   => $request->jersey_size === 'Custom Size' ? 'lebar ' . $request->custom_lebar . ' x panjang ' . $request->custom_panjang : null,
                'email'              => $request->email,
                'whatsapp'           => $request->whatsapp,
                'address'            => $request->address,
                'gender'             => $request->gender,
                'city'               => $request->city,
                'payment_expired_at' => now()->addHours(24),
            ]);
        }

        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        // Parameter untuk Snap
        $params = [
            'transaction_details' => [
                'order_id' => $participant->order_id,
                'gross_amount' => $participant->gross_amount,
            ],
            'customer_details' => [
                'first_name' => $participant->full_name,
                'email' => $participant->email,
                'phone' => $participant->whatsapp,
            ],
        ];

        // Dapatkan Snap Token
        try {
            $snapToken = Snap::getSnapToken($params);
            $participant->update(['snap_token' => $snapToken]);
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal memproses pembayaran: ' . $e->getMessage());
        }

        // Redirect ke halaman pembayaran dengan order_id
        return redirect()->route('pembayaran.show', $participant->order_id)
                         ->with('registered', true);
    }

    public function showPembayaran($order_id)
    {
        $participant = Participant::where('order_id', $order_id)->firstOrFail();
        $settings = EventSetting::first() ?? new EventSetting();
        return view('user.pembayaran', compact('participant', 'settings'));
    }

    // -------------------------------------------------------
    // POST /pembayaran/manual/{order_id}
    // -------------------------------------------------------
    public function uploadBukti(Request $request, $order_id)
    {
        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|min:10|max:3048',
        ], [
            'payment_proof.required' => 'Bukti pembayaran wajib diunggah.',
            'payment_proof.image' => 'File harus berupa gambar.',
            'payment_proof.mimes' => 'Format yang didukung hanya JPG, JPEG, PNG.',
            'payment_proof.min' => 'File gambar terlalu kecil atau korup. Silakan unggah ulang foto yang valid.',
            'payment_proof.max' => 'Ukuran file maksimal 3MB.',
        ]);

        $participant = Participant::where('order_id', $order_id)->firstOrFail();

        if ($request->hasFile('payment_proof')) {
            $file = $request->file('payment_proof');
            $path = $file->store('payment_proofs', 'public');
            
            // Hapus file lama jika ada
            if ($participant->payment_proof && Storage::disk('public')->exists($participant->payment_proof)) {
                Storage::disk('public')->delete($participant->payment_proof);
            }

            $participant->payment_proof = $path;
            $participant->payment_status = 'verifying';
            $participant->save();

            return back()->with('success', 'Bukti pembayaran berhasil diunggah. Silakan tunggu verifikasi admin.');
        }

        return back()->with('error', 'Gagal mengunggah bukti pembayaran.');
    }

    // -------------------------------------------------------
    // POST /api/midtrans-callback  → Webhook dari Midtrans
    // -------------------------------------------------------
    public function webhook(Request $request)
    {
        Log::info('Midtrans Webhook Payload: ', $request->all());

        $payload = $request->all();

        $order_id = $payload['order_id'] ?? '';
        $status_code = $payload['status_code'] ?? '';
        $gross_amount = $payload['gross_amount'] ?? '';
        $signature_key = $payload['signature_key'] ?? '';
        $server_key = config('midtrans.server_key');

        // 1. Validasi Signature Key (Gunakan gross_amount ASLI dari Midtrans)
        $expected_signature = hash('sha512', $order_id . $status_code . $gross_amount . $server_key);
        if ($expected_signature !== $signature_key) {
            Log::error("Midtrans Webhook: Invalid Signature Key for Order ID: $order_id");
            return response()->json(['message' => 'Invalid Signature'], 403);
        }

        $participant = Participant::where('order_id', $order_id)->first();
        if (!$participant) {
            Log::error("Midtrans Webhook: Participant not found for Order ID: $order_id");
            return response()->json(['message' => 'Participant not found'], 404);
        }

        // 2. Validasi Gross Amount (Hapus desimal .00)
        $requestAmount = (int) floor($gross_amount);

        // Ambil dari database, TANPA HARDCODE
        $settings = EventSetting::first() ?? new EventSetting();
        $ticketPrice = $settings->ticket_price ?? 150000;
        $adminFee = $settings->admin_fee ?? 5000;
        $expectedAmount = $ticketPrice + $adminFee;

        if ($requestAmount !== (int)$expectedAmount && $requestAmount !== (int)$participant->gross_amount) {
             Log::error("Midtrans Webhook: Invalid Gross Amount for Order ID: $order_id. Expected: $expectedAmount, Got: $requestAmount");
             return response()->json(['message' => 'Invalid Amount'], 400);
        }

        $transaction = $payload['transaction_status'] ?? '';
        $type = $payload['payment_type'] ?? '';
        $fraud = $payload['fraud_status'] ?? '';

        $participant->payment_method = $type;

        if ($transaction == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $participant->payment_status = 'pending';
                } else {
                    $participant->payment_status = 'paid';
                }
            }
        } else if ($transaction == 'settlement') {
            $participant->payment_status = 'paid';
        } else if ($transaction == 'pending') {
            $participant->payment_status = 'pending';
        } else if ($transaction == 'deny') {
            $participant->payment_status = 'failed';
        } else if ($transaction == 'expire') {
            $participant->payment_status = 'expired';
        } else if ($transaction == 'cancel') {
            $participant->payment_status = 'failed';
        }

        $participant->save();

        // 3. Jika lunas, kirim E-Ticket
        if ($participant->payment_status === 'paid') {
            try {
                Mail::to($participant->email)->send(new ETicketMail($participant, $settings));
                Log::info("Midtrans Webhook: E-Ticket sent to {$participant->email} for Order ID: $order_id");
            } catch (\Exception $e) {
                Log::error("Midtrans Webhook: Failed to send E-Ticket for Order ID: $order_id. Error: " . $e->getMessage());
            }
        }

        return response()->json(['message' => 'OK']);
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
        $participants = collect();
        $settings = EventSetting::first();
        
        if ($request->filled('order_id')) {
            $query = strtolower(trim($request->order_id));
            $participants = Participant::whereRaw('LOWER(order_id) LIKE ?', ['%' . $query])
                                      ->orWhereRaw('LOWER(email) = ?', [$query])
                                      ->latest()
                                      ->get();
        }

        return view('user.cek-status', compact('participants', 'settings'));
    }

    // -------------------------------------------------------
    // GET /e-ticket/{order_id}
    // -------------------------------------------------------
    public function showTicket($order_id)
    {
        $participant = Participant::where('order_id', $order_id)->firstOrFail();
        
        if ($participant->payment_status !== 'paid') {
            return redirect('/cek-status')->with('error', 'E-Ticket belum tersedia. Selesaikan pembayaran terlebih dahulu.');
        }

        $settings = EventSetting::first() ?? new EventSetting();
        
        try {
            $qrCodeData = file_get_contents('https://api.qrserver.com/v1/create-qr-code/?size=200x200&margin=2&data=' . urlencode($participant->order_id));
        } catch (\Exception $e) {
            $qrCodeData = null;
        }

        return view('emails.eticket', [
            'participant' => $participant,
            'settings' => $settings,
            'qrCodeData' => $qrCodeData,
            'is_email' => false
        ]);
    }

    // Legacy method (kept for compatibility)
    public function payment()
    {
        return redirect()->route('daftar');
    }
}