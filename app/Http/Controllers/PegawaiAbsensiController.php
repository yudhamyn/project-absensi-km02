<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\AbsensiDetail;
use App\Models\JamKerja;
use App\Models\Pegawai;
use App\Models\Settings;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class PegawaiAbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $absensi = Absensi::firstWhere('tgl_absen', date('d-M-Y', time()));
        $detail_absensi = [];
        if ($absensi) {
            $detail_absensi = AbsensiDetail::where('kode_absensi', $absensi->kode_absensi)
                ->where('pegawai_id', session('id'))
                ->get();
        }
        
        $riwayat_absensi = AbsensiDetail::where('pegawai_id', session('id'))
                                    ->get();

        return view('pegawai.absensi.index', [
            'judul_halaman' => 'Absensi',
            'judul_sidebar' => 'Dashboard',
            'menu' => [
                'tab' => 'home',
                'page' => 'absensi'
            ],
            'plugins' => '
                <link rel="stylesheet" href="' . url('') . '/assets/template/presensi-abdul/vendor/datatables/dataTables.bs4.css" />
                <link rel="stylesheet" href="' . url('') . '/assets/template/presensi-abdul/vendor/datatables/dataTables.bs4-custom.css" />
                <link href="' . url('') . '/assets/template/presensi-abdul/vendor/datatables/buttons.bs.css" rel="stylesheet" />
                <script src="' . url('') . '/assets/template/presensi-abdul/vendor/datatables/dataTables.min.js"></script>
                <script src="' . url('') . '/assets/template/presensi-abdul/vendor/datatables/dataTables.bootstrap.min.js"></script>
                <script src="' . url('') . '/assets/template/presensi-abdul/vendor/datatables/custom/custom-datatables.js"></script>
                <script src="' . url('') . '/assets/template/presensi-abdul/vendor/datatables/buttons.min.js"></script>
                <script src="' . url('') . '/assets/template/presensi-abdul/vendor/datatables/jszip.min.js"></script>
                <script src="' . url('') . '/assets/template/presensi-abdul/vendor/datatables/pdfmake.min.js"></script>
                <script src="' . url('') . '/assets/template/presensi-abdul/vendor/datatables/vfs_fonts.js"></script>
                <script src="' . url('') . '/assets/template/presensi-abdul/vendor/datatables/html5.min.js"></script>
                <script src="' . url('') . '/assets/template/presensi-abdul/vendor/datatables/buttons.print.min.js"></script>	
            ',
            'pegawai' => Pegawai::firstWhere('id', session('id')),
            'absensi' => $absensi,
            'riwayat_absensi' => $riwayat_absensi,
            'detail_absen' => $detail_absensi
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function show(Absensi $absensi)
    {
        $detail_absensi = AbsensiDetail::where('kode_absensi', $absensi->kode_absensi)
                                            ->where('pegawai_id', session('id'))
                                            ->first();
                                        
        return view('pegawai.absensi.show', [
            'judul_halaman' => 'Detail Absen',
            'judul_sidebar' => 'Dashboard',
            'menu' => [
                'tab' => 'home',
                'page' => 'absensi'
            ],
            'plugins' => '
                <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
            ',
            'pegawai' => Pegawai::firstWhere('id', session('id')),
            'absensi' => $absensi,
            'detail_absen' => $detail_absensi,
            'pengaturan' => Settings::first()
        ]);
    }
    
    public function izin(Absensi $absensi)
    {
        $detail_absensi = AbsensiDetail::where('kode_absensi', $absensi->kode_absensi)
                                            ->where('pegawai_id', session('id'))
                                            ->first();
                                        
        return view('pegawai.absensi.izin', [
            'judul_halaman' => 'Izin Absen',
            'judul_sidebar' => 'Dashboard',
            'menu' => [
                'tab' => 'home',
                'page' => 'absensi'
            ],
            'plugins' => '
                <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
            ',
            'pegawai' => Pegawai::firstWhere('id', session('id')),
            'absensi' => $absensi,
            'detail_absensi' => $detail_absensi,
            'pengaturan' => Settings::first()
        ]);
    }
    public function _izin(Request $request)
    {
        $absensi = Absensi::firstWhere('kode_absensi', $request->kode_absensi);
        
        $file_izin = str_replace('assets/img/pegawai/', '', $request->file('bukti_izin')->store('assets/img/pegawai'));
        $data_izin = [
            'izin' => 1,
            'status_izin' => 0,
            'alasan' => $request->alasan,
            'bukti_izin' => $file_izin
        ];

        AbsensiDetail::where('kode_absensi', $request->kode_absensi)
                        ->where('pegawai_id', session('id'))
                        ->update($data_izin);

        $jumlah_izin = ($absensi->jumlah_izin + 1);
        $jumlah_pegawai = ($absensi->total + 1);

        $data_absensi = [
            'jumlah_izin' => $jumlah_izin,
            'total' => $jumlah_pegawai
        ];

        Absensi::where('kode_absensi', $request->kode_absensi)
                ->update($data_absensi);

        return redirect('/pegawai/izin_absensi/' . $request->kode_absensi)->with('pesan', "
            <script>
                Swal.fire(
                    'Berhasil!',
                    'Permintaan Izin Dikirim!',
                    'success'
                )
            </script>
        ");
    }
    public function download_izin($file)
    {
        return Storage::download('assets/img/pegawai/' . $file);
        // return Storage::download('assets/files/' . $file);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function edit(Absensi $absensi, Request $request)
    {
        if (!$request->get('detail_id')) return redirect()->back();
        $detail_absensi = AbsensiDetail::where('kode_absensi', $absensi->kode_absensi)
            ->where('id', $request->get('detail_id'))
            ->where('pegawai_id', session('id'))
            ->first();
                                        
        return view('pegawai.absensi.create', [
            'judul_halaman' => 'Isi Absen',
            'judul_sidebar' => 'Dashboard',
            'menu' => [
                'tab' => 'home',
                'page' => 'absensi'
            ],
            'plugins' => '
                <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
            ',
            'pegawai' => Pegawai::firstWhere('id', session('id')),
            'absensi' => $detail_absensi,
            'pengaturan' => Settings::first()
        ]);
    }
    public function absensi_masuk(Request $request)
    {
        $kode_absensi = $request->kode_absensi;
        $absensi = Absensi::firstWhere('kode_absensi', $request->kode_absensi);
        $detail = AbsensiDetail::findOrFail($request->absensi_detail_id);

        $pengaturan_absen = Settings::first();
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $image_tag = $request->image_tag;
        $waktu_absen = date('H:i', time());

        // $waktu_absen = '05:30'; // Pagi
        $waktu_absen = '06:30'; // Pagi - Terlambat
        // $waktu_absen = '08:45'; // Siang
        // $waktu_absen = '10:00'; // Siang - Terlambat
        // $waktu_absen = '13:30'; // Malam
        // $waktu_absen = '14:30'; // Malam - Terlambat

        if ($kode_absensi == null || $latitude == null || $longitude == null || $image_tag == null) {
            return redirect()->back()->with('jarak', '
                <div class="alert alert-danger" role="alert">
                    Semua data harus dilengkapi. pastikan izin lokasi sudah di aktifkan
                </div>
            ');
        }

        function distance($lat1, $lon1, $lat2, $lon2, $unit)
        {
            if (($lat1 == $lat2) && ($lon1 == $lon2)) {
                return 0;
            } else {
                $theta = $lon1 - $lon2;
                $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
                $dist = acos($dist);
                $dist = rad2deg($dist);
                $miles = $dist * 60 * 1.1515;
                $unit = strtoupper($unit);

                if ($unit == "K") {
                    return ($miles * 1.609344);
                } else if ($unit == "N") {
                    return ($miles * 0.8684);
                } else {
                    return $miles;
                }
            }
        }
        $jarak_belum_bulat =  (distance($pengaturan_absen->latitude, $pengaturan_absen->longitude, $latitude, $longitude, "K") * 1000);
        $jarak = ceil($jarak_belum_bulat);

        if ($pengaturan_absen->batas_jarak < $jarak) {

            return redirect()->back()->with('jarak', '
                <div class="alert alert-danger" role="alert">
                    Jarak Kamu dari lokasi kantor adalah <strong>' . $jarak . '</strong> Meter, melebihi aturan batas jarak. Batas jarak yg di tetapkan adalah <strong>' . $pengaturan_absen->batas_jarak . '</strong> Meter
                </div>
            ');
        }

        // echo "Jarak Saya dengan Kantor adalah $jarak M, Batas Jarak yg di tetapkan adalah $pengaturan_absen->batas_jarak M";

        // CARI JAM KERJA
        $jam_kerja = $this->cariJamKerja($waktu_absen);
        
        if ($jam_kerja === false || !$jam_kerja->id) {
            return redirect()->back()->with('jarak', '
                <div class="alert alert-danger" role="alert">
                    Jam kerja tidak ditemukan
                </div>
            ');
        }

        // CEK APAKAH DIA TERLAMBAT
        if (strtotime($waktu_absen) > strtotime($jam_kerja->jam_masuk)) {
            $terlambat = 1; // 1 Berarti Telambat
        } else {
            $terlambat = 0; // 0 Berarti tidak terlambat
        }

        //UPLOAD-GAMBAR
        $img = str_replace('data:image/png;base64,', '', $image_tag);
        $img = base64_decode($img, true);
        $filename = Str::random(15) . '.png';
        file_put_contents('assets/img/pegawai/' . $filename, $img);
        
        $data_absensi_detail = [
            'absen_masuk' => time(),
            'status_masuk' => $terlambat,
            'latitude_masuk' => $latitude,
            'longitude_masuk' => $longitude,
            'bukti_masuk'=> $filename,
            'jam_kerja_id' => $jam_kerja->id
        ];
        AbsensiDetail::where('kode_absensi', $kode_absensi)
            ->where('pegawai_id', session('id'))
            ->where('id', $request->absensi_detail_id)
            ->update($data_absensi_detail);

        $jumlah_masuk = ($absensi->jumlah_pegawai_masuk + 1);
        $jumlah_pegawai = ($absensi->total + 1);

        $data_absensi = [
            'jumlah_pegawai_masuk' => $jumlah_masuk,
            'total' => $jumlah_pegawai
        ];

        Absensi::where('kode_absensi', $kode_absensi)
            ->update($data_absensi);

        return redirect('/pegawai/absensi')->with('jarak', "
            <script>
                Swal.fire(
                    'Berhasil!',
                    'Absen Masuk Berhasil!',
                    'success'
                )
            </script>
        ");
    }
    public function absensi_pulang(Request $request)
    {
        // dd($request->all());
        $kode_absensi = $request->kode_absensi;
        $absensi = Absensi::firstWhere('kode_absensi', $request->kode_absensi);
        $detail = AbsensiDetail::findOrFail($request->absensi_detail_id);

        $pengaturan_absen = Settings::first();
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $image_tag = $request->image_tag;
        $waktu_absen = date('H:i', time());

        if ($kode_absensi == null || $latitude == null || $longitude == null || $image_tag == null) {
            return redirect()->back()->with('jarak', '
                <div class="alert alert-danger" role="alert">
                    Semua data harus dilengkapi. pastikan izin lokasi sudah di aktifkan
                </div>
            ');
        }

        function distance($lat1, $lon1, $lat2, $lon2, $unit)
        {
            if (($lat1 == $lat2) && ($lon1 == $lon2)) {
                return 0;
            } else {
                $theta = $lon1 - $lon2;
                $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
                $dist = acos($dist);
                $dist = rad2deg($dist);
                $miles = $dist * 60 * 1.1515;
                $unit = strtoupper($unit);

                if ($unit == "K") {
                    return ($miles * 1.609344);
                } else if ($unit == "N") {
                    return ($miles * 0.8684);
                } else {
                    return $miles;
                }
            }
        }
        $jarak_belum_bulat =  (distance($pengaturan_absen->latitude, $pengaturan_absen->longitude, $latitude, $longitude, "K") * 1000);
        $jarak = ceil($jarak_belum_bulat);

        if ($pengaturan_absen->batas_jarak < $jarak) {

            return redirect()->back()->with('jarak', '
                <div class="alert alert-danger" role="alert">
                    Jarak Kamu dari lokasi kantor adalah <strong>' . $jarak . '</strong> Meter, melebihi aturan batas jarak. Batas jarak yg di tetapkan adalah <strong>' . $pengaturan_absen->batas_jarak . '</strong> Meter
                </div>
            ');
        }

        // CEK APAKAH DIA Absen sebelum saatnya
        if (strtotime($waktu_absen) < strtotime($detail->jam_kerja->jam_keluar)) {
            // dd(' Belum saatnya absen pulang');
            return redirect()->back()->with('jarak', '
                <div class="alert alert-danger" role="alert">
                    Belum saatnya absen pulang ('. $detail->jam_kerja->jam_keluar .')
                </div>
            ');
        }

        //UPLOAD-GAMBAR
        $img = str_replace('data:image/png;base64,', '', $image_tag);
        $img = base64_decode($img, true);
        $filename = Str::random(15) . '.png';
        file_put_contents('assets/img/pegawai/' . $filename, $img);
        
        $data_absensi_detail = [
            'absen_pulang' => time(),
            'latitude_pulang' => $latitude,
            'longitude_pulang' => $longitude,
            'bukti_pulang'=> $filename,
            'durasi' => $this->hitungDurasiMenit(date('H:i',$detail->absen_masuk), $waktu_absen)
        ];
        
        AbsensiDetail::where('kode_absensi', $kode_absensi)
            ->where('pegawai_id', session('id'))
            ->where('id', $request->absensi_detail_id)
            ->update($data_absensi_detail);

        $jumlah_keluar = ($absensi->jumlah_pegawai_pulang + 1);
        $data_absensi = [
            'jumlah_pegawai_pulang'=> $jumlah_keluar
        ];
        Absensi::where('kode_absensi', $kode_absensi)
                ->update($data_absensi);
                
        return redirect('/pegawai/absensi')->with('jarak', "
            <script>
                Swal.fire(
                    'Berhasil!',
                    'Absen Pulang Berhasil!',
                    'success'
                )
            </script>
        ");

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Absensi $absensi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Absensi $absensi)
    {
        //
    }

    function hitungDurasiMenit($jam_masuk, $jam_keluar) {
        $jamMasuk = DateTime::createFromFormat('H:i', $jam_masuk);
        $jamKeluar = DateTime::createFromFormat('H:i', $jam_keluar);
    
        $durasi = $jamKeluar->diff($jamMasuk);
        $durasiMenit = $durasi->h * 60 + $durasi->i; // Konversi jam ke menit
    
        return $durasiMenit;
    }

    function cariJamKerja($jamMasuk) {
        $data = JamKerja::get();
        $jamMasukInput = DateTime::createFromFormat('H:i', $jamMasuk);
        
        foreach ($data as $shift) {
            $jamMasukShift = DateTime::createFromFormat('H:i', $shift->jam_masuk);
            $jamMasukShiftSebelumnya = clone $jamMasukShift->modify('-1 hours');
            $jamMasukShiftBerikutnya = clone $jamMasukShift->modify('+2 hours');
            
            if ($jamMasukInput >= $jamMasukShiftSebelumnya && $jamMasukInput <= $jamMasukShiftBerikutnya) {
                return $shift;
            }
        }
    
        return false;
    }
}
