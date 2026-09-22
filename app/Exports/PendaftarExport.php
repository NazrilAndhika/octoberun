<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class PendaftarExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        if ($this->data instanceof Builder) {
            return $this->data->latest()->get();
        }
        
        return $this->data;
    }

    public function headings(): array
    {
        return [
            'No. Order',
            'Nama Lengkap',
            'Paket Tiket',
            'Nama BIB',
            'Nomor BIB',
            'No. KTP/Passport',
            'Ukuran Jersey',
            'Email',
            'No. WhatsApp',
            'Jenis Kelamin',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Golongan Darah',
            'Kota',
            'Alamat',
            'Nama Kontak Darurat',
            'No. HP Darurat',
            'Hubungan Darurat',
            'Riwayat Penyakit',
            'Status Pembayaran',
            'Status Race Pack',
            'Metode Pembayaran',
            'Total Bayar',
            'Tanggal Daftar',
        ];
    }

    public function map($p): array
    {
        return [
            $p->order_id,
            $p->full_name,
            $p->ticketPackage->nama_paket ?? 'EARLY BIRD',
            $p->bib_name,
            $p->bib_number ?? '-',
            $p->id_number,
            $p->jersey_size === 'Custom Size' ? $p->jersey_size . ' (' . $p->custom_size_note . ')' : $p->jersey_size,
            $p->email,
            $p->whatsapp,
            $p->gender === 'male' ? 'Laki-laki' : 'Perempuan',
            $p->birth_place ?? '-',
            $p->birth_date ?? '-',
            $p->blood_type ?? '-',
            $p->city,
            $p->address,
            $p->emergency_contact_name ?? '-',
            $p->emergency_contact_phone ?? '-',
            $p->emergency_contact_relation ?? '-',
            $p->medical_history ?? '-',
            ucfirst($p->payment_status),
            $p->is_racepack_taken ? 'Sudah Diambil' : 'Belum Diambil',
            $p->payment_method ?? '-',
            'Rp ' . number_format($p->gross_amount, 0, ',', '.'),
            $p->created_at ? $p->created_at->format('d M Y H:i') : '-',
        ];
    }
}
