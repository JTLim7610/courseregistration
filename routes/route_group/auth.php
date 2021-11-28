<?php

# Localization

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

Route::get('index', function () {

    return view('login');
});

Route::get('/users/export', 'ExportController@user');

Route::group([], function () {
    Route::get('/', ['as' => 'index', 'uses' => 'AuthorityController@index']);
    Route::get('/login', ['as' => 'loginPage', 'uses' => 'AuthorityController@loginPage']);
    Route::get('/register',  ['as' => 'register', 'uses' => 'AuthorityController@regisPage']);
    Route::post('/create', ['as' => 'create', 'uses' => 'AuthorityController@registerUser']);
    Route::post('/', ['as' => 'submit', 'uses' => 'AuthorityController@attemptLogin','middleware'=>['throttle:15,1']]);
    Route::get('/guest', ['as' => 'guest', 'uses' => 'Student\IndexController@index']);
    Route::get('/guest/about_us', ['as' => 'guest_about_us', 'uses' => 'Student\AboutUsController@index']);
    Route::get('/guest/course', ['as' => 'guest_course', 'uses' => 'testController@get']);
    Route::get('/logout', ['as' => 'logout', 'uses' => 'AuthorityController@logout']);

});

Route::get('test',function(){
    return view('pages.notificationView.verifyNotification');
});

Route::group([], function () {
    Route::get('/activity/{activity_token}','AuthorityController@verifyAccount')->name('user.verify');
    Route::get('/course/{activity_token}','AuthorityController@verifyCourse')->name('course.verify');
});

