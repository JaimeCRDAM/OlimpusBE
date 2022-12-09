<?php

use App\Http\Controllers\Api\v1\GodController;
use App\Http\Controllers\Api\v1\HumanController;
use App\Http\Controllers\AuthHumanController;
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


Route::apiResource("gods", GodController::class);

Route::apiResource("humans", HumanController::class);

