<?php

Route::group(['prefix' => 'student', 'as' => 'student.', 'namespace' => 'Student'], function () {

    Route::group(['prefix' => 'account', 'as' => 'account.'], function () {

        Route::get('/', ['as' => 'index', 'uses' => 'IndexController@index']);
        
        Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'IndexController@dashboard']);

        Route::group(['prefix' => 'course', 'as' => 'course.'], function () {
            Route::get('/', ['as' => 'details', 'uses' => 'CourseController@get']);
            Route::post('/', ['as' => 'register', 'uses' => 'CourseController@registerCourse']);
            Route::get('/form',['as' => 'form', 'uses' => 'CourseController@registerForm']);
            Route::post('/unregister', ['as' => 'unregister', 'uses' => 'CourseController@unregisterCourse']);
            Route::post('/unregisterAll', ['as' => 'unregister.all', 'uses' => 'CourseController@unregisterAll']);
        });

        Route::group(['prefix' => 'feedback', 'as' => 'feedback.'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'FeedbackController@index']);
            Route::post('/', ['as' => 'create', 'uses' => 'FeedbackController@create']);
        });

        Route::group(['prefix' => 'registered_course','as' => 'registered_course.'], function(){
            Route::get('/', ['as' => 'index', 'uses' => 'RegisteredController@index']);
            Route::get('/certificate', ['as' => 'certificate', 'uses' => 'RegisteredController@viewCert']);
        });

        Route::group(['prefix' => 'about_us','as' => 'about_us'], function(){
            Route::get('/', ['as' => 'index', 'uses' => 'AboutUsController@index']);
        });

        Route::group(['prefix' => 'payment','as' => 'payment.'], function(){
            Route::get('/', ['as' => 'index', 'uses' => 'PaymentController@index']);
            Route::post('/upload', ['as' => 'upload', 'uses' => 'PaymentController@uploadReceipt']);
        });
    });
});






