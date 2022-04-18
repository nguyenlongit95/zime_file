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

Route::post('/admin/login', [\App\Http\Controllers\Auth\AuthController::class, 'processAdminLogin']);

Route::get('/login', [\App\Http\Controllers\Auth\AuthController::class, 'loginForm']);

Route::post('/login', [\App\Http\Controllers\Auth\AuthController::class, 'processLogin']);

Route::get('/signup', [\App\Http\Controllers\Auth\AuthController::class, 'signupForm']);

Route::post('/signup', [\App\Http\Controllers\Auth\AuthController::class, 'processSignup']);

Route::get('/package', [\App\Http\Controllers\user\PackageController::class, 'selectPackage']);

Route::group(["prefix" => "admin"], function () {
    Route::get('/dashboard', [\App\Http\Controllers\admin\DashboardController::class, 'dashboard']);

    Route::group(["prefix" => "packages"], function () {
        Route::get('/', [\App\Http\Controllers\admin\PackageController::class, 'index']);
        Route::get('/add', [\App\Http\Controllers\admin\PackageController::class, 'createForm']);
        Route::post('/store', [\App\Http\Controllers\admin\PackageController::class, 'store']);
        Route::get('/{id}/edit',[\App\Http\Controllers\admin\PackageController::class, 'editForm']);
        Route::post('/{id}/update',[\App\Http\Controllers\admin\PackageController::class, 'update']);
        Route::delete('/{id}/delete', [\App\Http\Controllers\admin\PackageController::class, 'destroy']);
    });

    Route::group(["prefix" => "users"], function () {
       Route::get('/', [\App\Http\Controllers\admin\UserController::class, 'index']);
       Route::get('/{id}/view', [\App\Http\Controllers\admin\UserController::class, 'view']);
       Route::post('/{id}/update', [\App\Http\Controllers\admin\UserController::class, 'update']);
       Route::post('/delete', [\App\Http\Controllers\admin\UserController::class, 'destroy']);
    });

    Route::get('/file-detail', [\App\Http\Controllers\admin\FileController::class, 'view']);
});
