<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\ItemController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/',[ItemController::class,'index'])->name('index');
Route::get('/search',[ItemController::class,'search']);
Route::get('/item/{item}',[ItemController::class,'detail'])->name('detail');
Route::get('/likes_unchecked/{item}',[ItemController::class,'likeUnchecked']);



//Route::post('/register',[RegisteredUserController::class,'store']);
//Route::post('/login',[AuthenticatedSessionController::class,'store']);
//Route::post('/logout',[AuthenticatedSessionController::class,'destroy']);
//Route::get('/register', [UserController::class,'register']);

Route::middleware(['auth'])->group(function () {
    Route::get('/mypage',[ItemController::class,'mypage'])->name('mypage');
    Route::get('/mypage/profile',[ItemController::class,'editProfile'])->name('editProfile');
    Route::post('/mypage/profile',[ItemController::class,'updateProfile']);
    Route::get('/likes_checked/{item}',[ItemController::class,'likeChecked']);
    Route::post('/coment_register',[ItemController::class,'comentRegister']);
    Route::get('/purchase/{item}',[ItemController::class,'purchase']);
    Route::post('/purchase/{item}',[ItemController::class,'sendStripe']);     
    Route::get('/purchase/address/{item}',[ItemController::class,'address']);
    Route::post('/purchase/address/{item}',[ItemController::class,'returnAddress']);
    Route::get('/sell',[ItemController::class,'sell']);
    Route::post('/sell',[ItemController::class,'registerSell']);
    //Route::get('/?tab=mylist',[ItemController::class,'mylist'])->name('mylist');
});