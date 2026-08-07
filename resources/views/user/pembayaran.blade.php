<!-- resources/views/user/pembayaran.blade.php -->
@extends('layouts.user')

@section('content')
    <div class="bg-gray-50 min-h-screen pt-28 pb-20 font-sans">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header Total Pembayaran -->
            <div class="text-center mb-10">
                <p class="text-gray-500 text-sm font-semibold mb-2 uppercase tracking-widest">BAYAR SEBELUM 7 AGUSTUS 2026 PUKUL 12:00 WIB</p>
                <h1 class="text-4xl md:text-5xl text-[#0b4d75] font-light">IDR 305.000</h1>
            </div>

            <div class="flex flex-col lg:flex-row gap-8">
                
                <!-- KOLOM KIRI: METODE PEMBAYARAN -->
                <div class="w-full lg:w-3/5">
                    <h3 class="font-bold text-gray-500 text-xs uppercase tracking-wider mb-4">METODE PEMBAYARAN</h3>
                    
                    <div class="space-y-4">
                        
                        <!-- Accordion: Transfer Bank -->
                        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm">
                            <button onclick="togglePayment('bank-options', this)" class="w-full flex items-center justify-between p-4 focus:outline-none hover:bg-gray-50 transition">
                                <div class="flex items-center gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#0b4d75]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>
                                    <span class="font-semibold text-gray-700">Transfer Bank</span>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 transform transition-transform duration-300 chevron" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                            </button>
                            <!-- Pilihan Bank (Hidden by default) -->
                            <div id="bank-options" class="hidden p-4 border-t border-gray-100 bg-gray-50">
                                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                                    <div class="bg-white border border-gray-200 rounded p-4 flex items-center justify-center cursor-pointer hover:border-[#0b4d75] transition"><span class="font-bold text-[#0b4d75]">BCA</span></div>
                                    <div class="bg-white border border-gray-200 rounded p-4 flex items-center justify-center cursor-pointer hover:border-[#0b4d75] transition"><span class="font-bold text-orange-500">BNI</span></div>
                                    <div class="bg-white border border-gray-200 rounded p-4 flex items-center justify-center cursor-pointer hover:border-[#0b4d75] transition"><span class="font-bold text-blue-800">Mandiri</span></div>
                                    <div class="bg-white border border-gray-200 rounded p-4 flex items-center justify-center cursor-pointer hover:border-[#0b4d75] transition"><span class="font-bold text-blue-600">BRI</span></div>
                                    <div class="bg-white border border-gray-200 rounded p-4 flex items-center justify-center cursor-pointer hover:border-[#0b4d75] transition"><span class="font-bold text-red-600">CIMB</span></div>
                                    <div class="bg-white border border-gray-200 rounded p-4 flex items-center justify-center cursor-pointer hover:border-[#0b4d75] transition"><span class="font-bold text-green-600">BSI</span></div>
                                </div>
                            </div>
                        </div>

                        <!-- Accordion: E-Wallet -->
                        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm">
                            <button onclick="togglePayment('ewallet-options', this)" class="w-full flex items-center justify-between p-4 focus:outline-none hover:bg-gray-50 transition">
                                <div class="flex items-center gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#0b4d75]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>
                                    <span class="font-semibold text-gray-700">E-Wallet</span>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 transform transition-transform duration-300 chevron" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                            </button>
                            <div id="ewallet-options" class="hidden p-4 border-t border-gray-100 bg-gray-50">
                                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                                    <div class="bg-white border border-gray-200 rounded p-4 flex items-center justify-center cursor-pointer hover:border-[#0b4d75] transition"><span class="font-bold text-green-500">GoPay</span></div>
                                    <div class="bg-white border border-gray-200 rounded p-4 flex items-center justify-center cursor-pointer hover:border-[#0b4d75] transition"><span class="font-bold text-purple-600">OVO</span></div>
                                    <div class="bg-white border border-gray-200 rounded p-4 flex items-center justify-center cursor-pointer hover:border-[#0b4d75] transition"><span class="font-bold text-blue-500">DANA</span></div>
                                </div>
                            </div>
                        </div>

                        <!-- Accordion: QRIS -->
                        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm">
                            <button onclick="togglePayment('qris-options', this)" class="w-full flex items-center justify-between p-4 focus:outline-none hover:bg-gray-50 transition">
                                <div class="flex items-center gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#0b4d75]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" /></svg>
                                    <span class="font-semibold text-gray-700">QRIS</span>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 transform transition-transform duration-300 chevron" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                            </button>
                            <div id="qris-options" class="hidden p-4 border-t border-gray-100 bg-gray-50">
                                <div class="bg-white border border-gray-200 rounded p-6 flex flex-col items-center justify-center">
                                    <img src="https://via.placeholder.com/150?text=QR+CODE+DUMMY" alt="QRIS" class="mb-4">
                                    <p class="text-sm text-gray-500 text-center">Scan QR Code ini menggunakan aplikasi M-Banking atau E-Wallet pilihanmu.</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- KOLOM KANAN: RINGKASAN -->
                <div class="w-full lg:w-2/5">
                    <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm sticky top-28">
                        <h2 class="text-xl text-gray-800 mb-2">Ringkasan Pesanan</h2>
                        <p class="text-xs text-gray-500 mb-6">Transaksi #: INV-2608-OCTOBERUN</p>

                        <div class="flex items-start gap-3 mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#0b4d75] mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                            <div>
                                <h4 class="text-sm font-semibold text-gray-700">Deskripsi</h4>
                                <p class="text-xs text-gray-500 mt-1 leading-relaxed">Pembayaran Tiket OCTOBERUN 2026 INV-2608-OCTOBERUN</p>
                            </div>
                        </div>

                        <div class="space-y-3 text-sm text-gray-600 mb-6 border-b border-t py-4">
                            <div class="flex justify-between">
                                <span>Subtotal</span>
                                <span>IDR 300.000</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Admin Fee</span>
                                <span>IDR 5.000</span>
                            </div>
                        </div>

                        <div class="flex justify-between items-center mb-6">
                            <span class="font-bold text-gray-700">Jumlah Total</span>
                            <span class="font-bold text-xl text-[#0b4d75]">IDR 305.000</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Script untuk efek buka-tutup menu pembayaran -->
    <script>
        function togglePayment(id, buttonElement) {
            // Tutup semua opsi pembayaran yang sedang terbuka
            const allOptions = ['bank-options', 'ewallet-options', 'qris-options'];
            allOptions.forEach(opt => {
                if(opt !== id) document.getElementById(opt).classList.add('hidden');
            });

            // Reset semua icon chevron
            const allChevrons = document.querySelectorAll('.chevron');
            allChevrons.forEach(chev => chev.style.transform = 'rotate(0deg)');

            // Buka opsi yang diklik
            const target = document.getElementById(id);
            const chevron = buttonElement.querySelector('.chevron');
            
            if (target.classList.contains('hidden')) {
                target.classList.remove('hidden');
                chevron.style.transform = 'rotate(180deg)';
            } else {
                target.classList.add('hidden');
                chevron.style.transform = 'rotate(0deg)';
            }
        }
    </script>
@endsection