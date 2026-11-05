<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CasinoController;

Route::get('/', function () { return view('home'); })->name('home');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/panel', function () { return view('panel-usuario'); })->name('panel');
    
    Route::get('/casino', [CasinoController::class, 'index'])->middleware('age')->name('casino');
    Route::post('/casino/update-balance', [CasinoController::class, 'updateBalance'])->middleware('age')->name('casino.update');

    Route::get('/admin', function () { return view('panel-admin'); })->middleware('admin')->name('admin');
});