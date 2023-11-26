<?php

namespace App\Console\Commands;

use App\Http\Controllers\AdminAbsensiController;
use App\Models\Absensi;
use App\Models\AbsensiDetail;
use App\Models\Pegawai;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CreateAbsentCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'absen:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command buat absen';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $check = Absensi::firstWhere('tgl_absen', date('d-M-Y', time()));

        if($check) {
            $this->info("Absensi hari ini sudah terbuat!");
            Log::info("Absensi hari ini sudah terbuat!");
            return true;
        } else {
            // AdminAbsensiController::
            $pegawai = Pegawai::all();
            $kode_absen = Str::random(20);

            $data_absen = [
                'kode_absensi' => $kode_absen,
                'jumlah_pegawai' => count($pegawai),
                'jumlah_pegawai_masuk' => null,
                'jumlah_pegawai_pulang' => null,
                'jumlah_izin' => null,
                'total' => null,
                'tgl_absen' => date('d-M-Y', time())
            ];

            $absen_detail = [];

            foreach ($pegawai as $p) {
                array_push($absen_detail, [
                    'kode_absensi' => $kode_absen,
                    'pegawai_id' => $p->id,
                ]);
            }

            Absensi::create($data_absen);
            AbsensiDetail::insert($absen_detail);

            $this->info("Absen berhasil dibuat!");
            Log::info("Absen berhasil dibuat!");
        }
        return true;
    }
}
