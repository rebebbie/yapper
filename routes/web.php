<?php

use App\Models\Yap;
use App\Http\Controllers\YapController;
use Illuminate\Support\Facades\Route;


Route::get('/', function (){
    $yaps = Yap::all();
    return view('home', ['yaps'=>$yaps->reverse()]);
});
Route::get('/',[YapController::class, 'index']);
Route::post('/yaps', [YapController::class, 'store']);
