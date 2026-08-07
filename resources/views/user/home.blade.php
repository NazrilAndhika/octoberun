<!-- resources/views/user/home.blade.php -->
@extends('layouts.user')

@section('content')
    <!-- CSS untuk Smooth Scroll ke id section saat navbar diklik -->
    <style> html { scroll-behavior: smooth; } </style>

    <!-- ========================================== -->
    <!-- BAGIAN 1: HERO SECTION (ID: beranda)       -->
    <!-- ========================================== -->
    <section id="beranda" class="relative bg-gray-100 pt-28 pb-20 lg:pt-40 lg:pb-32 overflow-hidden min-h-[650px] flex items-center" 
             style="background-image: url('{{ !empty($settings->hero_image) ? asset('storage/' . $settings->hero_image) : asset('img/hero-bg.jpg') }}'); background-size: cover; background-position: right center;">
        
        <div class="absolute inset-0 bg-gradient-to-r from-white via-white/90 to-transparent sm:via-white/70"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
            <div class="max-w-2xl">
                
                <h3 class="text-[#e85d04] font-sporty font-bold text-lg md:text-xl italic tracking-wide mb-2 uppercase">
                    {{ $settings->event_name ?? 'OCTOBERUN 2026' }}
                </h3>
                <h1 class="font-sporty text-5xl md:text-6xl lg:text-7xl font-black italic tracking-tighter text-[#0b4d75] leading-none mb-4 uppercase drop-shadow-md">
                    {{ $settings->hero_title ?? 'RUN BEYOND LIMITS' }}
                </h1>
                
                <div class="flex items-center gap-2 md:gap-3 text-[#0b4d75] font-bold text-xs md:text-sm tracking-widest mb-6 uppercase flex-wrap">
                    <span>Faster</span>
                    <div class="w-1.5 h-1.5 rounded-full bg-[#e85d04]"></div>
                    <span>Stronger</span>
                    <div class="w-1.5 h-1.5 rounded-full bg-[#e85d04]"></div>
                    <span>Together</span>
                </div>

                <p class="text-gray-700 mb-8 max-w-md text-sm md:text-base leading-relaxed">
                    Bergabunglah dalam event lari terbesar di bulan Oktober. Rasakan pengalaman lari yang seru, menantang, dan penuh makna bersama ribuan pelari lainnya!
                </p>

                <div class="flex flex-col sm:flex-row items-center gap-4">
                    <a href="{{ route('daftar') }}" class="w-full sm:w-auto justify-center bg-[#0b4d75] hover:bg-blue-800 text-white text-sm font-bold py-3 px-8 rounded flex items-center gap-2 transition duration-300 shadow-lg transform hover:-translate-y-1">
                        DAFTAR SEKARANG
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                    <a href="#" class="w-full sm:w-auto justify-center bg-white/80 backdrop-blur-sm border border-gray-300 hover:border-gray-400 text-[#0b4d75] text-sm font-bold py-3 px-8 rounded flex items-center gap-2 transition duration-300 shadow-sm transform hover:-translate-y-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#e85d04]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        LIHAT VIDEO
                    </a>
                </div>
                
            </div>
        </div>
    </section>

    <!-- ========================================== -->
    <!-- BAGIAN 2: KARTU LAYANAN (ID: info)         -->
    <!-- ========================================== -->
    <section id="info" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative -mt-12 md:-mt-16 z-20 pb-16">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 md:gap-6">
            
            <!-- Kartu 1: Jersey (Memicu Pop-up modal-jersey) -->
            <div class="bg-white rounded-lg shadow-xl border-t-4 border-cyan-500 p-6 md:p-8 text-center flex flex-col items-center hover:-translate-y-2 transition duration-300">
                <div class="w-12 h-12 md:w-16 md:h-16 rounded-full border-2 border-cyan-500 flex items-center justify-center mb-4 text-cyan-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:h-8 md:w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                </div>
                <h4 class="font-sporty font-bold text-lg md:text-xl text-[#0b4d75] italic mb-2 uppercase">JERSEY & SIZE</h4>
                <p class="text-gray-500 text-xs md:text-sm mb-6 flex-grow">Bahan High Performance yang ringan, sejuk, dan anti-bau.</p>
                <button onclick="openModal('modal-jersey')" class="w-full bg-[#0b4d75] hover:bg-blue-800 text-white font-bold py-2.5 rounded text-sm transition">LIHAT DETAIL &rarr;</button>
            </div>

            <!-- Kartu 2: Race Pack (Memicu Pop-up modal-racepack) -->
            <div class="bg-white rounded-lg shadow-xl border-t-4 border-[#e85d04] p-6 md:p-8 text-center flex flex-col items-center hover:-translate-y-2 transition duration-300">
                <div class="w-12 h-12 md:w-16 md:h-16 rounded-full border-2 border-[#e85d04] flex items-center justify-center mb-4 text-[#e85d04]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:h-8 md:w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <h4 class="font-sporty font-bold text-lg md:text-xl text-[#e85d04] italic mb-2 uppercase">RACE PACK</h4>
                <p class="text-gray-500 text-xs md:text-sm mb-6 flex-grow">Jersey, Medali, BIB, dan 1 Bibit Pohon spesial untukmu.</p>
                <button onclick="openModal('modal-racepack')" class="w-full bg-[#e85d04] hover:bg-orange-700 text-white font-bold py-2.5 rounded text-sm transition">ISI LENGKAP &rarr;</button>
            </div>

            <!-- Kartu 3: Rute Lari (Memicu Pop-up modal-rute) -->
            <div class="bg-white rounded-lg shadow-xl border-t-4 border-cyan-500 p-6 md:p-8 text-center flex flex-col items-center hover:-translate-y-2 transition duration-300 sm:col-span-2 md:col-span-1">
                <div class="w-12 h-12 md:w-16 md:h-16 rounded-full border-2 border-cyan-500 flex items-center justify-center mb-4 text-cyan-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:h-8 md:w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                </div>
                <h4 class="font-sporty font-bold text-lg md:text-xl text-cyan-500 italic mb-2 uppercase">RUTE LARI</h4>
                <p class="text-gray-500 text-xs md:text-sm mb-6 flex-grow">Rute 5K melewati landmark ikonik kota.</p>
                <button onclick="openModal('modal-rute')" class="w-full bg-cyan-500 hover:bg-cyan-600 text-white font-bold py-2.5 rounded text-sm transition">LIHAT PETA &rarr;</button>
            </div>

        </div>
    </section>

    <!-- ========================================== -->
    <!-- BAGIAN 3: BANNER STATISTIK (KEMBALI UTUH)  -->
    <!-- ========================================== -->
    <section class="bg-[#0b4d75] text-white py-10 relative z-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 md:gap-4 divide-x-0 md:divide-x-2 divide-blue-600/50">
                
                <!-- Stat 1: Pelari -->
                <div class="flex items-center justify-center gap-4 px-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white opacity-90" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <div>
                        <h3 class="text-2xl md:text-3xl font-black font-sporty italic leading-none">{{ $settings->target_runners ?? '3.000+' }}</h3>
                        <p class="text-xs tracking-widest font-bold mt-1 uppercase text-blue-200">PELARI</p>
                    </div>
                </div>

                <!-- Stat 2: Tanggal -->
                <div class="flex items-center justify-center gap-4 px-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white opacity-90" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <div>
                        <h3 class="text-lg md:text-xl font-black font-sporty italic leading-tight">{{ $settings->event_date ?? '18 OKTOBER 2026' }}</h3>
                        <p class="text-xs tracking-widest font-bold uppercase text-blue-200">MINGGU</p>
                    </div>
                </div>

                <!-- Stat 3: Jarak Lari (Permintaan GSC 5K saja) -->
                <div class="flex items-center justify-center gap-4 px-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white opacity-90" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9" />
                    </svg>
                    <div>
                        <h3 class="text-xs tracking-widest font-bold uppercase text-blue-200 mb-0.5">JARAK LARI</h3>
                        <p class="text-xl md:text-2xl font-black font-sporty italic leading-none">5K</p>
                    </div>
                </div>

                <!-- Stat 4: Tujuan -->
                <div class="flex items-center justify-center gap-4 px-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white opacity-90" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                    </svg>
                    <div>
                        <h3 class="text-2xl md:text-3xl font-black font-sporty italic leading-none">1 TUJUAN</h3>
                        <p class="text-xs tracking-widest font-bold mt-1 uppercase text-blue-200">SATU SEMANGAT</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ========================================== -->
    <!-- BAGIAN 4: TENTANG KAMI (ID: tentang)       -->
    <!-- ========================================== -->
    <section id="tentang" class="bg-white pt-20 pb-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Grid Tentang Kami -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center mb-20">
                <!-- Kiri: Teks -->
                <div>
                    <h2 class="font-sporty font-black text-3xl md:text-4xl italic text-[#0b4d75] mb-6 uppercase leading-tight">
                        {{ $settings->about_title ?? 'LEBIH DARI SEKEDAR LARI, INI TENTANG PERUBAHAN.' }}
                    </h2>
                    
                    <div class="space-y-4 text-gray-600 text-sm md:text-base leading-relaxed">
                        <p>{{ $settings->about_text ?? 'OCTOBERUN 2026 adalah event lari tahunan yang diselenggarakan oleh GSC pada bulan Oktober untuk menginspirasi gaya hidup sehat, memperkuat kebersamaan, dan mendorong setiap individu untuk melampaui batas diri.' }}</p>
                    </div>

                    <p class="font-sporty font-bold italic text-[#0b4d75] text-lg mt-8 uppercase tracking-wide">
                        RUN TOGETHER, <span class="text-cyan-500">STRONGER</span> FOREVER.
                    </p>
                </div>

                <!-- Kanan: Gambar/Grafis -->
                <div class="relative w-full flex justify-center lg:justify-end">
                    <img src="{{ !empty($settings->about_image) ? asset('storage/' . $settings->about_image) : asset('img/about-graphic.png') }}" alt="Tentang Octoberun" class="w-full max-w-md object-contain rounded-lg">
                </div>
            </div>

            <!-- Kotak Tujuan Kami (Background Biru Pudar) -->
            <div class="bg-cyan-50 rounded-3xl p-8 md:p-12 border border-cyan-100 shadow-sm">
                <h3 class="text-center font-sporty font-black text-2xl italic text-cyan-600 mb-10 uppercase tracking-wider">
                    TUJUAN KAMI
                </h3>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-4 divide-y sm:divide-y-0 sm:divide-x divide-cyan-200">
                    <!-- Tujuan 1 -->
                    <div class="flex flex-col items-center text-center px-4 pt-6 sm:pt-0">
                        <div class="w-16 h-16 rounded-full bg-white flex items-center justify-center text-[#0b4d75] mb-4 shadow-sm border border-cyan-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>
                        </div>
                        <h4 class="font-black font-sporty text-[#0b4d75] text-lg mb-2 uppercase italic">MENGINSPIRASI</h4>
                        <p class="text-sm text-gray-500 leading-relaxed">Menginspirasi masyarakat untuk hidup sehat dan aktif melalui olahraga lari.</p>
                    </div>
                    <!-- Tujuan 2 -->
                    <div class="flex flex-col items-center text-center px-4 pt-6 sm:pt-0">
                        <div class="w-16 h-16 rounded-full bg-white flex items-center justify-center text-[#0b4d75] mb-4 shadow-sm border border-cyan-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                        </div>
                        <h4 class="font-black font-sporty text-[#0b4d75] text-lg mb-2 uppercase italic">MEMPERERAT</h4>
                        <p class="text-sm text-gray-500 leading-relaxed">Mempererat kebersamaan dan membangun komunitas pelari yang positif.</p>
                    </div>
                    <!-- Tujuan 3 -->
                    <div class="flex flex-col items-center text-center px-4 pt-6 sm:pt-0">
                        <div class="w-16 h-16 rounded-full bg-white flex items-center justify-center text-[#0b4d75] mb-4 shadow-sm border border-cyan-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                        </div>
                        <h4 class="font-black font-sporty text-[#0b4d75] text-lg mb-2 uppercase italic">MENANTANG DIRI</h4>
                        <p class="text-sm text-gray-500 leading-relaxed">Memberikan pengalaman menantang bagi setiap peserta untuk melampui batas diri.</p>
                    </div>
                    <!-- Tujuan 4 -->
                    <div class="flex flex-col items-center text-center px-4 pt-6 sm:pt-0">
                        <div class="w-16 h-16 rounded-full bg-white flex items-center justify-center text-[#0b4d75] mb-4 shadow-sm border border-cyan-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <h4 class="font-black font-sporty text-[#0b4d75] text-lg mb-2 uppercase italic">BERDAMPAK</h4>
                        <p class="text-sm text-gray-500 leading-relaxed">Memberikan dampak positif bagi lingkungan dan masyarakat sekitar.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================== -->
    <!-- BAGIAN 5: FREQUENTLY ASKED QUESTIONS       -->
    <!-- ========================================== -->
    <section class="bg-gray-50 py-16 mb-10 border-t border-gray-200">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-center font-sporty font-black text-2xl md:text-3xl italic text-[#0b4d75] mb-12 uppercase tracking-wider">
                FREQUENTLY ASKED <span class="text-cyan-500">QUESTIONS</span>
            </h2>
            
            <div class="space-y-4">
                
                @forelse($faqs ?? [] as $faq)
                <div class="border-2 border-[#0b4d75] rounded-xl overflow-hidden bg-white transition-all duration-300">
                    <button onclick="toggleFaq(this)" class="w-full p-4 md:p-5 flex items-center justify-between focus:outline-none hover:bg-blue-50 transition">
                        <span class="font-bold text-[#0b4d75] text-left text-sm md:text-base">{{ $faq->question }}</span>
                        <span class="text-2xl text-[#e85d04] font-bold transform transition-transform duration-300">+</span>
                    </button>
                    <div class="hidden px-5 pb-5 text-gray-600 text-sm border-t border-gray-100 pt-3">
                        {{ $faq->answer }}
                    </div>
                </div>
                @empty
                <p class="text-center text-gray-400 text-sm py-8">Belum ada FAQ tersedia.</p>
                @endforelse

            </div>
        </div>
    </section>

    <!-- ========================================== -->
    <!-- AREA MODAL / POP-UP (Disembunyikan)        -->
    <!-- ========================================== -->
    
    <!-- Modal Jersey -->
    <div id="modal-jersey" class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/60 backdrop-blur-sm transition-opacity opacity-0">
        <div class="bg-white p-6 rounded-2xl w-11/12 max-w-lg shadow-2xl transform scale-95 transition-transform duration-300">
            <h3 class="font-sporty text-2xl text-[#0b4d75] font-black italic mb-4 border-b pb-2">DETAIL JERSEY & SIZE</h3>
            <!-- Konten Dummy -->
            <img src="https://via.placeholder.com/400x300?text=Desain+Jersey+Dummy" class="w-full rounded-lg mb-4" alt="Jersey">
            <p class="text-gray-600 text-sm mb-4">Desain exclusive dengan bahan dry-fit premium yang menyerap keringat. Tersedia ukuran S, M, L, XL, hingga XXL.</p>
            <button onclick="closeModal('modal-jersey')" class="w-full bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 rounded transition">Tutup</button>
        </div>
    </div>

    <!-- Modal Race Pack -->
    <div id="modal-racepack" class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/60 backdrop-blur-sm transition-opacity opacity-0">
        <div class="bg-white p-6 rounded-2xl w-11/12 max-w-lg shadow-2xl transform scale-95 transition-transform duration-300">
            <h3 class="font-sporty text-2xl text-[#e85d04] font-black italic mb-4 border-b pb-2">RACE PACK BENEFIT</h3>
            <ul class="text-gray-600 text-sm mb-6 space-y-2 list-disc list-inside">
                <li>Jersey Premium Exclusive</li>
                <li>Medali Finisher (Bagi yang mencapai garis finish)</li>
                <li>Nomor Dada (BIB)</li>
                <li>Tumbler Exclusive OCTOBERUN</li>
                <li>Sumbangan 1 Bibit Pohon atas nama peserta</li>
            </ul>
            <button onclick="closeModal('modal-racepack')" class="w-full bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 rounded transition">Tutup</button>
        </div>
    </div>

    <!-- Modal Rute -->
    <div id="modal-rute" class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/60 backdrop-blur-sm transition-opacity opacity-0">
        <div class="bg-white p-6 rounded-2xl w-11/12 max-w-lg shadow-2xl transform scale-95 transition-transform duration-300">
            <h3 class="font-sporty text-2xl text-cyan-500 font-black italic mb-4 border-b pb-2">RUTE LARI 5K</h3>
            <img src="https://via.placeholder.com/400x300?text=Peta+Rute+Dummy" class="w-full rounded-lg mb-4" alt="Rute">
            <p class="text-gray-600 text-sm mb-4">Rute 5K mengelilingi pusat kota, melewati jalan protokol, dan ditutup kembali di Alun-alun. Cocok untuk pelari pemula maupun profesional.</p>
            <button onclick="closeModal('modal-rute')" class="w-full bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 rounded transition">Tutup</button>
        </div>
    </div>

    <!-- SCRIPT JAVASCRIPT UNTUK ANIMASI & INTERAKSI -->
    <script>
        // Fungsi untuk FAQ Dropdown
        function toggleFaq(button) {
            const answerDiv = button.nextElementSibling;
            const icon = button.querySelector('span:last-child');
            
            if (answerDiv.classList.contains('hidden')) {
                answerDiv.classList.remove('hidden');
                icon.style.transform = 'rotate(45deg)'; // Ubah + jadi x
            } else {
                answerDiv.classList.add('hidden');
                icon.style.transform = 'rotate(0deg)'; // Balik ke +
            }
        }

        // Fungsi Membuka Modal
        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            const content = modal.querySelector('div');
            
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            
            // Animasi Fade In & Zoom in
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                content.classList.remove('scale-95');
                content.classList.add('scale-100');
            }, 10);
        }

        // Fungsi Menutup Modal
        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            const content = modal.querySelector('div');
            
            // Animasi Fade Out & Zoom out
            modal.classList.add('opacity-0');
            content.classList.remove('scale-100');
            content.classList.add('scale-95');
            
            setTimeout(() => {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
            }, 300); // Tunggu animasi selesai sebelum dihilangkan
        }
    </script>
@endsection