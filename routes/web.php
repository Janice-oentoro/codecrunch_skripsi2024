<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PayController;
use Illuminate\Support\Facades\Route;


Route::get('/home', [MainController::class, 'home'])->name('home');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [MainController::class, 'land'])->name('land');
Route::get('/about', [MainController::class, 'about'])->name('about');
Route::get('/detailconsultant/{id}', [MainController::class,'detailConsultant'])->name('detail/{id}');

#AUTHS USERS
Route::group(['middleware' => 'guest'], function(){
Route::get('/login', [MainController::class, 'loginPage'])->name('login_page');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/registeruser', [MainController::class, 'registerPage'])->name('register_page');
Route::post('/register', [AuthController::class, 'registerUser'])->name('register');    
});

#USER ROUTES
Route::group(['middleware' => 'user'], function(){
    Route::get('/editprofile',[MainController::class,'editProfile'])->name('profile');
    Route::post('edit/profile',[AuthController::class,'editProfileLogic'])->name('edit-profile');
    Route::get('/consultation', [MainController::class, 'consultation'])->name('consultation');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/pay',[PayController::class,'showView']);
    Route::post('/pay',[PayController::class, 'pay']);
});

#CONSULTANT ROUTES
Route::group(['middleware' => 'consultant'], function(){
    Route::get('/editskill',[MainController::class,'viewSkill'])->name('skill');
    Route::post('add/conprog',[MainController::class,'addConProg'])->name('add-conprog');
    Route::post('add/contopic',[MainController::class,'addConTopic'])->name('add-contopic');
    Route::delete('delete/conprog',[MainController::class,'deleteConProg'])->name('delete-progcon');
    Route::delete('delete/contopic',[MainController::class,'deleteConTopic'])->name('delete-topiccon');
    Route::get('/addconsultation',[MainController::class,'addConsultation'])->name('add-consultation');
    Route::post('add/con',[MainController::class,'addCon'])->name('add-con');
    Route::delete('delete/con',[MainController::class,'deleteCon'])->name('delete-con');
    Route::put('edit/con',[MainController::class,'editCon'])->name('edit-con');
});
