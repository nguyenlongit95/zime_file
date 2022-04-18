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

Route::post("/getAllPackage", [\App\Http\Controllers\api\PackageController::class, 'getAllPackage']);

Route::post("/checkUserPackage", [\App\Http\Controllers\api\PackageController::class, 'checkUserPackage']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
