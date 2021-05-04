<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('articles', \App\Http\Controllers\ArticleController::class)->only(['show', 'edit', 'update', 'destroy']);
Route::resource('citations', \App\Http\Controllers\CitationController::class)->only(['destroy']);
Route::resource('articles.citations', \App\Http\Controllers\ArticleCitationController::class)->only(['store']);
Route::resource('users', \App\Http\Controllers\UserController::class)->only(['index', 'show', 'update', 'destroy']);
Route::resource('categories', \App\Http\Controllers\CategoryController::class)->only(['index', 'store', 'destroy']);
Route::resource('articles.comments', \App\Http\Controllers\CommentController::class)->only(['store', 'destroy']);
Route::resource('teams', \App\Http\Controllers\TeamController::class)->only(['index', 'store', 'show']);
Route::resource('teams.articles', \App\Http\Controllers\TeamArticleController::class)->only(['create', 'store']);
Route::resource('teams.users',\App\Http\Controllers\TeamUserController::class)->only(['index', 'store', 'destroy']);
