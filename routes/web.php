<?php

use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'GuestController@home') -> name('home');

// ROTTE DI REGISTRAZIONE, LOGIN E LOGOUT
Route::get('/logout', 'Auth\LoginController@logout') ->name('logout');

Route::post('/register', 'Auth\RegisterController@register') ->name('register');
Route::post('/login', 'Auth\LoginController@login') ->name('login');

// appartamenti
Route::middleware('auth')
        ->name('apartment.')
        ->prefix('apartment')
        ->group(function () {
    Route::get('/create', 'Apartment@create')->name('create');
    Route::post('/store', 'Apartment@store')->name('store');
    Route::get('/edit/{id}', 'Apartment@edit')->name('edit');
    Route::post('/update/{id}', 'Apartment@update')->name('update');
    Route::get('delete/{id}', 'DeleteController@delete')->name('delete');

});
