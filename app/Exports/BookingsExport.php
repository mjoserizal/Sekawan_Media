<?php

namespace App\Exports;

use App\Models\Booking;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BookingsExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Booking::with('car')->get()->map(function ($booking) {
            return [
                'ID' => $booking->id,
                'Car Name' => $booking->car->nama_mobil, // Assuming 'nama_mobil' is the car's name
                'Nama Lengkap' => $booking->nama_lengkap,
                'Alamat Lengkap' => $booking->alamat_lengkap,
                'Nomer WA' => $booking->nomer_wa,
                'Hari Sewa' => $booking->rent_days,
                'Total Harga' => $booking->total_price,
                'Status' => $booking->status,
                'Pemakaian Kilometer' => $booking->kilometers,
                'Pemakaian BBM' => $booking->fuel_used,
            ];
        });
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Car Name',
            'Nama Lengkap',
            'Alamat Lengkap',
            'Nomer WA',
            'Hari Sewa',
            'Total Harga',
            'Status',
            'Pemakaian Kilometer',
            'Pemakaian BBM',
        ];
    }
}
