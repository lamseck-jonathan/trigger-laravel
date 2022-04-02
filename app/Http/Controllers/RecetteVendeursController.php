<?php

namespace App\Http\Controllers;

use App\Models\RecetteVendeurs;
use App\Models\Vendeur;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RecetteVendeursController extends Controller
{
    use ApiResponser;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recettes_vendeurs = RecetteVendeurs::All();
        return $this->success($recettes_vendeurs, 'Liste de toute les recettes des vendeurs');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'vd_id' => 'required',
            'rc_montant' => 'required'
        ]);

        if($validator->fails()) {
            return $this->error('Données manquants ou invalides', 400);
        }

        if(!Vendeur::find($request->vd_id)) {
            return $this->error('Ce vendeur n\'existe pas dans la base de données', 400);
        }

        $new_recette_vendeurs = RecetteVendeurs::create([
            'vd_id' => $request->vd_id,
            'rc_date' => now(),
            'rc_montant' => $request->rc_montant
        ]);

        return $this->success($new_recette_vendeurs, 'Recette vendeur ajouté avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RecetteVendeurs  $recetteVendeurs
     * @return \Illuminate\Http\Response
     */
    public function show(RecetteVendeurs $recetteVendeurs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RecetteVendeurs  $recetteVendeurs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RecetteVendeurs $recetteVendeurs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RecetteVendeurs  $recetteVendeurs
     * @return \Illuminate\Http\Response
     */
    public function destroy(RecetteVendeurs $recetteVendeurs)
    {
        //
    }
}
