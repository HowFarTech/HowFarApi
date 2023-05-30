<?php

use App\Http\Controllers\StatusController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


// AUTHENTICATED ROUTES
Route::middleware('auth:sanctum')->group(function () {
    // index,store,show and delete routes for user status
    Route::apiResource('/status', StatusController::class);
    // show user profile
    Route::get('/users', [UserController::class, 'index']);
});

// NORMAL ROUTES
Route::group([], function () {
    // store user data to database
    Route::post('/user', [UserController::class, 'store']);
});
