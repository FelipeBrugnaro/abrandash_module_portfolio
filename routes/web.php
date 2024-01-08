<?php

use Illuminate\Support\Facades\Route;
use Modules\Service\app\Http\Controllers\PortfolioController;

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

Route::middleware(['auth.admin', 'page.permission'])->group(function() {

    Route::get('/', 'PortfolioController@index')->name('index');
    Route::get('/create', 'PortfolioController@create')->name('create');
    Route::get('/edit/{portfolio}', 'PortfolioController@edit')->name('edit');

    Route::post('/create', 'PortfolioController@store')->name('store');
    Route::put('/edit/{portfolio}', 'PortfolioController@update')->name('update');
    Route::delete('/delete/{portfolio}', 'PortfolioController@destroy')->name('destroy');
    
});