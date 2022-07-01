<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;

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
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('store', [App\Http\Controllers\UserController::class, 'store'])->name('reg');

Route::group(['prefix'=>'admin', 'middleware'=>['isAdmin','auth', 'PreventBackHistory']], function(){
    Route::get('dashboard', [UserController::class, 'index'])->name('admin.index');
    Route::get('logout', [UserController::class, 'perform'])->name('admin.logout');
});
