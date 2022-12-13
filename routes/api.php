<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorksController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobsController;

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

Route::post('/auth/register', [AuthController::class, 'register']);

Route::post('/auth/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::resource('/works', WorksController::class, [
        'only' => ['index', 'store', 'show', 'update', 'destroy']
    ]);

    Route::resource('/jobs', JobsController::class, [
        'only' => ['index', 'store', 'show', 'update', 'destroy']
    ]);

    Route::post('/auth/logout', [AuthController::class, 'logout']);
});
