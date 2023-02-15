<?php

use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
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

Route::middleware('guest')->group(function () {
    Route::get('auth/google', [GoogleController::class, 'redirect_to_google'])->name('google.login');
    Route::get('auth/google/callback', [GoogleController::class, 'google_callback'])->name('google.callback');
});


// home
Route::get('/', HomeController::class)->name('home');
// contact
Route::get('/contact',[ContactController::class,'index'])->name('contact.index');
Route::post('/contact',[ContactController::class,'store'])->name('contact.store');

// blog
Route::get('/blog',[PostController::class,'index'])->name('posts.index');
Route::get('/blog/{slug}',[PostController::class,'show'])->name('posts.show');
