@extends('layouts.admin')

@section('title', 'Distribusi Race Pack - Admin')

@section('content')

{{-- HEADER HALAMAN --}}
<div class="mb-6 flex flex-col sm:flex-row sm:items-start justify-between gap-4">
    <div>
        <h1 class="text-2xl font-black text-gray-900 tracking-tight">Distribusi Race Pack</h1>
        <p class="text-sm text-gray-500 mt-1">Gunakan 6 digit terakhir dari No. Order untuk mencari tiket peserta secara cepat.</p>
    </div>
    <div class="bg-blue-50 border border-blue-200 text-[#0b4d75] px-4 py-2 rounded-xl text-sm shadow-sm flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
        <span>Race Pack Terdistribusi: <strong class="font-black text-lg">{{ $totalDistributed }}</strong> / {{ $totalPaid }}</span>
    </div>
</div>

{{-- NOTIFIKASI --}}
@if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6 shadow-sm" role="alert">
        <strong class="font-bold">SUKSES!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif

@if (session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-6 shadow-sm" role="alert">
        <strong class="font-bold">PERHATIAN!</strong>
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
@endif

{{-- AREA PENCARIAN --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 text-center max-w-2xl mx-auto mb-8">
    <form action="{{ route('admin.rpc') }}" method="GET">
        <label for="kode" class="block text-lg font-bold text-gray-800 mb-4">Masukkan 6 Digit Kode E-Ticket</label>
        <div class="flex flex-col sm:flex-row items-center gap-3">
            <input type="text" id="kode" name="kode" value="{{ request('kode') }}" 
                   class="w-full sm:flex-1 text-center text-3xl font-black tracking-[0.2em] uppercase rounded-xl border-2 border-gray-300 focus:border-[#0b4d75] focus:ring-[#0b4d75] py-4"
                   placeholder="XXXXXX"
                   maxlength="6"
                   required
                   autofocus>
            <button type="submit" class="w-full sm:w-auto bg-[#0b4d75] hover:bg-blue-800 text-white px-8 py-5 rounded-xl font-bold text-lg shadow-md transition">
                Cari
            </button>
        </div>
    </form>
</div>

{{-- AREA HASIL --}}
@if ($searchPerformed)
    <div class="max-w-2xl mx-auto">
        @if ($participant)
            
            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
                <div class="bg-blue-50 border-b border-blue-100 p-6 text-center">
                    <p class="text-xs font-bold text-[#0b4d75] tracking-widest uppercase mb-1">Tiket Ditemukan</p>
                    <h2 class="text-3xl font-black text-gray-900">{{ $participant->full_name }}</h2>
                    <p class="text-gray-500 mt-1">No. Order: <span class="font-bold">{{ $participant->order_id }}</span></p>
                </div>
                
                <div class="p-8 text-center">
                    <p class="text-sm font-semibold text-gray-400 uppercase tracking-widest mb-2">Ukuran Jersey</p>
                    <div class="inline-block bg-[#0b4d75] text-white text-6xl font-black rounded-3xl px-10 py-6 mb-8 shadow-inner">
                        {{ $participant->jersey_size }}
                    </div>

                    @if ($participant->is_racepack_taken)
                        <div class="bg-red-50 border-2 border-dashed border-red-300 rounded-xl p-6">
                            <h3 class="text-xl font-black text-red-600 mb-1">SUDAH DIAMBIL</h3>
                            <p class="text-red-500 text-sm">
                                Race Pack ini telah diserahkan pada:<br>
                                <strong class="text-red-700 text-base">{{ $participant->racepack_taken_at ? $participant->racepack_taken_at->format('d M Y H:i') : 'Waktu tidak diketahui' }}</strong>
                            </p>
                        </div>
                    @else
                        <div class="bg-green-50 border-2 border-dashed border-green-300 rounded-xl p-6">
                            <h3 class="text-lg font-bold text-green-700 mb-4">Belum Diambil - Siap Diserahkan!</h3>
                            
                            <form action="{{ route('admin.rpc.confirm', $participant->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin mengkonfirmasi penyerahan Race Pack ini?');">
                                @csrf
                                <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white font-black text-xl py-4 rounded-xl shadow-lg transition transform hover:scale-[1.02]">
                                    KONFIRMASI PENGAMBILAN
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>

        @else
            <div class="bg-red-50 border border-red-200 rounded-2xl p-8 text-center shadow-sm">
                <div class="w-20 h-20 bg-red-100 text-red-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                </div>
                <h2 class="text-2xl font-bold text-red-700 mb-2">Data Tidak Ditemukan</h2>
                <p class="text-red-600 text-lg">Tiket dengan kode <strong>{{ strtoupper($kode) }}</strong> tidak ditemukan atau status pembayarannya belum LUNAS.</p>
            </div>
        @endif
    </div>
@endif

@endsection
