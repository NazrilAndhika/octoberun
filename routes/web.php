<?php

use Illuminate\Support\Facades\Route;
use App\Models\EventSetting;
use App\Models\Faq;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\DatapendaftarController;
use App\Http\Controllers\Admin\FaqController;

Route::get('/', function () {
    $settings = EventSetting::first();
    $faqs = Faq::active()->get();
    return view('user.home', compact('settings', 'faqs'));
});

// Rute Halaman Pendaftaran
Route::get('/daftar', [RegistrationController::class, 'index'])->name('daftar');
Route::post('/daftar', [RegistrationController::class, 'store'])->name('daftar.store');

// Rute Pembayaran
Route::get('/pembayaran/{order_id}', [RegistrationController::class, 'showPembayaran'])->name('pembayaran.show');
Route::post('/pembayaran/upload-bukti', [RegistrationController::class, 'uploadBukti'])->name('pembayaran.upload');
Route::get('/pembayaran/sukses/{order_id}', [RegistrationController::class, 'sukses'])->name('pembayaran.sukses');

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

    // === Rute Data Pendaftar ===
    Route::get('/datapendaftar', [DatapendaftarController::class, 'index'])->name('admin.datapendaftar');
    Route::get('/datapendaftar/export', [DatapendaftarController::class, 'exportCsv'])->name('admin.datapendaftar.export');
    Route::get('/datapendaftar/{id}', [DatapendaftarController::class, 'show'])->name('admin.datapendaftar.show');
    Route::patch('/datapendaftar/{id}/status', function (\Illuminate\Http\Request $request, $id) {
        $participant = \App\Models\Participant::findOrFail($id);
        $participant->update(['payment_status' => $request->payment_status]);
        return back()->with('success', 'Status pembayaran berhasil diperbarui!');
    })->name('admin.datapendaftar.status');

    // === Rute FAQ ===
    Route::get('/faq', [FaqController::class, 'index'])->name('admin.faq');
    Route::get('/faq/create', [FaqController::class, 'create'])->name('admin.faq.create');
    Route::post('/faq', [FaqController::class, 'store'])->name('admin.faq.store');
    Route::get('/faq/{id}/edit', [FaqController::class, 'edit'])->name('admin.faq.edit');
    Route::put('/faq/{id}', [FaqController::class, 'update'])->name('admin.faq.update');
    Route::delete('/faq/{id}', [FaqController::class, 'destroy'])->name('admin.faq.destroy');
    Route::patch('/faq/{id}/toggle', [FaqController::class, 'toggleStatus'])->name('admin.faq.toggle');

});