<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;
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

Route::middleware(['isAdmin', 'auth'])->group(function () {
    Route::get('/admin', [HomeController::class, 'adminView'])->name('admin');
});
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/report', [ReportController::class, 'report'])->name('report');




Route::get('/profile', [UserController::class, 'index']);
