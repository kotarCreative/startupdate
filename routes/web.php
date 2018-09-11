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
Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/feedback', 'HomeController@feedback')->name('feedback');
Route::get('/companies', 'CompaniesController@index');

Route::group(['middleware' => 'auth'], function() {
  Route::get('/profile/{slug}/edit', 'UsersController@edit')->name('users.edit');
  Route::patch('/profile/{slug}', 'UsersController@update')->name('users.update');

  Route::patch('/companies/{slug}', 'CompaniesController@update')->name('companies.update');

  Route::patch('companies/{company}/progress/{progress_update}', 'ProgressUpdatesController@update')->name('progress.update');
  Route::post('companies/{company}/progress', 'ProgressUpdatesController@create')->name('progress.create');
});
