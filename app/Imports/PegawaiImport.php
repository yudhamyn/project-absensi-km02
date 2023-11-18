<?php

namespace App\Imports;

use App\Models\Pegawai;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PegawaiImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Pegawai([
            'nip'     => $row['nip'],
            'nama'    => $row['nama'],
            'jenis_kelamin'    => $row['jenis_kelamin'],
            'jabatan_id'    => $row['jabatan_id'],
            'email'    => $row['email'],
            'password' => $row['nip'],
            'gambar' => 'default.jpg',
            'is_active' => 1,
            'role' => 2
        ]);
    }
}
