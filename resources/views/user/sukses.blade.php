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
                            <p class="text-sm font-bold text-gray-400">Status Lunas</p>
                            <p class="text-xs text-gray-400">E-Ticket akan dikirim setelah pembayaran</p>
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

                {{-- Info Email E-Ticket / WA CTA --}}
                @php $eventSettings = \App\Models\EventSetting::first(); @endphp
                @if($participant->payment_status === 'paid' && !empty($eventSettings->wa_group_link))
                <div class="bg-green-50 border border-green-200 rounded-xl p-6 text-center">
                    <h3 class="text-green-800 font-bold mb-2">Langkah Selanjutnya</h3>
                    <p class="text-green-700 text-sm mb-4">Wajib bergabung ke dalam grup WhatsApp untuk mendapatkan informasi terbaru terkait pengambilan Race Pack dan jadwal acara.</p>
                    <a href="{{ $eventSettings->wa_group_link }}" target="_blank" class="inline-flex items-center justify-center gap-2 bg-[#25D366] hover:bg-green-600 text-white font-bold py-3 px-6 rounded-xl transition text-sm shadow-md uppercase w-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.888-.788-1.489-1.761-1.663-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        GABUNG GRUP WHATSAPP PESERTA
                    </a>
                </div>
                @else
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 text-left flex items-start gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-xs text-blue-800 leading-relaxed font-medium">
                        Silakan pantau kotak masuk atau folder spam Email Anda. <strong>E-Ticket</strong> akan dikirimkan otomatis jika pembayaran Anda telah berhasil.
                    </p>
                </div>
                @endif

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
@if($participant->payment_status !== 'paid')
<script>
    setTimeout(function() {
        window.location.reload();
    }, 10000);
</script>
@endif
@endsection
