<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\TransactionController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');

Route::resource('product', ProductController::class);
Route::post('/request_topup/{id}', [WalletController::class, 'request_topup'])->name('request_topup');
Route::post('/addToCart', [TransactionController::class, 'addToCart'])->name('addToCart');
Route::post('/payNow', [TransactionController::class, 'payNow'])->name('payNow');
Route::post('TopUpNow', [WalletController::class, 'TopUpNow'])->name('TopUpNow');
Route::post('request_topup', [WalletController::class, 'request_topup'])->name('request_topup');