<?php

namespace App\Exports;

use App\Models\AbsensiDetail;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class AbsenExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize, WithTitle
{
    private $tgl_awal;
    private $tgl_akhir;

    public function __construct(string $tgl_awal, string $tgl_akhir) 
    {
        $this->tgl_awal = $tgl_awal;
        $this->tgl_akhir = $tgl_akhir;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return AbsensiDetail::all();
    }

    public function headings(): array
    {
        return [
            'Tanggal Absen',
            'NIP',
            'Nama',
            'Status',
            'Jam Masuk',
            'Jam Pulang',
            'Durasi Kerja (menit)',
            'Izin'
        ];
    }

    public function map($item): array
    {
        $tgl_absen = Carbon::createFromDate($item->absensi->tgl_absen)->format('d/m/Y');
        $absen_masuk = Carbon::createFromTimestamp($item->absen_masuk)->format('H:i');
        $absen_pulang = Carbon::createFromTimestamp($item->absen_pulang)->format('H:i');
        $status_izin = $item->status_izin == 0 ? 'Pending' : ($item->status_izin == 1 ? 'Di setujui' : 'Di tolak');

        return [
            $tgl_absen,
            $item->pegawai->nip,
            $item->pegawai->nama,
            $item->status_masuk == 1 ? 'Terlambat' : 'Tepat Waktu',
            $item->izin == 1 ? 'Izin' : $absen_masuk,
            $item->izin == 1 ? 'Izin' : $absen_pulang,
            $item->durasi ?? '0',
            $item->izin == 1 ? "Ya ($status_izin)" : 'Tidak'
        ];
    }

    public function title(): string
    {
        return "Laporan $this->tgl_awal s/d $this->tgl_akhir";
    }
}
