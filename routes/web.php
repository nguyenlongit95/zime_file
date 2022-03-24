<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', [\App\Http\Controllers\admin\UserController::class, 'index']);

Route::get('/admin/login', [\App\Http\Controllers\Auth\AuthController::class, 'adminLogin']);

Route::post('/admin/login', [\App\Http\Controllers\Auth\AuthController::class, 'process_adminLogin']);

Route::get('/login', [\App\Http\Controllers\Auth\AuthController::class, 'login_form']);

Route::post('/login', [\App\Http\Controllers\Auth\AuthController::class, 'process_login']);

Route::get('/signup', [\App\Http\Controllers\Auth\AuthController::class, 'signup_form']);

Route::post('/signup', [\App\Http\Controllers\Auth\AuthController::class, 'process_signup']);

Route::group(["prefix" => "admin"], function () {
    Route::get('/dashboard', [\App\Http\Controllers\admin\DashboardController::class, 'dashboard']);

    Route::group(["prefix" => "packages"], function () {
        Route::get('/', [\App\Http\Controllers\admin\PackageController::class, 'index']);
        Route::get('/add', [\App\Http\Controllers\admin\PackageController::class, 'createForm']);
        Route::post('/store', [\App\Http\Controllers\admin\PackageController::class, 'store']);
        Route::get('/{id}/edit',[\App\Http\Controllers\admin\PackageController::class, 'editForm']);
        Route::post('/{id}/update',[\App\Http\Controllers\admin\PackageController::class, 'update']);
    });
});
