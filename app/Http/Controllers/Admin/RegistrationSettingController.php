<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventSetting;
use Illuminate\Http\Request;

class RegistrationSettingController extends Controller
{
    // Menampilkan form pengaturan pendaftaran
    public function index()
    {
        $settings = EventSetting::first() ?? new EventSetting();
        return view('admin.registration-settings', compact('settings'));
    }

    // Menyimpan perubahan ke database
    public function update(Request $request)
    {
        $settings = EventSetting::first() ?? new EventSetting();
        
        // Kita HANYA mengambil 3 data ini agar aman dan tidak menimpa data Konten Website
        $data = $request->only(['event_date', 'target_runners', 'registration_deadline']);
        
        $settings->fill($data);
        $settings->save();

        return back()->with('success', 'Pengaturan jadwal dan kuota pendaftaran berhasil diperbarui!');
    }
}