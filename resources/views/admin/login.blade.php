<!-- resources/views/admin/login.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Panitia - OCTOBERUN 2026</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">
        <div class="flex justify-center mb-8">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-12">
        </div>
        
        <h2 class="text-2xl font-black text-center text-[#0b4d75] mb-6 uppercase italic">Login Panitia</h2>

        <!-- Area Pesan Error -->
        @if ($errors->any())
            <div class="bg-red-50 text-red-500 p-3 rounded-lg mb-4 text-sm font-semibold text-center border border-red-200">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-gray-600 mb-1.5">Email Panitia</label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-[#0b4d75] focus:border-[#0b4d75] py-2.5 px-3 text-sm" placeholder="Masukkan email" required autofocus>
            </div>
            
            <div>
                <label class="block text-sm font-semibold text-gray-600 mb-1.5">Password</label>
                <input type="password" name="password" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-[#0b4d75] focus:border-[#0b4d75] py-2.5 px-3 text-sm" placeholder="Masukkan password" required>
            </div>

            <button type="submit" class="w-full bg-[#0b4d75] hover:bg-blue-800 text-white font-bold py-3 rounded-lg transition uppercase tracking-widest mt-4">
                Masuk Dashboard
            </button>
        </form>
    </div>

</body>
</html>