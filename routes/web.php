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
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/reports', [ReportController::class, 'report'])->name('report');
Route::post('/reports/search', [ReportController::class, 'searchUser']);
Route::resource('report', ReportController::class);

Route::middleware('superAdmin')->group( function() {
    Route::get('/users', [UserController::class, 'getUsers']);
    Route::resource('user', UserController::class);
});
Route::get('/profile/changePassword', function () {
    return view('passwordChange');
});
Route::post('/profile/changePassword', [UserController::class, 'changePassword']);
Route::get('/profile', [UserController::class, 'index']);
Route::post('/profile/update', [UserController::class, 'profileUpdate']);
