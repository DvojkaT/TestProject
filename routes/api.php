<?php


use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\UserController;
use \App\Http\Controllers\Api\DepartmentController;

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

Route::post('/auth/register', [AuthController::class, 'store']);

Route::post('/auth/login', [AuthController::class, 'authenticate']);

Route::post('/auth/restore', [AuthController::class, 'restorePassword']);

Route::post('/auth/restore/confirm', [AuthController::class, 'restoreConfirmPassword']);


Route::get('/user', [UserController::class, 'showUser'])->middleware('auth:api');

Route::post('/user', [UserController::class, 'editUser'])->middleware('auth:api');

Route::get('/workers/{user}', [UserController::class, 'showWorker'])->middleware('auth:api');

Route::get('/workers', [UserController::class, 'listWorkers'])->middleware('auth:api');


Route::get('/departments', [DepartmentController::class, 'listDepartments'])->middleware('auth:api');
