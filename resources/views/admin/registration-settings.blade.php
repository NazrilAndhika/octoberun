<!-- resources/views/admin/registration-settings.blade.php -->
@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-black text-gray-900 tracking-tight">Pengaturan Pendaftaran</h1>
        <button form="reg-setting-form" type="submit" class="bg-[#0b4d75] hover:bg-blue-800 text-white font-bold py-2 px-6 rounded-lg shadow-sm transition">
            Simpan Pengaturan
        </button>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-600 px-4 py-3 rounded-lg mb-6 font-semibold">
            {{ session('success') }}
        </div>
    @endif

    <form id="reg-setting-form" action="{{ route('admin.registration.update') }}" method="POST" class="space-y-6">
        @csrf
        
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
            <h2 class="text-lg font-bold text-[#e85d04] border-b pb-3 mb-6">Jadwal & Kuota Event</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Tanggal Pelaksanaan -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Tanggal Pelaksanaan Event</label>
                    <input type="date" name="event_date" value="{{ $settings->event_date }}" class="w-full border-gray-300 rounded-md focus:ring-[#0b4d75]">
                    <p class="text-xs text-gray-500 mt-1">Tanggal acara lari OCTOBERUN diselenggarakan.</p>
                </div>
                
                <!-- Titik Lokasi Event -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Titik Lokasi Event</label>
                    <input type="text" name="event_location" value="{{ $settings->event_location }}" placeholder="Contoh: TITIK 0 CILACAP" class="w-full border-gray-300 rounded-md focus:ring-[#0b4d75] uppercase">
                    <p class="text-xs text-gray-500 mt-1">Lokasi utama atau titik kumpul pelaksanaan lari.</p>
                </div>
                
                <!-- Kapasitas -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Kapasitas / Kuota Maksimal Peserta</label>
                    <input type="number" name="target_runners" value="{{ $settings->target_runners }}" placeholder="Contoh: 3000" class="w-full border-gray-300 rounded-md focus:ring-[#0b4d75]">
                    <p class="text-xs text-gray-500 mt-1">Pendaftaran akan otomatis tertutup jika jumlah pendaftar mencapai angka ini.</p>
                </div>
                
                <!-- Deadline Pendaftaran -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Batas Akhir Pendaftaran (Deadline)</label>
                    <input type="datetime-local" name="registration_deadline" value="{{ $settings->registration_deadline }}" class="w-full md:w-1/2 border-gray-300 rounded-md focus:ring-[#0b4d75]">
                    <p class="text-xs text-gray-500 mt-1">Sistem form pendaftaran akan otomatis ditutup melewati tanggal dan jam ini.</p>
                </div>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 mt-6">
            <h2 class="text-lg font-bold text-[#e85d04] border-b pb-3 mb-6">Harga Tiket & Biaya Admin</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Harga Tiket -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Harga Tiket (Rp)</label>
                    <input type="number" name="ticket_price" value="{{ $settings->ticket_price }}" class="w-full border-gray-300 rounded-md focus:ring-[#0b4d75]">
                    <p class="text-xs text-gray-500 mt-1">Harga dasar tiket pendaftaran (tanpa titik/koma, contoh: 150000).</p>
                </div>
                
                <!-- Biaya Admin -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Biaya Admin (Rp)</label>
                    <input type="number" name="admin_fee" value="{{ $settings->admin_fee }}" class="w-full border-gray-300 rounded-md focus:ring-[#0b4d75]">
                    <p class="text-xs text-gray-500 mt-1">Biaya admin atau platform fee (contoh: 5000).</p>
                </div>
            </div>
        </div>
    </form>
@endsection