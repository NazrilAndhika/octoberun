{{-- resources/views/admin/datapendaftar_edit.blade.php --}}
@extends('layouts.admin')

@section('title', 'Edit Data Pendaftar - ' . $participant->full_name)

@section('content')

<div class="mb-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-black text-gray-900 tracking-tight">Edit Data Pendaftar</h1>
        </div>
        <a href="{{ route('admin.datapendaftar.show', $participant->id) }}"
            class="inline-flex items-center gap-2 text-sm font-semibold px-4 py-2 rounded-xl border border-gray-200 bg-white text-gray-600 hover:text-[#0b4d75] hover:border-[#0b4d75] transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            Batal
        </a>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Kolom Kiri: Info Transaksi (Readonly) --}}
    <div class="space-y-5">
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <h2 class="font-bold text-gray-800 text-sm flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#0b4d75]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                    Data Transaksi (Terkunci)
                </h2>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <label class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-1 block">No. Order</label>
                    <input type="text" value="{{ $participant->order_id }}" class="w-full border-gray-300 rounded-lg shadow-sm bg-gray-100 text-gray-600 px-3 py-2 text-sm cursor-not-allowed" readonly disabled>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-1 block">Total Pembayaran</label>
                    <input type="text" value="Rp {{ number_format($participant->gross_amount, 0, ',', '.') }}" class="w-full border-gray-300 rounded-lg shadow-sm bg-gray-100 text-gray-600 px-3 py-2 text-sm cursor-not-allowed" readonly disabled>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-1 block">Status Pembayaran</label>
                    <input type="text" value="{{ strtoupper($participant->payment_status) }}" class="w-full border-gray-300 rounded-lg shadow-sm bg-gray-100 text-gray-600 px-3 py-2 text-sm cursor-not-allowed" readonly disabled>
                </div>
            </div>
            <div class="px-6 pb-6">
                <div class="bg-blue-50 border border-blue-100 rounded-lg p-3 text-sm text-blue-700">
                    <p class="font-bold mb-1">Informasi</p>
                    <p class="text-xs">Data transaksi tidak dapat diubah untuk menjaga sinkronisasi dengan Midtrans.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Kolom Kanan: Form Edit Data Diri --}}
    <div class="lg:col-span-2 space-y-5">
        <form action="{{ route('admin.datapendaftar.update', $participant->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="bg-gradient-to-r from-[#0b4d75] to-[#0d6096] px-6 py-4">
                    <h2 class="text-white font-bold text-base flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                        Edit Data Diri Peserta
                    </h2>
                </div>
                
                <div class="p-6">
                    @if ($errors->any())
                        <div class="bg-red-50 text-red-600 p-4 rounded-xl mb-6 text-sm">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                        
                        <div>
                            <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1 block">Nama Lengkap</label>
                            <input type="text" name="full_name" value="{{ old('full_name', $participant->full_name) }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-[#0b4d75] focus:ring-[#0b4d75] px-3 py-2 text-sm" required>
                        </div>
                        
                        <div>
                            <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1 block">Nama BIB (Maks. 10 Huruf)</label>
                            <input type="text" name="bib_name" value="{{ old('bib_name', $participant->bib_name) }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-[#0b4d75] focus:ring-[#0b4d75] px-3 py-2 text-sm" maxlength="10" required>
                        </div>

                        <div>
                            <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1 block">No. KTP/Passport</label>
                            <input type="text" name="id_number" value="{{ old('id_number', $participant->id_number) }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-[#0b4d75] focus:ring-[#0b4d75] px-3 py-2 text-sm" required>
                        </div>

                        <div>
                            <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1 block">Email</label>
                            <input type="email" name="email" value="{{ old('email', $participant->email) }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-[#0b4d75] focus:ring-[#0b4d75] px-3 py-2 text-sm" required>
                        </div>
                        
                        <div>
                            <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1 block">No. WhatsApp</label>
                            <input type="text" name="whatsapp" value="{{ old('whatsapp', $participant->whatsapp) }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-[#0b4d75] focus:ring-[#0b4d75] px-3 py-2 text-sm" required>
                        </div>

                        <div>
                            <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1 block">Jenis Kelamin</label>
                            <select name="gender" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-[#0b4d75] focus:ring-[#0b4d75] px-3 py-2 text-sm" required>
                                <option value="male" {{ old('gender', $participant->gender) === 'male' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="female" {{ old('gender', $participant->gender) === 'female' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>

                        <div>
                            <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1 block">Ukuran Jersey</label>
                            <select name="jersey_size" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-[#0b4d75] focus:ring-[#0b4d75] px-3 py-2 text-sm" required>
                                @foreach(['XXS', 'XS', 'S', 'M', 'L', 'XL', 'XXL'] as $size)
                                    <option value="{{ $size }}" {{ old('jersey_size', $participant->jersey_size) === $size ? 'selected' : '' }}>{{ $size }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div>
                            <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1 block">Kota</label>
                            <input type="text" name="city" value="{{ old('city', $participant->city) }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-[#0b4d75] focus:ring-[#0b4d75] px-3 py-2 text-sm" required>
                        </div>

                        <div class="md:col-span-2">
                            <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1 block">Alamat Lengkap</label>
                            <textarea name="address" rows="3" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-[#0b4d75] focus:ring-[#0b4d75] px-3 py-2 text-sm" required>{{ old('address', $participant->address) }}</textarea>
                        </div>

                    </div>
                </div>
                
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-end">
                    <button type="submit" class="bg-[#0b4d75] hover:bg-blue-800 text-white font-bold py-2.5 px-6 rounded-lg shadow-sm transition flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>

</div>

@endsection
