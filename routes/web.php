<?php

use Illuminate\Support\Facades\Route;
use App\Models\EventSetting;
use App\Models\Faq;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\DatapendaftarController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RegistrationSettingController;
use App\Http\Controllers\Admin\RacePackController;

Route::get('/', function () {
    $settings = EventSetting::first();
    $faqs = Faq::active()->get();
    
    $kapasitasMaksimal = (int) ($settings->target_runners ?? 0);
    $jumlahPendaftar = \App\Models\Participant::whereIn('payment_status', ['paid', 'pending'])->count();
    $sisaKuota = $kapasitasMaksimal - $jumlahPendaftar;

    return view('user.home', compact('settings', 'faqs', 'sisaKuota'));
});

// Rute Halaman Pendaftaran
Route::get('/daftar', [RegistrationController::class, 'index'])->name('daftar');
Route::post('/daftar', [RegistrationController::class, 'store'])->name('daftar.store');

// Rute Cek Status
Route::get('/cek-status', [RegistrationController::class, 'cekStatus'])->name('cek-status');
Route::get('/e-ticket/{order_id}', [RegistrationController::class, 'showTicket'])->name('e-ticket.show');

// Webhook Midtrans
Route::post('/api/midtrans-callback', [RegistrationController::class, 'webhook'])->name('midtrans.callback');
// Rute Pembayaran
Route::get('/pembayaran/{order_id}', [RegistrationController::class, 'showPembayaran'])->name('pembayaran.show');
Route::post('/pembayaran/manual/{order_id}', [RegistrationController::class, 'uploadBukti'])->name('pembayaran.manual.upload');
Route::get('/pembayaran/sukses/{order_id}', [RegistrationController::class, 'sukses'])->name('pembayaran.sukses');

// === Rute Halaman Statis Payment Gateway ===
Route::get('/faq', function () { return view('pages.faq'); });
Route::get('/refund-policy', function () { return view('pages.refund-policy'); });
Route::get('/syarat-ketentuan', function () { return view('pages.syarat-ketentuan'); });
Route::get('/kontak', function () { return view('pages.kontak'); });

// Rute Halaman Login
Route::get('/portal-rahasia-gsc', [AuthController::class, 'showLogin'])->name('login');
Route::post('/portal-rahasia-gsc', [AuthController::class, 'authenticate']);
Route::post('/logout-panitia', [AuthController::class, 'logout'])->name('logout');

// Rute Admin yang DIKUNCI (Middleware Auth)
// Rute Admin yang DIKUNCI (Middleware Auth)
Route::prefix('admin-gsc')->middleware('auth')->group(function () {
    
    Route::get('/', function () {
        return redirect('/admin-gsc/dashboard');
    });

    // UBAH JADI SEPERTI INI (Hanya 1 baris, tidak ada function() lagi):
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Rute Konten Website
    Route::get('/settings', [SettingController::class, 'index'])->name('admin.settings');

    // Rute Konten Website
    Route::get('/settings', [SettingController::class, 'index'])->name('admin.settings');
    
    // TAMBAHKAN BARIS INI: Rute untuk memproses form saat disubmit
    Route::post('/settings', [SettingController::class, 'update'])->name('admin.settings.update');

    // === Rute Data Pendaftar ===
    Route::get('/datapendaftar', [DatapendaftarController::class, 'index'])->name('admin.datapendaftar');
    Route::get('/datapendaftar/export', [DatapendaftarController::class, 'exportCsv'])->name('admin.datapendaftar.export');
    Route::get('/datapendaftar/{id}', [DatapendaftarController::class, 'show'])->name('admin.datapendaftar.show');
    Route::get('/datapendaftar/{id}/edit', [DatapendaftarController::class, 'edit'])->name('admin.datapendaftar.edit');
    Route::put('/datapendaftar/{id}', [DatapendaftarController::class, 'update'])->name('admin.datapendaftar.update');
    Route::post('/datapendaftar/{id}/resend-email', [DatapendaftarController::class, 'resendEmail'])->name('admin.datapendaftar.resendEmail');
    Route::delete('/datapendaftar/{id}', [DatapendaftarController::class, 'destroy'])->name('admin.datapendaftar.destroy');

    // === Rute Verifikasi Manual ===
    Route::get('/verifikasi', [\App\Http\Controllers\Admin\VerificationController::class, 'index'])->name('admin.verifikasi');
    Route::post('/verifikasi/{id}/terima', [\App\Http\Controllers\Admin\VerificationController::class, 'terima'])->name('admin.verifikasi.terima');
    Route::post('/verifikasi/{id}/tolak', [\App\Http\Controllers\Admin\VerificationController::class, 'tolak'])->name('admin.verifikasi.tolak');

    // === Rute Distribusi Race Pack ===
    Route::get('/rpc', [RacePackController::class, 'index'])->name('admin.rpc');
    Route::post('/rpc/confirm/{id}', [RacePackController::class, 'confirm'])->name('admin.rpc.confirm');

    // === Rute FAQ ===
    Route::get('/faq', [FaqController::class, 'index'])->name('admin.faq');
    Route::get('/faq/create', [FaqController::class, 'create'])->name('admin.faq.create');
    Route::post('/faq', [FaqController::class, 'store'])->name('admin.faq.store');
    Route::get('/faq/{id}/edit', [FaqController::class, 'edit'])->name('admin.faq.edit');
    Route::put('/faq/{id}', [FaqController::class, 'update'])->name('admin.faq.update');
    Route::delete('/faq/{id}', [FaqController::class, 'destroy'])->name('admin.faq.destroy');
    Route::patch('/faq/{id}/toggle', [FaqController::class, 'toggleStatus'])->name('admin.faq.toggle');

    // Rute Pengaturan Pendaftaran
    Route::get('/pengaturan-pendaftaran', [RegistrationSettingController::class, 'index'])->name('admin.registration.settings');
    Route::post('/pengaturan-pendaftaran', [RegistrationSettingController::class, 'update'])->name('admin.registration.update');

});

Route::get('/buat-jembatan', function () {
    \Illuminate\Support\Facades\Artisan::call('storage:link');
    return 'Jembatan foto berhasil dibangun!';
});