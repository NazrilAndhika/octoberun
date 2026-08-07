<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Wajib ditambahkan untuk fitur hapus file

class SettingController extends Controller
{
    public function index()
    {
        $settings = EventSetting::first() ?? new EventSetting();
        return view('admin.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = EventSetting::first() ?? new EventSetting();
        
        // Ambil SEMUA data teks, KECUALI file gambar (gambar diproses terpisah)
        $data = $request->except(['_token', 'hero_image', 'about_image', 'jersey_image', 'route_image', 'racepack_image']);

        // Fungsi bantuan (Helper) pintar untuk menghapus foto lama & menyimpan foto baru
        $handleImage = function ($field) use ($request, $settings, &$data) {
            if ($request->hasFile($field)) {
                // 1. Cek apakah ada foto lama di database dan fisiknya ada di folder storage
                if ($settings->$field && Storage::disk('public')->exists($settings->$field)) {
                    // 2. Hapus foto lama tersebut
                    Storage::disk('public')->delete($settings->$field);
                }
                // 3. Simpan foto baru ke folder 'settings'
                $data[$field] = $request->file($field)->store('settings', 'public');
            }
        };

        // Eksekusi fungsi helper untuk masing-masing foto
        $handleImage('hero_image');
        $handleImage('about_image');
        $handleImage('jersey_image');
        $handleImage('route_image');
        $handleImage('racepack_image');

        // Timpa data lama dengan data baru, lalu simpan paksa!
        $settings->fill($data);
        $settings->save();

        return back()->with('success', 'Konten website & foto berhasil diperbarui! (Foto lama otomatis terhapus)');
    }
}