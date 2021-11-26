<?php

use Illuminate\Http\Request;
use App\Http\Controllers\TestController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::get('/jogos',[TestController::class, 'index']);
Route::get('/jogos/{id}',[TestController::class, 'show']);
Route::post('/jogos',[TestController::class, 'store']);
Route::put('/jogos/{id}',[TestController::class, 'update']);
Route::delete('/jogos/{id}',[TestController::class, 'destroy']);
