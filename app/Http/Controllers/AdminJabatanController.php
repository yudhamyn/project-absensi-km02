<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Jabatan;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class AdminJabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.jabatan.index', [
            'judul_halaman' => 'Data Jabatan',
            'judul_sidebar' => 'Master Data',
            'menu' => [
                'tab' => 'master',
                'page' => 'jabatan'
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
            'jabatan' => Jabatan::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.jabatan.create', [
            'judul_halaman' => 'Tambah Jabatan',
            'judul_sidebar' => 'Master Data',
            'menu' => [
                'tab' => 'master',
                'page' => 'jabatan'
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
        $nama_jabatan = $request->nama;
        $data_jabatan = [];
        foreach ($nama_jabatan as $jabatan) {
            array_push($data_jabatan, [
                'nama' => $jabatan
            ]);
        }

        Jabatan::insert($data_jabatan);
        return redirect('/admin/jabatan')->with('pesan', "
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
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function show(Jabatan $jabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Jabatan $jabatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jabatan $jabatan)
    {
        Jabatan::where('id', $request->id)
            ->update(['nama' => $request->nama]);

        return redirect('/admin/jabatan')->with('pesan', "
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
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jabatan $jabatan)
    {
        Pegawai::where('jabatan_id', $jabatan->id)
            ->delete();
        Jabatan::destroy($jabatan->id);
        return redirect('/admin/jabatan')->with('pesan', "
            <script>
                Swal.fire(
                    'Sukses!',
                    'Data di hapus!',
                    'success'
                )
            </script>
        ");
    }
}
