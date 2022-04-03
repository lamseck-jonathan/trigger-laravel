<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RecetteJourController;
use App\Http\Controllers\RecetteVendeursController;
use App\Http\Controllers\VendeurController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

//All routes which need that the user must be authenticated
Route::middleware('auth:sanctum')->group(function() {
    // all routes for vendeurs
    Route::apiResources([
        'vendeurs' => VendeurController::class
    ]);

    // all routes for recette_vendeurs
    Route::apiResources([
        'recette/vendeurs' => RecetteVendeursController::class
    ]);

    Route::get('/recettejour',[RecetteJourController::class,'index']);
    Route::post('/recettejour',[RecetteJourController::class,'store']);
    Route::get('/recettejour/{id}',[RecetteJourController::class,'show']);
    Route::put('/recettejour/{id}',[RecetteJourController::class,'update']);
    Route::delete('/recettejour/{id}',[RecetteJourController::class,'destroy']);

    Route::get('/user', [AuthController::class, 'user']);
    Route::delete('/logout', [AuthController::class, 'logout']);
});