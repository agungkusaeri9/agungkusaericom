<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PortofolioController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ServiceController;
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

// home
Route::get('/about', AboutController::class)->name('about');

// download cv
Route::get('/download-cv', [DownloadController::class,'cv'])->name('download.cv');

// blog
Route::get('/blogs',[PostController::class,'index'])->name('posts.index');
Route::get('/blogs/search',[PostController::class,'index'])->name('posts.search');
Route::get('/blogs/category/{category}',[PostController::class,'category'])->name('posts.category');
Route::get('/blogs/tag/{tag}',[PostController::class,'tag'])->name('posts.tag');
Route::get('/blogs/{slug}',[PostController::class,'show'])->name('posts.show');

// post comments
Route::post('blogs/comments',[PostController::class,'comment'])->name('posts.comment');

// project
Route::get('/projects',[ProjectController::class,'index'])->name('projects.index');
Route::get('/projects/search',[ProjectController::class,'index'])->name('projects.search');
Route::get('/projects/category/{category}',[ProjectController::class,'category'])->name('projects.category');
Route::get('/projects/tag/{tag}',[ProjectController::class,'tag'])->name('projects.tag');
Route::get('/projects/{slug}',[ProjectController::class,'show'])->name('projects.show');


// service
Route::get('/services/{name}',[ServiceController::class,'index'])->name('services.index');

// portofolio
Route::get('/list-portofolio',[PortofolioController::class,'index'])->name('portofolio.index');
Route::get('/list-portofolio/search',[PortofolioController::class,'index'])->name('portofolio.search');
Route::get('/list-portofolio/category/{category}',[PortofolioController::class,'category'])->name('portofolio.category');
Route::get('/list-portofolio/tag/{tag}',[PortofolioController::class,'tag'])->name('portofolio.tag');
Route::get('/list-portofolio/{slug}',[PortofolioController::class,'show'])->name('portofolio.show');
