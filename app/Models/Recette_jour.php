<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recette_jour extends Model
{
    use HasFactory;

    protected $fillable = [
        "rc_date",
        "rc_montant",
    ];

    public function getRcDateAttribute($rc_date)
    {
        return ucfirst($rc_date);
    }

    public function setRcDateAttribute($value) {
        $this->attributes['rc_date'] = strtolower($value);
    }

}
