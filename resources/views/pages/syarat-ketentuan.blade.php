@extends('layouts.user')

@section('content')
<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8 pt-32 min-h-screen">
    <div class="text-center mb-12">
        <h1 class="font-sporty font-black text-3xl md:text-4xl italic text-[#0b4d75] uppercase tracking-wide">Syarat & Ketentuan</h1>
        <p class="mt-3 text-gray-500 text-sm md:text-base">Aturan Pendaftaran Event</p>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-8">
        <ul class="space-y-4 text-gray-700 list-disc list-inside">
            <li class="pl-2">Peserta wajib mengisi data diri dengan benar dan valid saat melakukan pendaftaran.</li>
            <li class="pl-2">Pendaftaran dianggap sah setelah peserta menyelesaikan pembayaran dan mendapatkan e-ticket.</li>
            <li class="pl-2">Tiket tidak dapat dipindahtangankan kepada orang lain tanpa persetujuan dari panitia.</li>
            <li class="pl-2">Peserta wajib dalam kondisi sehat secara jasmani dan rohani untuk mengikuti event lari ini.</li>
            <li class="pl-2">Panitia berhak mendiskualifikasi peserta yang melanggar aturan event atau berbuat curang.</li>
            <li class="pl-2">Pengambilan Race Pack harus dilakukan sesuai dengan jadwal yang telah ditentukan dengan membawa e-ticket dan kartu identitas asli.</li>
            <li class="pl-2">Panitia tidak bertanggung jawab atas kehilangan barang berharga milik peserta selama event berlangsung.</li>
        </ul>
    </div>
</div>
@endsection
