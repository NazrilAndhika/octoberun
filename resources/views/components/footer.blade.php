<!-- resources/views/components/footer.blade.php -->
<footer class="bg-[#0b4d75] text-white pt-16 pb-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:justify-between gap-10 md:gap-8 mb-12 text-center md:text-left">
            
            <!-- Kolom 1: Branding & Sosial Media -->
            <div class="w-full md:w-1/4 flex flex-col items-center md:items-start">
                <!-- Kita pakai logo yang sama -->
                <img src="{{ asset('img/logo.png') }}" alt="Logo Octoberun" class="h-10 mb-4 bg-white p-1 rounded shadow-sm mx-auto md:mx-0">
                <p class="text-sm text-gray-300 mb-6 leading-relaxed">
                    Run beyond limits. <br>
                    Faster, stronger, together. <br>
                    Sampai jumpa di garis finish!
                </p>
                <!-- Ikon Sosial Media -->
                <div class="flex gap-4 justify-center md:justify-start">
                    <a href="https://www.instagram.com/eventoctoberun?igsi=ZDNlZDc0MzIxNw==" class="w-8 h-8 rounded-full border border-white/30 flex items-center justify-center hover:bg-white hover:text-[#0b4d75] transition">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/></svg>
                    </a>
                </div>
            </div>

            <!-- Kolom 2: Menu Utama -->
            <div class="w-full md:w-1/4">
                <h4 class="font-bold text-sm tracking-widest mb-6 uppercase">MENU</h4>
                <ul class="space-y-3 text-sm text-gray-300">
                    <li><a href="{{ url('/#beranda') }}" class="hover:text-white hover:underline transition">Beranda</a></li>
                    <li><a href="{{ url('/#info') }}" class="hover:text-white hover:underline transition">Info</a></li>
                    <li><a href="{{ url('/#tentang') }}" class="hover:text-white hover:underline transition">Tentang</a></li>
                </ul>
            </div>

            <!-- Kolom 3: Kontak -->
            <div class="w-full md:w-1/4">
                <h4 class="font-bold text-sm tracking-widest mb-6 uppercase">HUBUNGI KAMI</h4>
                <ul class="space-y-3 text-sm text-gray-300">
                    <li class="flex items-center justify-center md:justify-start gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                        +62 895-6346-89045
                    </li>
                    <li class="flex items-center justify-center md:justify-start gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                        eventoctoberun@gmail.com
                    </li>
                    <li class="flex items-center justify-center md:justify-start gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        Cilacap, Jawa Tengah
                    </li>
                </ul>
            </div>



        </div>

        <!-- Copyright -->
        <div class="border-t border-white/20 pt-8 text-center text-xs text-gray-400">
            &copy; 2026 OCTOBERUN. All Rights Reserved.
        </div>
    </div>
</footer>