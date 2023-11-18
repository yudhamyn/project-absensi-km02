<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'judul_halaman' => 'Dashboard Admin',
            'judul_sidebar' => 'Dashboard',
            'menu' => [
                'tab' => 'home',
                'page' => 'dashboard'
            ],
            'plugins' => '',
            'admin' => Admin::firstWhere('id', session('id')),
        ]);
    }

    public function profile()
    {
        return view('admin.profile', [
            'judul_halaman' => 'Profile Admin',
            'judul_sidebar' => 'Dashboard',
            'menu' => [
                'tab' => 'home',
                'page' => 'dashboard'
            ],
            'plugins' => '',
            'admin' => Admin::firstWhere('id', session('id')),
        ]);
    }

    public function profile_(Request $request)
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

        Admin::where('id', session('id'))
                ->update($data);

        return redirect('/admin/profile')->with('pesan', "
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
        $admin = Admin::firstWhere('id', session('id'));

        $new_password = $request->new_password;
        $current_password = $request->current_password;

        if ($admin->password != $current_password) {
            return redirect('/admin/profile')->with('pesan', "
                <script>
                    Swal.fire(
                        'Error!',
                        'Current Password Salah!',
                        'error'
                    )
                </script>
            ");
        }

        Admin::where('id', session('id'))
                ->update(['password' => $new_password]);

        return redirect('/admin/profile')->with('pesan', "
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
