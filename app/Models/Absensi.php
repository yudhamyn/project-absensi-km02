<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    // choose table
    public $table = 'absensi';
    // Disable the model timestamps
    public $timestamps = false;
    // not allowed manual input field
    protected $guarded = ['id'];
    use HasFactory;

    // DEFAULT KEY DI UBAH JADI KODE BUKAN ID LAGI
    public function getRouteKeyName()
    {
        return 'kode_absensi';
    }
}
