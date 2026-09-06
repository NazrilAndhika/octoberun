{{-- resources/views/user/pembayaran.blade.php --}}
@extends('layouts.user')

@section('content')
<div class="bg-gray-50 min-h-screen pt-8 pb-20 font-sans">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Tombol Kembali --}}
        <div class="mb-4">
            <a href="{{ url('/') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-[#0b4d75] transition-colors bg-white px-4 py-2 rounded-lg shadow-sm border border-gray-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>
        </div>

        {{-- ===== STEP INDICATOR ===== --}}
        <div class="flex items-center justify-center gap-0 mb-10">
            {{-- Step 1 --}}
            <div class="flex flex-col items-center">
                <div class="w-9 h-9 rounded-full bg-green-500 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                </div>
                <span class="text-xs font-semibold text-green-600 mt-1">Data Diri</span>
            </div>
            <div class="w-20 h-0.5 bg-[#0b4d75] mb-4"></div>
            {{-- Step 2 --}}
            <div class="flex flex-col items-center">
                <div class="w-9 h-9 rounded-full {{ $participant->payment_status === 'paid' ? 'bg-green-500' : 'bg-[#0b4d75]' }} flex items-center justify-center">
                    @if($participant->payment_status === 'paid')
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                    @else
                        <span class="text-white font-bold text-sm">2</span>
                    @endif
                </div>
                <span class="text-xs font-bold {{ $participant->payment_status === 'paid' ? 'text-green-600' : 'text-[#0b4d75]' }} mt-1">Pembayaran</span>
            </div>
            <div class="w-20 h-0.5 {{ $participant->payment_status === 'paid' ? 'bg-[#0b4d75]' : 'bg-gray-200' }} mb-4"></div>
            {{-- Step 3 --}}
            <div class="flex flex-col items-center">
                <div class="w-9 h-9 rounded-full {{ $participant->payment_status === 'paid' ? 'bg-[#0b4d75]' : 'bg-gray-200' }} flex items-center justify-center">
                    <span class="{{ $participant->payment_status === 'paid' ? 'text-white' : 'text-gray-400' }} font-bold text-sm">3</span>
                </div>
                <span class="text-xs font-semibold {{ $participant->payment_status === 'paid' ? 'text-[#0b4d75] font-bold' : 'text-gray-400' }} mt-1">Konfirmasi</span>
            </div>
        </div>

        {{-- ===== HEADER ===== --}}
        <div class="text-center mb-8">
            @if($participant->payment_status === 'paid')
                <p class="text-xs font-bold text-green-600 bg-green-50 border border-green-200 inline-block px-4 py-1.5 rounded-full mb-3 uppercase tracking-wider">
                    Pembayaran Selesai!
                </p>
            @else
                <p class="text-xs font-bold text-amber-600 bg-amber-50 border border-amber-200 inline-block px-4 py-1.5 rounded-full mb-3 uppercase tracking-wider">
                    Selesaikan pembayaran dalam 24 jam!
                </p>
            @endif
            <h1 class="text-4xl md:text-5xl font-black text-[#0b4d75]">
                Rp {{ number_format($participant->gross_amount, 0, ',', '.') }}
            </h1>
            <p class="text-gray-500 text-sm mt-2 font-medium">No. Order: <span class="font-black text-gray-800">{{ $participant->order_id }}</span></p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

            {{-- ===== KOLOM KIRI: METODE PEMBAYARAN ===== --}}
            <div class="lg:col-span-3 space-y-5">
                @if(($settings->payment_mode ?? 'otomatis') == 'otomatis')
                    {{-- ===== METODE OTOMATIS (MIDTRANS) ===== --}}
                    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                        <div class="bg-gradient-to-r from-[#0b4d75] to-[#0d6096] px-5 py-4">
                            <h2 class="text-white font-bold text-base flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>
                                Pilih Metode Pembayaran
                            </h2>
                        </div>
                        <div class="p-8 text-center space-y-4">
                            <div class="mx-auto w-24 h-24 bg-blue-50 rounded-full flex items-center justify-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-[#0b4d75]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            
                            <h3 class="text-xl font-bold text-gray-800">Selesaikan Pembayaran Anda</h3>
                            <p class="text-gray-500 text-sm max-w-sm mx-auto">
                                Klik tombol di bawah ini untuk memilih metode pembayaran yang Anda inginkan (GoPay, QRIS, Virtual Account, dll).
                            </p>

                            <button id="pay-button" class="mt-6 w-full max-w-sm mx-auto bg-[#0b4d75] hover:bg-[#083b5c] text-white font-black py-4 rounded-xl transition uppercase tracking-widest shadow-lg shadow-blue-900/20 flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                Bayar Sekarang
                            </button>
                        </div>
                    </div>
                @else
                    {{-- ===== METODE MANUAL (TRANSFER BANK) ATAU SUCCESS ===== --}}
                    @if($participant->payment_status === 'paid')
                        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden text-center p-8">
                            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <h2 class="text-2xl font-black text-gray-800 mb-2">Pembayaran Lunas!</h2>
                            <p class="text-gray-500 mb-6 text-sm">
                                Terima kasih, pembayaran Anda telah diverifikasi. E-Ticket telah dikirimkan ke email Anda (cek folder Inbox atau Spam).
                            </p>
                            
                            <a href="{{ route('e-ticket.show', $participant->order_id) }}" target="_blank" class="block w-full max-w-sm mx-auto text-center bg-[#0b4d75] text-white font-bold py-3 px-6 rounded-lg shadow-md hover:bg-blue-800 transition duration-300 mb-4">
                                Lihat / Download E-Ticket
                            </a>
                            <p class="text-sm text-gray-500 italic mb-6 max-w-md mx-auto">
                                *E-Ticket juga telah dikirimkan ke email Anda. Jika email tidak masuk (pastikan cek folder Spam) atau penyimpanan penuh, Anda bisa mengunduhnya langsung melalui tombol di atas. Kendala lain? Hubungi WhatsApp Admin.
                            </p>
                            
                            @if($settings->wa_group_link)
                            <div class="bg-blue-50 border border-blue-200 rounded-xl p-5 inline-block w-full max-w-sm">
                                <h3 class="font-bold text-[#0b4d75] mb-2">Grup WhatsApp Peserta</h3>
                                <p class="text-xs text-gray-600 mb-4">Bergabunglah dengan grup WhatsApp khusus peserta untuk mendapatkan info terbaru seputar pengambilan Race Pack dan hari pelaksanaan event.</p>
                                <a href="{{ $settings->wa_group_link }}" target="_blank" class="w-full bg-[#25D366] hover:bg-[#1ebd5a] text-white font-bold py-3 rounded-lg transition flex items-center justify-center gap-2 text-sm shadow-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                                    Gabung Grup WhatsApp
                                </a>
                            </div>
                            @endif
                        </div>
                    @else
                        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                            <div class="bg-gradient-to-r from-[#e85d04] to-[#c74c03] px-5 py-4">
                                <h2 class="text-white font-bold text-base flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" /></svg>
                                    Informasi Pembayaran
                                </h2>
                            </div>
                            <div class="p-6">
                                @if(session('success'))
                                    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6 font-bold flex items-center gap-2 text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if(session('error'))
                                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6 font-bold flex items-center gap-2 text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        {{ session('error') }}
                                    </div>
                                @endif
    
                                <div class="mb-6 pb-6 border-b border-gray-200 text-center">
                                    <h3 class="font-semibold text-gray-800 mb-4">QRIS</h3>
                                    <img src="{{ asset('img/qris-gsc.jpg') }}" alt="QRIS GSC" class="mx-auto rounded-lg shadow-md border border-gray-200 max-w-xs w-full mb-3">
                                    <div class="text-center font-bold text-gray-800 mt-3">QRIS &middot; YAY GERAK SEDEKAH CILACAP</div>
                                    <p class="text-xs text-gray-500">Gunakan aplikasi m-Banking atau e-Wallet apa saja untuk scan QR Code di atas.</p>
                                </div>

                                <div class="mb-6">
                                    <h3 class="font-semibold text-gray-800 mb-4 text-center">Transfer Bank</h3>
                                    <div class="bg-orange-50 border border-orange-100 rounded-xl p-5">
                                        <p class="text-sm text-gray-700 mb-4 text-center">Silakan transfer <strong>TEPAT</strong> sejumlah <strong>Rp {{ number_format($participant->gross_amount, 0, ',', '.') }}</strong> (hingga 3 digit terakhir) ke rekening di bawah ini:</p>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-left">
                                            <div>
                                                <p class="text-xs text-gray-500 font-semibold mb-1">Bank Tujuan</p>
                                                <p class="font-black text-gray-800 text-lg">{{ $settings->manual_bank_name }}</p>
                                            </div>
                                            <div>
                                                <p class="text-xs text-gray-500 font-semibold mb-1">Atas Nama</p>
                                                <p class="font-black text-gray-800 text-lg">{{ $settings->manual_bank_owner }}</p>
                                            </div>
                                            <div class="md:col-span-2">
                                                <p class="text-xs text-gray-500 font-semibold mb-1">Nomor Rekening</p>
                                                <div class="flex flex-col gap-3">
                                                    <p id="nomor-rekening" class="font-black text-[#e85d04] text-2xl tracking-widest">{{ $settings->manual_bank_account }}</p>
                                                    <div>
                                                        <button type="button" onclick="copyRekening()" class="border-2 border-[#e85d04] text-[#e85d04] hover:bg-[#e85d04] hover:text-white font-bold py-2 px-4 rounded-lg transition text-xs uppercase tracking-wider w-full md:w-auto inline-flex items-center justify-center gap-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                                            </svg>
                                                            Salin Nomor Rekening
                                                        </button>
                                                        <p id="copy-notif" class="text-green-600 font-semibold text-xs mt-2 hidden transition-opacity duration-300 md:text-left text-center">Nomor rekening berhasil disalin!</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="border-t border-gray-200 pt-6">
                                    <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" /></svg>
                                        Upload Bukti Pembayaran
                                    </h3>
                                    
                                    @if($participant->payment_status === 'verifying')
                                        <div class="bg-blue-50 border border-blue-200 text-blue-700 px-4 py-3 rounded-lg font-bold flex flex-col items-center justify-center text-center gap-2 text-sm p-6">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-500 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                                            Bukti pembayaran Anda sedang diverifikasi oleh admin.
                                            <span class="text-xs font-normal text-blue-600 mt-1">Kami akan mengirimkan notifikasi E-Ticket melalui Email jika pembayaran disetujui.</span>
                                        </div>
                                    @else
                                        @if($participant->payment_status === 'rejected')
                                        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg font-bold flex flex-col items-center justify-center text-center gap-2 text-sm mb-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                            Bukti pembayaran Anda ditolak!
                                            <span class="text-xs font-normal text-red-600 mt-1">Silakan unggah ulang bukti pembayaran yang benar.</span>
                                        </div>
                                        @endif
                                        
                                        <form action="{{ route('pembayaran.manual.upload', $participant->order_id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                                            @csrf
                                            <div>
                                                <input type="file" name="payment_proof" accept="image/jpeg,image/png,image/jpg" required
                                                    class="w-full border border-gray-300 rounded-lg focus:outline-none file:mr-4 file:py-2.5 file:px-4 file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-[#e85d04] hover:file:bg-orange-100 text-sm text-gray-500 bg-gray-50">
                                                <p class="text-xs text-gray-400 mt-2">Format yang didukung: JPG, JPEG, PNG. Ukuran maksimal 3MB.</p>
                                            </div>
                                            <button type="submit" class="w-full bg-[#e85d04] hover:bg-orange-700 text-white font-bold py-3.5 rounded-xl transition shadow-lg shadow-orange-900/20 uppercase tracking-widest text-sm">
                                                Kirim Bukti Pembayaran
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            </div>

            {{-- ===== KOLOM KANAN: RINGKASAN ORDER ===== --}}
            <div class="lg:col-span-2">
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm sticky top-28">
                    <div class="bg-gradient-to-r from-gray-800 to-gray-900 px-5 py-4 rounded-t-xl">
                        <h2 class="text-white font-bold text-base">Ringkasan Pesanan</h2>
                        <p class="text-gray-400 text-xs mt-0.5">{{ $participant->order_id }}</p>
                    </div>
                    <div class="p-5 space-y-4">

                        {{-- Info Peserta --}}
                        <div class="space-y-3">
                            @php
                            $rows = [
                                ['label' => 'Nama Peserta', 'value' => $participant->full_name],
                                ['label' => 'Kategori',     'value' => $participant->kategori . ' Run'],
                                ['label' => 'Jersey',       'value' => $participant->jersey_size],
                                ['label' => 'Email',        'value' => $participant->email],
                            ];
                            @endphp
                            @foreach($rows as $row)
                            <div class="flex justify-between items-start gap-3">
                                <span class="text-xs text-gray-500 flex-shrink-0">{{ $row['label'] }}</span>
                                <span class="text-xs font-bold text-gray-800 text-right">{{ $row['value'] }}</span>
                            </div>
                            @endforeach
                        </div>

                        {{-- Rincian Harga --}}
                        <div class="border-t border-gray-100 pt-4 space-y-2">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Subtotal Tiket</span>
                                <span class="font-semibold text-gray-700">Rp {{ number_format($settings->ticket_price ?? 150000, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Biaya Admin</span>
                                <span class="font-semibold text-gray-700">Rp {{ number_format($settings->admin_fee ?? 5000, 0, ',', '.') }}</span>
                            </div>
                            @if($participant->kode_unik > 0)
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Biaya Sistem</span>
                                <span class="font-bold text-orange-600">Rp {{ number_format($participant->kode_unik, 0, ',', '.') }}</span>
                            </div>
                            @endif
                        </div>

                        {{-- Total --}}
                        <div class="border-t border-gray-100 pt-4 flex justify-between items-center mb-2">
                            <span class="font-black text-gray-800 uppercase tracking-wide text-sm">Total Bayar</span>
                            <span class="font-black text-[#e85d04] text-xl">Rp {{ number_format($participant->gross_amount, 0, ',', '.') }}</span>
                        </div>
                        @if($participant->kode_unik > 0 && $participant->payment_status === 'pending')
                        <p class="text-red-500 font-bold text-sm text-center bg-red-50 rounded-lg p-2 border border-red-200">
                            PENTING: Transfer TEPAT hingga 3 digit terakhir agar pembayaran dapat diverifikasi.
                        </p>
                        @endif

                        {{-- Status --}}
                        @if($participant->payment_status === 'paid')
                            <div class="bg-green-50 border border-green-200 rounded-xl p-3 text-center">
                                <span class="inline-flex items-center gap-2 text-green-700 font-bold text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                                    LUNAS
                                </span>
                            </div>
                        @else
                            <div class="bg-amber-50 border border-amber-200 rounded-xl p-3 text-center">
                                <span class="inline-flex items-center gap-2 text-amber-700 font-bold text-sm">
                                    <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                                    Menunggu Pembayaran
                                </span>
                            </div>

                            {{-- Sudah punya bukti? --}}
                            @if($participant->payment_proof)
                            <div class="bg-blue-50 border border-blue-200 rounded-xl p-3 text-center mt-4">
                                <p class="text-blue-700 font-bold text-sm flex items-center justify-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    Bukti sudah dikirim
                                </p>
                                <p class="text-xs text-blue-600 mt-1">Menunggu verifikasi admin</p>
                            </div>
                            @endif
                        @endif

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Midtrans Snap JS -->
<script src="{{ config('midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
    document.getElementById('pay-button').onclick = function(){
      // SnapToken acquired from previous step
      snap.pay('{{ $participant->snap_token }}', {
        // Optional
        onSuccess: function(result){
          /* You may add your own js here, this is just example */
          window.location.href = "{{ route('pembayaran.sukses', $participant->order_id) }}";
        },
        // Optional
        onPending: function(result){
          /* You may add your own js here, this is just example */
          window.location.href = "{{ route('pembayaran.sukses', $participant->order_id) }}";
        },
        // Optional
        onError: function(result){
          /* You may add your own js here, this is just example */
          alert("Pembayaran gagal!");
        },
        onClose: function(){
          console.log('Menutup pop-up tanpa menyelesaikan pembayaran');
        }
      });
    };

    function copyRekening() {
        var copyText = document.getElementById("nomor-rekening").innerText;
        // Hapus spasi jika ada
        copyText = copyText.replace(/\s+/g, '');
        navigator.clipboard.writeText(copyText).then(function() {
            var notif = document.getElementById("copy-notif");
            notif.classList.remove("hidden");
            setTimeout(function() {
                notif.classList.add("hidden");
            }, 3000);
        });
    }
</script>
@endsection