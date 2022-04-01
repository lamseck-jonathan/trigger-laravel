<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Vendeur;

class RecetteVendeurs extends Model
{
    use HasFactory;

    protected $fillable = [
        'vd_id',
        'rc_date',
        'rc_montant' 
    ];
    
    public function vendeur()
    {
        return $this->belongsTo(Vendeur::class);
    }
}
