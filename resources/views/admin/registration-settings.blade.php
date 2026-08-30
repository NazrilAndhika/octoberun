<!-- resources/views/admin/registration-settings.blade.php -->
@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-black text-gray-900 tracking-tight">Pengaturan Pendaftaran</h1>
            <p class="text-sm text-gray-500 mt-1">Atur jadwal, harga tiket, dan metode pembayaran event.</p>
        </div>
        <button form="reg-setting-form" type="submit" class="bg-[#0b4d75] hover:bg-blue-800 text-white font-bold py-2.5 px-6 rounded-lg shadow-sm transition">
            Simpan Pengaturan
        </button>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-600 px-4 py-3 rounded-lg mb-6 font-semibold flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
            {{ session('success') }}
        </div>
    @endif

    <!-- Menu Tabs Navigasi -->
    <div class="flex border-b border-gray-200 mb-6 gap-2 overflow-x-auto">
        <button type="button" onclick="switchTabReg('tab-jadwal')" id="btn-jadwal" class="tab-btn-reg active px-4 py-3 font-bold text-sm border-b-2 border-[#e85d04] text-[#e85d04] transition">
            Jadwal & Kuota Event
        </button>
        <button type="button" onclick="switchTabReg('tab-harga')" id="btn-harga" class="tab-btn-reg px-4 py-3 font-bold text-sm border-b-2 border-transparent text-gray-500 hover:text-gray-700 transition">
            Harga Tiket & Biaya Admin
        </button>
        <button type="button" onclick="switchTabReg('tab-pembayaran')" id="btn-pembayaran" class="tab-btn-reg px-4 py-3 font-bold text-sm border-b-2 border-transparent text-gray-500 hover:text-gray-700 transition">
            Mode Pembayaran
        </button>
    </div>

    <form id="reg-setting-form" action="{{ route('admin.registration.update') }}" method="POST" class="space-y-6">
        @csrf
        
        <!-- TAB 1: JADWAL & KUOTA -->
        <div id="tab-jadwal" class="tab-content-reg block">
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                <div class="bg-[#e85d04] px-6 py-4 flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    <h2 class="text-white font-bold tracking-wide">Jadwal & Kuota Event</h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Sakelar Pendaftaran -->
                        <div class="md:col-span-2 bg-gray-50 border border-gray-200 rounded-lg p-4 flex items-center justify-between mb-2">
                            <div>
                                <label class="block text-sm font-bold text-gray-800">Status Pendaftaran Manual</label>
                                <p class="text-xs text-gray-500 mt-1">Buka atau tutup pendaftaran secara paksa (mengabaikan batas waktu & kuota).</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="is_registration_open" class="sr-only peer" value="1" {{ ($settings->is_registration_open ?? true) ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-[#0b4d75]/30 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-500"></div>
                                <span class="ml-3 text-sm font-bold text-gray-700 peer-checked:text-green-600 uppercase" id="status-text">{{ ($settings->is_registration_open ?? true) ? 'BUKA' : 'TUTUP' }}</span>
                            </label>
                        </div>
                        
                        <!-- Tanggal Pelaksanaan -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Tanggal Pelaksanaan Event</label>
                            <input type="date" name="event_date" value="{{ $settings->event_date }}" class="w-full border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-[#0b4d75]/30 focus:border-[#0b4d75] bg-gray-50 text-sm">
                            <p class="text-xs text-gray-500 mt-1">Tanggal acara lari OCTOBERUN diselenggarakan.</p>
                        </div>
                        
                        <!-- Titik Lokasi Event -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Titik Lokasi Event</label>
                            <input type="text" name="event_location" value="{{ $settings->event_location }}" placeholder="Contoh: TITIK 0 CILACAP" class="w-full border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-[#0b4d75]/30 focus:border-[#0b4d75] bg-gray-50 text-sm uppercase">
                            <p class="text-xs text-gray-500 mt-1">Lokasi utama atau titik kumpul pelaksanaan lari.</p>
                        </div>
                        
                        <!-- Kapasitas -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Kapasitas / Kuota Maksimal Peserta</label>
                            <input type="number" name="target_runners" value="{{ $settings->target_runners }}" placeholder="Contoh: 3000" class="w-full border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-[#0b4d75]/30 focus:border-[#0b4d75] bg-gray-50 text-sm">
                            <p class="text-xs text-gray-500 mt-1">Pendaftaran otomatis tertutup jika jumlah pendaftar mencapai ini.</p>
                        </div>
                        
                        <!-- Deadline Pendaftaran -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Batas Akhir Pendaftaran (Deadline)</label>
                            <input type="datetime-local" name="registration_deadline" value="{{ $settings->registration_deadline }}" class="w-full border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-[#0b4d75]/30 focus:border-[#0b4d75] bg-gray-50 text-sm">
                            <p class="text-xs text-gray-500 mt-1">Sistem otomatis ditutup melewati tanggal dan jam ini.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB 2: HARGA TIKET -->
        <div id="tab-harga" class="tab-content-reg hidden">
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                <div class="bg-[#0b4d75] px-6 py-4 flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <h2 class="text-white font-bold tracking-wide">Harga Tiket & Biaya Admin</h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Harga Tiket -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Harga Tiket (Rp)</label>
                            <input type="number" name="ticket_price" value="{{ $settings->ticket_price }}" class="w-full border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-[#0b4d75]/30 focus:border-[#0b4d75] bg-gray-50 text-sm">
                            <p class="text-xs text-gray-500 mt-1">Harga dasar tiket pendaftaran (tanpa titik/koma, contoh: 150000).</p>
                        </div>
                        
                        <!-- Biaya Admin -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Biaya Admin (Rp)</label>
                            <input type="number" name="admin_fee" value="{{ $settings->admin_fee }}" class="w-full border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-[#0b4d75]/30 focus:border-[#0b4d75] bg-gray-50 text-sm">
                            <p class="text-xs text-gray-500 mt-1">Biaya admin atau platform fee (contoh: 5000).</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB 3: MODE PEMBAYARAN -->
        <div id="tab-pembayaran" class="tab-content-reg hidden">
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden" x-data="{ mode: '{{ $settings->payment_mode ?? 'otomatis' }}' }">
                <div class="bg-[#0b4d75] px-6 py-4 flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>
                    <h2 class="text-white font-bold tracking-wide">Pengaturan Mode Pembayaran</h2>
                </div>
                <div class="p-6 space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Pilih Mode Pembayaran</label>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <label class="flex items-center p-4 border rounded-xl cursor-pointer transition-all hover:bg-gray-50" :class="mode === 'otomatis' ? 'border-[#0b4d75] bg-blue-50/50' : 'border-gray-200'">
                                <input type="radio" name="payment_mode" value="otomatis" x-model="mode" class="w-4 h-4 text-[#0b4d75] bg-gray-100 border-gray-300 focus:ring-[#0b4d75]">
                                <div class="ml-3">
                                    <span class="block text-sm font-bold text-gray-900">Otomatis (Payment Gateway)</span>
                                    <span class="block text-xs text-gray-500">Bayar via Midtrans (VA, E-Wallet, QRIS)</span>
                                </div>
                            </label>

                            <label class="flex items-center p-4 border rounded-xl cursor-pointer transition-all hover:bg-gray-50" :class="mode === 'manual' ? 'border-[#0b4d75] bg-blue-50/50' : 'border-gray-200'">
                                <input type="radio" name="payment_mode" value="manual" x-model="mode" class="w-4 h-4 text-[#0b4d75] bg-gray-100 border-gray-300 focus:ring-[#0b4d75]">
                                <div class="ml-3">
                                    <span class="block text-sm font-bold text-gray-900">Manual (Transfer Bank)</span>
                                    <span class="block text-xs text-gray-500">Peserta transfer manual & upload bukti</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Input Bank Manual -->
                    <div x-show="mode === 'manual'" x-transition class="bg-gray-50 p-5 rounded-xl border border-gray-200 space-y-4">
                        <h3 class="text-sm font-bold text-gray-800 border-b pb-2 mb-4">Informasi Rekening Tujuan Transfer</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 mb-1">Nama Bank</label>
                                <input type="text" name="manual_bank_name" value="{{ $settings->manual_bank_name }}" class="w-full border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#0b4d75]/30 focus:border-[#0b4d75] bg-white text-sm" placeholder="Contoh: BCA / Mandiri">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 mb-1">Nomor Rekening</label>
                                <input type="text" name="manual_bank_account" value="{{ $settings->manual_bank_account }}" class="w-full border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#0b4d75]/30 focus:border-[#0b4d75] bg-white text-sm" placeholder="Contoh: 1234567890">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-xs font-semibold text-gray-700 mb-1">Atas Nama</label>
                                <input type="text" name="manual_bank_owner" value="{{ $settings->manual_bank_owner }}" class="w-full border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#0b4d75]/30 focus:border-[#0b4d75] bg-white text-sm" placeholder="Contoh: PT. Event Lari Bersama">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        document.querySelector('input[name="is_registration_open"]').addEventListener('change', function() {
            const statusText = document.getElementById('status-text');
            if(this.checked) {
                statusText.textContent = 'BUKA';
                statusText.classList.remove('text-red-600');
                statusText.classList.add('text-green-600');
            } else {
                statusText.textContent = 'TUTUP';
                statusText.classList.remove('text-green-600');
                statusText.classList.add('text-red-600');
            }
        });

        function switchTabReg(tabId) {
            document.querySelectorAll('.tab-content-reg').forEach(function(content) {
                content.classList.remove('block');
                content.classList.add('hidden');
            });
            document.getElementById(tabId).classList.remove('hidden');
            document.getElementById(tabId).classList.add('block');

            document.querySelectorAll('.tab-btn-reg').forEach(function(btn) {
                btn.classList.remove('border-[#e85d04]', 'text-[#e85d04]');
                btn.classList.add('border-transparent', 'text-gray-500');
            });

            let activeBtn = document.getElementById('btn-' + tabId.replace('tab-', ''));
            activeBtn.classList.remove('border-transparent', 'text-gray-500');
            activeBtn.classList.add('border-[#e85d04]', 'text-[#e85d04]');
        }
    </script>
@endsection