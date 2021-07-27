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

Route::get('/', 'HomeController@Index')->name('home');

// Route::get('bulletin', 'BulletinController@index')->name('bulletin.index');
// Route::post('bulletin', 'BulletinController@store')->name('bulletin.store');
// Route::get('bulletin/{bulletin}', 'BulletinController@show')->name('bulletin.show');
// Route::get('bulletin/edit/{bulletin}', 'BulletinController@showEdit')->name('bulletin.show.edit');
// Route::put('bulletin/update/{bulletin}', 'BulletinController@update')->name('bulletin.update');
// Route::get('bulletin/delete/{bulletin}', 'BulletinController@showDelete')->name('bulletin.show.delete');
// Route::delete('bulletin/delete/{bulletin}', 'BulletinController@delete')->name('bulletin.delete');
// Route::post('password/{bulletin}', 'BulletinController@postPassword')->name('post.password');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
