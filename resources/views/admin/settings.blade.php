@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-black text-gray-900 tracking-tight">Kelola Tampilan Beranda</h1>
            <p class="text-sm text-gray-500 mt-1">Atur konten teks dan gambar yang ditampilkan pada halaman utama website.</p>
        </div>
        <button form="setting-form" type="submit" class="bg-[#0b4d75] hover:bg-blue-800 text-white font-bold py-2.5 px-6 rounded-lg shadow-sm transition">
            Simpan Perubahan
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
        <button type="button" onclick="switchTab('tab-beranda')" id="btn-beranda" class="tab-btn active px-4 py-3 font-bold text-sm border-b-2 border-[#e85d04] text-[#e85d04] transition">
            Hero & Tentang
        </button>
        <button type="button" onclick="switchTab('tab-jersey')" id="btn-jersey" class="tab-btn px-4 py-3 font-bold text-sm border-b-2 border-transparent text-gray-500 hover:text-gray-700 transition">
            Jersey & Size
        </button>
        <button type="button" onclick="switchTab('tab-racepack')" id="btn-racepack" class="tab-btn px-4 py-3 font-bold text-sm border-b-2 border-transparent text-gray-500 hover:text-gray-700 transition">
            Info Race Pack
        </button>
        <button type="button" onclick="switchTab('tab-rute')" id="btn-rute" class="tab-btn px-4 py-3 font-bold text-sm border-b-2 border-transparent text-gray-500 hover:text-gray-700 transition">
            Rute Lari
        </button>
        <button type="button" onclick="switchTab('tab-terms')" id="btn-terms" class="tab-btn px-4 py-3 font-bold text-sm border-b-2 border-transparent text-gray-500 hover:text-gray-700 transition">
            Syarat & Ketentuan
        </button>
        <button type="button" onclick="switchTab('tab-faq')" id="btn-faq" class="tab-btn px-4 py-3 font-bold text-sm border-b-2 border-transparent text-gray-500 hover:text-gray-700 transition">
            FAQ (Pertanyaan)
        </button>
    </div>

    <!-- FORM UTAMA MEMBUNGKUS SEMUA TAB -->
    <form id="setting-form" action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- TAB 1: BERANDA & TENTANG KAMI -->
        <div id="tab-beranda" class="tab-content block space-y-6">
            
            <!-- Hero Section -->
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                <div class="bg-[#0b4d75] px-6 py-4 flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                    <h2 class="text-white font-bold tracking-wide">Hero Section & Info Dasar</h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Utama (Hero Title)</label>
                            <input type="text" name="hero_title" value="{{ $settings->hero_title }}" class="w-full border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-[#0b4d75]/30 focus:border-[#0b4d75] bg-gray-50 text-sm" placeholder="Contoh: RUN BEYOND LIMITS">
                            <p class="text-xs text-gray-400 mt-1">Teks besar yang muncul pertama kali di beranda.</p>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Sub-Judul (Nama Event)</label>
                            <input type="text" name="event_name" value="{{ $settings->event_name }}" class="w-full border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-[#0b4d75]/30 focus:border-[#0b4d75] bg-gray-50 text-sm" placeholder="Contoh: OCTOBERUN 2026">
                            <p class="text-xs text-gray-400 mt-1">Teks kecil berwarna oranye di atas judul utama.</p>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Statistik Jumlah Pelari (Teks Banner)</label>
                            <input type="text" name="target_runners_stat" value="{{ $settings->target_runners_stat }}" class="w-full border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-[#0b4d75]/30 focus:border-[#0b4d75] bg-gray-50 text-sm" placeholder="Contoh: 3100">
                            <p class="text-xs text-gray-400 mt-1">Teks stat biru di beranda untuk menarik pengguna, tidak mempengaruhi limit pendaftaran. Otomatis akan ditambahkan tanda '+' di belakangnya.</p>
                        </div>
                    </div>

                    <div class="pt-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Ganti Gambar Background Hero (Opsional)</label>
                        <input type="file" name="hero_image" class="w-full border border-gray-300 rounded-lg focus:outline-none file:mr-4 file:py-2.5 file:px-4 file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-[#0b4d75] hover:file:bg-blue-100 text-sm text-gray-500 bg-gray-50">
                        <p class="text-xs text-gray-400 mt-2 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            Biarkan kosong jika tidak ingin mengganti gambar. Format .JPG/.PNG.
                        </p>
                        @if($settings->hero_image)
                            <div class="mt-3 inline-flex items-center gap-2 bg-green-50 text-green-700 px-3 py-1.5 rounded-lg text-xs font-semibold border border-green-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                                Foto saat ini telah terpasang
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Tentang Kami -->
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                <div class="bg-[#0b4d75] px-6 py-4 flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <h2 class="text-white font-bold tracking-wide">Tentang Kami</h2>
                </div>
                <div class="p-6">
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Tentang Kami</label>
                            <input type="text" name="about_title" value="{{ $settings->about_title }}" class="w-full border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-[#0b4d75]/30 focus:border-[#0b4d75] bg-gray-50 text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                            <textarea name="about_text" rows="5" class="w-full border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-[#0b4d75]/30 focus:border-[#0b4d75] bg-gray-50 text-sm leading-relaxed">{{ $settings->about_text }}</textarea>
                            <p class="text-xs text-gray-400 mt-1">Penjelasan singkat yang muncul di bawah judul.</p>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Ganti Gambar 'Tentang Kami' (Opsional)</label>
                            <input type="file" name="about_image" class="w-full border border-gray-300 rounded-lg focus:outline-none file:mr-4 file:py-2.5 file:px-4 file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-[#0b4d75] hover:file:bg-blue-100 text-sm text-gray-500 bg-gray-50">
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <!-- TAB 2: JERSEY & SIZE -->
        <div id="tab-jersey" class="tab-content hidden">
            <div class="bg-white border border-cyan-500 rounded-xl shadow-sm overflow-hidden">
                <div class="bg-cyan-600 px-6 py-4 flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                    <h2 class="text-white font-bold tracking-wide">Konten Jersey & Size Chart</h2>
                </div>
                <div class="p-6">
                    <div class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Singkat (di Beranda)</label>
                                <input type="text" name="jersey_card_desc" value="{{ $settings->jersey_card_desc }}" class="w-full border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-500 bg-gray-50 text-sm" placeholder="Bahan ringan, sejuk, dll">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Upload Desain Jersey</label>
                                <input type="file" name="jersey_image" class="w-full border border-gray-300 rounded-lg focus:outline-none file:mr-4 file:py-2.5 file:px-4 file:border-0 file:text-sm file:font-semibold file:bg-cyan-50 file:text-cyan-700 hover:file:bg-cyan-100 text-sm text-gray-500 bg-gray-50">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Lengkap (di Modal Popup)</label>
                            <textarea name="jersey_modal_desc" rows="3" class="w-full border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-500 bg-gray-50 text-sm leading-relaxed" placeholder="Penjelasan lengkap tentang jersey...">{{ $settings->jersey_modal_desc }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB 3: RACE PACK -->
        <div id="tab-racepack" class="tab-content hidden">
            <div class="bg-white border border-[#e85d04] rounded-xl shadow-sm overflow-hidden">
                <div class="bg-[#e85d04] px-6 py-4 flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
                    <h2 class="text-white font-bold tracking-wide">Konten & Foto Race Pack</h2>
                </div>
                <div class="p-6">
                    <div class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Singkat (di Beranda)</label>
                                <input type="text" name="racepack_card_desc" value="{{ $settings->racepack_card_desc }}" class="w-full border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-[#e85d04]/30 focus:border-[#e85d04] bg-gray-50 text-sm" placeholder="Jersey, Medali, BIB, dll">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Upload Foto Race Pack</label>
                                <input type="file" name="racepack_image" class="w-full border border-gray-300 rounded-lg focus:outline-none file:mr-4 file:py-2.5 file:px-4 file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-[#e85d04] hover:file:bg-orange-100 text-sm text-gray-500 bg-gray-50">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Utama (di Modal Popup)</label>
                            <textarea name="racepack_modal_desc" rows="3" class="w-full border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-[#e85d04]/30 focus:border-[#e85d04] bg-gray-50 text-sm leading-relaxed" placeholder="Setiap pendaftar akan mendapatkan paket eksklusif...">{{ $settings->racepack_modal_desc }}</textarea>
                        </div>
                        
                        <div class="border-t border-gray-100 pt-6" x-data="racepackBenefits()">
                            <div class="flex justify-between items-center mb-4">
                                <label class="block text-sm font-bold text-gray-800">Daftar Benefit Race Pack</label>
                                <button type="button" @click="addBenefit()" class="bg-[#e85d04] text-white px-3 py-1.5 rounded text-xs font-bold shadow hover:bg-orange-600 transition flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" /></svg>
                                    Tambah Item
                                </button>
                            </div>
                            
                            <div class="space-y-3">
                                <template x-for="(item, index) in benefits" :key="index">
                                    <div class="bg-orange-50/50 p-4 rounded-xl border border-orange-200 relative flex items-start gap-4 transition-all">
                                        
                                        <!-- Hapus Button -->
                                        <button type="button" @click="removeBenefit(index)" class="absolute top-3 right-3 text-red-500 hover:text-white bg-red-50 hover:bg-red-500 p-1.5 rounded-md transition shadow-sm" title="Hapus Item">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M20 12H4" /></svg>
                                        </button>

                                        <div class="flex-grow grid grid-cols-1 md:grid-cols-3 gap-4 mt-2 pr-10">
                                            <!-- Title -->
                                            <div>
                                                <label class="block text-xs font-semibold text-gray-600 mb-1">Judul Benefit</label>
                                                <input type="text" x-model="item.title" :name="`racepack_benefits[${index}][title]`" class="w-full border-gray-300 rounded-md px-3 py-2 text-sm" placeholder="Cth: Jersey Premium" required>
                                            </div>
                                            <!-- Desc -->
                                            <div>
                                                <label class="block text-xs font-semibold text-gray-600 mb-1">Deskripsi Singkat</label>
                                                <input type="text" x-model="item.desc" :name="`racepack_benefits[${index}][desc]`" class="w-full border-gray-300 rounded-md px-3 py-2 text-sm" placeholder="Cth: Bahan anti-bau..." required>
                                            </div>
                                            <!-- Icon -->
                                            <div>
                                                <label class="block text-xs font-semibold text-gray-600 mb-1">Pilih Icon</label>
                                                <select x-model="item.icon" :name="`racepack_benefits[${index}][icon]`" class="w-full border-gray-300 rounded-md px-3 py-2 text-sm" required>
                                                    <option value="check">Ceklis Default</option>
                                                    <option value="jersey">Baju / Jersey</option>
                                                    <option value="medal">Medali</option>
                                                    <option value="ticket">Tiket / BIB</option>
                                                    <option value="bag">Tas / Goodie Bag</option>
                                                    <option value="drink">Minuman</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                                
                                <div x-show="benefits.length === 0" class="text-center py-6 text-gray-400 text-sm border-2 border-dashed border-gray-200 rounded-xl">
                                    Belum ada benefit yang ditambahkan. Klik tombol "+ Tambah Item".
                                </div>
                            </div>
                        </div>

                        <!-- Alpine Component Script -->
                        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
                        <script>
                            document.addEventListener('alpine:init', () => {
                                Alpine.data('racepackBenefits', () => ({
                                    benefits: @json($settings->racepack_benefits ?? []),
                                    
                                    init() {
                                        if (!Array.isArray(this.benefits)) {
                                            if (this.benefits && typeof this.benefits === 'object') {
                                                this.benefits = Object.values(this.benefits);
                                            } else {
                                                this.benefits = [];
                                            }
                                        }
                                    },

                                    addBenefit() {
                                        this.benefits.push({ title: '', desc: '', icon: 'check' });
                                    },

                                    removeBenefit(index) {
                                        this.benefits.splice(index, 1);
                                    }
                                }))
                            })
                        </script>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB 4: RUTE LARI -->
        <div id="tab-rute" class="tab-content hidden">
            <div class="bg-white border border-teal-500 rounded-xl shadow-sm overflow-hidden">
                <div class="bg-teal-600 px-6 py-4 flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" /></svg>
                    <h2 class="text-white font-bold tracking-wide">Peta Rute Lari</h2>
                </div>
                <div class="p-6">
                    <div class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Singkat (di Beranda)</label>
                                <input type="text" name="route_card_desc" value="{{ $settings->route_card_desc }}" class="w-full border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-teal-500/30 focus:border-teal-500 bg-gray-50 text-sm" placeholder="Rute 5K melewati landmark...">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Upload Peta Rute</label>
                                <input type="file" name="route_image" class="w-full border border-gray-300 rounded-lg focus:outline-none file:mr-4 file:py-2.5 file:px-4 file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100 text-sm text-gray-500 bg-gray-50">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Rute (di Modal Popup)</label>
                            <textarea name="route_modal_desc" rows="3" class="w-full border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-teal-500/30 focus:border-teal-500 bg-gray-50 text-sm leading-relaxed" placeholder="Tantang dirimu di rute 5 Kilometer...">{{ $settings->route_modal_desc }}</textarea>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Titik Start & Finish</label>
                                <input type="text" name="route_start_finish" value="{{ $settings->route_start_finish }}" class="w-full border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-teal-500/30 focus:border-teal-500 bg-gray-50 text-sm" placeholder="Cth: Alun-Alun Utama Kota">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Fasilitas Rute</label>
                                <input type="text" name="route_facilities" value="{{ $settings->route_facilities }}" class="w-full border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-teal-500/30 focus:border-teal-500 bg-gray-50 text-sm" placeholder="Water station, medis, dll">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB 5: SYARAT & KETENTUAN -->
        <div id="tab-terms" class="tab-content hidden">
            <div class="bg-white border border-indigo-500 rounded-xl shadow-sm overflow-hidden">
                <div class="bg-indigo-600 px-6 py-4 flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                    <h2 class="text-white font-bold tracking-wide">Syarat & Ketentuan</h2>
                </div>
                <div class="p-6">
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Isi Syarat & Ketentuan</label>
                            <textarea name="terms_conditions" rows="15" class="w-full border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-500 bg-gray-50 text-sm leading-relaxed" placeholder="Masukkan teks Syarat & Ketentuan di sini...">{{ $settings->terms_conditions }}</textarea>
                            <p class="text-xs text-gray-400 mt-2">Gunakan tombol Enter untuk membuat paragraf atau baris baru. Teks ini akan ditampilkan di halaman depan website.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>

    <!-- TAB 6: FAQ -->
    <div id="tab-faq" class="tab-content hidden">
        <div class="bg-white rounded-xl shadow-sm overflow-hidden p-6">
            {{-- TOOLBAR: Filter kiri + Tambah FAQ kanan --}}
            <div class="flex flex-wrap items-center justify-between gap-3 mb-4">

                {{-- Filter Form --}}
                <form method="GET" action="{{ route('admin.settings') }}" id="faq-filter-form" class="flex flex-wrap items-center gap-3">
                    <input type="hidden" name="tab" value="faq">
                    {{-- Search --}}
                    <div class="relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                        <input type="text" name="search" id="faq-search" value="{{ request('search') }}"
                            placeholder="Cari pertanyaan..."
                            class="pl-9 pr-4 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0b4d75]/30 focus:border-[#0b4d75] bg-gray-50 w-56">
                    </div>

                    {{-- Status --}}
                    <select name="status" id="faq-status" onchange="document.getElementById('faq-filter-form').submit()"
                        class="text-sm border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0b4d75]/30 focus:border-[#0b4d75] bg-gray-50 cursor-pointer">
                        <option value="all"      {{ request('status', 'all') === 'all'      ? 'selected' : '' }}>Semua Status</option>
                        <option value="active"   {{ request('status') === 'active'   ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </form>

                {{-- Aksi Kanan --}}
                <div class="flex items-center gap-2">
                    @if(request()->anyFilled(['search', 'status']))
                    <a href="{{ route('admin.settings', ['tab' => 'faq']) }}"
                        class="text-sm font-semibold text-gray-500 hover:text-red-500 px-3 py-2 rounded-lg border border-gray-200 hover:border-red-200 transition bg-gray-50">
                        Reset Filter
                    </a>
                    @endif
                    <a href="{{ route('admin.faq.create') }}" id="btn-tambah-faq"
                        class="inline-flex items-center gap-2 bg-[#0b4d75] hover:bg-[#083b5c] text-white text-sm font-bold px-5 py-2.5 rounded-xl transition shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
                        Tambah FAQ
                    </a>
                </div>
            </div>

            {{-- TABEL FAQ --}}
            <div class="border border-gray-200 rounded-xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gray-50/80 border-b border-gray-200 text-left">
                                <th class="px-5 py-3.5 text-xs font-bold text-gray-500 uppercase tracking-wider w-12">No.</th>
                                <th class="px-5 py-3.5 text-xs font-bold text-gray-500 uppercase tracking-wider">Pertanyaan</th>
                                <th class="px-5 py-3.5 text-xs font-bold text-gray-500 uppercase tracking-wider">Jawaban</th>
                                <th class="px-5 py-3.5 text-xs font-bold text-gray-500 uppercase tracking-wider text-center w-20">Urutan</th>
                                <th class="px-5 py-3.5 text-xs font-bold text-gray-500 uppercase tracking-wider text-center w-24">Status</th>
                                <th class="px-5 py-3.5 text-xs font-bold text-gray-500 uppercase tracking-wider text-center w-28">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($faqs as $index => $faq)
                            <tr class="hover:bg-blue-50/20 transition-colors duration-150">
                                {{-- No --}}
                                <td class="px-5 py-4 text-gray-500 font-semibold whitespace-nowrap">
                                    {{ $faqs->firstItem() + $index }}.
                                </td>
                                {{-- Pertanyaan --}}
                                <td class="px-5 py-4">
                                    <p class="font-semibold text-gray-800 text-sm leading-snug max-w-xs">{{ $faq->question }}</p>
                                </td>
                                {{-- Jawaban (dipotong) --}}
                                <td class="px-5 py-4">
                                    <p class="text-gray-500 text-sm max-w-sm">{{ Str::limit($faq->answer, 80) }}</p>
                                </td>
                                {{-- Urutan --}}
                                <td class="px-5 py-4 text-center">
                                    <span class="inline-block bg-gray-100 text-gray-700 text-xs font-bold px-3 py-1 rounded-full">
                                        {{ $faq->order }}
                                    </span>
                                </td>
                                {{-- Status --}}
                                <td class="px-5 py-4 text-center">
                                    <form method="POST" action="{{ route('admin.faq.toggle', $faq->id) }}" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" id="btn-toggle-{{ $faq->id }}" title="{{ $faq->is_active ? 'Klik untuk Nonaktifkan' : 'Klik untuk Aktifkan' }}"
                                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border transition cursor-pointer
                                            {{ $faq->is_active
                                                ? 'bg-green-50 text-green-700 border-green-200 hover:bg-red-50 hover:text-red-600 hover:border-red-200'
                                                : 'bg-gray-100 text-gray-500 border-gray-200 hover:bg-green-50 hover:text-green-700 hover:border-green-200' }}">
                                            <span class="w-1.5 h-1.5 rounded-full {{ $faq->is_active ? 'bg-green-500' : 'bg-gray-400' }}"></span>
                                            {{ $faq->is_active ? 'Aktif' : 'Nonaktif' }}
                                        </button>
                                    </form>
                                </td>
                                {{-- Aksi --}}
                                <td class="px-5 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        {{-- Edit --}}
                                        <a href="{{ route('admin.faq.edit', $faq->id) }}" id="btn-edit-faq-{{ $faq->id }}" title="Edit FAQ"
                                            class="w-8 h-8 flex items-center justify-center rounded-lg bg-amber-50 hover:bg-amber-100 text-amber-600 transition border border-amber-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                        </a>
                                        {{-- Hapus --}}
                                        <button type="button" id="btn-hapus-faq-{{ $faq->id }}" title="Hapus FAQ"
                                            onclick="confirmDelete({{ $faq->id }}, '{{ addslashes(Str::limit($faq->question, 40)) }}')"
                                            class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-50 hover:bg-red-100 text-red-500 transition border border-red-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center gap-3">
                                        <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        </div>
                                        <p class="text-gray-500 font-semibold text-sm">Belum ada FAQ.</p>
                                        <a href="{{ route('admin.faq.create') }}" class="text-[#0b4d75] font-bold text-sm hover:underline">+ Tambah FAQ pertama</a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Footer Pagination --}}
                <div class="flex flex-col sm:flex-row items-center justify-between px-6 py-4 border-t border-gray-100 gap-3 bg-gray-50">
                    <p class="text-sm text-gray-500">
                        Menampilkan <span class="font-bold text-gray-900">{{ $faqs->firstItem() ?? 0 }}</span> -
                        <span class="font-bold text-gray-900">{{ $faqs->lastItem() ?? 0 }}</span>
                        dari <span class="font-bold text-gray-900">{{ $faqs->total() }}</span> data
                    </p>

                    <div class="flex items-center gap-1">
                        @if($faqs->onFirstPage())
                            <span class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-100 text-gray-300 cursor-not-allowed">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
                            </span>
                        @else
                            <a href="{{ $faqs->previousPageUrl() }}&tab=faq" class="w-8 h-8 flex items-center justify-center rounded-lg bg-white border border-gray-200 hover:bg-blue-50 hover:border-[#0b4d75] text-gray-600 hover:text-[#0b4d75] transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
                            </a>
                        @endif

                        @for($p = 1; $p <= $faqs->lastPage(); $p++)
                            @if($p === $faqs->currentPage())
                                <span class="w-8 h-8 flex items-center justify-center rounded-lg bg-[#0b4d75] text-white text-sm font-bold">{{ $p }}</span>
                            @else
                                <a href="{{ $faqs->url($p) }}&tab=faq" class="w-8 h-8 flex items-center justify-center rounded-lg bg-white border border-gray-200 hover:bg-blue-50 hover:border-[#0b4d75] text-gray-600 hover:text-[#0b4d75] text-sm transition">{{ $p }}</a>
                            @endif
                        @endfor

                        @if($faqs->hasMorePages())
                            <a href="{{ $faqs->nextPageUrl() }}&tab=faq" class="w-8 h-8 flex items-center justify-center rounded-lg bg-white border border-gray-200 hover:bg-blue-50 hover:border-[#0b4d75] text-gray-600 hover:text-[#0b4d75] transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                            </a>
                        @else
                            <span class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-100 text-gray-300 cursor-not-allowed">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function switchTab(tabId) {
            // 1. Sembunyikan semua konten tab
            document.querySelectorAll('.tab-content').forEach(function(content) {
                content.classList.remove('block');
                content.classList.add('hidden');
            });

            // 2. Tampilkan tab yang dipilih
            document.getElementById(tabId).classList.remove('hidden');
            document.getElementById(tabId).classList.add('block');

            // 3. Reset warna semua tombol tab menjadi abu-abu (tidak aktif)
            document.querySelectorAll('.tab-btn').forEach(function(btn) {
                btn.classList.remove('border-[#e85d04]', 'text-[#e85d04]');
                btn.classList.add('border-transparent', 'text-gray-500');
            });

            // 4. Warnai tombol yang sedang aktif menjadi oranye
            let activeBtn = document.getElementById('btn-' + tabId.replace('tab-', ''));
            if (activeBtn) {
                activeBtn.classList.remove('border-transparent', 'text-gray-500');
                activeBtn.classList.add('border-[#e85d04]', 'text-[#e85d04]');
            }
        }

        // Buka tab FAQ otomatis jika ada parameter tab=faq atau session active_tab
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const activeTab = "{{ session('active_tab') }}";
            
            if (urlParams.get('tab') === 'faq' || activeTab === 'tab-faq' || urlParams.has('search') || urlParams.has('page') || urlParams.has('status')) {
                switchTab('tab-faq');
            }
        });

        // FAQ Modals Scripts
        function confirmDelete(id, question) {
            document.getElementById('delete-question-text').textContent = '"' + question + '"';
            document.getElementById('delete-form').action = '/admin-gsc/faq/' + id;
            document.getElementById('delete-modal').classList.remove('hidden');
            document.getElementById('delete-modal').classList.add('flex');
        }

        function closeDeleteModal() {
            document.getElementById('delete-modal').classList.add('hidden');
            document.getElementById('delete-modal').classList.remove('flex');
        }

        document.getElementById('delete-modal')?.addEventListener('click', function(e) {
            if (e.target === this) closeDeleteModal();
        });
    </script>

    {{-- MODAL KONFIRMASI HAPUS FAQ --}}
    <div id="delete-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm mx-4 overflow-hidden">
            <div class="bg-gradient-to-r from-red-500 to-red-600 p-5">
                <h3 class="text-white font-bold text-lg flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                    Hapus FAQ
                </h3>
            </div>
            <div class="p-6">
                <p class="text-gray-600 text-sm mb-1">Yakin ingin menghapus pertanyaan:</p>
                <p id="delete-question-text" class="font-bold text-gray-800 text-sm mb-6 italic">"..."</p>
                <p class="text-xs text-red-500 bg-red-50 border border-red-200 rounded-lg px-3 py-2 mb-6">⚠️ Data yang dihapus tidak dapat dikembalikan.</p>
                <div class="flex gap-3">
                    <button type="button" onclick="closeDeleteModal()" id="btn-batal-hapus"
                        class="flex-1 py-2.5 rounded-xl border border-gray-300 text-gray-600 font-semibold text-sm hover:bg-gray-50 transition">
                        Batal
                    </button>
                    <form id="delete-form" method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" id="btn-konfirmasi-hapus"
                            class="w-full py-2.5 rounded-xl bg-red-500 hover:bg-red-600 text-white font-bold text-sm transition">
                            Ya, Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection