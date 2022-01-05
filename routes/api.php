<?php

use App\Http\Controllers\AuthController;
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
    Route::apiResources([
        'vendeurs' => VendeurController::class
    ]);

    Route::post('/logout', [AuthController::class, 'logout']);
});