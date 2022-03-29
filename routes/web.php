<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{MainController, LoginController, CommentsController, PostController, BalanceController, BoosterpackController};

Route::group(['middleware' => ['web']], function () {

    Route::get('/', function () {
        return view('main');
    });

    Route::get('/get-content-for-main', [MainController::class, 'index']);
    Route::get('/get-post/{post}', [PostController::class, 'getPost']);
    Route::post('/post/{post}/like', [PostController::class, 'like'])->middleware('auth');

    Route::post('/post/{post}/comments/add', [CommentsController::class, 'add'])->middleware('auth');
    Route::post('/post/comment/{comment}/like', [CommentsController::class, 'like'])->middleware('auth');

    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout-user', [LoginController::class, 'logout']);
    Route::post('/get-user', [LoginController::class, 'getUser']);

    Route::post('/balance/refill', [BalanceController::class, 'reFill'])->middleware('auth');

    Route::post('/boosterpack/buy/{boosterpack}', [BoosterpackController::class, 'buy'])->middleware('auth');
    Route::post('/history', [BalanceController::class, 'history'])->middleware('auth');
});