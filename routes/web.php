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

        Route::get('/', 'HomeController@index')->name('root');

        //ACADEMIAS
        Route::get('/academy', 'AcademyController@index')->name('root.academy');
    });

    Route::group(['middleware' => 'admin', 'prefix' => 'admin', 'namespace' => 'Admin'], function(){

        Route::get('/', 'HomeController@index')->name('admin');

        //AULAS
        Route::get('/lesson', 'LessonController@index')->name('admin.lesson');

        //ALUNOS
        Route::get('/student', 'StudentController@index')->name('admin.student');

        //FINANCEIRO
        Route::get('/financial', 'FinancialController@index')->name('admin.financial');
    });


    Route::group(['middleware' => 'student', 'prefix' => 'student', 'namespace' => 'Student'], function(){

        Route::get('/', 'HomeController@index')->name('student');

        //AULAS
        Route::get('/lesson', 'LessonController@index')->name('student.lesson');
    });


});