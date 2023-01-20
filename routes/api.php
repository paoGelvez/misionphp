<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DeportesController;
use App\Http\Controllers\EntrenadoresController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([


    'middleware' => 'auth:api',
    'prefix' => 'auth'


], function () {


    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('me', [AuthController::class,'me']);
    
    
});




Route::group([
    'prefix' => 'regist'
], function(){


    Route::post('register',[AuthController::class,'register']);
    Route::post('login', [AuthController::class,'login']);


});

Route::group([
    'prefix' => 'deportes'
],function(){
    Route::post('registerSports',[DeportesController::class,'registerSports']);
});





