<?php

namespace App\Http\Controllers;

use App\Exports\AbsenExport;
use App\Models\Absensi;
use App\Models\AbsensiDetail;
use App\Models\Admin;
use App\Models\JamkerjaPegawai;
use App\Models\Pegawai;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class AdminAbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.absensi.index', [
            'judul_halaman' => 'Data Absensi',
            'judul_sidebar' => 'Master Data',
            'menu' => [
                'tab' => 'master',
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
            'admin' => Admin::firstWhere('id', session('id')),
            'absensi' => Absensi::firstWhere('tgl_absen', date('d-M-Y', time())),
            'riwayat_absensi' => Absensi::all()
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
    public function tambah()
    {
        $absensi = Absensi::firstWhere('tgl_absen', date('d-M-Y', time()));
        if ($absensi !== null) {
            return redirect('/admin/absensi')->with('pesan', "
                <script>
                    Swal.fire(
                        'Error!',
                        'Absensi Hari ini sudah pernah dibuat!',
                        'error'
                    )
                </script>
            ");
        }

        $pegawai = Pegawai::all();
        if ($pegawai->count() == 0) {
            return redirect('/admin/absensi')->with('pesan', "
                <script>
                    Swal.fire(
                        'Error!',
                        'Data pegawai belum ada, absensi tidak bisa dibuat!',
                        'error'
                    )
                </script>
            ");
        }

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

        // $jam_kerja_pegawai = JamkerjaPegawai::where('status', 1)->get();
        foreach ($pegawai as $p) {
            array_push($absen_detail, [
                'kode_absensi' => $kode_absen,
                'pegawai_id' => $p->id,
                // 'jam_kerja_id' => $p->jam_kerja_id
            ]);
        }

        Absensi::create($data_absen);
        AbsensiDetail::insert($absen_detail);

        return redirect('/admin/absensi')->with('pesan', "
            <script>
                Swal.fire(
                    'Sukses!',
                    'Absensi hari ini telah dibuat!',
                    'success'
                )
            </script>
        ");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function show(Absensi $absensi)
    {
        return view('admin.absensi.show', [
            'judul_halaman' => 'Detail Absensi',
            'judul_sidebar' => 'Master Data',
            'menu' => [
                'tab' => 'master',
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
            'admin' => Admin::firstWhere('id', session('id')),
            'absensi' => $absensi,
            'absensi_detail' => AbsensiDetail::where('kode_absensi', $absensi->kode_absensi)->get()
        ]);
    }
    public function absen_pegawai($kode_absensi, $pegawai_id)
    {
        $absensi = AbsensiDetail::firstWhere(['kode_absensi' => $kode_absensi, 'pegawai_id' => $pegawai_id]);

        return view('admin.absensi.absensi-pegawai', [
            'judul_halaman' => 'Data Absensi Pegawai',
            'judul_sidebar' => 'Master Data',
            'menu' => [
                'tab' => 'master',
                'page' => 'absensi'
            ],
            'plugins' => '
                
            ',
            'admin' => Admin::firstWhere('id', session('id')),
            'absensi' => $absensi,
            'pengaturan' => Settings::first()
        ]);
    }
    public function izin_pegawai($kode_absensi, $pegawai_id)
    {
        $absensi = AbsensiDetail::firstWhere(['kode_absensi' => $kode_absensi, 'pegawai_id' => $pegawai_id]);

        return view('admin.absensi.izin-pegawai', [
            'judul_halaman' => 'Data Absensi Pegawai',
            'judul_sidebar' => 'Master Data',
            'menu' => [
                'tab' => 'master',
                'page' => 'absensi'
            ],
            'plugins' => '
                
            ',
            'admin' => Admin::firstWhere('id', session('id')),
            'absensi' => $absensi,
            'pengaturan' => Settings::first()
        ]);
    }
    public function izinkan($kode_absensi, $pegawai_id)
    {
        AbsensiDetail::where('kode_absensi', $kode_absensi)
                        ->where('pegawai_id', $pegawai_id)
                        ->update(['status_izin' => 1]);
        return redirect('/admin/izin_pegawai/' . $kode_absensi . '/' . $pegawai_id)->with('pesan', "
            <script>
                Swal.fire(
                    'Berhasil!',
                    'Berhasil Diizinkan!',
                    'success'
                )
            </script>
        ");
    }

    public function ditolak($kode_absensi, $pegawai_id)
    {
        AbsensiDetail::where('kode_absensi', $kode_absensi)
                        ->where('pegawai_id', $pegawai_id)
                        ->update(['status_izin' => 2]);
        return redirect('/admin/izin_pegawai/' . $kode_absensi . '/' . $pegawai_id)->with('pesan', "
            <script>
                Swal.fire(
                    'Berhasil!',
                    'Berhasil Ditolak!',
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
    public function edit(Absensi $absensi)
    {
        //
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
        AbsensiDetail::where('kode_absensi', $absensi->kode_absensi)
            ->delete();
        Absensi::destroy($absensi->id);
        return redirect('/admin/absensi')->with('pesan', "
            <script>
                Swal.fire(
                    'Sukses!',
                    'Data dihapus!',
                    'success'
                )
            </script>
        ");
    }

    public function downloadLaporan(Request $request)
    {
        // dd($request->all());
        return Excel::download(new AbsenExport($request->tgl_awal, $request->tgl_akhir), "Laporan Absen {$request->tgl_awal} - {$request->tgl_akhir}.xlsx");
    }
}