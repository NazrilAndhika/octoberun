<!-- resources/views/layouts/admin.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - OCTOBERUN 2026</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-[#f8f9fa] text-gray-800 antialiased">

    <!-- Memanggil Komponen Sidebar -->
    @include('components.admin.sidebar')

    <!-- Area Konten Utama (Responsive margin dan padding) -->
    <main class="md:ml-64 p-4 md:p-8 min-h-screen transition-all duration-300">
        
        <!-- Header Atas & Breadcrumb -->
        <header class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6 md:mb-8 pb-4 border-b border-gray-200">
            
            <div class="flex items-center justify-between w-full md:w-auto">
                <div class="flex items-center gap-3">
                    <!-- Hamburger Button for Mobile -->
                    <button id="admin-mobile-btn" class="md:hidden text-gray-600 hover:text-[#0b4d75] focus:outline-none p-2 -ml-2">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    
                    <!-- Dynamic Breadcrumb -->
                    <nav aria-label="breadcrumb" class="block">
                        <ol class="flex items-center space-x-2 text-sm text-gray-500 font-medium">
                            <li>
                                <a href="{{ route('admin.dashboard') }}" class="hover:text-[#0b4d75] transition flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                                    Home
                                </a>
                            </li>
                            @php
                                $segments = request()->segments();
                                $url = '';
                            @endphp
                            @foreach($segments as $key => $segment)
                                @php
                                    $url .= '/' . $segment;
                                    $displayName = ucwords(str_replace('-', ' ', $segment));
                                @endphp
                                @if($segment !== 'admin-gsc')
                                    <li>
                                        <div class="flex items-center">
                                            <svg class="h-4 w-4 text-gray-400 mx-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                                            @if($key == count($segments) - 1)
                                                <span class="text-[#0b4d75] font-bold">{{ $displayName }}</span>
                                            @else
                                                <a href="{{ url($url) }}" class="hover:text-[#0b4d75] transition">{{ $displayName }}</a>
                                            @endif
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ol>
                    </nav>
                </div>

                <!-- Profile Info (Mobile: disebelah kanan hamburger, Desktop: di ujung kanan header) -->
                <div class="flex md:hidden items-center gap-3">
                    <div class="w-9 h-9 bg-[#0b4d75] rounded-full flex items-center justify-center text-white font-bold shadow-sm">P</div>
                </div>
            </div>

            <!-- Profile Info Desktop -->
            <div class="hidden md:flex items-center gap-3">
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