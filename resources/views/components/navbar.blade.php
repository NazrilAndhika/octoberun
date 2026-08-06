<!-- resources/views/components/navbar.blade.php -->
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
                <a href="{{ url('/#tentang') }}" class="text-gray-500 font-semibold hover:text-[#0b4d75] transition pb-1">TENTANG</a>
                <a href="{{ url('/#info') }}" class="text-gray-500 font-semibold hover:text-[#0b4d75] transition pb-1">INFO</a>
            </div>

            <!-- Bagian Tombol Kanan (Ditambah rute pendaftaran) -->
            <div class="hidden md:flex">
                <a href="{{ route('daftar') }}" class="bg-[#0b4d75] hover:bg-blue-800 text-white text-sm font-bold py-2.5 px-6 rounded flex items-center gap-2 transition duration-300">
                    DAFTAR SEKARANG
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>

        </div>
    </div>

    <!-- Dropdown Menu Mobile (Link juga diperbarui) -->
    <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-100 shadow-lg">
        <div class="px-4 pt-2 pb-4 space-y-2">
            <a href="{{ url('/#beranda') }}" class="block px-3 py-2 text-[#0b4d75] font-bold border-l-4 border-[#0b4d75] bg-blue-50">BERANDA</a>
            <a href="{{ url('/#tentang') }}" class="block px-3 py-2 text-gray-600 font-semibold hover:bg-gray-50">TENTANG</a>
            <a href="{{ url('/#info') }}" class="block px-3 py-2 text-gray-600 font-semibold hover:bg-gray-50">INFO</a>
            <a href="{{ route('daftar') }}" class="block mt-4 w-full text-center bg-[#0b4d75] hover:bg-blue-800 text-white font-bold py-3 rounded transition">
                DAFTAR SEKARANG
            </a>
        </div>
    </div>
</nav>

<!-- Script Sederhana untuk Toggle Menu Mobile -->
<script>
    document.getElementById('mobile-menu-btn').addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });
</script>