<?php

namespace App\Http\Controllers;

use App\Models\Vendeur;
use Illuminate\Http\Request;

class VendeurController extends Controller
{
    public function findAll() {
        return response()->json(
            Vendeur::all()
        );
    }

    public function findOne($id) {
        return response()->json(
            Vendeur::find($id)
        );
    }

    public function store(Request $request) {
        return response()->json(
            Vendeur::create([
                'vd_name' => $request->vd_name,
                'salaire' => $request->salaire
            ])
        ); 
    }

    public function update($id, Request $request) {
        $vendeur = Vendeur::find($id);
        $vendeur->update($request->all());
        return response()->json(
            $vendeur
        );
    }

    public function delete($id) {
        $vendeur = Vendeur::find($id);
        $vendeur->delete();
        return response()->json(
            $vendeur
        );
    }

}
