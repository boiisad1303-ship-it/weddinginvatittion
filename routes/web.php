<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\WeddingController;
use App\Http\Controllers\WishController;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [WeddingController::class, 'index'])->name('wedding.show');
Route::get('/invitation/{slug}', [WeddingController::class, 'showPublic'])->name('wedding.preview');
Route::get('/lang/{locale}', [LanguageController::class, 'switchLang'])->name('lang.switch');
Route::post('/wish', [WishController::class, 'storeWish'])->middleware('throttle:10,1')->name('wish.store');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->middleware('throttle:5,1');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get(RouteServiceProvider::HOME, [WeddingController::class, 'editForm'])->name('wedding.edit');
    Route::post(RouteServiceProvider::HOME, [WeddingController::class, 'updateForm'])->middleware('throttle:10,1')->name('wedding.update');
    Route::redirect('/admin/settings', RouteServiceProvider::HOME)->name('admin.settings');
});
