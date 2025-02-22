<?php

use App\Http\Controllers\API\ProjectTagController;
use App\Http\Controllers\API\AboutController;
use App\Http\Controllers\API\BlogCategoryController;
use App\Http\Controllers\API\BlogController;
use App\Http\Controllers\API\BlogTagController;
use App\Http\Controllers\API\ContactController;
use App\Http\Controllers\API\ProjectCategoryController;
use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\API\SeoController;
use App\Http\Controllers\API\ServiceController;
use App\Http\Controllers\API\SkillController;
use App\Http\Controllers\API\SocialMediaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('projects', [ProjectController::class, 'index']);
Route::get('projects/related', [ProjectController::class, 'related']);
Route::get('projects/{slug}', [ProjectController::class, 'show']);

Route::get('project-categories', [ProjectCategoryController::class, 'index']);
Route::get('project-tags', [ProjectTagController::class, 'index']);


Route::get('blog-tags', [BlogTagController::class, 'index']);
Route::get('blog-categories', [BlogCategoryController::class, 'index']);
Route::get('blogs/related', [BlogController::class, 'related']);
Route::get('blogs', [BlogController::class, 'index']);
Route::get('blogs/{slug}', [BlogController::class, 'show']);
Route::post('contact', [ContactController::class, 'store']);
Route::get('about', [AboutController::class, 'index']);
Route::get('skill', [SkillController::class, 'index']);
Route::get('social-medias', [SocialMediaController::class, 'index']);
Route::get('seo', [SeoController::class, 'get']);
Route::get('services', [ServiceController::class, 'index']);
Route::get('skills',[SkillController::class,'get']);
