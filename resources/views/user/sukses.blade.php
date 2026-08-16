{{-- resources/views/user/sukses.blade.php --}}
@extends('layouts.user')

@section('content')
<div class="bg-gray-50 min-h-screen pt-28 pb-20 font-sans">
    <div class="max-w-lg mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Card Sukses --}}
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden text-center">

            {{-- Header Hijau --}}
            <div class="bg-gradient-to-br from-green-500 to-emerald-600 px-8 py-10">
                <div class="w-20 h-20 bg-white/20 backdrop-blur rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h1 class="text-2xl font-black text-white mb-2">Terima Kasih!</h1>
                <p class="text-green-100 text-sm">Pendaftaran Anda sedang diproses oleh sistem.</p>
            </div>

            {{-- Body --}}
            <div class="px-8 py-8 space-y-5">

                {{-- No Order & QR Code --}}
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-100 flex flex-col items-center justify-center">
                    <p class="text-xs text-gray-400 font-semibold uppercase tracking-wide mb-1">No. Order Kamu</p>
                    <p class="text-2xl font-black text-[#0b4d75] tracking-wider mb-2">{{ $participant->order_id }}</p>
                    <p class="text-sm font-semibold text-gray-600">{{ $participant->full_name }}</p>
                    
                    @if($participant->payment_status == 'paid')
                        <div class="mt-4 p-3 bg-white rounded-lg shadow-sm border border-gray-100">
                            {!! QrCode::size(150)->generate($participant->order_id) !!}
                        </div>
                        <p class="text-xs text-green-600 font-bold mt-2 text-center">Screenshot halaman ini!<br>Tunjukkan QR Code saat pengambilan Race Pack.</p>
                    @endif
                </div>

                {{-- Status Timeline --}}
                <div class="text-left space-y-3">
                    <div class="flex items-start gap-3">
                        <div class="w-7 h-7 rounded-full bg-green-500 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-800">Form pendaftaran tersimpan</p>
                            <p class="text-xs text-gray-400">{{ $participant->created_at->format('d M Y, H:i') }} WIB</p>
                        </div>
                    </div>
                    
                    {{-- Step 2: Menunggu Pembayaran / Berhasil --}}
                    <div class="flex items-start gap-3">
                        @if($participant->payment_status === 'paid')
                        <div class="w-7 h-7 rounded-full bg-green-500 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-800">Pembayaran Berhasil</p>
                            <p class="text-xs text-gray-400">Terverifikasi otomatis oleh sistem</p>
                        </div>
                        @else
                        <div class="w-7 h-7 rounded-full bg-amber-400 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <span class="w-2.5 h-2.5 rounded-full bg-white animate-pulse"></span>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-800">Menunggu Pembayaran</p>
                            <p class="text-xs text-gray-400">Verifikasi otomatis oleh sistem</p>
                        </div>
                        @endif
                    </div>
                    
                    {{-- Step 3: Lunas --}}
                    <div class="flex items-start gap-3">
                        @if($participant->payment_status === 'paid')
                        <div class="w-7 h-7 rounded-full bg-green-500 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-800">Status: LUNAS ✅</p>
                            <p class="text-xs text-gray-400">E-Ticket dikirim ke email</p>
                        </div>
                        @else
                        <div class="w-7 h-7 rounded-full bg-gray-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <span class="w-2 h-2 rounded-full bg-gray-300"></span>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-400">Status: LUNAS ✅</p>
                            <p class="text-xs text-gray-400">E-Ticket akan dikirim otomatis</p>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Info Penting --}}
                <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 text-left">
                    <p class="text-xs font-bold text-[#0b4d75] mb-2 uppercase tracking-wide">📋 Simpan informasi ini</p>
                    <ul class="text-xs text-gray-600 space-y-1.5">
                        <li>• Simpan <strong>No. Order</strong> kamu sebagai bukti pendaftaran.</li>
                        <li>• Konfirmasi akan dikirim ke <strong>{{ $participant->email }}</strong>.</li>
                        <li>• Hubungi panitia jika ada pertanyaan melalui WhatsApp/Instagram.</li>
                    </ul>
                </div>

                {{-- Info Email E-Ticket --}}
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 text-left flex items-start gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-xs text-blue-800 leading-relaxed font-medium">
                        Silakan pantau kotak masuk atau folder spam Email Anda. <strong>E-Ticket</strong> akan dikirimkan otomatis jika pembayaran Anda telah berhasil.
                    </p>
                </div>

                {{-- Tombol --}}
                <div class="space-y-3 pt-2">
                    <a href="{{ route('cek-status', ['order_id' => $participant->order_id]) }}"
                        class="flex items-center justify-center gap-2 w-full bg-[#0b4d75] hover:bg-[#083b5c] text-white font-bold py-3 rounded-xl transition text-sm shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        Lihat Status Pesanan
                    </a>
                    <a href="{{ url('/') }}"
                        class="flex items-center justify-center gap-2 w-full border border-gray-300 text-gray-600 font-semibold py-3 rounded-xl hover:bg-gray-50 transition text-sm">
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
