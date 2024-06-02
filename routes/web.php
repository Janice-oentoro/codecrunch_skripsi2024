<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PayController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FilterController;

Auth::routes();
//Route::get('/home', [MainController::class, 'home'])->name('home');

Route::get('/', [MainController::class, 'land'])->name('land');
Route::get('/home', [MainController::class, 'land'])->name('land');
Route::get('/about', [MainController::class, 'about'])->name('about');
Route::get('/detailconsultant/{id}', [MainController::class,'detailConsultant'])->name('detail/{id}');
Route::get('/topics/{progName}', [FilterController::class, 'getTopics']);

#AUTHS USERS
// Route::group(['middleware' => 'guest'], function(){
// Route::get('/login', [MainController::class, 'loginPage'])->name('login_page');
// Route::post('/login', [AuthController::class, 'login'])->name('login');
// Route::get('/registeruser', [MainController::class, 'registerPage'])->name('register_page');
// Route::post('/register', [AuthController::class, 'registerUser'])->name('register');
// });

#USER ROUTES
Route::group(['middleware' => 'user'], function(){
    Route::get('/editprofile',[MainController::class,'editProfile'])->name('profile');
    Route::post('edit/profile',[AuthController::class,'editProfileLogic'])->name('edit-profile');
    Route::get('/consultation', [MainController::class, 'consultation'])->name('consultation');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/pay',[PayController::class,'showView']);
    Route::post('/pay',[PayController::class, 'pay']);
    Route::post('/addfeedback',[MainController::class, 'addFeedback'])->name('add-feedback');
    Route::get('/transactionhistory', [MainController::class, 'viewTransactionHistory'])->name('transactionhistory');
    Route::post('/addrefund', [MainController::class, 'addRefund'])->name('add-refund');
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
    Route::put('cancel/con',[MainController::class,'cancelCon'])->name('cancel-con');
    Route::put('edit/con',[MainController::class,'editCon'])->name('edit-con');
    Route::get('/feedback', [MainController::class, 'viewFeedback'])->name('feedback');
    Route::post('/addwithdraw', [MainController::class, 'addWithdraw'])->name('add-withdraw');
});

#ADMIN ROUTES
Route::group(['middleware' => 'admin'], function(){
    Route::get('/dashboard',[AdminController::class,'dashboard'])->name('dashboard');
    Route::get('/userlist',[AdminController::class,'userList'])->name('userlist');
    Route::get('/requestlist',[AdminController::class,'requestList'])->name('requestlist');
    Route::put('/suspenduser',[AdminController::class,'suspendUser'])->name('suspend-user');
    Route::put('/unsuspenduser',[AdminController::class,'unsuspendUser'])->name('unsuspend-user');
    Route::put('/acceptrequest',[AdminController::class,'acceptRequest'])->name('accept-req');
    Route::put('/rejectrequest',[AdminController::class,'rejectRequest'])->name('reject-req');
});