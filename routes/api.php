<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\MessageControler;
use Illuminate\Http\Request;
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



Route::group(['controller'=>AuthController::class],function (){

    Route::post('register', 'register');
    Route::post('login',  'login');
    Route::post('logout',  'logout');


});



Route::group(['middleware'=>'auth:api'],function (){

    Route::post('send-message',[MessageControler::class,'sendMessage']);
    Route::post('send-direct-message',[MessageControler::class,'sendDirectMessage']);
});
