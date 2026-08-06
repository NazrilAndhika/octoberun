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
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-sporty { font-family: 'Montserrat', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-slate-800 antialiased pt-20">

    <!-- Memanggil file komponen navbar -->
    <x-navbar />

    <!-- Area ini akan diisi oleh konten dari halaman lain -->
    <main>
        @yield('content')
    </main>

    <!-- Nanti kamu bisa buat komponen footer terpisah dan panggil pakai <x-footer /> -->

</body>
</html>