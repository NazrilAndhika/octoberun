@extends('layouts.admin')

@section('title', 'Tambah Paket Tiket - Admin')

@section('content')
<div class="mb-4 flex items-center gap-4">
    <a href="{{ route('admin.ticket_packages.index') }}" class="text-gray-500 hover:text-[#0b4d75] transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
    </a>
    <h1 class="text-2xl font-black text-gray-900 tracking-tight">Tambah Paket Tiket</h1>
</div>

<div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
    <form action="{{ route('admin.ticket_packages.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Paket <span class="text-red-500">*</span></label>
                <input type="text" name="nama_paket" value="{{ old('nama_paket') }}" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-[#0b4d75] focus:border-[#0b4d75] text-sm px-4 py-2.5">
                @error('nama_paket') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Harga (Rp) <span class="text-red-500">*</span></label>
                <input type="number" name="harga" value="{{ old('harga') }}" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-[#0b4d75] focus:border-[#0b4d75] text-sm px-4 py-2.5">
                @error('harga') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi Singkat</label>
            <textarea name="deskripsi" rows="3" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-[#0b4d75] focus:border-[#0b4d75] text-sm px-4 py-2.5">{{ old('deskripsi') }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Gambar Benefit (Opsional)</label>
            <input type="file" name="gambar_benefit" accept="image/*" class="w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2.5 text-sm bg-gray-50 focus:outline-none focus:ring-[#0b4d75] focus:border-[#0b4d75]">
            <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, WEBP. Maks: 2MB.</p>
        </div>

        <div x-data="{ benefits: [''] }">
            <label class="block text-sm font-semibold text-gray-700 mb-1">Daftar Benefit (Ceklis)</label>
            <p class="text-xs text-gray-500 mb-2">Tambahkan daftar fasilitas/benefit untuk paket ini.</p>
            
            <template x-for="(benefit, index) in benefits" :key="index">
                <div class="flex items-center gap-2 mb-2">
                    <input type="text" x-model="benefits[index]" :name="'benefits[' + index + ']'" placeholder="Contoh: Jersey Exclusive" class="flex-1 border-gray-300 rounded-lg shadow-sm focus:ring-[#0b4d75] focus:border-[#0b4d75] text-sm px-4 py-2.5">
                    <button type="button" @click="benefits.splice(index, 1)" x-show="benefits.length > 1" class="text-red-500 hover:bg-red-50 p-2 rounded-lg transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                    </button>
                </div>
            </template>
            
            <button type="button" @click="benefits.push('')" class="mt-2 text-sm text-[#0b4d75] font-semibold flex items-center gap-1 hover:underline">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                Tambah Benefit
            </button>
        </div>

        <div class="flex items-center gap-2 pt-4 border-t border-gray-100">
            <input type="checkbox" name="is_active" id="is_active" value="1" checked class="rounded border-gray-300 text-[#0b4d75] focus:ring-[#0b4d75]">
            <label for="is_active" class="text-sm font-medium text-gray-700">Aktifkan Paket Ini</label>
        </div>

        <div class="flex justify-end pt-4">
            <button type="submit" class="bg-[#0b4d75] hover:bg-blue-800 text-white font-bold py-2.5 px-6 rounded-lg shadow transition">
                Simpan Paket
            </button>
        </div>
    </form>
</div>
@endsection
