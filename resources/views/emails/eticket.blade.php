<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Ticket & Info Race Pack</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f9fafb; color: #374151; line-height: 1.6; margin: 0; padding: 20px 20px 100px 20px; }
        .container { max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); }
        .header { background-color: #0b4d75; color: #ffffff; padding: 30px 20px; text-align: center; }
        .header h1 { margin: 0; font-size: 24px; font-weight: 800; }
        .header p { margin: 5px 0 0; font-size: 14px; opacity: 0.9; }
        .content { padding: 30px; }
        .greeting { font-size: 18px; font-weight: 600; margin-bottom: 20px; }
        .ticket-box { background-color: #f0fdf4; border: 2px dashed #22c55e; border-radius: 10px; padding: 20px; text-align: center; margin-bottom: 30px; }
        .ticket-title { font-size: 12px; text-transform: uppercase; color: #166534; font-weight: bold; letter-spacing: 1px; margin-bottom: 10px; }
        .ticket-number { font-size: 32px; font-weight: 900; color: #0b4d75; margin: 0; letter-spacing: 2px; }
        .participant-details { margin-bottom: 30px; }
        .participant-details h3 { font-size: 14px; color: #9ca3af; text-transform: uppercase; letter-spacing: 1px; border-bottom: 1px solid #e5e7eb; padding-bottom: 5px; margin-bottom: 15px; }
        .detail-row { display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 14px; }
        .detail-label { font-weight: 600; color: #4b5563; }
        .rpc-box { background-color: #fffbeb; border-left: 4px solid #f59e0b; padding: 15px 20px; border-radius: 4px; margin-bottom: 30px; }
        .rpc-box h4 { margin: 0 0 10px; color: #b45309; font-size: 15px; }
        .rpc-box p { margin: 0 0 8px; font-size: 14px; }
        .rpc-box ul { margin: 0; padding-left: 20px; font-size: 14px; }
        .footer { background-color: #f3f4f6; text-align: center; padding: 20px; font-size: 12px; color: #6b7280; }
        
        /* === TAMBAHAN UNTUK CETAK PDF === */
        .print-btn-wrapper { position: fixed; bottom: 0; left: 0; width: 100%; background-color: rgba(255,255,255,0.95); border-top: 1px solid #e5e7eb; padding: 15px; box-shadow: 0 -4px 6px -1px rgba(0,0,0,0.1); z-index: 50; text-align: center; box-sizing: border-box; }
        .print-btn { background-color: #0b4d75; color: white; border: none; padding: 14px 28px; font-size: 16px; font-weight: bold; border-radius: 8px; cursor: pointer; display: block; width: 100%; max-width: 400px; margin: 0 auto; text-decoration: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .print-btn:hover { background-color: #083b5c; }
        
        @media print {
            * { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
            .no-print { display: none !important; }
            body { background-color: #ffffff; padding: 0; }
            .container { box-shadow: none; max-width: 100%; width: 100%; border-radius: 0; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Selamat, Pembayaran Lunas!</h1>
            <p>Terima kasih telah mendaftar di {{ $settings->event_name ?? 'OCTOBERUN 2026' }}</p>
        </div>
        
        <div class="content">
            <div class="greeting">
                Halo, {{ $participant->full_name }}!
            </div>
            <p>Pembayaran Anda telah berhasil kami validasi. Berikut adalah E-Ticket Anda yang wajib ditunjukkan saat pengambilan Race Pack.</p>
            
            <div class="ticket-box">
                <div class="ticket-title">Nomor Order / E-Ticket</div>
                <div class="ticket-number">{{ $participant->order_id }}</div>
                
                @if($qrCodeData)
                <div style="margin-top: 20px;">
                    @if(isset($message))
                        <img src="{{ $message->embedData($qrCodeData, 'qrcode.png', 'image/png') }}" alt="QR Code" style="width: 150px; height: 150px; border-radius: 8px; border: 4px solid white; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                    @else
                        <img src="data:image/png;base64,{{ base64_encode($qrCodeData) }}" alt="QR Code" style="width: 150px; height: 150px; border-radius: 8px; border: 4px solid white; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                    @endif
                </div>
                @endif

                @if(!empty($settings->wa_group_link))
                <div style="margin-top: 25px; border-top: 1px dashed #22c55e; padding-top: 20px;">
                    <p style="font-size: 13px; color: #166534; margin-bottom: 15px; font-weight: 600;">PENTING: Wajib bergabung ke dalam grup WhatsApp untuk mendapatkan informasi terbaru terkait pengambilan Race Pack dan jadwal acara.</p>
                    <a href="{{ $settings->wa_group_link }}" target="_blank" style="display: inline-block; background-color: #25D366; color: white; text-decoration: none; padding: 12px 24px; border-radius: 8px; font-weight: bold; font-size: 14px;">GABUNG GRUP WHATSAPP PESERTA</a>
                </div>
                @endif
            </div>

            <div class="participant-details">
                <h3>Detail Pendaftaran</h3>

                <div class="detail-row">
                    <span class="detail-label">Kategori:</span>
                    <span>{{ $participant->kategori }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Ukuran Jersey:</span>
                    <span>{{ $participant->jersey_size }}</span>
                </div>
            </div>

            <div class="rpc-box">
                <h4>📌 Informasi Pengambilan Race Pack (RPC)</h4>
                <p>Detail mengenai jadwal resmi, lokasi, serta dokumen persyaratan pengambilan Race Pack (RPC) sedang dalam tahap penyusunan oleh panitia.</p>
                <p>Informasi lengkap (termasuk panduan pengambilan yang diwakilkan) akan diumumkan lebih lanjut mendekati hari pelaksanaan event melalui:</p>
                <ul>
                    <li>Grup WhatsApp Resmi Peserta</li>
                    <li>Instagram Resmi @eventoctoberun</li>
                </ul>
                <p style="margin-top: 10px;">Pastikan Anda segera bergabung ke dalam Grup WhatsApp melalui tombol hijau di atas agar tidak tertinggal informasi penting terkait Race Pack.</p>
            </div>

            <p>Sampai jumpa di garis start! Terus berlatih dan persiapkan diri Anda.</p>
            <p>Salam hangat,<br><strong>Panitia {{ $settings->event_name ?? 'OCTOBERUN 2026' }}</strong></p>
        </div>

        <div class="footer">
            &copy; {{ date('Y') }} {{ $settings->event_name ?? 'OCTOBERUN 2026' }}. Semua hak cipta dilindungi.<br>
            Email ini dihasilkan secara otomatis, mohon tidak membalas email ini.
        </div>
    </div>

    <div class="print-btn-wrapper no-print">
        @if(isset($is_email) && $is_email)
            <a href="{{ route('e-ticket.show', $participant->order_id) }}" class="print-btn" style="text-align: center; display: block; box-sizing: border-box; color: #ffffff !important; text-decoration: none;">🌐 Buka di Browser untuk Cetak PDF</a>
        @else
            <button id="print-btn" class="print-btn" onclick="window.print()">Cetak atau Simpan sebagai PDF</button>
        @endif
    </div>

    @if(!isset($is_email) || !$is_email)
    <!-- Script untuk Cetak Otomatis -->
    <script>
        // Opsional: Jalankan print otomatis setelah 1 detik halaman dimuat
        setTimeout(function() {
            window.print();
        }, 1000);
    </script>
    @endif
</body>
</html>
