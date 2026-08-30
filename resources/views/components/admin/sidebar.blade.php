<!-- resources/views/components/admin/sidebar.blade.php -->
<aside id="admin-sidebar" class="w-64 bg-[#0b4d75] text-white h-screen fixed left-0 top-0 z-50 shadow-xl flex flex-col transition-transform duration-300 -translate-x-full md:translate-x-0">
    
    <!-- Bagian Logo -->
    <div class="p-6 border-b border-blue-800/50 flex justify-center">
        <a href="{{ url('/') }}" target="_blank" title="Lihat Website">
            <img src="{{ asset('img/logo.png') }}" alt="Logo Octoberun" class="h-10 bg-white/10 p-2 rounded-lg backdrop-blur-sm hover:scale-105 transition transform">
        </a>
    </div>

    <!-- Bagian Menu Navigasi -->
    <nav class="mt-6 px-4 space-y-1 flex-1 overflow-y-auto">
        
        <!-- Menu Dashboard (Telah Digabung) -->
        <a href="{{ url('/admin-gsc/dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg font-bold transition {{ request()->is('admin-gsc/dashboard') ? 'bg-white/10 text-white' : 'text-blue-100 hover:bg-white/10 hover:text-white' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
            Dashboard
        </a>

        <!-- Menu Data Pendaftar -->
        <a href="{{ route('admin.datapendaftar') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg font-bold transition {{ request()->routeIs('admin.datapendaftar*') || request()->is('admin-gsc/pendaftar*') ? 'bg-white/10 text-white' : 'text-blue-100 hover:bg-white/10 hover:text-white' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
            Data Pendaftar
        </a>

        <!-- Menu Verifikasi Manual -->
        <a href="{{ route('admin.verifikasi') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg font-bold transition {{ request()->routeIs('admin.verifikasi*') ? 'bg-white/10 text-white' : 'text-blue-100 hover:bg-white/10 hover:text-white' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
            Verifikasi Manual
        </a>

        <!-- Menu Distribusi Race Pack -->
        <a href="{{ route('admin.rpc') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg font-bold transition {{ request()->routeIs('admin.rpc') ? 'bg-white/10 text-white' : 'text-blue-100 hover:bg-white/10 hover:text-white' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
            Distribusi Race Pack
        </a>

        <!-- Menu Konten Website -->
        <a href="{{ route('admin.settings') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg font-bold transition {{ request()->routeIs('admin.settings') ? 'bg-white/10 text-white' : 'text-blue-100 hover:bg-white/10 hover:text-white' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H14" /></svg>
            Konten Website
        </a>

        <!-- Menu FAQ (Rute dari Annisa + Hover dari kamu) -->
        <a href="{{ route('admin.faq') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg font-bold transition {{ request()->routeIs('admin.faq') ? 'bg-white/10 text-white' : 'text-blue-100 hover:bg-white/10 hover:text-white' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            FAQ (Pertanyaan)
        </a>


        
        <!-- Menu Pengaturan Pendaftaran -->
        <a href="{{ route('admin.registration.settings') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg font-bold transition {{ request()->is('admin-gsc/pengaturan-pendaftaran') ? 'bg-white/10 text-white' : 'text-blue-100 hover:bg-white/10 hover:text-white' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
            Pengaturan pendaftaran
        </a>

    </nav>

    <!-- Bagian Logout -->
    <div class="p-4 border-t border-blue-800/50 mt-auto">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="flex items-center gap-3 px-4 py-3 w-full text-left text-red-300 hover:bg-red-500/20 hover:text-red-100 rounded-lg transition font-bold shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Keluar / Logout
            </button>
        </form>
    </div>

</aside>