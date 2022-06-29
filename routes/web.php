<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PageController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::prefix('user')->group(function(){
    Route::get('/sign-in', [LoginController::class, 'signin']);
    Route::post('/login', [LoginController::class, 'login'])->name('login.login');
    Route::get('/sign-up', [LoginController::class, 'signup'])->name('signup');
    Route::post('/register', [LoginController::class, 'register']);
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout.logout');
});

Route::prefix('page')->group(function(){
    Route::get('/dashboard', [PageController::class, 'index']);
});