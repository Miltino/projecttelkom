<?php

use App\Http\Controllers\activitycontroller;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
})->middleware('auth');

// Route::get('/login', [LoginController::class], 'login')->name('login');

route::get('/login',[LoginController::class,'login'])->name('login')->middleware('guest');
route::get('/register',[LoginController::class,'register'])->name('register')->middleware('guest');
route::post('/registeruser',[LoginController::class,'registeruser'])->name('registeruser');
route::post('/loginproses',[LoginController::class,'loginproses'])->name('loginproses');
route::get('/logout',[LoginController::class, 'logout'])->name('logout')->middleware('auth');
route::get('/activity',[activitycontroller::class,'activityLog'])->name('activity')->middleware('auth');
