<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\AbsensiDetail;
use App\Models\Pegawai;
use App\Models\Settings;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PegawaiController extends Controller
{
    public function index()
    {
        $absensi = Absensi::firstWhere('tgl_absen', date('d-M-Y', time()));
        if ($absensi) {
            $detail_absensi = $this->getAbsensiDetail($absensi->kode_absensi);
        } else {
            $detail_absensi = [];
        }

        return view('pegawai.dashboard', [
            'judul_halaman' => 'Dashboard Pegawai',
            'judul_sidebar' => 'Dashboard',
            'menu' => [
                'tab' => 'home',
                'page' => 'dashboard'
            ],
            'plugins' => '',
            'pegawai' => Pegawai::firstWhere('id', session('id')),
            'absensi' => $absensi,
            'detail_absen' => $detail_absensi,
            'pengaturan' => Settings::first(),
        ]);
    }

    public function profile()
    {
        return view('pegawai.profile', [
            'judul_halaman' => 'Profile',
            'judul_sidebar' => 'Profile',
            'menu' => [
                'tab' => 'home',
                'page' => 'dashboard'
            ],
            'plugins' => '',
            'pegawai' => Pegawai::firstWhere('id', session('id'))
        ]);
    }

    public function edit_profile(Request $request)
    {
        // ...

        Pegawai::where('id', session('id'))->update($data);

        return redirect('/pegawai/profile')->with('pesan', "
            <script>
                Swal.fire(
                    'Berhasil!',
                    'Profile Updated!',
                    'success'
                )
            </script>
        ");
    }

    public function password(Request $request)
    {
        // ...

        Pegawai::where('id', session('id'))->update(['password' => $new_password]);

        return redirect('/pegawai/profile')->with('pesan', "
            <script>
                Swal.fire(
                    'Berhasil!',
                    'Password Updated!',
                    'success'
                )
            </script>
        ");
    }

    // Fungsi untuk mendapatkan detail absensi
    private function getAbsensiDetail($kode_absensi)
    {
        $detail_absensi = AbsensiDetail::where('kode_absensi', $kode_absensi)
            ->where('pegawai_id', session('id'))
            ->first();

        $jamMasuk = date('H:i:s', $detail_absensi->absen_masuk);
        $jamPulang = date('H:i:s', $detail_absensi->absen_pulang);
        $durasi = $this->hitungDurasi($jamMasuk, $detail_absensi->absen_pulang > 0 ? $jamPulang : date('H:i:s'));

        $detail_absensi->duration_text = "Anda bekerja selama {$durasi['jam']} jam {$durasi['menit']} menit {$durasi['detik']} detik";

        return $detail_absensi;
    }

    // Fungsi untuk menghitung durasi
    private function hitungDurasi($jamMasuk, $jamKeluar)
    {
        $jamMasukObj = DateTime::createFromFormat('H:i:s', $jamMasuk);
        $jamKeluarObj = DateTime::createFromFormat('H:i:s', $jamKeluar);

        $durasi = $jamKeluarObj->diff($jamMasukObj);

        return [
            'jam_masuk' => $jamMasuk,
            'jam_keluar' => $jamKeluar,
            'jam' => $durasi->h,
            'menit' => $durasi->i,
            'detik' => $durasi->s
        ];
    }
}
