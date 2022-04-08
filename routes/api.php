<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RideController;
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

Route::post('/register', [AuthController::class,'register']);
Route::get('/ride-count/{id}', [RideController::class,'getRideCount']);
Route::get('/waitlist-count/{id}', [RideController::class,'getWaitlistCount']);
