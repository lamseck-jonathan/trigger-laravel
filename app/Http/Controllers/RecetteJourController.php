<?php

namespace App\Http\Controllers;

use App\Models\Recette_jour;
use Illuminate\Http\Request;

class RecetteJourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(Recette_jour::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response(Recette_jour::create([
            "rc_date" => $request->rc_date,
            "rc_montant" => $request->rc_montant
        ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recette_jour  $recette_jour
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response(Recette_jour::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recette_jour  $recette_jour
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $recette = Recette_jour::find($id);
        $recette->update($request->all());
        return response()->json($recette);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recette_jour  $recette_jour
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $recette = Recette_jour::find($id);
        $recette->delete();
        return response()->json(
            $recette
        );
    }
}
