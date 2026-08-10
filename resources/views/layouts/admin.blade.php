<!-- resources/views/layouts/admin.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - OCTOBERUN 2026</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#f8f9fa] text-gray-800 antialiased">

    <!-- Memanggil Komponen Sidebar -->
    @include('components.admin.sidebar')

    <!-- Area Konten Utama (Responsive margin dan padding) -->
    <main class="md:ml-64 p-4 md:p-8 min-h-screen transition-all duration-300">
        
        <!-- Header Atas -->
        <header class="flex justify-between md:justify-end items-center mb-6 md:mb-8 pb-4 border-b border-gray-200">
            <!-- Hamburger Button for Mobile -->
            <button id="admin-mobile-btn" class="md:hidden text-gray-600 hover:text-[#0b4d75] focus:outline-none p-2 -ml-2">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            
            <div class="flex items-center gap-3">
                <span class="text-sm font-semibold text-gray-600">Halo, Panitia</span>
                <div class="w-10 h-10 bg-[#0b4d75] rounded-full flex items-center justify-center text-white font-bold shadow-sm">P</div>
            </div>
        </header>

        <!-- Tempat menyisipkan konten dinamis per halaman -->
        <div class="overflow-x-hidden">
            @yield('content')
        </div>

    </main>

    <!-- Overlay untuk mobile sidebar -->
    <div id="admin-sidebar-overlay" class="fixed inset-0 bg-black/50 z-40 hidden md:hidden"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('admin-sidebar');
            const mobileBtn = document.getElementById('admin-mobile-btn');
            const overlay = document.getElementById('admin-sidebar-overlay');

            function toggleSidebar() {
                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('hidden');
            }

            if(mobileBtn) {
                mobileBtn.addEventListener('click', toggleSidebar);
            }
            if(overlay) {
                overlay.addEventListener('click', toggleSidebar);
            }
        });
    </script>
    @stack('scripts')
</body>
</html>