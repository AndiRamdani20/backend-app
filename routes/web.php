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

Route::controller(LoginController::class)->group(function(){
    Route::get('/login', 'index')->name('user.login');
    Route::post('/login/store', 'store')->name('login.store');
    Route::get('/register', 'signup')->name('register');
    Route::post('/register/store', 'registore')->name('register.store');
    Route::post('/logout', 'logout')->name('logout.logout');
});

Route::prefix('page')->group(function(){
    Route::get('/dashboard', [PageController::class, 'index'])->name('dashboard');
});