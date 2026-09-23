<!-- resources/views/layouts/user.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OCTOBERUN 2026 - Run Beyond Limits</title>
    
    <!-- Memanggil CSS dari Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Memanggil Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,700;0,800;0,900;1,800;1,900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-sporty { font-family: 'Montserrat', sans-serif; }
        
        
    </style>

    <!-- Facebook Domain Verification -->
    <meta name="facebook-domain-verification" content="umy1yzxfuy0thfwfyz3rd54k05otgb" />

    <!-- Meta Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '2825012037866512');
    fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=2825012037866512&ev=PageView&noscript=1"
    /></noscript>
    <!-- End Meta Pixel Code -->
</head>
<body class="bg-gray-50 text-slate-800 antialiased pt-20 flex flex-col min-h-screen">

    <!-- Memanggil file komponen navbar -->
    <x-navbar />

    <!-- Area ini akan diisi oleh konten dari halaman lain -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <x-footer />

    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true, // Animasi hanya berjalan sekali saat di-scroll
            offset: 50, // Mulai animasi sedikit lebih awal sebelum elemen muncul penuh
            duration: 800, // Durasi animasi standar (0.8 detik)
        });
    </script>
</body>
</html>