<?php

use App\Http\Controllers\CategoryNewsController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\Admin\IndexController as AdminController;
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

Route::group(['prefix' => 'admin'], static function () {
    Route::get('/', AdminController::class)
        ->name('admin.index');
});

Route::group(['prefix' => ''], static function() {
    Route::get('/news', [NewsController::class, 'index'])
        ->name('news');

    Route::get('/news/{id}/show', [NewsController::class, 'show'])
    ->where('id', '\d+')
        ->name('news.show');
});

Route::get('/category', [CategoryNewsController::class, 'index'])
        ->name('category');

Route::get('/category/{id}/show', [CategoryNewsController::class, 'show'])
    ->where('id', '\d+')
        ->name('category.show');