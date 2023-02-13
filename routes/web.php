<?php

use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes(['register' => false]);
Route::redirect('/', '/login', 301);

Route::middleware('guest')->group(function () {
    Route::get('auth/google', [GoogleController::class, 'redirect_to_google'])->name('google.login');
    Route::get('auth/google/callback', [GoogleController::class, 'google_callback'])->name('google.callback');
});
