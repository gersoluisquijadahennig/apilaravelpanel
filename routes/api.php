<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

    Route::post('/register', [UserController::class, 'store']);
   
    Route::post('login',[AuthController::class,'login'])->name('user.login');

Route::middleware('auth:sanctum')->group(function(){

    Route::get('/all', [UserController::class,'index'])->name('user.index');
    Route::post('logout',[AuthController::class,'logout'])->name('user.logout');
    Route::post('loginuser', [AuthController::class, 'loginuser'])->name('user.loginuser');
    Route::get('show/{user}', [UserController::class, 'show'])->name('user.show');
    Route::delete('show/{user}', [UserController::class, 'destroy'])->name('user.delete');

  });
  
