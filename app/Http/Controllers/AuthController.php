<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        $admin = Admin::first();
        if ($admin === null) {
            return redirect('/install');
        }

        return view('auth.login');
    }
    public function login(Request $request)
    {
        $admin = Admin::firstWhere('email', $request->email);
        if ($admin) {
            // Password Verification
            if ($admin->password != $request->password) {
                // Redirect Page + Alert
                return redirect('/')->with('pesan', "
                    <script>
                        Swal.fire(
                            'Error!',
                            'Password salah!',
                            'error'
                        )
                    </script>
                ");
            }

            session()->put('id', $admin->id);
            session()->put('role', $admin->role);
            // Redirect Page + Alert
            return redirect('/admin')->with('pesan', "
                <script>
                    Swal.fire(
                        'Sukses!',
                        'login berhasil!',
                        'success'
                    )
                </script>
            ");
        }

        $pegawai = Pegawai::firstWhere('email', $request->email);
        if ($pegawai) {
            // Password Verification
            if ($pegawai->password != $request->password) {
                // Redirect Page + Alert
                return redirect('/')->with('pesan', "
                    <script>
                        Swal.fire(
                            'Error!',
                            'Password salah!',
                            'error'
                        )
                    </script>
                ");
            }

            session()->put('id', $pegawai->id);
            session()->put('role', $pegawai->role);
            // Redirect Page + Alert
            return redirect('/pegawai')->with('pesan', "
                <script>
                    Swal.fire(
                        'Sukses!',
                        'login berhasil!',
                        'success'
                    )
                </script>
            ");
        }

        // Redirect Page + Alert
        return redirect('/')->with('pesan', "
            <script>
                Swal.fire(
                    'Error!',
                    'akun tidak ditemukan!',
                    'error'
                )
            </script>
        ");
    }
    public function install()
    {
        $admin = Admin::first();
        if ($admin !== null) {
            return redirect('/');
        }

        return view('auth.install');
    }
    public function install_(Request $request)
    {
        // Form Validation
        $validate = $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        $validate['gambar'] = 'default.jpg';
        $validate['role'] = 1; // 1 for Admin
        // Save Data to Database
        Admin::create($validate);
        // Redirect Page + Alert
        return redirect('/')->with('pesan', "
            <script>
                Swal.fire(
                    'Sukses!',
                    'Admin Disimpan!',
                    'success'
                )
            </script>
        ");
    }
    public function logout()
    {
        session()->forget('id');
        session()->forget('role');

        return redirect('/');
    }
}
