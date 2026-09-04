{{-- resources/views/user/daftar.blade.php --}}
@extends('layouts.user')

@section('content')
<div class="bg-gray-50 min-h-screen pt-8 pb-20">

    {{-- Tombol Kembali --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-4">
        <a href="{{ url('/') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-[#0b4d75] transition-colors bg-white px-4 py-2 rounded-lg shadow-sm border border-gray-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali
        </a>
    </div>

    {{-- Header Banner --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-8">
        <div class="bg-[#0b4d75] rounded-xl p-8 text-white relative overflow-hidden">
            <div class="relative z-10">
                <h1 class="font-sporty text-4xl font-black italic mb-2">OCTOBERUN <span class="text-[#e85d04]">2026</span></h1>
                <p class="text-blue-100 max-w-xl text-sm">Lengkapi data dirimu untuk bergabung dalam event lari terbesar di bulan Oktober. Bersama, kita raih semangat tanpa batas!</p>
            </div>
        </div>
    </div>

    {{-- Error / Validation --}}
    @if($errors->any())
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6">
        <div class="bg-red-50 border border-red-200 rounded-xl p-4">
            <p class="font-bold text-red-700 text-sm mb-2 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                Mohon perbaiki kesalahan berikut:
            </p>
            <ul class="list-disc list-inside text-red-600 text-sm space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

            {{-- ============ KOLOM KIRI: FORM ============ --}}
            <div class="w-full lg:col-span-2">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 md:p-8">

                    <div class="flex items-center gap-3 mb-8 border-b pb-4">
                        <div class="w-10 h-10 bg-blue-50 rounded-full flex items-center justify-center text-[#0b4d75]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        </div>
                        <div>
                            <h2 class="font-bold text-[#0b4d75] text-lg uppercase tracking-wide">DATA DIRI</h2>
                            <p class="text-xs text-gray-500">Lengkapi data diri dengan benar sesuai KTP</p>
                        </div>
                    </div>

                    <form action="{{ route('daftar.store') }}" method="POST" class="space-y-6">
                        @csrf

                        {{-- RACE DATA --}}
                        <h3 class="font-bold text-[#0b4d75] text-sm uppercase tracking-wider mb-4">RACE DATA</h3>


                        {{-- Nama Lengkap --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-1.5">
                                Nama Lengkap <span class="text-red-500">*</span>
                                <span class="text-gray-400 font-normal">(Sesuai KTP/Passport)</span>
                            </label>
                            <input type="text" name="full_name" id="full_name"
                                value="{{ old('full_name') }}"
                                placeholder="Masukkan nama lengkap"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-[#0b4d75] focus:border-[#0b4d75] py-2.5 px-3 text-sm {{ $errors->has('full_name') ? 'border-red-400' : '' }}"
                                required>
                        </div>

                        {{-- NIK --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-1.5">
                                Nomor Induk Kependudukan (NIK) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="nik" id="nik"
                                value="{{ old('nik') }}"
                                placeholder="Masukkan 16 digit NIK"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-[#0b4d75] focus:border-[#0b4d75] py-2.5 px-3 text-sm {{ $errors->has('nik') ? 'border-red-400' : '' }}"
                                required>
                            @error('nik')
                                <p class="text-red-500 text-xs font-semibold mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Size Jersey --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-1.5">
                                Pilih Size Jersey <span class="text-red-500">*</span>
                            </label>
                            <select name="jersey_size" id="jersey_size"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-[#0b4d75] focus:border-[#0b4d75] py-2.5 px-3 text-sm {{ $errors->has('jersey_size') ? 'border-red-400' : '' }}"
                                required onchange="toggleCustomSize()">
                                <option value="" disabled {{ old('jersey_size') ? '' : 'selected' }}>Pilih Ukuran</option>
                                @foreach(['S','M','L','XL','XXL','3XL','4XL','Custom Size'] as $s)
                                    <option value="{{ $s }}" {{ old('jersey_size') === $s ? 'selected' : '' }}>{{ $s }}</option>
                                @endforeach
                            </select>
                            @error('jersey_size')
                                <p class="text-red-500 text-xs font-semibold mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Custom Size Note (Hidden by default) --}}
                        <div id="custom_size_container" class="{{ old('jersey_size') === 'Custom Size' ? '' : 'hidden' }} mt-4">
                            <label class="block text-sm font-semibold text-gray-600 mb-1.5">
                                Detail Ukuran Custom <span class="text-red-500">*</span>
                                <span class="text-gray-400 font-normal block text-xs mt-0.5">(Harap sesuaikan dengan toleransi jahit 1-2 cm)</span>
                            </label>
                            <div class="flex gap-4">
                                <div class="flex-1">
                                    <label class="block text-xs text-gray-500 mb-1">Lebar (cm)</label>
                                    <input type="number" name="custom_lebar" id="custom_lebar"
                                        value="{{ old('custom_lebar') }}"
                                        placeholder="Misal: 63"
                                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-[#0b4d75] focus:border-[#0b4d75] py-2.5 px-3 text-sm {{ $errors->has('custom_lebar') ? 'border-red-400' : '' }}">
                                    @error('custom_lebar')
                                        <p class="text-red-500 text-xs font-semibold mt-1.5">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="flex-1">
                                    <label class="block text-xs text-gray-500 mb-1">Panjang (cm)</label>
                                    <input type="number" name="custom_panjang" id="custom_panjang"
                                        value="{{ old('custom_panjang') }}"
                                        placeholder="Misal: 75"
                                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-[#0b4d75] focus:border-[#0b4d75] py-2.5 px-3 text-sm {{ $errors->has('custom_panjang') ? 'border-red-400' : '' }}">
                                    @error('custom_panjang')
                                        <p class="text-red-500 text-xs font-semibold mt-1.5">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <script>
                            function toggleCustomSize() {
                                const select = document.getElementById('jersey_size');
                                const container = document.getElementById('custom_size_container');
                                const inputLebar = document.getElementById('custom_lebar');
                                const inputPanjang = document.getElementById('custom_panjang');
                                
                                if (select.value === 'Custom Size') {
                                    container.classList.remove('hidden');
                                    inputLebar.required = true;
                                    inputPanjang.required = true;
                                } else {
                                    container.classList.add('hidden');
                                    inputLebar.required = false;
                                    inputPanjang.required = false;
                                }
                            }
                            
                            // Initialize on load just in case old value is Custom Size
                            document.addEventListener('DOMContentLoaded', function() {
                                toggleCustomSize();
                            });
                        </script>

                        {{-- Email & WhatsApp --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-600 mb-1.5">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <input type="email" name="email" id="email"
                                    value="{{ old('email') }}"
                                    placeholder="contoh@email.com"
                                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-[#0b4d75] focus:border-[#0b4d75] py-2.5 px-3 text-sm {{ $errors->has('email') ? 'border-red-400' : '' }}"
                                    required>
                                @error('email')
                                    <p class="text-red-500 text-xs font-semibold mt-1.5">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-600 mb-1.5">
                                    No. WhatsApp <span class="text-red-500">*</span>
                                </label>
                                <input type="tel" name="whatsapp" id="whatsapp"
                                    value="{{ old('whatsapp') }}"
                                    placeholder="08xxxxxxxxxx"
                                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-[#0b4d75] focus:border-[#0b4d75] py-2.5 px-3 text-sm {{ $errors->has('whatsapp') ? 'border-red-400' : '' }}"
                                    required>
                            </div>
                        </div>

                        {{-- Alamat --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-1.5">
                                Alamat Domisili <span class="text-red-500">*</span>
                            </label>
                            <textarea name="address" id="address" rows="3"
                                placeholder="Masukkan alamat lengkap"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-[#0b4d75] focus:border-[#0b4d75] py-2.5 px-3 text-sm {{ $errors->has('address') ? 'border-red-400' : '' }}"
                                required>{{ old('address') }}</textarea>
                        </div>

                        {{-- DATA TAMBAHAN --}}
                        <h3 class="font-bold text-[#0b4d75] text-sm uppercase tracking-wider mt-8 mb-4 border-t pt-6">DATA TAMBAHAN</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Jenis Kelamin --}}
                            <div>
                                <label class="block text-sm font-semibold text-gray-600 mb-2">
                                    Jenis Kelamin <span class="text-red-500">*</span>
                                </label>
                                <div class="flex items-center gap-6 mt-2">
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="gender" value="male"
                                            {{ old('gender') === 'male' ? 'checked' : '' }}
                                            class="text-[#0b4d75] focus:ring-[#0b4d75] h-4 w-4" required>
                                        <span class="text-sm text-gray-700">Laki-laki</span>
                                    </label>
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="gender" value="female"
                                            {{ old('gender') === 'female' ? 'checked' : '' }}
                                            class="text-[#0b4d75] focus:ring-[#0b4d75] h-4 w-4">
                                        <span class="text-sm text-gray-700">Perempuan</span>
                                    </label>
                                </div>
                            </div>
                            {{-- Kota --}}
                            <div>
                                <label class="block text-sm font-semibold text-gray-600 mb-1.5">
                                    Kota <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="city" id="city"
                                    value="{{ old('city') }}"
                                    placeholder="Masukkan asal kota"
                                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-[#0b4d75] focus:border-[#0b4d75] py-2.5 px-3 text-sm {{ $errors->has('city') ? 'border-red-400' : '' }}"
                                    required>
                            </div>
                        </div>

                        {{-- Pernyataan --}}
                        <div class="pt-4">
                            <label class="flex items-start gap-3 cursor-pointer">
                                <input type="checkbox" id="setuju" class="mt-1 text-[#0b4d75] focus:ring-[#0b4d75]" required>
                                <span class="text-xs text-gray-600 leading-relaxed">
                                    Saya menyatakan bahwa data yang saya isikan adalah <strong>benar</strong> dan saya setuju dengan
                                    <strong>syarat & ketentuan</strong> yang berlaku. Pendaftaran yang sudah lunas tidak dapat dibatalkan.
                                </span>
                            </label>
                        </div>

                        {{-- Submit (hidden, dipanggil dari tombol di sidebar) --}}
                        <button type="submit" id="btn-submit-form" class="hidden">Submit</button>

                    </form>
                </div>
            </div>

            {{-- ============ KOLOM KANAN: RINGKASAN ============ --}}
<div class="w-full lg:col-span-1 sticky top-32 space-y-6">

                {{-- Kotak Harga --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center gap-3 mb-6 border-b pb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#0b4d75]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>
                        <h2 class="font-bold text-[#0b4d75] text-lg uppercase tracking-wide">RINGKASAN PESANAN</h2>
                    </div>

                    <div class="space-y-3 text-sm text-gray-600 mb-6">
                        <div class="flex justify-between">
                            <span>Kategori</span>
                            <span class="font-bold text-gray-900">5K RUN</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Total Peserta</span>
                            <span class="font-bold text-gray-900">1 Orang</span>
                        </div>
                    </div>

                    <div class="space-y-3 text-sm text-gray-600 border-t pt-4 mb-6">
                        <div class="flex justify-between">
                            <span>Subtotal Tiket</span>
                            <span class="font-bold text-gray-900">Rp {{ number_format($settings->ticket_price ?? 150000, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Biaya Admin</span>
                            <span class="font-bold text-gray-900">Rp {{ number_format($settings->admin_fee ?? 5000, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="flex justify-between items-center border-t pt-4 mb-2">
                        <span class="font-black text-[#0b4d75] uppercase tracking-wide">TOTAL BAYAR</span>
                        @php
                            $ticket = $settings->ticket_price ?? 150000;
                            $admin = $settings->admin_fee ?? 5000;
                            $total = $ticket + $admin;
                        @endphp
                        <span class="font-black text-[#e85d04] text-xl">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    @if(($settings->payment_mode ?? 'otomatis') === 'manual')
                        <p class="text-sm text-gray-500 italic mb-6">
                            *Catatan: Khusus metode Transfer Manual, total tagihan akan ditambahkan 3 digit angka acak (maks. Rp 500) pada halaman selanjutnya untuk keperluan verifikasi otomatis.
                        </p>
                    @else
                        <div class="mb-6"></div>
                    @endif

                    {{-- Tombol submit form --}}
                    <button type="button"
                        onclick="document.getElementById('btn-submit-form').click()"
                        class="w-full bg-[#0b4d75] hover:bg-blue-800 text-white font-bold py-3.5 rounded-xl transition uppercase tracking-widest shadow-md flex justify-center items-center gap-2 text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        DAFTAR & LANJUT BAYAR
                    </button>

                    <p class="text-center text-xs text-gray-400 mt-3">
                        Data kamu aman & terlindungi!
                    </p>
                </div>

                {{-- Kotak Informasi --}}
                <div class="bg-cyan-50 rounded-xl border border-cyan-100 p-5">
                    <div class="flex items-center gap-2 mb-3 text-[#0b4d75]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <h3 class="font-bold uppercase tracking-wide text-sm">INFORMASI</h3>
                    </div>
                    <ol class="text-xs text-gray-600 space-y-2 list-decimal list-inside leading-relaxed">
                        <li>Pendaftaran sah setelah <strong>bukti bayar</strong> diverifikasi admin.</li>
                        <li>Batas konfirmasi pembayaran: <strong>1x24 jam</strong> setelah daftar.</li>
                        <li>Tiket tidak dapat dikembalikan (non-refundable).</li>
                        <li>Pastikan data yang diinput sudah benar sebelum submit.</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection