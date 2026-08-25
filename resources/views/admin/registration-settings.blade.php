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
                </script>

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