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

    public function updateStatus(Request $request, $id)
    {
        $participant = Participant::findOrFail($id);
        $oldStatus = $participant->payment_status;
        $newStatus = $request->payment_status;

        $participant->update(['payment_status' => $newStatus]);

        $message = 'Status pembayaran berhasil diperbarui!';

        // Jika status berubah menjadi Lunas (paid), kirim email E-Ticket
        if ($oldStatus !== 'paid' && $newStatus === 'paid') {
            try {
                $settings = EventSetting::first() ?? new EventSetting();
                Mail::to($participant->email)->send(new ETicketMail($participant, $settings));
                $message .= ' Email E-Ticket telah berhasil dikirim ke peserta.';
            } catch (\Exception $e) {
                // Jangan gagalkan update status hanya karena email gagal
                $message .= ' Namun, email E-Ticket gagal dikirim: ' . $e->getMessage();
            }
        }

        return back()->with('success', $message);
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

        $participants = $query->latest()->get();

        $filename = 'data-pendaftar-octoberun-' . now()->format('Ymd-His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $response = new StreamedResponse(function () use ($participants) {
            $handle = fopen('php://output', 'w');

            // BOM untuk UTF-8
            fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));

            // Header CSV
            fputcsv($handle, [
                'No. Order',
                'Nama Lengkap',
                'Nama BIB',
                'No. KTP/Passport',
                'Ukuran Jersey',
                'Email',
                'No. WhatsApp',
                'Jenis Kelamin',
                'Kota',
                'Alamat',
                'Status Pembayaran',
                'Status Race Pack',
                'Metode Pembayaran',
                'Total Bayar',
                'Tanggal Daftar',
            ]);

            foreach ($participants as $p) {
                fputcsv($handle, [
                    $p->order_id,
                    $p->full_name,
                    $p->bib_name,
                    $p->id_number,
                    $p->jersey_size,
                    $p->email,
                    $p->whatsapp,
                    $p->gender === 'male' ? 'Laki-laki' : 'Perempuan',
                    $p->city,
                    $p->address,
                    ucfirst($p->payment_status),
                    $p->is_racepack_taken ? 'Sudah Diambil' : 'Belum Diambil',
                    $p->payment_method ?? '-',
                    'Rp ' . number_format($p->gross_amount, 0, ',', '.'),
                    $p->created_at->format('d M Y H:i'),
                ]);
            }

            fclose($handle);
        }, 200, $headers);

        return $response;
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
