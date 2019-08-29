<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::middleware(['auth'], function(){

    Route::middleware(['root'], function(){

        Route::get('/', 'Root\HomeController@index')->name('home');

    })->prefix('root');

    Route::middleware(['admin'], function(){

        Route::get('/', 'Admin\HomeController@index')->name('home');

    })->prefix('admin');

    Route::middleware(['student'], function(){

        Route::get('/', 'Student\HomeController@index')->name('home');

    })->prefix('student');


});
