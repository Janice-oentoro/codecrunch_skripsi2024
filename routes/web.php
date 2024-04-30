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

#USER ROUTES
Route::group(['middleware' => 'user'], function(){
    Route::get('/editprofile',[MainController::class,'editProfile'])->name('profile');
    Route::post('edit/profile',[AuthController::class,'editProfileLogic'])->name('edit-profile');
});

#CONSULTANT ROUTES
Route::group(['middleware' => 'consultant'], function(){
    Route::get('/editskill',[MainController::class,'viewSkill'])->name('skill');
    Route::post('add/conprog',[MainController::class,'addConProg'])->name('add-conprog');
    Route::post('add/contopic',[MainController::class,'addConTopic'])->name('add-contopic');
    Route::delete('delete/conprog',[MainController::class,'deleteConProg'])->name('delete-progcon');
    Route::delete('delete/contopic',[MainController::class,'deleteConTopic'])->name('delete-topiccon');
});
