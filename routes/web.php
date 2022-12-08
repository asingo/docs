<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|asd
*/

Route::get('/', [LoginController::class, 'login'])->name('login');
Route::post('actionlogin', [LoginController::class, 'actionLogin'])->name('actionlogin');

Route::get('home', [HomeController::class, 'index'])->name('home')->middleware('is_admin');
Route::get('home/docsman', [HomeController::class, 'docsMan'])->name('docsman')->middleware('is_admin');

Route::get('home/user/delete/{id}', [HomeController::class, 'delUser'])->name('delUser')->middleware('is_admin');
Route::post('user/edit', [HomeController::class, 'editUser'])->name('editUser')->middleware('is_admin');
Route::get('actionlogout', [LoginController::class, 'actionLogout'])->name('actionlogout')->middleware('auth');

//REGISTER
Route::get('register', [RegisterController::class, 'register'])->name('register');
Route::post('register/action', [RegisterController::class, 'actionregister'])->name('actionregister');

Route::get('home/user', [HomeController::class, 'listUser'])->name('listUser')->middleware('is_admin');
Route::get('home/user/add', [HomeController::class, 'addUser'])->name('addUser')->middleware('is_admin');
