<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [MainController::class, 'land'])->name('land');
Route::get('/home', [MainController::class, 'home'])->name('home');
Route::get('/about', [MainController::class, 'about'])->name('about');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'user'], function(){
    Route::get('/editprofile',[MainController::class,'editProfile'])->name('profile')->middleware('user');
    Route::post('edit/profile',[AuthController::class,'editProfileLogic'])->name('edit-profile')->middleware('user');
});

Route::group(['middleware' => 'consultant'], function(){
    Route::get('/editskill',[AuthController::class,'editSkill'])->name('skill')->middleware('consultant');
});
