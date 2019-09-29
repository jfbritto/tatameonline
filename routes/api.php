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
        
        Route::post('/lesson', 'LessonController@store');
        Route::post('/lesson/list/{academy}', 'LessonController@index');
        Route::post('/lesson/destroy/{lesson}', 'LessonController@destroy');
        Route::post('/lesson/not/aluns/list/{lesson}/{academy}', 'LessonController@listNotAluns');
        Route::post('/lesson/student/list/{student}', 'LessonController@listAluns');
        
        Route::post('/registration', 'RegistrationController@store');
        Route::post('/registration/list/{lesson}', 'RegistrationController@index');
        Route::post('/registration/destroy/{registration}', 'RegistrationController@destroy');
        
        Route::post('/contract', 'ContractController@store');
        Route::post('/contract/list/{user}', 'ContractController@index');
        
        Route::post('/invoice/list/{contract}', 'InvoiceController@index');
        Route::post('/invoice/reportPayment/{invoice}', 'InvoiceController@reportPayment');
        
        Route::post('/graduation', 'UserGraduationController@store');
        Route::post('/graduation/list/{user}', 'UserGraduationController@index');
        Route::post('/graduation/destroy/{userGraduation}', 'UserGraduationController@destroy');
        Route::post('/graduation/list/sport/{sport}', 'GraduationController@listBySport');
        
        Route::post('/presence/list/{user}/{userGraduation}', 'PresenceController@index');
        
    });



    Route::group(['prefix' => 'student', 'namespace' => 'Student'], function(){    

        //AULAS
        Route::post('/lesson/list/{user}', 'LessonController@index');
        Route::post('/lesson/next/{user}', 'LessonController@nextLesson');
        Route::post('/lesson/check/{user}', 'LessonController@checkLesson');

        //PRESENÇA
        Route::post('/presence', 'PresenceController@store');
        Route::post('/presence/last/list/{user}', 'PresenceController@openLastPresencesByStudent');
        
        //ACADEMIA
        Route::post('/academy/token/check/{user}/{token}', 'AcademyController@checkToken');
    });

