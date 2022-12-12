<?php

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

Route::middleware('auth.api')->post('/v1/notification/create', \App\Http\Controllers\Api\Auth\Clients\Notifications\CreateController::class . '@create');

Route::post('v1/guest/client/create', \App\Http\Controllers\Api\Guest\Clients\CreateController::class . '@create');
Route::put('v1/guest/client/update', \App\Http\Controllers\Api\Guest\Clients\UpdateController::class . '@update');