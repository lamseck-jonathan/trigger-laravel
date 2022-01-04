<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Throwable;

class AuthController extends Controller
{
    use ApiResponser;

    public function register(Request $request) {
        
        $validatedData = $request->validate([
            'name' => ['required'],
            'password' => ['required', 'min:6'],
            'isAdmin' => ['boolean']
        ]);   

        //Hash::make will encrypt the password before saving it in the database
        $user = User::create([
            'name' => $validatedData['name'],
            'password' => Hash::make($validatedData['password']),
            'isAdmin' => $validatedData['isAdmin']
        ]);

        //attribute token abilities depending isAdmin value
        if(!$validatedData['isAdmin']) {
            $tokenAbilities = 'isAdmin:false';
        } else {
            $tokenAbilities = 'isAdmin:true';
        }

        //to make the user status logged in
        Auth::login($user);

        return $this->success(
            $user->createToken('Team7-Token', [$tokenAbilities])->plainTextToken,
            'Inscription effectuée avec succès'
        );
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'name' => 'required',
            'password' => 'required|min:6'
        ]);

        //attempt to login, Auth::attempt return true if the credentials are correct
        if (Auth::attempt($credentials)) {
            $user =  User::find(Auth::id());

            //attribute token abilities depending isAdmin value
            if(!$user->isAdmin) {
                $tokenAbilities = 'isAdmin:false';
            } else {
                $tokenAbilities = "isAdmin:true";
            }

            return $this->success(
                $user->createToken('Team7-Token', [$tokenAbilities])->plainTextToken,
                'Connexion effectuée avec succès'
            );
        }

        //if the credentials are not correct
        return $this->error('Mot de passe ou nom d\'utilisateur éronné', 401);
    }

    public function logout() {
        try {
            //revoke all tokens
            $user = User::find(Auth::id());
            $user->tokens()->delete();

        } catch (Throwable $e) {
            return $this->error($e,500);
        }

        return $this->success([], 'Deconnexion effectuée et toout les tokens sont supprimés avec succès');
    }

}