<?php

use App\Models\Yap;
use App\Http\Controllers\YapController;
use App\Http\Controllers\Auth\Register;
use App\Http\Controllers\Auth\Logout;
use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/',[YapController::class, 'index']);

Route::middleware('auth')->group(function() {
    Route::post('/yaps', [YapController::class, 'store']);
    Route::get('/yaps/{yap}/edit', [YapController::class, 'edit']);
    Route::put('/yaps/{yap}', [YapController::class, 'update']);
    Route::delete('/yaps/{yap}', [YapController::class, 'destroy']);
});

Route::view('/register', 'auth.register')
    ->middleware('guest')
    ->name('register');
Route::post('/register', Register::class)
    ->middleware('guest');
Route::view('/login', 'auth.login')
    ->middleware('guest')
    ->name('login');
Route::post('/login', Login::class)
    ->middleware('guest');
Route::post('/logout', Logout::class)
    ->middleware('auth');
Route::view('/profile', 'auth.profile')
    ->middleware('auth');
Route::post('/profile', Profile::class)
    ->middleware('auth');
