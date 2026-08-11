{{-- resources/views/admin/datapendaftar_detail.blade.php --}}
@extends('layouts.admin')

@section('title', 'Detail Pendaftar - ' . $participant->full_name)

@section('content')

<div class="mb-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-black text-gray-900 tracking-tight">Detail Pendaftar</h1>
            <nav class="flex items-center gap-1.5 text-xs text-gray-400 mt-1 font-medium">
                <a href="{{ route('admin.datapendaftar') }}" class="hover:text-[#0b4d75] transition">Data Pendaftar</a>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-[#0b4d75] font-bold">{{ $participant->order_id }}</span>
            </nav>
        </div>
        <a href="{{ route('admin.datapendaftar') }}"
            class="inline-flex items-center gap-2 text-sm font-semibold px-4 py-2 rounded-xl border border-gray-200 bg-white text-gray-600 hover:text-[#0b4d75] hover:border-[#0b4d75] transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            Kembali
        </a>
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
                            ['label' => 'Nama BIB',        'value' => $participant->bib_name],
                            ['label' => 'No. KTP/Passport','value' => $participant->id_number],
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
                            'paid'    => ['label' => 'Lunas',   'class' => 'bg-green-100 text-green-700 border border-green-200'],
                            'pending' => ['label' => 'Pending', 'class' => 'bg-amber-100 text-amber-700 border border-amber-200'],
                            'failed'  => ['label' => 'Gagal',   'class' => 'bg-red-100 text-red-700 border border-red-200'],
                            'expired' => ['label' => 'Expired', 'class' => 'bg-gray-100 text-gray-600 border border-gray-200'],
                        ];
                        $cfg = $statusConfig[$participant->payment_status] ?? ['label' => ucfirst($participant->payment_status), 'class' => 'bg-gray-100 text-gray-600 border border-gray-200'];
                    @endphp
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold {{ $cfg['class'] }}">
                        {{ $cfg['label'] }}
                    </span>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-1">Tanggal Daftar</p>
                    <p class="text-sm font-semibold text-gray-700">{{ $participant->created_at->format('d M Y, H:i') }} WIB</p>
                </div>
            </div>

            {{-- Ubah Status --}}
            <div class="px-6 pb-6">
                <form method="POST" action="{{ route('admin.datapendaftar.status', $participant->id) }}">
                    @csrf
                    @method('PATCH')
                    <label class="block text-xs font-semibold text-gray-500 mb-2 uppercase tracking-wide">Ubah Status Pembayaran</label>
                    <div class="flex gap-2">
                        <select name="payment_status" id="detail-status-select"
                            class="flex-1 text-sm border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0b4d75]/30 focus:border-[#0b4d75]">
                            <option value="paid"    {{ $participant->payment_status === 'paid'    ? 'selected' : '' }}> Lunas</option>
                            <option value="pending" {{ $participant->payment_status === 'pending' ? 'selected' : '' }}> Pending</option>
                            <option value="failed"  {{ $participant->payment_status === 'failed'  ? 'selected' : '' }}> Gagal</option>
                            <option value="expired" {{ $participant->payment_status === 'expired' ? 'selected' : '' }}> Expired</option>
                        </select>
                        <button type="submit" id="btn-simpan-status"
                            class="px-4 py-2 bg-[#0b4d75] text-white font-bold text-sm rounded-lg hover:bg-[#083b5c] transition">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Bukti Pembayaran --}}
        @if($participant->payment_proof)
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h2 class="font-bold text-gray-800 text-sm flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#0b4d75]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    Bukti Pembayaran
                </h2>
            </div>
            <div class="p-4">
                <a href="{{ Storage::url($participant->payment_proof) }}" target="_blank">
                    <img src="{{ Storage::url($participant->payment_proof) }}" alt="Bukti Bayar" class="w-full rounded-lg object-cover border border-gray-200 hover:opacity-90 transition">
                </a>
                <a href="{{ Storage::url($participant->payment_proof) }}" target="_blank"
                    class="mt-3 flex items-center justify-center gap-2 text-sm font-semibold text-[#0b4d75] hover:underline">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                    Lihat Ukuran Penuh
                </a>
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
