<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

Route::get('/admin', function () {
    return 'Admin Area';
})->middleware(['auth', 'role:admin']);

Route::get('/login', [LoginController::class, 'show']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LogoutController::class, 'logout']);

Route::get('/', function () {
    return view('welcome');
});
