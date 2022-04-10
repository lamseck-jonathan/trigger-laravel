<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecetteMois extends Model
{
    use HasFactory;

    protected $fillable = [
        "rc_month",
        "rc_year",
        "rc_montant",
    ];

}
