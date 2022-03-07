<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'GuestController@home') -> name('home');
Route::get('/apartments/results/', 'GuestController@apartmentsResults') ->name('apartments.results');
Route::get('/services/list', 'ApiController@getServices') ->name('services.list');

// ricerca appartamenti
Route::get('/apartments/search/lng={lng}/lat={lat}/radius={radius}/rooms={nRooms}/beds={nBeds}', 'ApiController@searchApartments') -> name('apartments.search');

// ROTTE DI REGISTRAZIONE, LOGIN E LOGOUT
Route::get('/logout', 'Auth\LoginController@logout') ->name('logout');

Route::post('/register', 'Auth\RegisterController@register') ->name('register');
Route::post('/login', 'Auth\LoginController@login') ->name('login');


// user
Route::middleware('auth')
        ->name('user.')
        ->prefix('user')
        ->group(function () {
            Route::get('/dashboard', 'UserController@dashboard') ->name('dashboard');
        });

// crud appartamenti
Route::name('apartment.')
        ->prefix('apartment')
        ->group(function () {
            Route::get('/show/{id}', 'ApartmentController@show')->name('show');
            Route::post('/message/send/{id}', 'ApartmentController@message_send')->name('message_send');

            Route::middleware('auth')
                    ->group(function () {
                        Route::get('/create', 'ApartmentController@create')->name('create');
                        Route::post('/store', 'ApartmentController@store')->name('store');
                        Route::get('/edit/{id}', 'ApartmentController@edit')->name('edit');
                        Route::post('/update/{id}', 'ApartmentController@update')->name('update');
                        Route::get('/delete/{id}', 'ApartmentController@delete')->name('delete');
                    });
        });

// api

Route::middleware('auth')
-> prefix('api')
-> name('api.')
-> group(function () {

    // lista appartamenti dell'utenete loggato
    Route::get('/user/apartments/list', 'ApiController@getApartmentUserList') -> name('user.apartments.list');
}); 

