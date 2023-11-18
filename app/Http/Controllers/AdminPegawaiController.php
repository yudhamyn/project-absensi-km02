<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Jabatan;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PegawaiImport;

class AdminPegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pegawai.index', [
            'judul_halaman' => 'Data Pegawai',
            'judul_sidebar' => 'Master Data',
            'menu' => [
                'tab' => 'master',
                'page' => 'pegawai'
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
            'pegawai' => Pegawai::all(),
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
        return view('admin.pegawai.create', [
            'judul_halaman' => 'Tambah Pegawai',
            'judul_sidebar' => 'Master Data',
            'menu' => [
                'tab' => 'master',
                'page' => 'pegawai'
            ],
            'plugins' => '
                <link rel="stylesheet" href="' . url('') . '/assets/template/presensi-abdul/vendor/bs-select/bs-select.css" />
                <script src="' . url('') . '/assets/template/presensi-abdul/vendor/bs-select/bs-select.min.js"></script>
                <script src="' . url('') . '/assets/template/presensi-abdul/vendor/bs-select/bs-select-custom.js"></script>
            ',
            'admin' => Admin::firstWhere('id', session('id')),
            'pegawai' => Pegawai::all(),
            'jabatan' => Jabatan::all()
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
        // buat Validasi form
        $rules = [
            'nip' => 'required|max:255|unique:pegawai',
            'nama' => 'required|max:255',
            'jenis_kelamin' => 'required|max:255',
            'jabatan_id' => 'required',
            'email' => 'required|unique:pegawai',
            'gambar' => 'image|file',
        ];

        $validatedData = $request->validate($rules);

        // cek apakah ada gambar yang di upload
        if ($request->file('gambar')) {
            $validatedData['gambar'] = str_replace('assets/img/pegawai/', '', $request->file('gambar')->store('assets/img/pegawai'));
        } else {
            $validatedData['gambar'] = 'default.jpg';
        }
        $validatedData['password'] = $request->nip;
        $validatedData['is_active'] = 1;
        $validatedData['role'] = 2;

        Pegawai::create($validatedData);
        return redirect('/admin/pegawai')->with('pesan', "
            <script>
                Swal.fire(
                    'Sukses!',
                    'Data Disimpan!',
                    'success'
                )
            </script>
        ");
    }
    public function excel_pegawai(Request $request)
    {
        Excel::import(new PegawaiImport, $request->excel);
        return redirect('/admin/pegawai')->with('pesan', "
            <script>
                Swal.fire(
                    'Impor Berhasil!',
                    'Data Disimpan!',
                    'success'
                )
            </script>
        ");
    }
    public function edit_pegawai(Request $request)
    {
        $pegawai =  Pegawai::firstWhere('id', $request->id_pegawai);
        return json_encode($pegawai);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function show(Pegawai $pegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function edit(Pegawai $pegawai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pegawai $pegawai)
    {
        // buat Validasi form
        $rules = [
            'nama' => 'required|max:255',
            'jenis_kelamin' => 'required',
            'jabatan_id' => 'required',
            'email' => 'required',
            'password' => 'required',
            'is_active' => 'required',
        ];

        $validatedData = $request->validate($rules);

        // cek apakah ada gambar yang di upload
        if ($request->file('gambar')) {
            if ($request->gambar_lama != 'default.jpg') {
                Storage::delete('assets/img/pegawai/' . $request->gambar_lama);
            }
            $validatedData['gambar'] = str_replace('assets/img/pegawai/', '', $request->file('gambar')->store('assets/img/pegawai'));
        } else {
            $validatedData['gambar'] = $request->gambar_lama;
        }

        Pegawai::where('id', $request->id)
            ->update($validatedData);
        return redirect('/admin/pegawai')->with('pesan', "
            <script>
                Swal.fire(
                    'Sukses!',
                    'Data diubah!',
                    'success'
                )
            </script>
        ");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pegawai $pegawai)
    {
        Pegawai::destroy($pegawai->id);
        return redirect('/admin/pegawai')->with('pesan', "
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
