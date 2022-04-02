<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use ApiResponser;

    public function register(Request $request) {

        $validation = Validator::make($request->all(),[
            'name' => 'required|unique:users',
            'password' => 'required'|'min:6',
            'isAdmin' => 'boolean'
        ]);

        if ($validation->fails()) {
            return $this->error('Veuillez verifier que vos données remplissent les règles de validation', 400);
        }

        // Hash::make will encrypt the password before saving it in the database
        $user = User::create([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'isAdmin' => $request->isAdmin
        ]);

        // To make the user status logged in
        Auth::login($user);

        return $this->success(
            $user->createToken('Team7-Token')->plainTextToken,
            'Inscription effectuée avec succès'
        );
    }

    public function login(Request $request) {
        $validation = Validator::make($request->all(),[
            'name' => 'required',
            'password' => 'required'
        ]);

        if ($validation->fails()) {
            return $this->error('Veuillez verifier que vos données remplissent les règles de validation', 400);
        }

        //attempt to login, Auth::attempt return true if the credentials are correct
        if (Auth::attempt($request->all())) {
            $user =  User::find(Auth::id());

            return $this->success(
                $user->createToken('Team7-Token')->plainTextToken,
                'Connexion effectuée avec succès'
            );
        }

        //if the credentials are not correct
        return $this->error('Mot de passe ou nom d\'utilisateur éronné', 401);
    }

    public function logout() {
        //revoke all tokens
        $user = User::find(Auth::id());
        $user->tokens()->delete();

        return $this->success([], 'Deconnexion effectuée avec succès, tous les tokens ont été supprimé');
    }

}