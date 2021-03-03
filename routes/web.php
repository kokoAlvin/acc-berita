<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();
Auth::routes(['verify' => true]);
Route::get('/', 'HomeController@home')->name('home');
Route::get('/about-us', 'HomeController@aboutUs')->name('aboutUs');
Route::get('/blog', 'HomeController@blog')->name('blog');

Route::get('/my-blog', 'BlogController@index')->name('blog.index');
Route::get('/blog/create', 'BlogController@create')->name('blog.create');
Route::post('/blog', 'BlogController@store')->name('blog.store');

Route::get('/blog/{id}/edit', 'BlogController@edit')->name('blog.edit');
Route::put('/blog', 'BlogController@update')->name('blog.update');

Route::delete('/blog', 'BlogController@delete')->name('blog.delete');

Route::get('/blog/{id}/show', 'BlogController@show')->name('blog.show');

Route::get('/dashboard', 'BlogController@dashboard')->name('blog.dashboard');
Route::post('/blog/{id}/reject', 'BlogController@reject')->name('blog.reject');
Route::post('/blog/{id}/accept', 'BlogController@accept')->name('blog.accept');



