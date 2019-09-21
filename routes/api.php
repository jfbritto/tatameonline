<?php


    Route::group(['prefix' => 'root', 'namespace' => 'Root'], function(){

        Route::post('/sport', 'SportController@store');
        Route::post('/sport/list', 'SportController@index');
        Route::post('/sport/destroy/{sport}', 'SportController@destroy');

        Route::post('/academy', 'AcademyController@store');
        Route::post('/academy/list', 'AcademyController@index');
        Route::post('/academy/destroy/{academy}', 'AcademyController@destroy');

        Route::post('/academy/users', 'UserController@store');
        Route::post('/academy/users/list/{academy}', 'UserController@index');
        Route::post('/academy/users/destroy/{academy}', 'UserController@destroy');

        Route::post('/graduation', 'GraduationController@store');
        Route::post('/graduation/list', 'GraduationController@index');
        Route::post('/graduation/destroy/{graduation}', 'GraduationController@destroy');
    });



    Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function(){

        Route::post('/student', 'StudentController@store');
        Route::post('/student/list/{academy}', 'StudentController@index');
        Route::post('/student/destroy/{student}', 'StudentController@destroy');

        // Route::get('/', 'HomeController@index')->name('admin');

        // //AULAS
        // Route::get('/lesson', 'LessonController@index')->name('admin.lesson');
        // Route::get('/lesson/create', 'LessonController@create')->name('admin.lesson.create');
        // Route::get('/lesson/show/{lesson}', 'LessonController@show')->name('admin.lesson.show');
        // Route::get('/lesson/edit/{lesson}', 'LessonController@edit')->name('admin.lesson.edit');

        // //ALUNOS
        // Route::get('/student', 'StudentController@index')->name('admin.student');
        // Route::get('/student/create', 'StudentController@create')->name('admin.student.create');
        // Route::get('/student/show/{user}', 'StudentController@show')->name('admin.student.show');
        // Route::get('/student/edit/{user}', 'StudentController@edit')->name('admin.student.edit');

        // //FINANCEIRO
        // Route::get('/financial', 'FinancialController@index')->name('admin.financial');
    });



    Route::group(['middleware' => 'student', 'prefix' => 'student', 'namespace' => 'Student'], function(){

        // Route::get('/', 'HomeController@index')->name('student');

        // //AULAS
        // Route::get('/lesson', 'LessonController@index')->name('student.lesson');
    });

