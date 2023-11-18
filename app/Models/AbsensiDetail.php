<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiDetail extends Model
{
    // choose table
    public $table = 'absensi_detail';
    // Disable the model timestamps
    public $timestamps = false;
    // not allowed manual input field
    protected $guarded = ['id'];
    use HasFactory;

    protected $with = ['pegawai'];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
    public function absensi()
    {
        return $this->belongsTo(Absensi::class, 'kode_absensi', 'kode_absensi');
    }
}
