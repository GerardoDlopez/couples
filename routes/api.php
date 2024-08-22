<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CoupleController;
use App\Http\Controllers\GiftController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\userController;
use App\Models\media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/user/create',[AuthController::class,'CreateUser']);
Route::post('/user/login',[AuthController::class,'LoginUser']);

Route::get('/user/logout',[AuthController::class,'LogOutUser'])->middleware('auth:sanctum');

Route::middleware(['auth:sanctum','can:single-dashboard'])->group(function () {
    Route::get('/createTokenUser', [CoupleController::class,'CreateTokenUser']);
    Route::post('/couple/store', [CoupleController::class,'store']);
    Route::get('/couple/show/{id}',[CoupleController::class,'show']); //pendiente
});

Route::middleware([
    'auth:sanctum',
    'permission:couple-dashboard',
    'permission:medias',
])->group(function(){
    Route::delete('/couple/delete',[CoupleController::class,'destroy']);
    
    Route::post('/couple/media/store',[MediaController::class,'store']);
    Route::get('/couple/media/show/{id}',[MediaController::class,'show']);
    Route::delete('/couple/media/delete',[MediaController::class,'destroy']);
});

Route::resource('gifts',GiftController::class)->middleware('auth:sanctum');

