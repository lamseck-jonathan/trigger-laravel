<?php

namespace App\Http\Controllers;

use App\Models\Vendeur;
use Illuminate\Http\Request;

class VendeurController extends Controller
{
    public function get() {
        return response()->json(Vendeur::all());
    }
}
