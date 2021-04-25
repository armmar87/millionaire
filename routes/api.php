<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\PlayController;
use \App\Http\Controllers\QuestionController;

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


Route::get('start-play', [PlayController::class, 'index']);
Route::get('score', [PlayController::class, 'score']);
Route::post('add-answer', [PlayController::class, 'addAnswer']);

//Route::resource('questions', QuestionController::class);

//Route::group(['middleware' => 'auth:sanctum'], function (){
//
//});


