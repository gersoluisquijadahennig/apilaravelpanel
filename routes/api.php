<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


    Route::get('/all', [UserController::class,'index'])->name('user.index');
    Route::post('/register', [UserController::class, 'store']);
    Route::get('show/{user}', [UserController::class, 'show'])->name('user.show');
    Route::delete('show/{user}', [UserController::class, 'destroy'])->name('user.delete');
