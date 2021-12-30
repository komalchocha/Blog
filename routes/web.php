<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Localization;
use App\Http\Controllers\Blog\AddBlogController;
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

Route::get('/', [App\Http\Controllers\Blog\AddBlogController::class, 'index']);
Route::post('/', [App\Http\Controllers\Blog\AddBlogController::class, 'store'])->name('store');
Route::get('viewblog/{id}', [App\Http\Controllers\Blog\AddBlogController::class, 'blog'])->name('viewblog');
Route::post('like', [App\Http\Controllers\Blog\AddBlogController::class, 'like'])->name('like');
Route::post('comment', [App\Http\Controllers\Blog\AddBlogController::class, 'comment'])->name('comment');
Route::post('replyStore', [App\Http\Controllers\Blog\AddBlogController::class, 'replyStore'])->name('replyStore');
Route::post('fetchComment', [App\Http\Controllers\Blog\AddBlogController::class, 'fetchComment'])->name('fetchComment');
Route::post('get_reply_comment', [App\Http\Controllers\Blog\AddBlogController::class, 'get_reply_comment'])->name('get_reply_comment');
Route::post('destroy', [App\Http\Controllers\Blog\AddBlogController::class, 'destroy'])->name('destroy');
Route::post('update', [App\Http\Controllers\Blog\AddBlogController::class, 'update'])->name('update');
Route::get('blogEdit/{id}', [App\Http\Controllers\Blog\AddBlogController::class, 'blogEdit'])->name('blogEdit');
Route::post('updateBlog', [App\Http\Controllers\Blog\AddBlogController::class, 'updateBlog'])->name('updateBlog');
Route::post('destroyblog', [App\Http\Controllers\Blog\AddBlogController::class, 'destroyblog'])->name('destroyblog');
Route::get('language', [App\Http\Controllers\LanguageController::class, 'language'])->name('language');
Route::get('welcome/products', [App\Http\Controllers\Admin\ProductController::class, 'Products'])->name('welcome/products');;
Route::post('getCategory',[App\Http\Controllers\Admin\ProductController::class, 'getCategory'])->name('getCategory');

