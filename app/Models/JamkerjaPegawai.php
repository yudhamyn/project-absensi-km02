<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JamkerjaPegawai extends Model
{
    use HasFactory;

    protected $fillable = [
        'jam_kerja_id',
        'pegawai_id',
        'status',
    ];
}
