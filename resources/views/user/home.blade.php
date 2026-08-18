<!-- resources/views/user/home.blade.php -->
@extends('layouts.user')

@section('content')
    <!-- CSS untuk Smooth Scroll ke id section saat navbar diklik -->
    <style> html { scroll-behavior: smooth; } </style>

    @if(session('error'))
        <div class="bg-red-500 text-white text-center py-3 px-4 font-bold z-50 relative flex justify-center items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
            {{ session('error') }}
        </div>
    @endif

    <!-- ========================================== -->
    <!-- BAGIAN 1: HERO SECTION (ID: beranda)       -->
    <!-- ========================================== -->
    <section id="beranda" class="relative pt-20 pb-16 lg:pt-40 lg:pb-32 overflow-hidden min-h-[120vw] md:min-h-[85vh] flex items-center justify-center md:justify-start" 
             style="background-image: url('{{ !empty($settings->hero_image) ? asset('storage/' . $settings->hero_image) : asset('img/hero-bg.jpg') }}'); background-size: cover; background-position: 75% center;">
        
        <!-- MOBILE OVERLAY (Gradient dari transparan ke putih agar pelari & tugu di atas terlihat jelas, teks di bawah tetap terbaca) -->
        <div class="block md:hidden absolute inset-0 bg-gradient-to-b from-white/0 via-white/60 to-white/95 z-0"></div>
        
        <!-- DESKTOP GRADIENT OVERLAY (Transisi putih dari kiri ke kanan) -->
        <div class="hidden md:block absolute inset-0 z-0 bg-gradient-to-r from-white via-white/90 to-transparent sm:via-white/70"></div> 

        <!-- WADAH TEKS -->
        <div class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col items-center md:items-start text-center md:text-left mt-40 md:mt-0">
            <div class="max-w-2xl w-full flex flex-col items-center md:items-start">
                
                <h3 data-aos="fade-down" class="text-[#e85d04] font-sporty font-bold text-lg md:text-xl italic tracking-wide mb-2 uppercase drop-shadow-sm">
                    {{ $settings->event_name ?? 'OCTOBERUN 2026' }}
                </h3>
                <h1 data-aos="fade-right" data-aos-delay="100" class="font-sporty text-5xl md:text-6xl lg:text-7xl font-black italic tracking-tighter text-[#0b4d75] leading-none mb-4 uppercase drop-shadow-md">
                    {{ $settings->hero_title ?? 'RUN BEYOND LIMITS' }}
                </h1>
                
                <div data-aos="fade-right" data-aos-delay="200" class="flex items-center justify-center md:justify-start gap-2 md:gap-3 text-[#0b4d75] font-bold text-xs md:text-sm tracking-widest mb-6 uppercase flex-wrap drop-shadow-sm">
                    <span>Faster</span>
                    <div class="w-1.5 h-1.5 rounded-full bg-[#e85d04]"></div>
                    <span>Stronger</span>
                    <div class="w-1.5 h-1.5 rounded-full bg-[#e85d04]"></div>
                    <span>Together</span>
                </div>

                <p data-aos="fade-up" data-aos-delay="300" class="text-gray-800 md:text-gray-700 font-semibold md:font-normal mb-8 max-w-md text-sm md:text-base leading-relaxed drop-shadow-md md:drop-shadow-none">
                    Bergabunglah dalam event lari terbesar di bulan Oktober. Rasakan pengalaman lari yang seru, menantang, dan penuh makna bersama ribuan pelari lainnya!
                </p>

                <!-- Countdown Timer -->
                @if(!empty($settings->registration_deadline))
                <div data-aos="zoom-in" data-aos-delay="400" class="mb-8 w-full flex flex-col items-center md:items-start" id="countdown-container">
                    <p class="text-[#0b4d75] font-bold text-sm mb-2 tracking-wide drop-shadow-sm">PENDAFTARAN DITUTUP DALAM:</p>
                    <div class="flex gap-2 sm:gap-3 justify-center md:justify-start">
                        <div class="bg-white/90 backdrop-blur border-2 border-[#0b4d75] rounded-xl p-2 w-[70px] sm:w-[80px] shadow-lg">
                            <div class="font-black text-2xl sm:text-3xl text-black" id="cd-days">00</div>
                            <div class="text-[10px] font-bold text-[#0b4d75] uppercase">Hari</div>
                        </div>
                        <div class="bg-white/90 backdrop-blur border-2 border-[#0b4d75] rounded-xl p-2 w-[70px] sm:w-[80px] shadow-lg">
                            <div class="font-black text-2xl sm:text-3xl text-black" id="cd-hours">00</div>
                            <div class="text-[10px] font-bold text-[#0b4d75] uppercase">Jam</div>
                        </div>
                        <div class="bg-white/90 backdrop-blur border-2 border-[#0b4d75] rounded-xl p-2 w-[70px] sm:w-[80px] shadow-lg">
                            <div class="font-black text-2xl sm:text-3xl text-black" id="cd-minutes">00</div>
                            <div class="text-[10px] font-bold text-[#0b4d75] uppercase">Menit</div>
                        </div>
                        <div class="bg-white/90 backdrop-blur border-2 border-[#0b4d75] rounded-xl p-2 w-[70px] sm:w-[80px] shadow-lg">
                            <div class="font-black text-2xl sm:text-3xl text-black" id="cd-seconds">00</div>
                            <div class="text-[10px] font-bold text-[#0b4d75] uppercase">Detik</div>
                        </div>
                    </div>
                </div>
                @endif

                <div data-aos="fade-up" data-aos-delay="500" class="flex flex-col sm:flex-row items-center justify-center md:justify-start gap-4 w-full">
                    @if(isset($sisaKuota) && $sisaKuota <= 0)
                        <button disabled class="w-[80%] sm:w-auto justify-center bg-gray-400 cursor-not-allowed text-white text-sm font-bold py-3.5 px-8 rounded-xl flex items-center gap-2 shadow-xl uppercase tracking-wider">
                            KUOTA PENUH / PENDAFTARAN DITUTUP
                        </button>
                    @else
                        <a href="{{ route('daftar') }}" id="btn-daftar" class="btn-daftar-global w-[80%] sm:w-auto justify-center bg-[#0b4d75] hover:bg-blue-800 text-white text-sm font-bold py-3.5 px-8 rounded-xl flex items-center gap-2 transition duration-300 shadow-xl transform hover:-translate-y-1 uppercase tracking-wider">
                            DAFTAR SEKARANG
                        </a>
                    @endif
                    <!-- <a href="#" class="w-full sm:w-auto justify-center bg-white/80 backdrop-blur-sm border border-gray-300 hover:border-gray-400 text-[#0b4d75] text-sm font-bold py-3 px-8 rounded flex items-center gap-2 transition duration-300 shadow-sm transform hover:-translate-y-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#e85d04]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        LIHAT VIDEO
                    </a> -->
                </div>
                
            </div>
        </div>
    </section>

    <!-- ========================================== -->
    <!-- BAGIAN 2: BANNER STATISTIK                 -->
    <!-- ========================================== -->
    <section class="bg-[#0b4d75] text-white py-10 relative z-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 md:gap-4 divide-x-0 md:divide-x-2 divide-blue-600/50">
                
                <!-- Stat 1: Pelari -->
                <div data-aos="zoom-in" data-aos-delay="100" class="flex items-center justify-center gap-4 px-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white opacity-90" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <div>
                        <h3 class="text-2xl md:text-3xl font-black font-sporty italic leading-none">{{ $settings->target_runners ?? '3.000+' }}+</h3>
                        <p class="text-xs tracking-widest font-bold mt-1 uppercase text-blue-200">PELARI</p>
                    </div>
                </div>

                <!-- Stat 2: Tanggal -->
                <div data-aos="zoom-in" data-aos-delay="200" class="flex items-center justify-center gap-4 px-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white opacity-90" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <div>
                        <h3 class="text-lg md:text-xl font-black font-sporty italic leading-tight">{{ $settings->event_date ?? '18 OKTOBER 2026' }}</h3>
                        <p class="text-xs tracking-widest font-bold uppercase text-blue-200">MINGGU</p>
                    </div>
                </div>

                <!-- Stat 3: Jarak Lari (Permintaan GSC 5K saja) -->
                <div data-aos="zoom-in" data-aos-delay="300" class="flex items-center justify-center gap-4 px-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white opacity-90" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9" />
                    </svg>
                    <div>
                        <h3 class="text-xs tracking-widest font-bold uppercase text-blue-200 mb-0.5">JARAK LARI</h3>
                        <p class="text-xl md:text-2xl font-black font-sporty italic leading-none">5K</p>
                    </div>
                </div>

                <!-- Stat 4: Lokasi -->
                <div data-aos="zoom-in" data-aos-delay="400" class="flex items-center justify-center gap-4 px-2">
                    <!-- Tambahkan shrink-0 dan style="flex-shrink: 0;" di sini -->
                    <svg style="flex-shrink: 0;" xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white opacity-90 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                    </svg>
                    <div>
                        <h3 class="text-xl md:text-2xl font-black font-sporty italic leading-tight">{{ $settings->event_location ?? 'TITIK 0 CILACAP' }}</h3>
                        <p class="text-xs tracking-widest font-bold mt-1 uppercase text-blue-200">LOKASI EVENT</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ========================================== -->
    <!-- BAGIAN 3: KARTU LAYANAN (ID: info)         -->
    <!-- ========================================== -->
    <section id="info" class="scroll-mt-28 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20 pt-16 pb-16">
        <div class="text-center mb-12">
            <h2 class="font-sporty font-black text-3xl md:text-4xl italic text-[#0b4d75] uppercase tracking-wide">
                INFORMASI EVENT
            </h2>
            <p class="mt-3 text-gray-500 text-sm md:text-base">Temukan segala hal yang perlu kamu ketahui tentang perlengkapan dan rute lari.</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 md:gap-6">
            
            <!-- Kartu 1: Jersey (Memicu Pop-up modal-jersey) -->
            <div data-aos="fade-up" data-aos-delay="100" class="bg-white rounded-lg shadow-xl p-6 md:p-8 text-center flex flex-col items-center hover:-translate-y-2 transition duration-300">
                <div class="w-12 h-12 md:w-16 md:h-16 rounded-full border-2 border-cyan-500 flex items-center justify-center mb-4 text-cyan-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:h-8 md:w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                </div>
                <h4 class="font-sporty font-bold text-lg md:text-xl text-[#0b4d75] italic mb-2 uppercase">JERSEY & SIZE</h4>
                <p class="text-gray-500 text-xs md:text-sm mb-6 flex-grow">{{ $settings->jersey_card_desc ?? 'Bahan High Performance yang ringan, sejuk, dan anti-bau.' }}</p>
                <button onclick="openModal('modal-jersey')" class="w-full bg-[#0b4d75] hover:bg-blue-800 text-white font-bold py-2.5 rounded text-sm transition">LIHAT DETAIL</button>
            </div>

            <div data-aos="fade-up" data-aos-delay="200" class="bg-white rounded-lg shadow-xl p-6 md:p-8 text-center flex flex-col items-center hover:-translate-y-2 transition duration-300">
                <div class="w-12 h-12 md:w-16 md:h-16 bg-orange-100 rounded-full flex items-center justify-center text-[#e85d04] mb-4 shadow-inner">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:h-8 md:w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <h4 class="font-sporty font-bold text-lg md:text-xl text-[#e85d04] italic mb-2 uppercase">RACE PACK</h4>
                <p class="text-gray-500 text-xs md:text-sm mb-6 flex-grow">{{ $settings->racepack_card_desc ?? 'Jersey, Medali, BIB, dan 1 Bibit Pohon spesial untukmu.' }}</p>
                <button onclick="openModal('modal-racepack')" class="w-full bg-[#e85d04] hover:bg-orange-700 text-white font-bold py-2.5 rounded text-sm transition">ISI LENGKAP</button>
            </div>

            <div data-aos="fade-up" data-aos-delay="300" class="bg-white rounded-lg shadow-xl p-6 md:p-8 text-center flex flex-col items-center hover:-translate-y-2 transition duration-300">
                <div class="w-12 h-12 md:w-16 md:h-16 bg-cyan-100 rounded-full flex items-center justify-center text-cyan-500 mb-4 shadow-inner">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:h-8 md:w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                </div>
                <h4 class="font-sporty font-bold text-lg md:text-xl text-cyan-500 italic mb-2 uppercase">RUTE LARI</h4>
                <p class="text-gray-500 text-xs md:text-sm mb-6 flex-grow">{{ $settings->route_card_desc ?? 'Rute 5K melewati landmark ikonik kota.' }}</p>
                <button onclick="openModal('modal-rute')" class="w-full bg-cyan-500 hover:bg-cyan-600 text-white font-bold py-2.5 rounded text-sm transition">LIHAT PETA</button>
            </div>

        </div>
    </section>

    <!-- ========================================== -->
    <!-- BAGIAN ALUR PENDAFTARAN (HOW IT WORKS)     -->
    <!-- ========================================== -->
    <section class="py-20 bg-gray-50 relative border-t border-gray-100 overflow-hidden">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <h2 class="font-sporty font-black text-3xl md:text-4xl italic text-[#0b4d75] uppercase tracking-wide">
                    ALUR PENDAFTARAN
                </h2>
                <p class="mt-3 text-gray-500 text-sm md:text-base">Ikuti 5 langkah mudah ini untuk mengamankan slot larimu!</p>
            </div>

            <div class="relative">
                <!-- Vertical Dashed Line -->
                <div class="absolute left-6 md:left-8 lg:left-1/2 top-0 bottom-0 w-0 border-l-2 border-dashed border-gray-300 lg:-translate-x-1/2 z-0"></div>

                <div class="space-y-12 lg:space-y-0 lg:-space-y-4 relative z-10">
                    
                    <!-- Step 1 (Kiri) -->
                    <div class="relative flex lg:justify-between items-center w-full mb-12 lg:mb-0" data-aos="fade-up">
                        <!-- Node Mobile -->
                        <div class="lg:hidden absolute left-6 md:left-8 top-1/2 -translate-x-1/2 -translate-y-1/2 w-5 h-5 bg-[#e85d04] rounded-full shadow-md border-4 border-white z-20"></div>
                        <!-- Node Desktop -->
                        <div class="hidden lg:block absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-5 h-5 bg-[#e85d04] rounded-full shadow-md border-4 border-white z-20"></div>
                        
                        <!-- Garis konektor horizontal desktop -->
                        <div class="hidden lg:block absolute left-[46%] right-1/2 top-1/2 -translate-y-1/2 border-t-2 border-dashed border-gray-300 z-0"></div>

                        <!-- Card -->
                        <div class="w-full lg:w-[46%] pl-14 md:pl-16 lg:pl-0 relative z-10">
                            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl p-6 lg:p-8 border-l-4 lg:border-l-0 lg:border-r-4 border-[#e85d04] hover:-translate-y-1 transition-transform duration-300 relative overflow-hidden">
                                <div class="text-7xl font-black text-[#e85d04]/10 absolute top-2 right-4 lg:left-4 lg:right-auto leading-none pointer-events-none">1</div>
                                <h3 class="font-sporty font-bold text-xl text-blue-900 mb-2 uppercase italic relative z-10 lg:text-right">REGISTRASI DATA DIRI</h3>
                                <p class="text-gray-600 text-sm lg:text-base relative z-10 lg:text-right">Lengkapi formulir pendaftaran dengan data diri yang valid serta pastikan ukuran jersey yang Anda pilih sudah sesuai.</p>
                            </div>
                        </div>
                        
                        <div class="hidden lg:block lg:w-[46%]"></div>
                    </div>

                    <!-- Step 2 (Kanan) -->
                    <div class="relative flex flex-row-reverse lg:flex-row lg:justify-between items-center w-full mb-12 lg:mb-0" data-aos="fade-up" data-aos-delay="100">
                        <div class="lg:hidden absolute left-6 md:left-8 top-1/2 -translate-x-1/2 -translate-y-1/2 w-5 h-5 bg-[#e85d04] rounded-full shadow-md border-4 border-white z-20"></div>
                        <div class="hidden lg:block absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-5 h-5 bg-[#e85d04] rounded-full shadow-md border-4 border-white z-20"></div>

                        <div class="hidden lg:block absolute right-[46%] left-1/2 top-1/2 -translate-y-1/2 border-t-2 border-dashed border-gray-300 z-0"></div>

                        <div class="hidden lg:block lg:w-[46%]"></div>

                        <!-- Card -->
                        <div class="w-full lg:w-[46%] pr-0 pl-14 md:pl-16 lg:pl-0 relative z-10">
                            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl p-6 lg:p-8 border-l-4 border-[#e85d04] hover:-translate-y-1 transition-transform duration-300 relative overflow-hidden">
                                <div class="text-7xl font-black text-[#e85d04]/10 absolute top-2 right-4 leading-none pointer-events-none">2</div>
                                <h3 class="font-sporty font-bold text-xl text-blue-900 mb-2 uppercase italic relative z-10 text-left">SELESAIKAN PEMBAYARAN</h3>
                                <p class="text-gray-600 text-sm lg:text-base relative z-10 text-left">Pilih metode pembayaran yang Anda inginkan seperti BCA, Mandiri, QRIS, atau e-Wallet. Sistem memverifikasi otomatis.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3 (Kiri) -->
                    <div class="relative flex lg:justify-between items-center w-full mb-12 lg:mb-0" data-aos="fade-up" data-aos-delay="150">
                        <div class="lg:hidden absolute left-6 md:left-8 top-1/2 -translate-x-1/2 -translate-y-1/2 w-5 h-5 bg-[#e85d04] rounded-full shadow-md border-4 border-white z-20"></div>
                        <div class="hidden lg:block absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-5 h-5 bg-[#e85d04] rounded-full shadow-md border-4 border-white z-20"></div>
                        
                        <div class="hidden lg:block absolute left-[46%] right-1/2 top-1/2 -translate-y-1/2 border-t-2 border-dashed border-gray-300 z-0"></div>

                        <div class="w-full lg:w-[46%] pl-14 md:pl-16 lg:pl-0 relative z-10">
                            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl p-6 lg:p-8 border-l-4 lg:border-l-0 lg:border-r-4 border-[#e85d04] hover:-translate-y-1 transition-transform duration-300 relative overflow-hidden">
                                <div class="text-7xl font-black text-[#e85d04]/10 absolute top-2 right-4 lg:left-4 lg:right-auto leading-none pointer-events-none">3</div>
                                <h3 class="font-sporty font-bold text-xl text-blue-900 mb-2 uppercase italic relative z-10 lg:text-right">CEK STATUS & E-TICKET</h3>
                                <p class="text-gray-600 text-sm lg:text-base relative z-10 lg:text-right">Pantau status pesanan Anda. E-Ticket akan dikirimkan ke alamat email setelah pembayaran berhasil.</p>
                            </div>
                        </div>
                        
                        <div class="hidden lg:block lg:w-[46%]"></div>
                    </div>

                    <!-- Step 4 (Kanan) -->
                    <div class="relative flex flex-row-reverse lg:flex-row lg:justify-between items-center w-full mb-12 lg:mb-0" data-aos="fade-up" data-aos-delay="200">
                        <div class="lg:hidden absolute left-6 md:left-8 top-1/2 -translate-x-1/2 -translate-y-1/2 w-5 h-5 bg-[#e85d04] rounded-full shadow-md border-4 border-white z-20"></div>
                        <div class="hidden lg:block absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-5 h-5 bg-[#e85d04] rounded-full shadow-md border-4 border-white z-20"></div>

                        <div class="hidden lg:block absolute right-[46%] left-1/2 top-1/2 -translate-y-1/2 border-t-2 border-dashed border-gray-300 z-0"></div>

                        <div class="hidden lg:block lg:w-[46%]"></div>

                        <div class="w-full lg:w-[46%] pr-0 pl-14 md:pl-16 lg:pl-0 relative z-10">
                            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl p-6 lg:p-8 border-l-4 border-[#e85d04] hover:-translate-y-1 transition-transform duration-300 relative overflow-hidden">
                                <div class="text-7xl font-black text-[#e85d04]/10 absolute top-2 right-4 leading-none pointer-events-none">4</div>
                                <h3 class="font-sporty font-bold text-xl text-blue-900 mb-2 uppercase italic relative z-10 text-left">AMBIL RACE PACK</h3>
                                <p class="text-gray-600 text-sm lg:text-base relative z-10 text-left">Tunjukkan QR Code pada E-Ticket Anda kepada panitia di lokasi penukaran untuk mengambil perlengkapan lari.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Step 5 (Kiri) -->
                    <div class="relative flex lg:justify-between items-center w-full" data-aos="fade-up" data-aos-delay="250">
                        <div class="lg:hidden absolute left-6 md:left-8 top-1/2 -translate-x-1/2 -translate-y-1/2 w-5 h-5 bg-[#e85d04] rounded-full shadow-md border-4 border-white z-20"></div>
                        <div class="hidden lg:block absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-5 h-5 bg-[#e85d04] rounded-full shadow-md border-4 border-white z-20"></div>
                        
                        <div class="hidden lg:block absolute left-[46%] right-1/2 top-1/2 -translate-y-1/2 border-t-2 border-dashed border-gray-300 z-0"></div>

                        <div class="w-full lg:w-[46%] pl-14 md:pl-16 lg:pl-0 relative z-10">
                            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl p-6 lg:p-8 border-l-4 lg:border-l-0 lg:border-r-4 border-[#e85d04] hover:-translate-y-1 transition-transform duration-300 relative overflow-hidden">
                                <div class="text-7xl font-black text-[#e85d04]/10 absolute top-2 right-4 lg:left-4 lg:right-auto leading-none pointer-events-none">5</div>
                                <h3 class="font-sporty font-bold text-xl text-blue-900 mb-2 uppercase italic relative z-10 lg:text-right">RACE DAY!</h3>
                                <p class="text-gray-600 text-sm lg:text-base relative z-10 lg:text-right">Siapkan fisik dan semangat Anda! Hadir tepat waktu di lokasi pada tanggal pelaksanaan dan raih garis finis.</p>
                            </div>
                        </div>
                        
                        <div class="hidden lg:block lg:w-[46%]"></div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- ========================================== -->
    <!-- BAGIAN 4: TENTANG KAMI (ID: tentang)       -->
    <!-- ========================================== -->
    <section id="tentang" class="scroll-mt-28 bg-white pt-20 pb-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Grid Tentang Kami -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center mb-20">
                <!-- Kiri: Teks -->
                <div data-aos="fade-right">
                    <p class="uppercase text-xs md:text-sm text-[#e85d04] font-bold tracking-[0.2em] mb-2">TENTANG OCTOBERUN</p>
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
                <div data-aos="fade-left" data-aos-delay="200" class="relative w-full flex justify-center lg:justify-end">
                    <img src="{{ !empty($settings->about_image) ? asset('storage/' . $settings->about_image) : asset('img/about-graphic.png') }}" alt="Tentang Octoberun" class="w-full max-w-md object-contain rounded-lg">
                </div>
            </div>

            <!-- Kotak Tujuan Kami (Background Biru Pudar) -->
            <div data-aos="fade-up" class="bg-cyan-50 rounded-3xl p-8 md:p-12 border border-cyan-100 shadow-sm">
                <h3 class="text-center font-sporty font-black text-2xl italic text-cyan-600 mb-10 uppercase tracking-wider">
                    TUJUAN KAMI
                </h3>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-4 divide-y sm:divide-y-0 sm:divide-x divide-cyan-200">
                    <!-- Tujuan 1 -->
                    <div data-aos="fade-up" data-aos-delay="100" class="flex flex-col items-center text-center px-4 pt-6 sm:pt-0">
                        <div class="w-16 h-16 rounded-full bg-white flex items-center justify-center text-[#0b4d75] mb-4 shadow-sm border border-cyan-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>
                        </div>
                        <h4 class="font-black font-sporty text-[#0b4d75] text-lg mb-2 uppercase italic">MENGINSPIRASI</h4>
                        <p class="text-sm text-gray-500 leading-relaxed">Menginspirasi masyarakat untuk hidup sehat dan aktif melalui olahraga lari.</p>
                    </div>
                    <!-- Tujuan 2 -->
                    <div data-aos="fade-up" data-aos-delay="200" class="flex flex-col items-center text-center px-4 pt-6 sm:pt-0">
                        <div class="w-16 h-16 rounded-full bg-white flex items-center justify-center text-[#0b4d75] mb-4 shadow-sm border border-cyan-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                        </div>
                        <h4 class="font-black font-sporty text-[#0b4d75] text-lg mb-2 uppercase italic">MEMPERERAT</h4>
                        <p class="text-sm text-gray-500 leading-relaxed">Mempererat kebersamaan dan membangun komunitas pelari yang positif.</p>
                    </div>
                    <!-- Tujuan 3 -->
                    <div data-aos="fade-up" data-aos-delay="300" class="flex flex-col items-center text-center px-4 pt-6 sm:pt-0">
                        <div class="w-16 h-16 rounded-full bg-white flex items-center justify-center text-[#0b4d75] mb-4 shadow-sm border border-cyan-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                        </div>
                        <h4 class="font-black font-sporty text-[#0b4d75] text-lg mb-2 uppercase italic">MENANTANG DIRI</h4>
                        <p class="text-sm text-gray-500 leading-relaxed">Memberikan pengalaman menantang bagi setiap peserta untuk melampui batas diri.</p>
                    </div>
                    <!-- Tujuan 4 -->
                    <div data-aos="fade-up" data-aos-delay="400" class="flex flex-col items-center text-center px-4 pt-6 sm:pt-0">
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
                
                @forelse($faqs ?? [] as $index => $faq)
                <div class="border-2 border-[#0b4d75] rounded-xl overflow-hidden bg-white transition-all duration-300 faq-item">
                    <button onclick="toggleFaq(this)" class="w-full p-4 md:p-5 flex items-center justify-between focus:outline-none hover:bg-blue-50 transition">
                        <span class="font-bold text-[#0b4d75] text-left text-sm md:text-base">{{ $faq->question }}</span>
                        <span class="faq-icon text-2xl text-[#e85d04] font-bold transform transition-transform duration-300">+</span>
                    </button>
                    <div class="faq-answer max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                        <div class="px-5 pb-5 text-gray-600 text-sm border-t border-gray-100 pt-3">
                            {{ $faq->answer }}
                        </div>
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
    <div id="modal-jersey" class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/70 backdrop-blur-sm transition-opacity opacity-0 p-4">
        <!-- Wrapper Modal dengan Border dan Max-Height -->
        <div class="bg-white rounded-2xl w-full max-w-5xl shadow-2xl overflow-hidden transform scale-95 transition-transform duration-300 max-h-[95vh] relative border-[3px] border-[#e85d04] flex flex-col">
            
            <!-- Tombol Close Floating Fixed -->
            <button onclick="closeModal('modal-jersey')" class="absolute top-4 right-4 z-50 text-gray-900 hover:text-white hover:bg-red-500 bg-white shadow-md p-1.5 rounded-full transition border-2 border-gray-900">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <!-- Header Modal Mobile -->
            <div class="md:hidden pt-6 pb-4 px-6 border-b border-gray-100 bg-white z-40">
                <h3 class="font-sporty text-xl text-[#0b4d75] font-black italic uppercase leading-none pr-10">DETAIL JERSEY<br><span class="text-cyan-500">& SIZE CHART</span></h3>
            </div>

            <!-- Konten Scrollable -->
            <div class="overflow-y-auto flex flex-col md:flex-row w-full flex-grow">
                <!-- Sisi Kiri: Gambar -->
                <div class="md:w-1/2 bg-gray-100 flex items-center justify-center p-6 relative group min-h-[40vh] md:min-h-0 shrink-0">
                    @if(!empty($settings->jersey_image))
                        <div class="relative w-full h-full group cursor-pointer flex justify-center items-center" onclick="openImagePreview('{{ asset('storage/' . $settings->jersey_image) }}')">
                            <img src="{{ asset('storage/' . $settings->jersey_image) }}" class="max-w-full max-h-[50vh] md:max-h-[75vh] object-contain drop-shadow-xl transition duration-300 group-hover:scale-105" alt="Detail Jersey & Size Chart">
                            <!-- Overlay Perbesar Gambar -->
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-lg flex items-center justify-center">
                                <span class="bg-[#0b4d75] text-white px-5 py-2.5 rounded-full font-bold text-sm flex items-center gap-2 shadow-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" /></svg>
                                    Perbesar Gambar
                                </span>
                            </div>
                        </div>
                    @else
                        <div class="text-center text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 mx-auto mb-2 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                            <p>Panitia belum mengunggah foto Jersey</p>
                        </div>
                    @endif
                </div>

                <!-- Sisi Kanan: Informasi -->
                <div class="md:w-1/2 p-6 md:p-8 flex flex-col bg-white shrink-0">
                    <div class="hidden md:flex justify-between items-start mb-6">
                        <h3 class="font-sporty text-3xl text-[#0b4d75] font-black italic uppercase leading-none">DETAIL JERSEY<br><span class="text-cyan-500">& SIZE CHART</span></h3>
                    </div>
                    
                    <div class="prose text-gray-600 text-sm mb-8 flex-grow">
                        <p class="mb-4">{{ $settings->jersey_modal_desc ?? 'Desain exclusive OCTOBERUN dengan material Premium Dry-Fit Tech yang super ringan, menyerap keringat dengan cepat, dan memiliki sirkulasi udara maksimal untuk menjaga performa larimu.' }}</p>
                        
                        <div class="bg-cyan-50 border border-cyan-100 p-4 rounded-lg mt-6">
                            <p class="font-bold text-[#0b4d75] mb-3 text-xs tracking-wider uppercase">Panduan Ukuran (Toleransi 1-2 cm)</p>
                            <div class="flex flex-wrap gap-2">
                                <span class="px-3 py-1.5 bg-white border border-cyan-200 rounded text-xs font-bold text-cyan-800 shadow-sm">S</span>
                                <span class="px-3 py-1.5 bg-white border border-cyan-200 rounded text-xs font-bold text-cyan-800 shadow-sm">M</span>
                                <span class="px-3 py-1.5 bg-white border border-cyan-200 rounded text-xs font-bold text-cyan-800 shadow-sm">L</span>
                                <span class="px-3 py-1.5 bg-white border border-cyan-200 rounded text-xs font-bold text-cyan-800 shadow-sm">XL</span>
                                <span class="px-3 py-1.5 bg-white border border-cyan-200 rounded text-xs font-bold text-cyan-800 shadow-sm">XXL</span>
                            </div>
                        </div>
                    </div>

                    <button onclick="closeModal('modal-jersey')" class="w-full bg-[#e85d04] hover:bg-orange-700 text-white font-bold py-3.5 rounded-xl transition shadow-md mt-4 uppercase tracking-wider text-sm">Kembali</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Race Pack -->
    <div id="modal-racepack" class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/70 backdrop-blur-sm transition-opacity opacity-0 p-4">
        <div class="bg-white rounded-2xl w-full max-w-5xl shadow-2xl overflow-hidden transform scale-95 transition-transform duration-300 max-h-[95vh] relative border-[3px] border-[#e85d04] flex flex-col">
            
            <button onclick="closeModal('modal-racepack')" class="absolute top-4 right-4 z-50 text-gray-900 hover:text-white hover:bg-red-500 bg-white shadow-md p-1.5 rounded-full transition border-2 border-gray-900">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <div class="md:hidden pt-6 pb-4 px-6 border-b border-gray-100 bg-white z-40">
                <h3 class="font-sporty text-xl text-[#e85d04] font-black italic uppercase leading-none pr-10">RACE PACK<br><span class="text-gray-800">BENEFITS</span></h3>
            </div>

            <div class="overflow-y-auto flex flex-col md:flex-row w-full flex-grow">
                <div class="md:w-1/2 bg-gray-100 flex items-center justify-center p-6 relative group min-h-[40vh] md:min-h-0 shrink-0">
                    @if(!empty($settings->racepack_image))
                        <div class="relative w-full h-full group cursor-pointer flex justify-center items-center" onclick="openImagePreview('{{ asset('storage/' . $settings->racepack_image) }}')">
                            <img src="{{ asset('storage/' . $settings->racepack_image) }}" class="max-w-full max-h-[50vh] md:max-h-[75vh] object-contain drop-shadow-xl transition duration-300 group-hover:scale-105" alt="Isi Race Pack">
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-lg flex items-center justify-center">
                                <span class="bg-[#e85d04] text-white px-5 py-2.5 rounded-full font-bold text-sm flex items-center gap-2 shadow-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" /></svg>
                                    Perbesar Gambar
                                </span>
                            </div>
                        </div>
                    @else
                        <div class="text-center text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 mx-auto mb-2 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
                            <p>Panitia belum mengunggah foto Race Pack</p>
                        </div>
                    @endif
                </div>

                <div class="md:w-1/2 p-6 md:p-8 flex flex-col bg-white shrink-0">
                    <div class="hidden md:flex justify-between items-start mb-6">
                        <h3 class="font-sporty text-3xl text-[#e85d04] font-black italic uppercase leading-none">RACE PACK<br><span class="text-gray-800">BENEFITS</span></h3>
                    </div>
                    
                    <div class="text-gray-600 text-sm mb-8 flex-grow">
                        <p class="mb-5">{{ $settings->racepack_modal_desc ?? 'Setiap pendaftar OCTOBERUN akan mendapatkan paket eksklusif yang tidak hanya mendukung performa larimu, tapi juga berdampak positif bagi lingkungan.' }}</p>
                        
                        <ul class="space-y-4">
                            <li class="flex items-start gap-3">
                                <div class="bg-orange-100 p-2 rounded text-[#e85d04] mt-0.5"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
                                <div><strong class="text-gray-800 block">{{ $settings->benefit_1_title ?? 'Jersey Premium Exclusive' }}</strong><span class="text-xs">{{ $settings->benefit_1_desc ?? 'Bahan anti-bau dan super sejuk.' }}</span></div>
                            </li>
                            <li class="flex items-start gap-3">
                                <div class="bg-orange-100 p-2 rounded text-[#e85d04] mt-0.5"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
                                <div><strong class="text-gray-800 block">{{ $settings->benefit_2_title ?? 'Medali Finisher 3D' }}</strong><span class="text-xs">{{ $settings->benefit_2_desc ?? 'Bagi peserta yang berhasil melewati garis finish.' }}</span></div>
                            </li>
                            <li class="flex items-start gap-3">
                                <div class="bg-orange-100 p-2 rounded text-[#e85d04] mt-0.5"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path></svg></div>
                                <div><strong class="text-gray-800 block">{{ $settings->benefit_3_title ?? 'Nomor Dada (BIB) & String Bag' }}</strong><span class="text-xs">{{ $settings->benefit_3_desc ?? 'Identitas resmi pelari dan tas serut fungsional.' }}</span></div>
                            </li>
                            <li class="flex items-start gap-3">
                                <div class="bg-orange-100 p-2 rounded text-[#e85d04] mt-0.5"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
                                <div><strong class="text-gray-800 block">{{ $settings->benefit_4_title ?? '1 Bibit Pohon' }}</strong><span class="text-xs">{{ $settings->benefit_4_desc ?? 'Sumbangan pelestarian alam atas namamu.' }}</span></div>
                            </li>
                        </ul>
                    </div>

                    <button onclick="closeModal('modal-racepack')" class="w-full bg-[#e85d04] hover:bg-orange-700 text-white font-bold py-3.5 rounded-xl transition shadow-md mt-4 uppercase tracking-wider text-sm">Kembali</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Rute -->
    <div id="modal-rute" class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/70 backdrop-blur-sm transition-opacity opacity-0 p-4">
        <div class="bg-white rounded-2xl w-full max-w-5xl shadow-2xl overflow-hidden transform scale-95 transition-transform duration-300 max-h-[95vh] relative border-[3px] border-[#e85d04] flex flex-col">
            
            <button onclick="closeModal('modal-rute')" class="absolute top-4 right-4 z-50 text-gray-900 hover:text-white hover:bg-red-500 bg-white shadow-md p-1.5 rounded-full transition border-2 border-gray-900">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <div class="md:hidden pt-6 pb-4 px-6 border-b border-gray-100 bg-white z-40">
                <h3 class="font-sporty text-xl text-cyan-600 font-black italic uppercase leading-none pr-10">PETA RUTE<br><span class="text-gray-800">LARI 5K</span></h3>
            </div>

            <div class="overflow-y-auto flex flex-col md:flex-row w-full flex-grow">
                <div class="md:w-1/2 bg-gray-100 flex items-center justify-center p-6 relative group min-h-[40vh] md:min-h-0 shrink-0">
                    @if(!empty($settings->route_image))
                        <div class="relative w-full h-full group cursor-pointer flex justify-center items-center" onclick="openImagePreview('{{ asset('storage/' . $settings->route_image) }}')">
                            <img src="{{ asset('storage/' . $settings->route_image) }}" class="max-w-full max-h-[50vh] md:max-h-[75vh] object-contain drop-shadow-xl transition duration-300 group-hover:scale-105" alt="Peta Rute Lari">
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-lg flex items-center justify-center">
                                <span class="bg-cyan-500 text-white px-5 py-2.5 rounded-full font-bold text-sm flex items-center gap-2 shadow-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" /></svg>
                                    Perbesar Gambar
                                </span>
                            </div>
                        </div>
                    @else
                        <div class="text-center text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 mx-auto mb-2 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" /></svg>
                            <p>Panitia belum mengunggah Peta Rute</p>
                        </div>
                    @endif
                </div>

                <div class="md:w-1/2 p-6 md:p-8 flex flex-col bg-white shrink-0">
                    <div class="hidden md:flex justify-between items-start mb-6">
                        <h3 class="font-sporty text-3xl text-cyan-500 font-black italic uppercase leading-none">PETA RUTE<br><span class="text-gray-800">LARI 5K</span></h3>
                    </div>
                    
                    <div class="text-gray-600 text-sm mb-8 flex-grow">
                        <p class="mb-4">{{ $settings->route_modal_desc ?? 'Tantang dirimu di rute 5 Kilometer yang telah dikurasi khusus! Mengelilingi pusat kota, melintasi landmark ikonik, dengan kontur jalan rata yang sangat bersahabat bagi pelari pemula (*newbie friendly*) namun menantang bagi pro yang mengejar *Personal Best* (PB).' }}</p>
                        
                        <div class="mt-6 border-l-4 border-cyan-500 pl-4 bg-cyan-50 py-3 pr-3 rounded-r-lg">
                            <p class="font-bold text-gray-800 text-xs uppercase mb-1">Titik Start & Finish</p>
                            <p class="text-[#0b4d75] font-bold">{{ $settings->route_start_finish ?? 'Alun-Alun Utama Kota' }}</p>
                        </div>
                        <div class="mt-3 border-l-4 border-orange-400 pl-4 bg-orange-50 py-3 pr-3 rounded-r-lg">
                            <p class="font-bold text-gray-800 text-xs uppercase mb-1">Fasilitas Rute</p>
                            <p class="text-orange-800 font-bold text-xs">{{ $settings->route_facilities ?? 'Water Station di KM 2.5 • Tim Medis Mobile • Marshall di setiap persimpangan' }}</p>
                        </div>
                    </div>

                    <button onclick="closeModal('modal-rute')" class="w-full bg-[#e85d04] hover:bg-orange-700 text-white font-bold py-3.5 rounded-xl transition shadow-md mt-4 uppercase tracking-wider text-sm">Kembali</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Preview Gambar Fullscreen -->
    <div id="modal-image-preview" class="fixed inset-0 z-[200] hidden items-center justify-center bg-black/95 backdrop-blur-md transition-opacity opacity-0 p-4">
        <button onclick="closeImagePreview()" class="absolute top-4 right-4 md:top-8 md:right-8 text-white/70 hover:text-white transition focus:outline-none z-[210] bg-black/50 p-2 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 md:h-10 md:w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
        </button>
        <div class="relative w-full h-full flex items-center justify-center" onclick="closeImagePreview()">
            <!-- Gambar dicegah menerima klik agar modal tidak tertutup jika gambar diklik (opsional, tapi lebih baik) -->
            <img id="preview-image-src" src="" class="max-w-full max-h-full object-contain transform scale-90 transition-transform duration-300 drop-shadow-2xl cursor-default" alt="Preview Fullscreen" onclick="event.stopPropagation()">
        </div>
    </div>

    <!-- SCRIPT JAVASCRIPT UNTUK ANIMASI & INTERAKSI -->
    <script>
        // Fungsi untuk FAQ Dropdown
        function toggleFaq(button) {
            const answerDiv = button.nextElementSibling;
            const icon = button.querySelector('.faq-icon');
            
            // Periksa apakah item ini sedang terbuka (maxHeight diset dan tidak 0)
            const isOpen = answerDiv.style.maxHeight && answerDiv.style.maxHeight !== '0px';
            
            // Tutup semua FAQ yang lain
            const allItems = document.querySelectorAll('.faq-item');
            allItems.forEach(item => {
                const ans = item.querySelector('.faq-answer');
                const ic = item.querySelector('.faq-icon');
                if (ans) ans.style.maxHeight = null; // Menghapus style agar kembali ke class max-h-0
                if (ic) ic.style.transform = 'rotate(0deg)';
            });
            
            // Buka yang ditekan jika sebelumnya tertutup
            if (!isOpen) {
                answerDiv.style.maxHeight = answerDiv.scrollHeight + 'px';
                icon.style.transform = 'rotate(45deg)'; // Ubah + jadi x
            }
        }

        // Fungsi Membuka Modal
        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            const content = modal.querySelector('div');
            
            document.body.classList.add('overflow-hidden'); // Mengunci scroll halaman belakang
            
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
            
            document.body.classList.remove('overflow-hidden'); // Membuka kembali scroll halaman belakang
            
            // Animasi Fade Out & Zoom out
            modal.classList.add('opacity-0');
            content.classList.remove('scale-100');
            content.classList.add('scale-95');
            
            setTimeout(() => {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
            }, 300); // Tunggu animasi selesai sebelum dihilangkan
        }

        // Fungsi Membuka Modal Preview Gambar
        function openImagePreview(imageUrl) {
            const modal = document.getElementById('modal-image-preview');
            const imgElement = document.getElementById('preview-image-src');
            
            document.body.classList.add('overflow-hidden'); // Mengunci scroll halaman belakang
            
            imgElement.src = imageUrl;
            
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            
            // Animasi Fade In & Zoom in
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                imgElement.classList.remove('scale-90');
                imgElement.classList.add('scale-100');
            }, 10);
        }

        // Fungsi Menutup Modal Preview Gambar
        function closeImagePreview() {
            const modal = document.getElementById('modal-image-preview');
            const imgElement = document.getElementById('preview-image-src');
            
            // Animasi Fade Out & Zoom out
            modal.classList.add('opacity-0');
            imgElement.classList.remove('scale-100');
            imgElement.classList.add('scale-90');
            
            setTimeout(() => {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
                imgElement.src = ''; // Kosongkan src
            }, 300);
        }

        // Countdown Timer Logic
        @if(!empty($settings->registration_deadline))
        const deadline = new Date("{{ $settings->registration_deadline }}").getTime();
        const btnsDaftar = document.querySelectorAll('.btn-daftar-global');
        
        const countdownTimer = setInterval(function() {
            const now = new Date().getTime();
            const distance = deadline - now;
            
            if (distance < 0) {
                clearInterval(countdownTimer);
                document.getElementById('cd-days').innerText = "00";
                document.getElementById('cd-hours').innerText = "00";
                document.getElementById('cd-minutes').innerText = "00";
                document.getElementById('cd-seconds').innerText = "00";
                
                btnsDaftar.forEach(btn => {
                    btn.classList.add('bg-gray-400', 'cursor-not-allowed');
                    btn.classList.remove('bg-[#0b4d75]', 'hover:bg-blue-800', 'hover:-translate-y-1');
                    btn.removeAttribute('href');
                    btn.innerHTML = 'PENDAFTARAN DITUTUP';
                });
            } else {
                document.getElementById('cd-days').innerText = Math.floor(distance / (1000 * 60 * 60 * 24)).toString().padStart(2, '0');
                document.getElementById('cd-hours').innerText = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)).toString().padStart(2, '0');
                document.getElementById('cd-minutes').innerText = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)).toString().padStart(2, '0');
                document.getElementById('cd-seconds').innerText = Math.floor((distance % (1000 * 60)) / 1000).toString().padStart(2, '0');
            }
        }, 1000);
        @endif
    </script>
@endsection