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
            $detail_absensi = AbsensiDetail::where('kode_absensi', $absensi->kode_absensi)
                ->where('pegawai_id', session('id'))
                ->first();
            
            $jamMasuk = date('H:i', $detail_absensi->absen_masuk);
            $jamPulang = date('H:i', $detail_absensi->absen_pulang);
            $durasi = $this->hitungDurasi($jamMasuk, $detail_absensi->absen_pulang > 0 ? $jamPulang : date('H:i'));
            // dd($durasi);
            $detail_absensi->duration_text = "Anda berkerja selama {$durasi['jam']} jam {$durasi['menit']} Menit";
            
        }else {
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

    function hitungDurasi($jamMasuk, $jamKeluar) {
        $jamMasukObj = DateTime::createFromFormat('H:i', $jamMasuk);
        $jamKeluarObj = DateTime::createFromFormat('H:i', $jamKeluar);
    
        $durasi = $jamKeluarObj->diff($jamMasukObj);
    
        return [
            'jam_masuk' => $jamMasuk,
            'jam_keluar' => $jamKeluar,
            'jam' => $durasi->h,
            'menit' => $durasi->i
        ];
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
            'plugins' => '
                
            ',
            'pegawai' => Pegawai::firstWhere('id', session('id'))
        ]);
    }

    public function edit_profile(Request $request)
    {
        // cek apakah ada gambar yang di upload
        if ($request->file('gambar')) {
            if ($request->gambar_lama) {
                if ($request->gambar_lama != 'default.jpg') {
                    Storage::delete('assets/img/pegawai/' . $request->gambar_lama);
                }
            }
            $gambar = str_replace('assets/img/pegawai/', '', $request->file('gambar')->store('assets/img/pegawai/'));
        }else {
            $gambar = $request->gambar_lama;
        }

        $data = [
            'nama'=> $request->nama,
            'gambar' => $gambar
        ];

        Pegawai::where('id', session('id'))
                ->update($data);

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
        $pegawai = Pegawai::firstWhere('id', session('id'));

        $new_password = $request->new_password;
        $current_password = $request->current_password;

        if ($pegawai->password != $current_password) {
            return redirect('/pegawai/profile')->with('pesan', "
                <script>
                    Swal.fire(
                        'Error!',
                        'Current Password Salah!',
                        'error'
                    )
                </script>
            ");
        }

        Pegawai::where('id', session('id'))
                ->update(['password' => $new_password]);

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
}
