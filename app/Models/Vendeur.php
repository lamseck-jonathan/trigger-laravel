<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendeur extends Model
{
    use HasFactory;

    protected $fillable = [
        'vd_name',
        'salaire' 
    ];

    public function getVdNameAttribute($value) {
        return ucfirst($value);
    }

    public function setVdNameAttribute($value) {
        $this->attributes['vd_name'] = strtolower($value);
    }

}
