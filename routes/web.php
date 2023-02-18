<?php

declare(strict_types=1);

use App\Http\Controllers\Account\IndexController as AccountController;
use App\Http\Controllers\Admin\ParserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryNewsController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\Admin\IndexController as AdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\SocialProvidersController;
use UniSharp\LaravelFilemanager\Lfm;

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

Route::group(['middleware' => 'auth'], static function (){
    Route::get('/logout', [LoginController::class, 'logout'])
        ->name('account.logout');
    Route::get('/account', AccountController::class)
        ->name('account');
});

    // filemanager route
    Route::group(['prefix' => 'laravel-file-manager', 'middleware' => ['web']], static function () {
        Lfm::routes();
    });

Route::group(['prefix' => 'admin', 'as' => 'admin.'], static function () {
    Route::get('/', AdminController::class)
        ->name('index');
    Route::get('/parser', ParserController::class)
        ->name('parser');

    Route::resource('categories', AdminCategoryController::class);
    Route::resource('news', AdminNewsController::class);
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

Route::get('session', function() {
    $sessionName = 'test';
    if (session()->has($sessionName)) {
        // dd(session()->get($sessionName), session()->all());
        session()->forget($sessionName);
    }
    dd(session()->all());
    session()->put($sessionName);

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'guest'], static function() {
    Route::get('/auth/redirect/{driver}', [SocialProvidersController::class, 'redirect'])
        ->where('driver', '\w*')
        ->name('social.auth.redirect');

    Route::get('/auth/callback/{driver}', [SocialProvidersController::class, 'callback'])
        ->where('driver', '\w*');
});
