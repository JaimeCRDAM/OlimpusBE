<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GodAuthController;
use App\Http\Controllers\HumanAuthController;
use App\Http\Controllers\QuestsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(GodAuthController::class)->group(function () {
    Route::post('/gods/login', 'login');
    Route::post('/gods/logout', 'logout');
    Route::post('/gods/refresh', 'refresh');
    Route::post('/gods/updatepassword', 'updatePassword');
    Route::post('/gods/avatar', 'updateAvatar');
    Route::get("/gods/humans", 'humans');
    Route::get("/gods/quests", 'quests');
    Route::post("/gods/quests", 'assignQuests');
    Route::post('/gods/Human', 'createHuman');

});

Route::controller(QuestsController::class)->group(function () {
    Route::get('quest', 'index');
    Route::post('quest', 'store');
    Route::get('quest/{id}', 'show');
    Route::put('quest/{id}', 'update');
    Route::delete('quest/{id}', 'destroy');
});



Route::controller(HumanAuthController::class)->group(function () {
    Route::post('/humans/login', 'login');
    Route::post('/humans/register', 'register');
    Route::post('/humans/logout', 'logout');
    Route::post('/humans/refresh', 'refresh');
    Route::post('/humans/updatepassword', 'updatePassword');
    Route::post('/humans/avatar', 'updateAvatar');

});
