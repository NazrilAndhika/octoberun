<!-- resources/views/admin/dashboard.blade.php -->
@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-black text-gray-900 tracking-tight mb-8">Data Pendaftar</h1>

    <!-- Kotak-kotak Statistik Kosong (Menyerupai desain Figma) -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
        <div class="bg-blue-50/50 border border-blue-100 rounded-lg h-24 shadow-sm"></div>
        <div class="bg-blue-50/50 border border-blue-100 rounded-lg h-24 shadow-sm"></div>
        <div class="bg-blue-50/50 border border-blue-100 rounded-lg h-24 shadow-sm"></div>
        <div class="bg-blue-50/50 border border-blue-100 rounded-lg h-24 shadow-sm"></div>
    </div>

    <!-- Area Tabel Kosong -->
    <div class="bg-white border border-gray-200 rounded-lg shadow-sm min-h-[400px]">
        <!-- Baris atas tabel (Header) -->
        <div class="bg-gray-100/50 border-b border-gray-200 px-6 py-4 rounded-t-lg">
            <div class="h-6 bg-gray-200 rounded w-1/4"></div>
        </div>
        
        <!-- Isi tabel (Kosong) -->
        <div class="p-6">
            <div class="h-64 bg-blue-50/30 rounded border border-dashed border-blue-200 flex items-center justify-center">
                <p class="text-blue-300 text-sm font-semibold">Tabel Data Pendaftar Akan Muncul Di Sini</p>
            </div>
        </div>
    </div>
@endsection