<?php

use Illuminate\Support\Facades\Route;
use App\Models\EventSetting; // Panggil modelnya di sini
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\SettingController;

Route::get('/', function () {
    // Ambil data pertama dari tabel event_settings
    $settings = EventSetting::first(); 
    
    // Kirim variabel $settings ke halaman home
    return view('user.home', compact('settings'));
});

// Rute Halaman Pendaftaran
Route::get('/daftar', [RegistrationController::class, 'index'])->name('daftar');

Route::get('/pembayaran', [RegistrationController::class, 'payment'])->name('pembayaran');

// ... rute pendaftaran & frontend di atasnya biarkan saja ...

// Rute Halaman Login
Route::get('/login-panitia', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login-panitia', [AuthController::class, 'authenticate']);
Route::post('/logout-panitia', [AuthController::class, 'logout'])->name('logout');

// Rute Admin yang DIKUNCI (Middleware Auth)
Route::prefix('admin-gsc')->middleware('auth')->group(function () {
    
    Route::get('/', function () {
        return redirect('/admin-gsc/dashboard');
    });

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });

    // Rute Konten Website
    Route::get('/settings', [SettingController::class, 'index'])->name('admin.settings');
    
    // TAMBAHKAN BARIS INI: Rute untuk memproses form saat disubmit
    Route::post('/settings', [SettingController::class, 'update'])->name('admin.settings.update');
    
});