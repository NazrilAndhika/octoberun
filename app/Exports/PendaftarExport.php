<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Database\Eloquent\Builder;

class PendaftarExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $query;

    public function __construct(Builder $query)
    {
        $this->query = $query;
    }

    public function query()
    {
        return $this->query->latest();
    }

    public function headings(): array
    {
        return [
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
        ];
    }

    public function map($p): array
    {
        return [
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
            $p->created_at ? $p->created_at->format('d M Y H:i') : '-',
        ];
    }
}
