{{-- resources/views/admin/datapendaftar_detail.blade.php --}}
@extends('layouts.admin')

@section('title', 'Detail Pendaftar - ' . $participant->full_name)

@section('content')

<div class="mb-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-black text-gray-900 tracking-tight">Detail Pendaftar</h1>

        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.datapendaftar') }}"
                class="inline-flex items-center gap-2 text-sm font-semibold px-4 py-2 rounded-xl border border-gray-200 bg-white text-gray-600 hover:text-[#0b4d75] hover:border-[#0b4d75] transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                Kembali
            </a>
            <a href="{{ route('admin.datapendaftar.edit', $participant->id) }}"
                class="inline-flex items-center gap-2 text-sm font-semibold px-4 py-2 rounded-xl border border-[#0b4d75] bg-[#0b4d75] text-white hover:bg-blue-800 transition shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                Edit Data
            </a>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Kolom Kiri: Info Peserta --}}
    <div class="lg:col-span-2 space-y-5">

        {{-- Card Data Diri --}}
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="bg-gradient-to-r from-[#0b4d75] to-[#0d6096] px-6 py-4">
                <h2 class="text-white font-bold text-base flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                    Data Diri Peserta
                </h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                    @php
                        $fields = [
                            ['label' => 'Nama Lengkap',    'value' => $participant->full_name],
                            ['label' => 'NIK',             'value' => $participant->id_number],
                            ['label' => 'Jenis Kelamin',   'value' => $participant->gender === 'male' ? 'Laki-laki' : 'Perempuan'],
                            ['label' => 'Email',           'value' => $participant->email],
                            ['label' => 'No. WhatsApp',    'value' => $participant->whatsapp],
                            ['label' => 'Kota',            'value' => $participant->city],
                            ['label' => 'Ukuran Jersey',   'value' => $participant->jersey_size],
                        ];
                    @endphp

                    @foreach($fields as $field)
                    <div class="border-b border-gray-50 pb-3">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-1">{{ $field['label'] }}</p>
                        <p class="text-sm font-semibold text-gray-800">{{ $field['value'] ?: '-' }}</p>
                    </div>
                    @endforeach

                    <div class="md:col-span-2 border-b border-gray-50 pb-3">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-1">Alamat Lengkap</p>
                        <p class="text-sm font-semibold text-gray-800">{{ $participant->address ?: '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Kolom Kanan: Info Transaksi --}}
    <div class="space-y-5">

        {{-- Card Status Pembayaran --}}
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h2 class="font-bold text-gray-800 text-sm flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#0b4d75]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    Informasi Pembayaran
                </h2>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-1">No. Order</p>
                    <p class="text-sm font-bold text-[#0b4d75]">{{ $participant->order_id }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-1">Total Pembayaran</p>
                    <p class="text-xl font-black text-gray-900">Rp {{ number_format($participant->gross_amount, 0, ',', '.') }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-1">Metode Pembayaran</p>
                    <p class="text-sm font-semibold text-gray-700">{{ $participant->payment_method ? strtoupper($participant->payment_method) : '-' }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-1">Status</p>
                    @php
                    $statusConfig = [
                        'paid'     => ['label' => 'Lunas',   'class' => 'bg-green-100 text-green-700 border-green-200'],
                        'pending'  => ['label' => 'Pending', 'class' => 'bg-amber-100 text-amber-700 border-amber-200'],
                        'rejected' => ['label' => 'Ditolak', 'class' => 'bg-red-100 text-red-700 border-red-200'],
                        'failed'   => ['label' => 'Gagal',   'class' => 'bg-red-100 text-red-700 border-red-200'],
                        'expired'  => ['label' => 'Expired', 'class' => 'bg-gray-100 text-gray-600 border-gray-200'],
                    ];
                    $cfg = $statusConfig[$participant->payment_status] ?? ['label' => ucfirst($participant->payment_status), 'class' => 'bg-gray-100 text-gray-600'];
                    @endphp
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border {{ $cfg['class'] }}">
                        <span class="w-1.5 h-1.5 rounded-full 
                            {{ $participant->payment_status === 'paid' ? 'bg-green-500' : '' }}
                            {{ $participant->payment_status === 'pending' ? 'bg-amber-500' : '' }}
                            {{ in_array($participant->payment_status, ['failed', 'rejected']) ? 'bg-red-500' : '' }}
                            {{ $participant->payment_status === 'expired' ? 'bg-gray-400' : '' }}
                        "></span>
                        {{ $cfg['label'] }}
                    </span>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-1">Tanggal Daftar</p>
                    <p class="text-sm font-semibold text-gray-700">{{ $participant->created_at->format('d M Y, H:i') }} WIB</p>
                </div>
            </div>

            {{-- Ubah Status --}}
            @php
                $settings = \App\Models\EventSetting::first();
            @endphp
            @if(($settings->payment_mode ?? 'otomatis') == 'otomatis')
            <div class="px-6 pb-6">
                <div class="bg-blue-50 border border-blue-100 rounded-lg p-3 text-sm text-blue-700">
                    <p class="font-bold mb-1">Status Pembayaran Otomatis</p>
                    <p class="text-xs">Status dikelola secara otomatis oleh Midtrans. Anda tidak perlu mengubah status secara manual.</p>
                </div>
            </div>
            @endif
        </div>

        {{-- Bukti Pembayaran --}}
        @if($participant->payment_proof)
        <div class="bg-gray-50 rounded-xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="font-bold text-gray-800 text-sm flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    Bukti Pembayaran Manual
                </h2>
                <p class="text-xs text-gray-500 mt-1">Peserta mengunggah bukti transfer.</p>
            </div>
            <div class="p-4" x-data="{ open: false }">
                <button @click="open = true" type="button" class="text-xs text-blue-600 hover:underline font-semibold focus:outline-none">
                    Lihat Bukti Bayar Manual
                </button>
                
                <!-- Modal Pop-up -->
                <div x-show="open" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center bg-black bg-opacity-75 p-4"
                     @keydown.escape.window="open = false" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0">
                    
                    <!-- Modal Content -->
                    <div @click.away="open = false" class="relative bg-white rounded-xl shadow-2xl max-w-2xl w-full p-4 overflow-hidden"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                         x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                        
                        <!-- Header Modal -->
                        <div class="flex justify-between items-center mb-4 pb-3 border-b border-gray-100">
                            <h3 class="font-bold text-gray-800 text-sm">Bukti Pembayaran: {{ $participant->full_name }}</h3>
                            <button @click="open = false" class="text-gray-400 hover:text-gray-600 focus:outline-none transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        
                        <!-- Gambar Bukti -->
                        <div class="flex justify-center bg-gray-50 rounded-lg overflow-hidden border border-gray-100 max-h-[70vh] overflow-y-auto p-2">
                            <img src="{{ Storage::url($participant->payment_proof) }}" alt="Bukti Pembayaran" class="max-w-full h-auto object-contain">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

    </div>
</div>

@if(session('success'))
<div id="flash-success" class="fixed bottom-6 right-6 z-50 bg-green-600 text-white text-sm font-semibold px-5 py-3 rounded-xl shadow-lg flex items-center gap-2 transition-all">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
    {{ session('success') }}
</div>
<script>setTimeout(() => { document.getElementById('flash-success')?.remove(); }, 3000);</script>
@endif

@endsection
