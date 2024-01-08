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
Route::post('home/file/delete', [HomeController::class, 'delFile'])->name('delFile')->middleware('is_admin');
Route::get('home/parent/delete/{id}', [HomeController::class, 'removeParent'])->name('removeParent')->middleware('is_admin');
Route::post('user/edit', [HomeController::class, 'editUser'])->name('editUser')->middleware('is_admin');
Route::post('parent/edit', [HomeController::class, 'editParent'])->name('editParent')->middleware('is_admin');
Route::get('actionlogout', [LoginController::class, 'actionLogout'])->name('actionlogout')->middleware('auth');

//REGISTER
Route::get('register', [RegisterController::class, 'register'])->name('register');
Route::post('register/action', [RegisterController::class, 'actionregister'])->name('actionregister');
Route::post('parent/add', [HomeController::class, 'actionAddParent'])->name('actionAddParent')->middleware('is_admin');
Route::post('save', [HomeController::class, 'saveDocs'])->name('saveDocs')->middleware('is_admin');
Route::post('create', [HomeController::class, 'createDocs'])->name('createDocs')->middleware('is_admin');

Route::get('home/user', [HomeController::class, 'listUser'])->name('listUser')->middleware('is_admin');
Route::get('home/user/add', [HomeController::class, 'addUser'])->name('addUser')->middleware('is_admin');

Route::get('home/docs/add/parent', [HomeController::class, 'addParentDocs'])->name('addParentDocs')->middleware('is_admin');
Route::get('home/docs/editor', [HomeController::class, 'editor'])->name('editor')->middleware('is_admin');
Route::get('home/docs/create', [HomeController::class, 'create'])->name('create')->middleware('is_admin');

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
Route::middleware(['web','auth'])->group(function (){
    Route::get('/downloadPdf',[HomeController::class, 'downloadPdf'])->name('downloadPdf');
});
