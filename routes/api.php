<?php

use App\Http\Controllers\Api\v1\GodController;
use App\Http\Controllers\Api\v1\HumanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthControllerV2;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource("gods", GodController::class);

Route::apiResource("humans", HumanController::class);

Route::controller(AuthController::class)->group(function () {
    Route::post('humans/login', 'login');
    Route::post('humans/register', 'register');
    Route::post('humans/logout', 'logout');
    Route::post('humans/refresh', 'refresh');
});

