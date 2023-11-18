<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.settings.index', [
            'judul_halaman' => 'Pengaturan Absensi',
            'judul_sidebar' => 'Master Data',
            'menu' => [
                'tab' => 'master',
                'page' => 'settings'
            ],
            'plugins' => '
            ',
            'admin' => Admin::firstWhere('id', session('id')),
            'settings' => Settings::first()
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
     * @param  \App\Models\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function show(Settings $settings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function edit(Settings $settings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Settings $settings)
    {
        $latitude_longitude = explode(',', $request->latitude_longitude);
        $data = [
            'jam_masuk' => $request->jam_masuk,
            'jam_keluar' => $request->jam_keluar,
            'latitude' => $latitude_longitude[0],
            'longitude' => trim($latitude_longitude[1], ' '),
            'batas_jarak' => $request->batas_jarak
        ];
        Settings::where('id', $request->id)
            ->update($data);

        return redirect('/admin/settings')->with('pesan', "
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
     * @param  \App\Models\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function destroy(Settings $settings)
    {
        //
    }
}
