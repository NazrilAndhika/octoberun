<?php

use Illuminate\Support\Facades\Route;
use App\Models\EventSetting; // Panggil modelnya di sini
use App\Http\Controllers\RegistrationController;

Route::get('/', function () {
    // Ambil data pertama dari tabel event_settings
    $settings = EventSetting::first(); 
    
    // Kirim variabel $settings ke halaman home
    return view('user.home', compact('settings'));
});

// Rute Halaman Pendaftaran
Route::get('/daftar', [RegistrationController::class, 'index'])->name('daftar');

