{{-- resources/views/user/pembayaran.blade.php --}}
@extends('layouts.user')

@section('content')
<div class="bg-gray-50 min-h-screen pt-28 pb-20 font-sans">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

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
            {{-- Step 2 (aktif) --}}
            <div class="flex flex-col items-center">
                <div class="w-9 h-9 rounded-full bg-[#0b4d75] flex items-center justify-center">
                    <span class="text-white font-bold text-sm">2</span>
                </div>
                <span class="text-xs font-bold text-[#0b4d75] mt-1">Pembayaran</span>
            </div>
            <div class="w-20 h-0.5 bg-gray-200 mb-4"></div>
            {{-- Step 3 --}}
            <div class="flex flex-col items-center">
                <div class="w-9 h-9 rounded-full bg-gray-200 flex items-center justify-center">
                    <span class="text-gray-400 font-bold text-sm">3</span>
                </div>
                <span class="text-xs font-semibold text-gray-400 mt-1">Konfirmasi</span>
            </div>
        </div>

        {{-- ===== HEADER ===== --}}
        <div class="text-center mb-8">
            <p class="text-xs font-bold text-amber-600 bg-amber-50 border border-amber-200 inline-block px-4 py-1.5 rounded-full mb-3 uppercase tracking-wider">
                ⏰ Selesaikan pembayaran dalam 24 jam
            </p>
            <h1 class="text-4xl md:text-5xl font-black text-[#0b4d75]">
                Rp {{ number_format($participant->gross_amount, 0, ',', '.') }}
            </h1>
            <p class="text-gray-500 text-sm mt-2 font-medium">No. Order: <span class="font-black text-gray-800">{{ $participant->order_id }}</span></p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

            {{-- ===== KOLOM KIRI: MIDTRANS SNAP ===== --}}
            <div class="lg:col-span-3 space-y-5">

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
                        </div>

                        {{-- Total --}}
                        <div class="border-t border-gray-100 pt-4 flex justify-between items-center">
                            <span class="font-black text-gray-800 uppercase tracking-wide text-sm">Total Bayar</span>
                            <span class="font-black text-[#e85d04] text-xl">Rp {{ number_format($participant->gross_amount, 0, ',', '.') }}</span>
                        </div>

                        {{-- Status --}}
                        <div class="bg-amber-50 border border-amber-200 rounded-xl p-3 text-center">
                            <span class="inline-flex items-center gap-2 text-amber-700 font-bold text-sm">
                                <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                                Menunggu Pembayaran
                            </span>

                        </div>

                        {{-- Sudah punya bukti? --}}
                        @if($participant->payment_proof)
                        <div class="bg-green-50 border border-green-200 rounded-xl p-3 text-center">
                            <p class="text-green-700 font-bold text-sm flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                Bukti sudah dikirim
                            </p>
                            <p class="text-xs text-green-600 mt-1">Menunggu verifikasi admin</p>
                        </div>
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
</script>
@endsection