<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    // Disable the model timestamps
    public $timestamps = false;
    // not allowed manual input field
    protected $guarded = ['id'];
}
