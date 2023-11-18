<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    // choose table
    public $table = 'jabatan';
    // Disable the model timestamps
    public $timestamps = false;
    // not allowed manual input field
    protected $guarded = ['id'];
}
