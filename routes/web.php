<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BlogController;

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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::controller(WebController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/post/{id}', 'post')->name('post');
    Route::get('/author', 'author')->name('author');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::controller(CategoryController::class)->group(function () {
        Route::get('/add-category', 'index')->name('category.add');
        Route::post('/new-category', 'create')->name('category.new');
        Route::get('/manage-category', 'manage')->name('category.manage');
        Route::get('/edit-category/{id}', 'edit')->name('category.edit');
        Route::post('/update-category/{id}', 'update')->name('category.update');
        Route::get('/delete-category/{id}', 'delete')->name('category.delete');
    });

    Route::controller(BlogController::class)->group(function () {
        Route::get('/add-blog', 'index')->name('blog.add');
        Route::post('/new-blog', 'create')->name('blog.new');
        Route::get('/manage-blog', 'manage')->name('blog.manage');
        Route::get('/detail-blog-info/{id}', 'detail')->name('blog.detail');
        Route::get('/update-blog-status/{id}', 'updateStatus')->name('blog.status');
        Route::get('/edit-blog/{id}', 'edit')->name('blog.edit');
        Route::post('/update-blog/{id}', 'update')->name('blog.update');
        Route::get('/delete-blog/{id}', 'delete')->name('blog.delete');
    });
});
