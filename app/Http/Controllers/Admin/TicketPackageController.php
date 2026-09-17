<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TicketPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TicketPackageController extends Controller
{
    public function index()
    {
        $packages = TicketPackage::orderBy('harga', 'asc')->get();
        return view('admin.ticket_packages.index', compact('packages'));
    }

    public function create()
    {
        return view('admin.ticket_packages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_paket' => 'required|string|max:255',
            'harga'      => 'required|numeric|min:0',
            'deskripsi'  => 'nullable|string',
            'gambar_benefit' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'benefits'   => 'nullable|array',
            'benefits.*' => 'string|max:255',
        ]);

        $data = $request->except(['gambar_benefit', 'is_active']);
        $data['is_active'] = $request->has('is_active');
        $data['benefits'] = array_filter($request->benefits ?? [], fn($b) => !empty(trim($b)));

        if ($request->hasFile('gambar_benefit')) {
            $data['gambar_benefit'] = $request->file('gambar_benefit')->store('ticket_packages', 'public');
        }

        TicketPackage::create($data);

        return redirect()->route('admin.ticket_packages.index')->with('success', 'Paket Tiket berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $package = TicketPackage::findOrFail($id);
        return view('admin.ticket_packages.edit', compact('package'));
    }

    public function update(Request $request, $id)
    {
        $package = TicketPackage::findOrFail($id);

        $request->validate([
            'nama_paket' => 'required|string|max:255',
            'harga'      => 'required|numeric|min:0',
            'deskripsi'  => 'nullable|string',
            'gambar_benefit' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'benefits'   => 'nullable|array',
            'benefits.*' => 'string|max:255',
        ]);

        $data = $request->except(['gambar_benefit', 'is_active']);
        $data['is_active'] = $request->has('is_active');
        $data['benefits'] = array_filter($request->benefits ?? [], fn($b) => !empty(trim($b)));

        if ($request->hasFile('gambar_benefit')) {
            if ($package->gambar_benefit && Storage::disk('public')->exists($package->gambar_benefit)) {
                Storage::disk('public')->delete($package->gambar_benefit);
            }
            $data['gambar_benefit'] = $request->file('gambar_benefit')->store('ticket_packages', 'public');
        }

        $package->update($data);

        return redirect()->route('admin.ticket_packages.index')->with('success', 'Paket Tiket berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $package = TicketPackage::findOrFail($id);
        if ($package->gambar_benefit && Storage::disk('public')->exists($package->gambar_benefit)) {
            Storage::disk('public')->delete($package->gambar_benefit);
        }
        $package->delete();
        return redirect()->route('admin.ticket_packages.index')->with('success', 'Paket Tiket berhasil dihapus!');
    }

    public function toggleStatus($id)
    {
        $package = TicketPackage::findOrFail($id);
        $package->update(['is_active' => !$package->is_active]);
        return back()->with('success', 'Status Paket Tiket berhasil diubah!');
    }
}
