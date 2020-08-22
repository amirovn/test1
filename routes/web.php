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

Route::get('/', 'IndexController@show')->name('index');
Route::get('/articles', 'ArticleController@articles')->name('articles');
Route::get('/article/{id}', 'ArticleController@article')->name('article');
Route::get('/article/toggle-like/{id}', 'ArticleController@toggleLike')->name('article-toggle-like');
Route::get('/article/toggle-view/{id}', 'ArticleController@toggleView')->name('article-toggle-view');
Route::post('/article/add-comment/', 'ArticleController@addComment')->name('article-add-comment');
