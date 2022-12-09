<?php


use App\Http\Controllers\Api\v1\GodController;
use App\Http\Controllers\Api\v1\HumanController;
use App\Http\Controllers\AuthGodController;
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


Route::controller(AuthGodController::class)->group(function () {
    /////
    Route::post('gods/login', 'login');
    Route::post('gods/logout', 'logout');
    Route::post('gods/refresh', 'refresh');
});

Route::controller(AuthHumanController::class)->group(function () {


    Route::post('humans/login', 'login');
    Route::post('humans/register', 'register');
    Route::post('humans/logout', 'logout');
    Route::post('humans/refresh', 'refresh');
    Route::post('humans/avatar', 'setAvatar');
    Route::post('humans/getavatar', 'getAvatar');
});







