<?php

namespace App\Http\Controllers;

use App\Models\Vendeur;
use Illuminate\Http\Request;

class VendeurController extends Controller
{
    public function get() {
        return response()->json(
            Vendeur::all(),
            200
        );
    }

    public function store(Request $request) {
        return response()->json(
            Vendeur::create([
                'vd_name' => $request->vd_name,
                'salaire' => $request->salaire
            ]),
            201
        ); 
    }

}
