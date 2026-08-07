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

    <!-- Area Konten Utama (Diberi margin-left 64 agar tidak tertutup sidebar) -->
    <main class="ml-64 p-8 min-h-screen">
        
        <!-- Header Atas (Bisa diisi nama admin / tombol logout nanti) -->
        <header class="flex justify-end items-center mb-8 pb-4 border-b border-gray-200">
            <div class="flex items-center gap-3">
                <span class="text-sm font-semibold text-gray-600">Halo, Panitia</span>
                <div class="w-10 h-10 bg-[#0b4d75] rounded-full flex items-center justify-center text-white font-bold">P</div>
            </div>
        </header>

        <!-- Tempat menyisipkan konten dinamis per halaman -->
        @yield('content')

    </main>

</body>
</html>