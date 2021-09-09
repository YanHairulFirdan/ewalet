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
    Route::middleware(['auth', 'active'])->group(function () {
        Route::post('transactions/{transaction}', 'TransactionController@update');
        Route::post('transactions/export/excel', 'TransactionController@exportExcel')->name('export.excel');
        // Route::post('transactions/export/pdf', 'TransactionController@exportPdf')->name('export.pdf');
        Route::resource('transactions', TransactionController::class)->except(['create', 'edit', 'update']);
    });

    Auth::routes();
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', 'Admin\LoginController@showForm')->name('login');
    Route::post('login', 'Admin\LoginController@login')->name('post.login');
    Route::get('/', 'Admin\DashboardController@index')->name('dashboaard');
    Route::get('/users', 'Admin\DashboardController@showUsers')->name('show.users');
});

// Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
