<?php

namespace App\Http\Controllers;

use App\Models\RecetteVendeurs;
use Illuminate\Http\Request;

class RecetteVendeursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response()->json(
            RecetteVendeurs::create([
                'vd_id' => $request->vd_id,
                'rc_date' => now(),
                'rc_montant' => $request->rc_montant
            ])
        );
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
