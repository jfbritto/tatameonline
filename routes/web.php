<?php

Route::get('/', 'SiteController@index')->name('site');

// Auth::routes();

// Route::get('/login', 'Auth\LoginController@get_autenticar')->name('login');
Route::post('/login', 'Auth\LoginController@post_autenticar')->name('login.post');

// Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware' => ['auth']], function(){

    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');



    Route::group(['middleware' => 'root', 'prefix' => 'root', 'namespace' => 'Root'], function(){

        Route::get('/', 'HomeController@index')->name('root');

        //ACADEMIAS
        Route::get('/academy', 'AcademyController@index')->name('root.academy');
        Route::get('/academy/create', 'AcademyController@create')->name('root.academy.create');
        Route::get('/academy/show/{academy}', 'AcademyController@show')->name('root.academy.show');

        //GRADUAÇÃO
        Route::get('/graduation', 'GraduationController@index')->name('root.graduation');
        Route::get('/graduation/create', 'GraduationController@create')->name('root.graduation.create');

        //ESPORTES
        Route::get('/sport', 'SportController@index')->name('root.sport');
        Route::get('/sport/create', 'SportController@create')->name('root.sport.create');
    });



    Route::group(['middleware' => 'admin', 'prefix' => 'admin', 'namespace' => 'Admin'], function(){

        Route::get('/', 'HomeController@index')->name('admin');

        //AULAS
        Route::get('/lesson', 'LessonController@index')->name('admin.lesson');
        Route::get('/lesson/create', 'LessonController@create')->name('admin.lesson.create');
        Route::get('/lesson/show/{lesson}', 'LessonController@show')->name('admin.lesson.show');
        Route::get('/lesson/edit/{lesson}', 'LessonController@edit')->name('admin.lesson.edit');

        //ALUNOS
        Route::get('/student', 'StudentController@index')->name('admin.student');
        Route::get('/student/create', 'StudentController@create')->name('admin.student.create');
        Route::get('/student/show/{user}', 'StudentController@show')->name('admin.student.show');
        Route::get('/student/edit/{user}', 'StudentController@edit')->name('admin.student.edit');

        //GRADUAÇÃO
        Route::get('/graduation', 'GraduationController@index')->name('admin.graduation');
        Route::get('/graduation/create', 'GraduationController@create')->name('admin.graduation.create');

        //CONTRATOS
        Route::get('/student/contract/{user}', 'ContractController@index')->name('admin.student.contract');

        //GRADUAÇÕES
        Route::get('/student/graduation/{user}', 'UserGraduationController@index')->name('admin.student.graduation');

        //FINANCEIRO
        Route::get('/financial', 'FinancialController@index')->name('admin.financial');
    });




    Route::group(['middleware' => 'student', 'prefix' => 'student', 'namespace' => 'Student'], function(){

        Route::get('/', 'HomeController@index')->name('student');

        //AULAS
        Route::get('/lesson', 'LessonController@index')->name('student.lesson');
    });




});
