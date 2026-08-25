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
            'jersey_size'=> 'required|in:XS,S,M,L,XL,XXL',
            'email'      => [
                'required',
                'email:rfc,dns',
                'max:255',
                Rule::unique('participants')->where(function ($query) use ($request) {
                    return $query->where('full_name', $request->full_name);
                })
            ],
            'whatsapp'   => 'required|string|max:20',
            'address'    => 'required|string',
            'gender'     => 'required|in:male,female',
            'city'       => 'required|string|max:100',
        ], [
            'full_name.required'   => 'Nama lengkap wajib diisi.',
            'jersey_size.required' => 'Pilih ukuran jersey.',
            'email.required'       => 'Email wajib diisi.',
            'email.email'          => 'Format email tidak valid.',
            'email.unique'         => 'Email dan Nama ini sudah terdaftar. Silakan gunakan email/nama lain.',
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
        $grossAmount = $ticketPrice + $adminFee;

        // Cek email manual
        $existingParticipant = Participant::where('email', $request->email)
                                          ->where('full_name', $request->full_name)
                                          ->first();
                                          
        if ($existingParticipant) {
            if (in_array($existingParticipant->payment_status, ['paid', 'pending'])) {
                return back()->withInput()->withErrors(['email' => 'Email dan Nama ini sudah terdaftar. Silakan cek status pendaftaran Anda.']);
            }
            
            // Jika expired/failed, update data lama
            $participant = $existingParticipant;
            $participant->update([
                'order_id'           => $orderId,
                'kategori'           => '5K',
                'gross_amount'       => $grossAmount,
                'payment_status'     => 'pending',
                'payment_method'     => null,
                'bib_name'           => '-', // Generic/empty as requested
                'full_name'          => $request->full_name,
                'id_number'          => '-', // Default value since NIK is no longer used
                'jersey_size'        => $request->jersey_size,
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
                'payment_status'     => 'pending',
                'payment_method'     => null,
                'bib_name'           => '-', // Generic/empty as requested
                'full_name'          => $request->full_name,
                'id_number'          => '-', // Default value since NIK is no longer used
                'jersey_size'        => $request->jersey_size,
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

    // -------------------------------------------------------
    // GET /pembayaran/{order_id}  → tampilkan halaman bayar
    // -------------------------------------------------------
    public function showPembayaran($order_id)
    {
        $participant = Participant::where('order_id', $order_id)->firstOrFail();
        $settings = EventSetting::first() ?? new EventSetting();
        return view('user.pembayaran', compact('participant', 'settings'));
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

    // Legacy method (kept for compatibility)
    public function payment()
    {
        return redirect()->route('daftar');
    }
}