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
        
        // Kita HANYA mengambil data yang diperbolehkan agar aman dan tidak menimpa data Konten Website
        $data = $request->only([
            'event_date', 
            'event_location', 
            'target_runners', 
            'registration_deadline',
            'ticket_price',
            'admin_fee',
            'is_registration_open',
            'payment_mode',
            'manual_bank_name',
            'manual_bank_account',
            'manual_bank_owner',
            'wa_group_link'
        ]);
        
        // Checkbox dari form (toggle switch) jika tidak diceklis maka tidak akan terkirim
        $data['is_registration_open'] = $request->has('is_registration_open');
        
        $settings->fill($data);
        $settings->save();

        return back()->with('success', 'Pengaturan jadwal dan kuota pendaftaran berhasil diperbarui!');
    }
}