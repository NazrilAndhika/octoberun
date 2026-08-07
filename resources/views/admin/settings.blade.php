<!-- resources/views/admin/settings.blade.php -->
@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-black text-gray-900 tracking-tight">Kelola Konten Website</h1>
        <button form="setting-form" type="submit" class="bg-[#e85d04] hover:bg-orange-700 text-white font-bold py-2 px-6 rounded-lg shadow-sm transition">
            Simpan Perubahan
        </button>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-600 px-4 py-3 rounded-lg mb-6 font-semibold">
            {{ session('success') }}
        </div>
    @endif
    <!-- Form Pembungkus Utama -->
    <form id="setting-form" action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <!-- SECTION 1: HERO & EVENT INFO -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
            <h2 class="text-lg font-bold text-[#0b4d75] border-b pb-3 mb-6">1. Hero Section & Info Dasar</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Nama Event (Teks Kecil Orange)</label>
                    <input type="text" name="event_name" value="{{ $settings->event_name }}" class="w-full border-gray-300 rounded-md focus:ring-[#0b4d75] focus:border-[#0b4d75]">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Judul Utama Hero (Biru Besar)</label>
                    <input type="text" name="hero_title" value="{{ $settings->hero_title }}" class="w-full border-gray-300 rounded-md focus:ring-[#0b4d75] focus:border-[#0b4d75]">
                </div>
                
                <!-- Tanggal & Kuota Pendaftaran -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Tanggal Pelaksanaan Event</label>
                    <input type="date" name="event_date" value="{{ $settings->event_date }}" class="w-full border-gray-300 rounded-md focus:ring-[#0b4d75] focus:border-[#0b4d75]">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Kapasitas / Kuota Peserta</label>
                    <input type="number" name="target_runners" value="{{ $settings->target_runners }}" placeholder="Contoh: 3000" class="w-full border-gray-300 rounded-md focus:ring-[#0b4d75] focus:border-[#0b4d75]">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Batas Akhir Pendaftaran (Deadline)</label>
                    <input type="datetime-local" name="registration_deadline" class="w-full md:w-1/2 border-gray-300 rounded-md focus:ring-[#0b4d75] focus:border-[#0b4d75]">
                </div>

                <div class="md:col-span-2 mt-4 pt-4 border-t border-gray-100">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Upload Foto Background Hero (Landing Page)</label>
                    <input type="file" name="hero_image" class="w-full border border-gray-300 p-2 rounded-md focus:outline-none">
                    @if($settings->hero_image)
                        <p class="text-xs text-green-600 mt-1">✓ Foto hero sudah terpasang.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- SECTION 2: TENTANG KAMI -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
            <h2 class="text-lg font-bold text-[#0b4d75] border-b pb-3 mb-6">2. Tentang Kami</h2>
            
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Judul Tentang Kami</label>
                    <input type="text" name="about_title" value="{{ $settings->about_title }}" class="w-full border-gray-300 rounded-md focus:ring-[#0b4d75] focus:border-[#0b4d75]">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi (Paragraph)</label>
                    <textarea name="about_text" rows="4" class="w-full border-gray-300 rounded-md focus:ring-[#0b4d75] focus:border-[#0b4d75]">{{ $settings->about_text }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Upload Gambar 'Tentang Kami'</label>
                    <input type="file" name="about_image" class="w-full border border-gray-300 p-2 rounded-md focus:outline-none">
                </div>
            </div>
        </div>

        <!-- SECTION 3: MEDIA (JERSEY, RUTE, RACEPACK) -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
            <h2 class="text-lg font-bold text-[#0b4d75] border-b pb-3 mb-6">3. Desain Jersey, Peta Rute & Race Pack</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Jersey -->
                <div class="border-2 border-dashed border-cyan-300 bg-cyan-50/30 p-4 rounded-lg text-center">
                    <label class="block text-sm font-bold text-cyan-800 mb-2">Upload Desain Jersey</label>
                    <input type="file" name="jersey_image" class="w-full text-xs text-gray-500 file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:bg-cyan-50 file:text-cyan-700">
                </div>
                <!-- Rute -->
                <div class="border-2 border-dashed border-[#e85d04]/30 bg-orange-50/30 p-4 rounded-lg text-center">
                    <label class="block text-sm font-bold text-[#e85d04] mb-2">Upload Peta Rute Lari</label>
                    <input type="file" name="route_image" class="w-full text-xs text-gray-500 file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:bg-orange-50 file:text-[#e85d04]">
                </div>
                <!-- Race Pack -->
                <div class="border-2 border-dashed border-blue-300 bg-blue-50/30 p-4 rounded-lg text-center">
                    <label class="block text-sm font-bold text-[#0b4d75] mb-2">Upload Foto Race Pack</label>
                    <input type="file" name="racepack_image" class="w-full text-xs text-gray-500 file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:bg-blue-50 file:text-blue-700">
                </div>
            </div>
        </div>

    </form>
@endsection