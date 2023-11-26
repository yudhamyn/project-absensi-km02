<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\JamKerja;
use App\Models\JamkerjaPegawai;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminJamkerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $jam_kerja_id = $request->get('jam_kerja_id');
        $object_jam_kerja = false;
        $data_jam_kerja = [];

        if($jam_kerja_id) {
            $object_jam_kerja = JamKerja::find($jam_kerja_id);
            $data_jam_kerja = DB::select("
                select P.id, P.nip, P.nama, case when JP.status is null then false else JP.status end as status
                from pegawai P
                left join jamkerja_pegawais JP on JP.pegawai_id = P.id and JP.jam_kerja_id = $jam_kerja_id; 
            ");
        }

        // dd($object_jam_kerja);

        return view('admin.jamkerja.index', [
            'judul_halaman' => 'Data Jam Kerja',
            'judul_sidebar' => 'Master Data',
            'menu' => [
                'tab' => 'master',
                'page' => 'jamkerja'
            ],
            'plugins' => '
                <link rel="stylesheet" href="' . url('') . '/assets/template/presensi-abdul/vendor/datatables/dataTables.bs4.css" />
                <link rel="stylesheet" href="' . url('') . '/assets/template/presensi-abdul/vendor/datatables/dataTables.bs4-custom.css" />
                <link href="' . url('') . '/assets/template/presensi-abdul/vendor/datatables/buttons.bs.css" rel="stylesheet" />
                <script src="' . url('') . '/assets/template/presensi-abdul/vendor/datatables/dataTables.min.js"></script>
                <script src="' . url('') . '/assets/template/presensi-abdul/vendor/datatables/dataTables.bootstrap.min.js"></script>
                <script src="' . url('') . '/assets/template/presensi-abdul/vendor/datatables/custom/custom-datatables.js"></script>
            ',
            'admin' => Admin::firstWhere('id', session('id')),
            'jamkerja' => JamKerja::all(),
            'object_jam_kerja' => $object_jam_kerja,
            'data_jam_kerja' => $data_jam_kerja
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.jamkerja.create', [
            'judul_halaman' => 'Tambah Jam Kerja',
            'judul_sidebar' => 'Master Data',
            'menu' => [
                'tab' => 'master',
                'page' => 'jamkerja'
            ],
            'plugins' => '
                
            ',
            'admin' => Admin::firstWhere('id', session('id')),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'nama' => $request->nama,
            'kode' => $request->kode,
            'jam_masuk' => $request->jam_masuk,
            'jam_keluar' => $request->jam_keluar,
        ];

        JamKerja::insert($data);
        return redirect('/admin/jamkerja')->with('pesan', "
            <script>
                Swal.fire(
                    'Sukses!',
                    'Data Disimpan!',
                    'success'
                )
            </script>
        ");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JamKerja  $jamkerja
     * @return \Illuminate\Http\Response
     */
    public function show(JamKerja $jamkerja)
    {
        //
    }
    public function edit_jamkerja(Request $request)
    {
        $jamkerja =  JamKerja::firstWhere('id', $request->id_jamkerja);
        return json_encode($jamkerja);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JamKerja  $jamkerja
     * @return \Illuminate\Http\Response
     */
    public function edit(JamKerja $jamkerja)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JamKerja  $jamkerja
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JamKerja $jamkerja)
    {
        JamKerja::where('id', $request->id)
            ->update([
                'nama' => $request->nama,
                'kode' => $request->kode,
                'jam_masuk' => $request->jam_masuk,
                'jam_keluar' => $request->jam_keluar,
            ]);

        return redirect('/admin/jamkerja')->with('pesan', "
            <script>
                Swal.fire(
                    'Sukses!',
                    'Data di ubah!',
                    'success'
                )
            </script>
        ");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JamKerja  $jamkerja
     * @return \Illuminate\Http\Response
     */
    public function destroy(JamKerja $jamkerja)
    {
        JamKerja::destroy($jamkerja->id);
        return redirect('/admin/jamkerja')->with('pesan', "
            <script>
                Swal.fire(
                    'Sukses!',
                    'Data di hapus!',
                    'success'
                )
            </script>
        ");
    }

    public function pegawai (Request $request) {
        $check = JamkerjaPegawai::where([
            'jam_kerja_id' => $request->jam_kerja_id,
            'pegawai_id' => $request->pegawai_id,
        ])->first();

        if($check) {
            $check->update([
                'status' => $request->status === 'true' ? 1 : 0
            ]);
        } else {
            JamkerjaPegawai::create([
                'jam_kerja_id' => $request->jam_kerja_id,
                'pegawai_id' => $request->pegawai_id,
                'status' => $request->status === 'true' ? 1 : 0
            ]);
        }

        return response()->json([
            'status' => 'success'
        ], 200);
    }
}
