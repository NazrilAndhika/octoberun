<!-- resources/views/components/navbar.blade.php -->
@php
    $navbarSettings = \App\Models\EventSetting::first();
    $isClosed = false;
    if (!$navbarSettings || !$navbarSettings->is_registration_open || now()->greaterThan($navbarSettings->registration_deadline)) {
        $isClosed = true;
    } else {
        $kapasitas = (int) ($navbarSettings->target_runners ?? 0);
        $pendaftar = \App\Models\Participant::whereIn('payment_status', ['paid', 'pending'])->count();
        if ($kapasitas - $pendaftar <= 0) {
            $isClosed = true;
        }
    }
@endphp

<nav class="bg-white shadow-sm fixed w-full z-50 top-0">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            
            <!-- Bagian Logo Kiri (Sekarang bisa diklik untuk balik ke Home) -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo Octoberun" class="h-10">
                </a>
            </div>

            <!-- Tombol Hamburger untuk Mobile -->
            <div class="flex items-center md:hidden">
                <button id="mobile-menu-btn" class="text-gray-600 hover:text-[#0b4d75] focus:outline-none p-2">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

            <!-- Bagian Menu Tengah (Link diperbarui menggunakan url('/#...')) -->
            <div class="hidden md:flex space-x-10">
                <a href="{{ url('/#beranda') }}" class="text-[#0b4d75] font-bold hover:text-[#e85d04] transition pb-1">BERANDA</a>
                <a href="{{ url('/#info') }}" class="text-[#0b4d75] font-bold hover:text-[#e85d04] transition pb-1">INFO</a>
                <a href="{{ url('/#tentang') }}" class="text-[#0b4d75] font-bold hover:text-[#e85d04] transition pb-1">TENTANG</a>
                <a href="{{ route('cek-status') }}" class="text-[#0b4d75] font-bold hover:text-[#e85d04] transition pb-1">CEK STATUS</a>
            </div>

            <!-- Bagian Tombol Kanan (Ditambah rute pendaftaran) -->
            <div class="hidden md:flex">
                @if($isClosed)
                    <button disabled class="bg-gray-400 cursor-not-allowed text-white text-sm font-bold py-2.5 px-6 rounded flex items-center gap-2">
                        PENDAFTARAN DITUTUP
                    </button>
                @else
                    <a href="{{ route('daftar') }}" class="btn-daftar-global bg-[#0b4d75] hover:bg-blue-800 text-white text-sm font-bold py-2.5 px-6 rounded flex items-center gap-2 transition duration-300">
                        DAFTAR SEKARANG
                    </a>
                @endif
            </div>

        </div>
    </div>

    <!-- Dropdown Menu Mobile (Link juga diperbarui) -->
    <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-100 shadow-lg">
        <div class="px-4 pt-2 pb-4 space-y-2">
            <a href="{{ url('/#beranda') }}" class="block px-3 py-2 text-[#0b4d75] font-bold border-l-4 border-[#0b4d75] bg-blue-50">BERANDA</a>
            <a href="{{ url('/#info') }}" class="block px-3 py-2 text-[#0b4d75] font-bold hover:bg-gray-50">INFO</a>
            <a href="{{ url('/#tentang') }}" class="block px-3 py-2 text-[#0b4d75] font-bold hover:bg-gray-50">TENTANG</a>
            <a href="{{ route('cek-status') }}" class="block px-3 py-2 text-[#0b4d75] font-bold hover:bg-gray-50">CEK STATUS</a>
            
            @if($isClosed)
                <button disabled class="block mt-4 w-full text-center bg-gray-400 cursor-not-allowed text-white font-bold py-3 rounded">
                    PENDAFTARAN DITUTUP
                </button>
            @else
                <a href="{{ route('daftar') }}" class="btn-daftar-global block mt-4 w-full text-center bg-[#0b4d75] hover:bg-blue-800 text-white font-bold py-3 rounded transition">
                    DAFTAR SEKARANG
                </a>
            @endif
        </div>
    </div>
</nav>

<!-- Script Sederhana untuk Toggle Menu Mobile -->
<script>
    document.getElementById('mobile-menu-btn').addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu');
        const iconPath = this.querySelector('path');
        
        menu.classList.toggle('hidden');
        
        if (menu.classList.contains('hidden')) {
            // Jika menu disembunyikan, tampilkan ikon hamburger
            iconPath.setAttribute('d', 'M4 6h16M4 12h16M4 18h16');
        } else {
            // Jika menu terbuka, tampilkan ikon silang (X)
            iconPath.setAttribute('d', 'M6 18L18 6M6 6l12 12');
        }
    });
</script>