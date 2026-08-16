{{-- resources/views/user/cek-status.blade.php --}}
@extends('layouts.user')

@section('content')
<div class="bg-gray-50 min-h-screen pt-28 pb-20 font-sans">
    <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Judul Halaman --}}
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-[#0b4d75]">Cek Status Pendaftaran</h1>
            <p class="text-gray-500 mt-2">Pantau status validasi pembayaran tiket Anda</p>
        </div>

        {{-- Form Pencarian --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
            <form action="{{ route('cek-status') }}" method="GET">
                <label for="order_id" class="block text-sm font-bold text-gray-700 mb-2">
                    Masukkan Nomor Order atau Email Anda
                </label>
                <div class="flex gap-3">
                    <input type="text" name="order_id" id="order_id" 
                           class="flex-1 rounded-lg border-gray-300 focus:border-[#0b4d75] focus:ring-[#0b4d75] shadow-sm uppercase px-4 py-3"
                           placeholder="Contoh: ORD-12345 atau email@kamu.com" 
                           value="{{ request('order_id') }}"
                           required>
                    <button type="submit" class="bg-[#0b4d75] hover:bg-blue-800 text-white font-bold py-3 px-6 rounded-lg shadow-md transition duration-300">
                        Cari
                    </button>
                </div>
                <p class="text-xs text-gray-400 mt-2">*Masukkan 6 karakter acak dari belakang nomor order Anda, atau nomor order lengkap (ORD-...).</p>
            </form>
        </div>

        {{-- Hasil Pencarian --}}
        @if(request()->filled('order_id'))
            @if($participant)
                @if($participant->payment_status === 'pending')
                    <div class="bg-yellow-50 border border-yellow-200 rounded-2xl p-6 text-center shadow-sm">
                        <div class="w-16 h-16 bg-yellow-100 text-yellow-500 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-yellow-700 mb-2">Menunggu Pembayaran</h2>
                        <p class="text-yellow-600 font-medium">Anda memiliki transaksi yang belum diselesaikan.</p>
                        
                        <div class="mt-6 pt-6 border-t border-yellow-200 text-left">
                            <p class="text-sm text-yellow-700"><strong>Nomor Order:</strong> {{ $participant->order_id }}</p>
                            <p class="text-sm text-yellow-700"><strong>Nama:</strong> {{ $participant->full_name }}</p>
                        </div>

                        <a href="{{ route('pembayaran.show', $participant->order_id) }}" class="block w-full text-center bg-[#0b4d75] text-white font-bold py-4 px-6 rounded-lg shadow-md uppercase mt-6 hover:bg-blue-800 transition duration-300">
                            LANJUTKAN PEMBAYARAN
                        </a>
                    </div>
                @elseif($participant->payment_status === 'paid')
                    <div class="bg-green-50 border border-green-200 rounded-2xl p-6 text-center shadow-sm">
                        <div class="w-16 h-16 bg-green-100 text-green-500 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-green-700 mb-2">Pendaftaran Berhasil! 🎉</h2>
                        
                        <div class="bg-white border-2 border-dashed border-green-400 rounded-xl p-4 my-6 flex flex-col items-center">
                            <p class="text-xs text-gray-500 font-bold uppercase tracking-widest mb-1">E-Ticket / No. Order</p>
                            <p class="text-2xl font-black text-[#0b4d75] tracking-widest mb-2">{{ $participant->order_id }}</p>
                            <p class="text-sm font-semibold text-gray-600">{{ $participant->full_name }} ({{ $participant->bib_name }})</p>
                            
                            <div class="mt-4 p-3 bg-gray-50 rounded-lg border border-gray-100">
                                {!! QrCode::size(180)->generate($participant->order_id) !!}
                            </div>
                        </div>

                        <p class="text-green-700 font-medium bg-green-100 p-4 rounded-lg mb-4 text-sm">
                            📱 <strong>Screenshot halaman ini!</strong><br>
                            Silakan tunjukkan QR Code di atas saat pengambilan Race Pack di area EVENT. 
                        </p>
                    </div>
                @elseif(in_array($participant->payment_status, ['expired', 'cancel', 'deny', 'failed']))
                    <div class="bg-red-50 border border-red-200 rounded-2xl p-6 text-center shadow-sm">
                        <div class="w-16 h-16 bg-red-100 text-red-500 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-red-700 mb-2">Waktu Pembayaran Habis</h2>
                        <p class="text-red-600 font-medium">Pendaftaran Anda telah kedaluwarsa dan dibatalkan oleh sistem.</p>
                        
                        <a href="{{ route('daftar') }}" class="block w-full text-center bg-[#e85d04] text-white font-bold py-4 px-6 rounded-lg shadow-md uppercase mt-6 hover:bg-orange-700 transition duration-300">
                            DAFTAR ULANG
                        </a>
                    </div>
                @endif
            @else
                <div class="bg-red-50 border border-red-200 rounded-2xl p-6 text-center shadow-sm">
                    <div class="w-16 h-16 bg-red-100 text-red-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-red-700 mb-2">Data Tidak Ditemukan</h2>
                    <p class="text-red-600">Maaf, kami tidak menemukan pendaftar dengan nomor order tersebut. Pastikan Anda memasukkan nomor yang benar.</p>
                </div>
            @endif
        @endif

    </div>
</div>
@endsection
