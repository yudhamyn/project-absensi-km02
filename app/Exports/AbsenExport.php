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
        // dd([$this->tgl_awal, $this->tgl_akhir]);
        // return AbsensiDetail::whereHas('absensi', function ($query) {
            // return $query->whereBetween('tgl_absen', [$this->tgl_awal, $this->tgl_akhir]);
            // return $query->whereRaw("DATE_FORMAT(absensi.tgl_absen, \"%Y-%m-%d\") between '2023-11-01' and '2023-11-31'");
        // })->get();
        $data = AbsensiDetail::get();

        $tgl_awal = Carbon::createFromDate($this->tgl_awal);
        $tgl_akhir = Carbon::createFromDate($this->tgl_akhir);

        $temp = collect([]);
        foreach ($data as $key => $item) {
            if(Carbon::createFromDate($item->absensi->tgl_absen)->between($tgl_awal, $tgl_akhir)) $temp->push($item);
        }

        return $temp;
    }

    public function headings(): array
    {
        return [
            'Tanggal Absen',
            'Nama',
            'Jabatan',
            'Status',
            'Jam Kerja',
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
        $jam_kerja = $item->jam_kerja;

        return [
            $tgl_absen,
            $item->pegawai->nama,
            $item->pegawai && $item->pegawai->jabatan ? $item->pegawai->jabatan->nama : '-',
            $item->status_masuk == 1 ? 'Terlambat' : (!$item->absen_masuk && !$item->absen_pulang ? 'Belum Absen' : 'Tepat Waktu'),
            $jam_kerja ? "$jam_kerja->nama ($jam_kerja->kode)" : '-',
            $item->izin == 1 ? 'Izin' : ($item->absen_masuk > 0 ? $absen_masuk : '-'),
            $item->izin == 1 ? 'Izin' : ($item->absen_pulang > 0 ? $absen_pulang : '-'),
            $item->durasi ?? '0',
            $item->izin == 1 ? "Ya ($status_izin)" : 'Tidak'
        ];
    }

    public function title(): string
    {
        return "Laporan $this->tgl_awal s/d $this->tgl_akhir";
    }
}
