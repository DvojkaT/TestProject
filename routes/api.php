<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\UserController;

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

Route::post('/auth/register', [UserController::class, 'store']);

Route::post('/auth/login', [UserController::class, 'authenticate']);

Route::post('/auth/restore', [UserController::class, 'restorePassword']);

Route::post('/auth/restore/confirm', [UserController::class, 'restoreConfirmPassword']);

Route::get('/user', [UserController::class, 'showUser'])->middleware('auth:api');
Route::post('/user', [UserController::class, 'editUser'])->middleware('auth:api');

//Route::get('/workers/{user}', [User])
