<?php


use App\Domain\Enums\UserRoleEnum;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PositionController;
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

Route::get('/workers/{user}', [UserController::class, 'showWorker'])->middleware(['auth:api', 'role:' . UserRoleEnum::ADMIN . ',' . UserRoleEnum::WORKER]);

Route::get('/workers', [UserController::class, 'listWorkers'])->middleware(['auth:api', 'role:' . UserRoleEnum::ADMIN . ',' . UserRoleEnum::WORKER]);


Route::get('/departments', [DepartmentController::class, 'listDepartments'])->middleware('auth:api');

Route::get('/departments/select', [DepartmentController::class,'selectDepartments'])->middleware('auth:api');


Route::get('/positions/select', [PositionController::class, 'selectPositions']);
