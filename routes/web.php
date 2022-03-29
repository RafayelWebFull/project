<?php

use App\Http\Controllers\UserController;
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
    return redirect()->guest('/login');
});

Auth::routes();

//Route::middleware('superAdmin')->group(function () {
    Route::get('/superAdmin', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//});
Route::get('/profile', [UserController::class, 'index']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
