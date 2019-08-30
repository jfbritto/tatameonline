<?php

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();

Route::get('/login', 'Auth\LoginController@get_autenticar')->name('login');
Route::post('/login', 'Auth\LoginController@post_autenticar')->name('login.post');

// Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware' => ['auth']], function(){

    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

    Route::group(['middleware' => 'root', 'prefix' => 'root', 'namespace' => 'Root'], function(){

        Route::get('/', 'HomeController@index')->name('home.root');

    });

    Route::group(['middleware' => 'admin', 'prefix' => 'admin', 'namespace' => 'Admin'], function(){

        Route::get('/', 'HomeController@index')->name('home.admin');
    });


    Route::group(['middleware' => 'student', 'prefix' => 'student', 'namespace' => 'Student'], function(){

        Route::get('/', 'HomeController@index')->name('home.student');

    });


});