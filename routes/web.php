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

Route::get('/', 'CalendarController@index')->name('home');
Route::get('create', 'CalendarController@create')->name('create');
Route::post('create', 'CalendarController@store')->name('store');
Route::get('edit/{id}', 'CalendarController@edit')->name('edit');
Route::post('update/{id}', 'CalendarController@update')->name('update');
Route::delete('delete/{id}', 'CalendarController@delete')->name('delete');
