<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vendeur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VendeurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(
            Vendeur::all()
        );
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
            Vendeur::create([
                'vd_name' => $request->vd_name,
                'salaire' => $request->salaire
            ])
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(
            Vendeur::find($id)
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find(Auth::id());

        //Creating the trigger which store vendeur->salaire update event
        DB::unprepared(
            "DROP TRIGGER IF EXISTS before_vendeurs_update;
             CREATE TRIGGER before_vendeurs_update BEFORE UPDATE ON vendeurs
             FOR EACH ROW
             INSERT INTO audit_vendeurs (quand,qui,quoi,ancien_salaire,nouv_salaire) 
                VALUES (NOW(), '$user->name', CONCAT('Changement de salaire: ' , OLD.vd_name), OLD.salaire, NEW.salaire)"
        );

        $vendeur = Vendeur::find($id);
        $vendeur->update($request->all());
        return response()->json(
            $vendeur
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vendeur = Vendeur::find($id);
        $vendeur->delete();
        return response()->json(
            $vendeur
        );
    }
    
}
