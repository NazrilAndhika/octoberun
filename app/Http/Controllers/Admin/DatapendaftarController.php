<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Participant;
use App\Models\EventSetting;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\Mail;
use App\Mail\ETicketMail;

class DatapendaftarController extends Controller
{
    public function index(Request $request)
    {
        $settings = EventSetting::first();

        $query = Participant::query();

        // --- Filter: Search ---
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('whatsapp', 'like', "%{$search}%")
                  ->orWhere('order_id', 'like', "%{$search}%");
            });
        }

        // --- Filter: Status Pembayaran ---
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('payment_status', $request->status);
        }

        // --- Filter: Ukuran Jersey ---
        if ($request->filled('jersey_size') && $request->jersey_size !== 'all') {
            $query->where('jersey_size', $request->jersey_size);
        }

        // --- Filter: Status Race Pack ---
        if ($request->filled('racepack_status') && $request->racepack_status !== 'all') {
            if ($request->racepack_status === 'taken') {
                $query->where('is_racepack_taken', true);
            } else if ($request->racepack_status === 'not_taken') {
                $query->where('is_racepack_taken', false);
            }
        }

        // --- Filter: Tanggal ---
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // --- Paginate ---
        $perPage = $request->input('per_page', 10);
        $participants = $query->latest()->paginate($perPage)->appends($request->query());

        return view('admin.datapendaftar', compact(
            'participants',
            'perPage'
        ));
    }

    public function show($id)
    {
        $participant = Participant::findOrFail($id);
        return view('admin.datapendaftar_detail', compact('participant'));
    }

    public function resendEmail(Request $request, $id)
    {
        $participant = Participant::findOrFail($id);

        if ($participant->payment_status !== 'paid') {
            return back()->with('error', 'Tidak dapat mengirim E-Ticket karena status pembayaran belum Lunas.');
        }

        try {
            $settings = EventSetting::first() ?? new EventSetting();
            Mail::to($participant->email)->send(new ETicketMail($participant, $settings));
            return back()->with('success', 'Email E-Ticket berhasil dikirim ulang ke peserta.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengirim email E-Ticket: ' . $e->getMessage());
        }
    }

    public function exportCsv(Request $request)
    {
        $query = Participant::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('whatsapp', 'like', "%{$search}%")
                  ->orWhere('order_id', 'like', "%{$search}%");
            });
        }
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('payment_status', $request->status);
        }
        if ($request->filled('jersey_size') && $request->jersey_size !== 'all') {
            $query->where('jersey_size', $request->jersey_size);
        }
        if ($request->filled('racepack_status') && $request->racepack_status !== 'all') {
            if ($request->racepack_status === 'taken') {
                $query->where('is_racepack_taken', true);
            } else if ($request->racepack_status === 'not_taken') {
                $query->where('is_racepack_taken', false);
            }
        }
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        return \Maatwebsite\Excel\Facades\Excel::download(
            new \App\Exports\PendaftarExport($query), 
            'Data_Pendaftar_OCTOBERUN.xlsx'
        );
    }

    public function edit($id)
    {
        $participant = Participant::findOrFail($id);
        return view('admin.datapendaftar_edit', compact('participant'));
    }

    public function update(Request $request, $id)
    {
        $participant = Participant::findOrFail($id);

        $request->validate([
            'full_name'  => 'required|string|max:255',
            'nik'        => 'required|numeric|digits:16',
            'email'      => 'required|email|max:255',
            'whatsapp'   => 'required|string|max:20',
            'gender'     => 'required|in:male,female',
            'city'       => 'required|string|max:255',
            'address'    => 'required|string',
            'jersey_size'=> 'required|in:S,M,L,XL,XXL,3XL,4XL,Custom Size',
            'custom_lebar'   => 'required_if:jersey_size,Custom Size|nullable|numeric',
            'custom_panjang' => 'required_if:jersey_size,Custom Size|nullable|numeric',
        ]);

        $customNote = $participant->custom_size_note;
        if ($request->filled('custom_lebar') && $request->filled('custom_panjang')) {
            $customNote = 'lebar ' . $request->custom_lebar . ' x panjang ' . $request->custom_panjang;
        }

        $participant->update([
            'full_name'  => $request->full_name,
            'id_number'  => $request->nik,
            'email'      => $request->email,
            'whatsapp'   => $request->whatsapp,
            'gender'     => $request->gender,
            'city'       => $request->city,
            'address'    => $request->address,
            'jersey_size'=> $request->jersey_size,
            'custom_size_note' => $customNote,
        ]);

        return redirect()->route('admin.datapendaftar.show', $participant->id)->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $participant = Participant::findOrFail($id);
        
        // Hapus file bukti pembayaran jika ada
        if ($participant->payment_proof && \Illuminate\Support\Facades\Storage::disk('public')->exists($participant->payment_proof)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($participant->payment_proof);
        }

        $participant->delete();

        return back()->with('success', 'Data pendaftar berhasil dihapus!');
    }
}
