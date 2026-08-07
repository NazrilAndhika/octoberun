<!-- resources/views/user/daftar.blade.php -->
@extends('layouts.user')

@section('content')
    <div class="bg-gray-50 min-h-screen pt-28 pb-20">
        
        <!-- Header Banner -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-8">
            <div class="bg-[#0b4d75] rounded-xl p-8 text-white bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] relative overflow-hidden">
                <div class="relative z-10">
                    <h1 class="font-sporty text-4xl font-black italic mb-2">OCTOBERUN <span class="text-[#e85d04]">2026</span></h1>
                    <p class="text-blue-100 max-w-xl text-sm">Lengkapi data dirimu untuk bergabung dalam event lari terbesar di bulan Oktober. Bersama, kita raih semangat tanpa batas!</p>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8">
                
                <!-- KOLOM KIRI: FORMULIR PENDAFTARAN -->
                <div class="w-full lg:w-2/3">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 md:p-8">
                        
                        <div class="flex items-center gap-3 mb-8 border-b pb-4">
                            <div class="w-10 h-10 bg-blue-50 rounded-full flex items-center justify-center text-[#0b4d75]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                            </div>
                            <div>
                                <h2 class="font-bold text-[#0b4d75] text-lg uppercase tracking-wide">DATA DIRI</h2>
                                <p class="text-xs text-gray-500">Lengkapi data diri dengan benar</p>
                            </div>
                        </div>

                        <!-- Form Start (Nanti action-nya diisi saat memproses data) -->
                        <form action="#" method="POST" class="space-y-6">
                            
                            <h3 class="font-bold text-[#0b4d75] text-sm uppercase tracking-wider mb-4">RACE DATA</h3>
                            
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Nama di BIB (Maks 10 Huruf)</label>
                                <input type="text" maxlength="10" placeholder="CTH : NAZRIL" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-[#0b4d75] focus:border-[#0b4d75] uppercase" required>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Nama Lengkap ( Sesuai ID )</label>
                                <input type="text" placeholder="Masukkan nama lengkap" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-[#0b4d75] focus:border-[#0b4d75]" required>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1">No. ID ( KTP / Passport )</label>
                                    <input type="text" placeholder="Masukkan nomor ID" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-[#0b4d75] focus:border-[#0b4d75]" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1">Pilih Size Jersey</label>
                                    <select class="w-full border-gray-300 rounded-md shadow-sm focus:ring-[#0b4d75] focus:border-[#0b4d75]" required>
                                        <option value="" disabled selected>Pilih Ukuran</option>
                                        <option value="S">S</option>
                                        <option value="M">M</option>
                                        <option value="L">L</option>
                                        <option value="XL">XL</option>
                                        <option value="XXL">XXL</option>
                                    </select>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1">Email</label>
                                    <input type="email" placeholder="Masukkan email aktif" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-[#0b4d75] focus:border-[#0b4d75]" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1">No. WhatsApp</label>
                                    <input type="tel" placeholder="Masukkan no WhatsApp" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-[#0b4d75] focus:border-[#0b4d75]" required>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Alamat Domisili</label>
                                <textarea placeholder="Masukkan alamat lengkap" rows="3" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-[#0b4d75] focus:border-[#0b4d75]" required></textarea>
                            </div>

                            <h3 class="font-bold text-[#0b4d75] text-sm uppercase tracking-wider mt-8 mb-4 border-t pt-6">DATA TAMBAHAN</h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Jenis Kelamin</label>
                                    <div class="flex items-center gap-6">
                                        <label class="flex items-center gap-2 cursor-pointer">
                                            <input type="radio" name="gender" value="Laki-laki" class="text-[#0b4d75] focus:ring-[#0b4d75]" required>
                                            <span class="text-sm text-gray-700">Laki - laki</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer">
                                            <input type="radio" name="gender" value="Perempuan" class="text-[#0b4d75] focus:ring-[#0b4d75]" required>
                                            <span class="text-sm text-gray-700">Perempuan</span>
                                        </label>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1">Kota</label>
                                    <input type="text" placeholder="Masukkan asal kota" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-[#0b4d75] focus:border-[#0b4d75]" required>
                                </div>
                            </div>

                            <div class="pt-6">
                                <p class="text-xs text-blue-800 bg-blue-50 p-4 rounded-md">
                                    Saya menyatakan bahwa data yang saya isikan adalah benar dan saya setuju dengan syarat & ketentuan yang berlaku.
                                </p>
                            </div>

                        </form>
                    </div>
                </div>

                <!-- KOLOM KANAN: RINGKASAN PESANAN -->
                <div class="w-full lg:w-1/3">
                    <div class="sticky top-28 space-y-6">
                        
                        <!-- Kotak Harga -->
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
                                    <span class="font-bold text-gray-900">Rp. 300.000</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Biaya Admin</span>
                                    <span class="font-bold text-gray-900">Rp. 5.000</span>
                                </div>
                            </div>

                            <div class="flex justify-between items-center border-t pt-4 mb-8">
                                <span class="font-black text-[#0b4d75] uppercase tracking-wide">TOTAL BAYAR</span>
                                <span class="font-black text-[#e85d04] text-lg">RP. 305.000</span>
                            </div>

                            <!-- Tombol Bayar (Sementara submit form kosong) -->
                            <a href="{{ route('pembayaran') }}" class="w-full bg-[#0b4d75] hover:bg-blue-800 text-white font-bold py-3 rounded-md transition uppercase tracking-widest shadow-md flex justify-center text-center">
                                LANJUT PEMBAYARAN
                            </a>
                        </div>

                        <!-- Kotak Informasi -->
                        <div class="bg-cyan-50 rounded-xl border border-cyan-100 p-6">
                            <div class="flex items-center gap-2 mb-4 text-[#0b4d75]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                <h3 class="font-bold uppercase tracking-wide text-sm">INFORMASI</h3>
                            </div>
                            <ol class="text-xs text-gray-600 space-y-2 list-decimal list-inside leading-relaxed">
                                <li>Pendaftaran hanya dianggap sah setelah pembayaran berhasil.</li>
                                <li>Tiket tidak dapat dikembalikan (non-refundable).</li>
                                <li>Pastikan data yang diinput sudah benar.</li>
                                <li>Untuk bantuan, hubungi kami melalui kontak di bagian bawah halaman.</li>
                            </ol>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection