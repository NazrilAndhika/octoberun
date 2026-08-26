@extends('layouts.user')

@section('content')
<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8 pt-32 min-h-screen">
    <div class="text-center mb-12">
        <h1 class="font-sporty font-black text-3xl md:text-4xl italic text-[#0b4d75] uppercase tracking-wide">FAQ</h1>
        <p class="mt-3 text-gray-500 text-sm md:text-base">Pertanyaan yang Sering Diajukan</p>
    </div>

    <div class="space-y-4">
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-2">Kapan acara ini diselenggarakan?</h3>
            <p class="text-gray-600">Acara ini akan diselenggarakan pada hari Minggu, 11 Oktober 2026.</p>
        </div>
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-2">Di mana lokasi acara?</h3>
            <p class="text-gray-600">Lokasi acara berada di Titik 0 Cilacap.</p>
        </div>
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-2">Apa saja yang didapatkan oleh peserta?</h3>
            <p class="text-gray-600">Peserta akan mendapatkan Jersey eksklusif, Medali Finisher, dan fasilitas pendukung lainnya selama acara.</p>
        </div>
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-2">Bagaimana cara mendaftar?</h3>
            <p class="text-gray-600">Pendaftaran dapat dilakukan secara online melalui website ini dengan mengisi formulir dan menyelesaikan pembayaran.</p>
        </div>
    </div>
</div>
@endsection
