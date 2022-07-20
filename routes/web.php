<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Providers\AppServiceProvider;
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
    return view('register.adduser');
});
// Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
Route::post('adduser', [AdminController::class, 'index'])->name('adduser');

Route::get('/signin', [AdminController::class, 'signin'])->name('signin');

Route::group(['middleware' => 'Aut_back'], function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
});

Route::post('/loginuser', [AdminController::class, 'login'])->name('loginuser');

Route::get('/logout', [AdminController::class, 'logout'])->name('logout');

Route::post('/updateuser/{id}', [AdminController::class, 'updateuser'])->name('updateuser');

Route::post('/changepass/{id}', [AdminController::class, 'changepassword'])->name('changepass');

Route::post('/addproduct', [ProductController::class, 'store'])->name('addproduct');

Route::get('/showproduct', [ProductController::class, 'show'])->name('showproduct');

Route::post('/updateproduct/{id}', [ProductController::class, 'update'])->name('updateproduct');

Route::post('/deleteproduct/{id}', [ProductController::class, 'destroy'])->name('deleteproduct');
