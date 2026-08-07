{{-- resources/views/user/pembayaran.blade.php --}}
@extends('layouts.user')

@section('content')
<div class="bg-gray-50 min-h-screen pt-28 pb-20 font-sans">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- ===== STEP INDICATOR ===== --}}
        <div class="flex items-center justify-center gap-0 mb-10">
            {{-- Step 1 --}}
            <div class="flex flex-col items-center">
                <div class="w-9 h-9 rounded-full bg-green-500 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                </div>
                <span class="text-xs font-semibold text-green-600 mt-1">Data Diri</span>
            </div>
            <div class="w-20 h-0.5 bg-[#0b4d75] mb-4"></div>
            {{-- Step 2 (aktif) --}}
            <div class="flex flex-col items-center">
                <div class="w-9 h-9 rounded-full bg-[#0b4d75] flex items-center justify-center">
                    <span class="text-white font-bold text-sm">2</span>
                </div>
                <span class="text-xs font-bold text-[#0b4d75] mt-1">Pembayaran</span>
            </div>
            <div class="w-20 h-0.5 bg-gray-200 mb-4"></div>
            {{-- Step 3 --}}
            <div class="flex flex-col items-center">
                <div class="w-9 h-9 rounded-full bg-gray-200 flex items-center justify-center">
                    <span class="text-gray-400 font-bold text-sm">3</span>
                </div>
                <span class="text-xs font-semibold text-gray-400 mt-1">Konfirmasi</span>
            </div>
        </div>

        {{-- ===== HEADER ===== --}}
        <div class="text-center mb-8">
            <p class="text-xs font-bold text-amber-600 bg-amber-50 border border-amber-200 inline-block px-4 py-1.5 rounded-full mb-3 uppercase tracking-wider">
                ⏰ Selesaikan pembayaran dalam 24 jam
            </p>
            <h1 class="text-4xl md:text-5xl font-black text-[#0b4d75]">
                Rp {{ number_format($participant->gross_amount, 0, ',', '.') }}
            </h1>
            <p class="text-gray-500 text-sm mt-2 font-medium">No. Order: <span class="font-black text-gray-800">{{ $participant->order_id }}</span></p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

            {{-- ===== KOLOM KIRI: UPLOAD BUKTI ===== --}}
            <div class="lg:col-span-3 space-y-5">

                {{-- Info Rekening Tujuan --}}
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                    <div class="bg-gradient-to-r from-[#0b4d75] to-[#0d6096] px-5 py-4">
                        <h2 class="text-white font-bold text-base flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>
                            Transfer ke Rekening Berikut
                        </h2>
                    </div>
                    <div class="p-5 space-y-4">
                        {{-- Bank BCA --}}
                        <div class="bg-blue-50 border border-blue-100 rounded-xl p-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-xs text-gray-500 font-semibold uppercase tracking-wide mb-1">Bank BCA</p>
                                    <p class="text-2xl font-black text-[#0b4d75] tracking-widest" id="no-rek">1234567890</p>
                                    <p class="text-sm text-gray-600 font-semibold mt-1">a.n. Panitia OCTOBERUN 2026</p>
                                </div>
                                <button onclick="copyNoRek()" id="btn-copy-rek"
                                    class="flex-shrink-0 flex items-center gap-1.5 bg-[#0b4d75] text-white text-xs font-bold px-3 py-2 rounded-lg hover:bg-[#083b5c] transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>
                                    Salin
                                </button>
                            </div>
                        </div>

                        {{-- Jumlah Transfer --}}
                        <div class="bg-orange-50 border border-orange-100 rounded-xl p-4 flex items-center justify-between">
                            <div>
                                <p class="text-xs text-gray-500 font-semibold uppercase tracking-wide mb-1">Jumlah Transfer (Tepat)</p>
                                <p class="text-xl font-black text-[#e85d04]" id="jumlah-tf">Rp {{ number_format($participant->gross_amount, 0, ',', '.') }}</p>
                            </div>
                            <button onclick="copyJumlah()" id="btn-copy-jumlah"
                                class="flex-shrink-0 flex items-center gap-1.5 bg-[#e85d04] text-white text-xs font-bold px-3 py-2 rounded-lg hover:bg-orange-700 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>
                                Salin
                            </button>
                        </div>

                        <p class="text-xs text-gray-500 bg-gray-50 rounded-lg px-3 py-2 border border-gray-100">
                            ⚠️ Transfer <strong>sesuai nominal</strong> di atas untuk mempermudah verifikasi admin.
                        </p>
                    </div>
                </div>

                {{-- Form Upload Bukti --}}
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b border-gray-100">
                        <h2 class="font-bold text-gray-800 text-base flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#0b4d75]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                            Upload Bukti Transfer
                        </h2>
                        <p class="text-xs text-gray-500 mt-1">Format JPG/PNG, maksimal 3MB</p>
                    </div>

                    @if($errors->any())
                    <div class="mx-5 mt-4 bg-red-50 border border-red-200 rounded-lg p-3">
                        @foreach($errors->all() as $err)
                        <p class="text-red-600 text-xs font-semibold">• {{ $err }}</p>
                        @endforeach
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="mx-5 mt-4 bg-red-50 border border-red-200 rounded-lg p-3">
                        <p class="text-red-600 text-xs font-semibold">{{ session('error') }}</p>
                    </div>
                    @endif

                    <form action="{{ route('pembayaran.upload') }}" method="POST" enctype="multipart/form-data" class="p-5">
                        @csrf
                        <input type="hidden" name="order_id" value="{{ $participant->order_id }}">

                        {{-- Upload Area --}}
                        <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-[#0b4d75] transition cursor-pointer" id="drop-area"
                            onclick="document.getElementById('bukti-input').click()">
                            <div id="preview-area" class="hidden mb-4">
                                <img id="preview-img" src="" alt="Preview" class="max-h-48 mx-auto rounded-lg object-contain">
                            </div>
                            <div id="upload-placeholder">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-300 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                <p class="text-sm font-semibold text-gray-500">Klik untuk pilih foto bukti transfer</p>
                                <p class="text-xs text-gray-400 mt-1">atau drag & drop di sini</p>
                            </div>
                            <input type="file" name="payment_proof" id="bukti-input" accept="image/*" class="hidden"
                                onchange="previewImage(event)">
                        </div>

                        <p id="filename-display" class="text-xs text-center text-gray-400 mt-2"></p>

                        <button type="submit" id="btn-upload-bukti"
                            class="mt-5 w-full bg-[#0b4d75] hover:bg-[#083b5c] text-white font-black py-3.5 rounded-xl transition uppercase tracking-widest shadow-md flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" /></svg>
                            Kirim Bukti Pembayaran
                        </button>
                    </form>
                </div>

            </div>

            {{-- ===== KOLOM KANAN: RINGKASAN ORDER ===== --}}
            <div class="lg:col-span-2">
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm sticky top-28">
                    <div class="bg-gradient-to-r from-gray-800 to-gray-900 px-5 py-4 rounded-t-xl">
                        <h2 class="text-white font-bold text-base">Ringkasan Pesanan</h2>
                        <p class="text-gray-400 text-xs mt-0.5">{{ $participant->order_id }}</p>
                    </div>
                    <div class="p-5 space-y-4">

                        {{-- Info Peserta --}}
                        <div class="space-y-3">
                            @php
                            $rows = [
                                ['label' => 'Nama Peserta', 'value' => $participant->full_name],
                                ['label' => 'BIB Name',     'value' => $participant->bib_name],
                                ['label' => 'Kategori',     'value' => $participant->kategori . ' Run'],
                                ['label' => 'Jersey',       'value' => $participant->jersey_size],
                                ['label' => 'Email',        'value' => $participant->email],
                            ];
                            @endphp
                            @foreach($rows as $row)
                            <div class="flex justify-between items-start gap-3">
                                <span class="text-xs text-gray-500 flex-shrink-0">{{ $row['label'] }}</span>
                                <span class="text-xs font-bold text-gray-800 text-right">{{ $row['value'] }}</span>
                            </div>
                            @endforeach
                        </div>

                        {{-- Rincian Harga --}}
                        <div class="border-t border-gray-100 pt-4 space-y-2">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Subtotal Tiket</span>
                                <span class="font-semibold text-gray-700">Rp 150.000</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Biaya Admin</span>
                                <span class="font-semibold text-gray-700">Rp 5.000</span>
                            </div>
                        </div>

                        {{-- Total --}}
                        <div class="border-t border-gray-100 pt-4 flex justify-between items-center">
                            <span class="font-black text-gray-800 uppercase tracking-wide text-sm">Total Bayar</span>
                            <span class="font-black text-[#e85d04] text-xl">Rp {{ number_format($participant->gross_amount, 0, ',', '.') }}</span>
                        </div>

                        {{-- Status --}}
                        <div class="bg-amber-50 border border-amber-200 rounded-xl p-3 text-center">
                            <span class="inline-flex items-center gap-2 text-amber-700 font-bold text-sm">
                                <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                                Menunggu Pembayaran
                            </span>
                            <p class="text-xs text-amber-600 mt-1">Upload bukti transfer di kiri</p>
                        </div>

                        {{-- Sudah punya bukti? --}}
                        @if($participant->payment_proof)
                        <div class="bg-green-50 border border-green-200 rounded-xl p-3 text-center">
                            <p class="text-green-700 font-bold text-sm flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                Bukti sudah dikirim
                            </p>
                            <p class="text-xs text-green-600 mt-1">Menunggu verifikasi admin</p>
                        </div>
                        @endif

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    function previewImage(event) {
        const file = event.target.files[0];
        if (!file) return;

        document.getElementById('filename-display').textContent = '📎 ' + file.name;
        document.getElementById('upload-placeholder').classList.add('hidden');

        const reader = new FileReader();
        reader.onload = (e) => {
            document.getElementById('preview-img').src = e.target.result;
            document.getElementById('preview-area').classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }

    function copyNoRek() {
        const noRek = document.getElementById('no-rek').textContent.trim();
        navigator.clipboard.writeText(noRek).then(() => {
            const btn = document.getElementById('btn-copy-rek');
            btn.textContent = '✓ Tersalin!';
            setTimeout(() => { btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg> Salin'; }, 2000);
        });
    }

    function copyJumlah() {
        const jumlah = '{{ $participant->gross_amount }}';
        navigator.clipboard.writeText(jumlah).then(() => {
            const btn = document.getElementById('btn-copy-jumlah');
            btn.textContent = '✓ Tersalin!';
            setTimeout(() => { btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg> Salin'; }, 2000);
        });
    }
</script>
@endsection