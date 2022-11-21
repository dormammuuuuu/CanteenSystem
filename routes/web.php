<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('auth/facebook', 'App\Http\Controllers\SocialiteController@facebookRedirect')->name('facebook.auth')->middleware('guest');
Route::get('auth/facebook/callback', 'App\Http\Controllers\SocialiteController@loginWithFacebook')->name('facebook.auth.callback');

Route::get('auth/twitter', 'App\Http\Controllers\SocialiteController@twitterRedirect')->name('twitter.auth')->middleware('guest');
Route::get('auth/twitter/callback', 'App\Http\Controllers\SocialiteController@loginWithTwitter')->name('twitter.auth.callback');

Route::get('auth/google', 'App\Http\Controllers\SocialiteController@googleRedirect')->name('google.auth')->middleware('guest');
Route::get('auth/google/callback', 'App\Http\Controllers\SocialiteController@loginWithGoogle')->name('google.auth.callback');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::get('/listings', 'App\Http\Controllers\FoodController@listings')->name('listings');
    Route::post('/tmp/images/', 'App\Http\Controllers\FileUploadController@store')->name('images.tmp');
    Route::get('/food/get/', 'App\Http\Controllers\FoodController@read')->name('food.read');
    Route::post('/food/add/', 'App\Http\Controllers\FoodController@store')->name('food.store');
});
