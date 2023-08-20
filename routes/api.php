<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\entrepriseController;
use App\Http\Controllers\liste_entreprise_controller;
use App\Http\Controllers\formulaireController;
use App\Http\Controllers\userController;
use App\Http\Controllers\typeEntrepriseController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */


Route::post('submitEntreprise',[ entrepriseController::class,'store']);
Route::post('createList',[ liste_entreprise_controller::class,'store']);
Route::post('searchFilter',[ entrepriseController::class,'filter']);
Route::post('submitFormulaire',[ formulaireController::class,'store']);
Route::post('getFormulaireList',[ entrepriseController::class,'showByList']);
Route::post('registerUser',[ userController::class,'store']);
Route::post('login',[ userController::class,'authenticate']);
Route::post('updateUser',[ userController::class,'updateUser']);
Route::get('getCountInitValueByMonth',[ formulaireController::class,'getCountInitValueByMonth']);
Route::get('logout',[ userController::class,'logout']);
Route::get('getCurrentUserRole',[ userController::class,'getCurrentUserRole']);
Route::get('getAllTypesEntreprise',[ typeEntrepriseController::class,'getAllTypes']);
Route::get('getCurrentUser',[ userController::class,'getCurrentUser']);
Route::get('isAuthenticated',[ userController::class,'isAuthenticated']);
Route::get('getAllEntreprise',[ entrepriseController::class,'showAll']);
Route::get('getAllListEntreprise',[ liste_entreprise_controller::class,'showAll']);
Route::get('getAllFormulaire',[ formulaireController::class,'showAll']);

