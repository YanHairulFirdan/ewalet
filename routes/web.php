<?php

use App\Transaction;
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

Route::namespace('User')->group(function () {
    Route::get('/', 'HomeController@Index')->name('home');
    Route::get('mulai-berlangganan', 'SubscriptionController@index')->name('subscribe');
    Route::post('mulai-berlangganan', 'SubscriptionController@subscribe')->name('subscribe.post');
    Route::post('subscribe-finish', 'SubscriptionController@paymentFinished')->name('subscribe.finish');
    Route::middleware(['auth', 'active'])->group(function () {
        Route::post('transactions/{transaction}', 'TransactionController@update');
        Route::post('transactions/export/pdf', 'TransactionController@exportPdf')->name('export.pdf');
        Route::post('transactions/export/excel', 'TransactionController@exportExcel')->name('export.excel');
        Route::resource('transactions', TransactionController::class)->except(['create', 'edit', 'update']);
    });

    Auth::routes();
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::namespace('Admin')->group(function () {
        Route::get('login', 'LoginController@showForm')->name('login');
        Route::post('login', 'LoginController@login')->name('post.login');
        Route::get('/', 'DashboardController@index')->name('dashboaard');
        Route::get('/users', 'DashboardController@showUsers')->name('show.users');
        Route::post('types/{type}', 'TypeController@update');
        Route::resource('types', TypeController::class)->except('update');
    });
});

// Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
