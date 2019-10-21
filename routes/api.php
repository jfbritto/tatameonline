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

        //ALUNO
        Route::post('/student', 'StudentController@store');
        Route::post('/student/list/{academy}', 'StudentController@index');
        Route::post('/student/find/{student}', 'StudentController@find');
        Route::post('/student/destroy/{student}', 'StudentController@destroy');
        Route::post('/student/activate/{student}', 'StudentController@activate');
        Route::post('/student/edit/pass', 'StudentController@editPass');
        Route::post('/student/edit/avatar', 'StudentController@editAvatar');

        //AULA
        Route::post('/lesson', 'LessonController@store');
        Route::post('/lesson/list/{academy}', 'LessonController@index');
        Route::post('/lesson/now/list/{academy}', 'LessonController@lessonNow');
        Route::post('/lesson/destroy/{lesson}', 'LessonController@destroy');
        Route::post('/lesson/not/aluns/list/{lesson}/{academy}', 'LessonController@listNotAluns');
        Route::post('/lesson/students/now/list/{lesson}', 'LessonController@lessonAlunsList');
        Route::post('/lesson/student/list/{student}', 'LessonController@listAluns');

        //MATRÍCULA
        Route::post('/registration', 'RegistrationController@store');
        Route::post('/registration/list/{lesson}', 'RegistrationController@index');
        Route::post('/registration/destroy/{registration}', 'RegistrationController@destroy');

        //CONTRATO
        Route::post('/contract', 'ContractController@store');
        Route::post('/contract/renew', 'ContractController@renew');
        Route::post('/contract/list/{user}', 'ContractController@index');
        Route::post('/contract/get/{user}', 'ContractController@getActiveByUser');

        //FATURA
        Route::post('/invoice/list/{contract}', 'InvoiceController@index');
        Route::post('/invoice/reportPayment/{invoice}', 'InvoiceController@reportPayment');

        //GRADUAÇÃO
        Route::post('/graduation', 'GraduationController@store');
        Route::post('/graduation/list/{academy}', 'GraduationController@index');
        Route::post('/graduation/destroy/{graduation}', 'GraduationController@destroy');

        //GRADUAÇÃO DO ALUNO
        Route::post('/user-graduation', 'UserGraduationController@store');
        Route::post('/user-graduation/graduate', 'UserGraduationController@graduate');
        Route::post('/user-graduation/list/{user}', 'UserGraduationController@index');
        Route::post('/user-graduation/find/{user_graduation}', 'UserGraduationController@find');
        Route::post('/user-graduation/destroy/{userGraduation}', 'UserGraduationController@destroy');
        Route::post('/user-graduation/list/sport/{sport}/{academy}', 'GraduationController@listBySport');
        Route::post('/user-graduation/active/list/{user}', 'UserGraduationController@listActivesByUser');
        Route::post('/user-graduation/situation/{academy}', 'UserGraduationController@situationAlunsByAcademy');

        //PRESENÇA
        Route::post('/presence/list/{user}/{userGraduation}', 'PresenceController@index');

        //ACADEMIA
        Route::post('/academy/list/{academy}', 'AcademyController@index');
        Route::post('/academy/update-token/{academy}', 'AcademyController@updateToken');

        //HORA START
        Route::post('/start', 'StartUserGraduationController@store');

        //FINANCEIRO
        Route::post('/financial/{academy}/{date}', 'FinancialController@index');

        //BUGS
        Route::post('/bug', 'BugController@store');

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

        //BUGS
        Route::post('/bug', 'BugController@store');

        //FINNANCEIRO
        Route::post('/financial/invoiceDue/{user}', 'InvoiceController@invoiceDue');

        //INDEX
        Route::post('/index/{user}', 'IndexController@mainFunction');
    });

