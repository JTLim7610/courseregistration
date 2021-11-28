<?php 

 Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin'], function () {
    Route::group(['prefix' => 'account', 'as' => 'account.'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'IndexController@index']);

        Route::group(['prefix' => 'course', 'as' => 'course.', 'namespace' => 'Course'], function(){
            Route::get('/', ['as' => 'index', 'uses' => 'IndexController@index']);
            Route::get('/{id}', ['as' => 'details', 'uses' => 'IndexController@get']);
            Route::post('/', ['as' => 'update', 'uses' => 'IndexController@update']);
            Route::post('/markAllComplete', ['as' => 'mark_all_complete', 'uses' => 'IndexController@markAllCompleted']);
            Route::post('/markAsComplete', ['as' => 'mark_as_complete', 'uses' => 'IndexController@markAsComplete']);
            Route::post('/generateCertificate', ['as' => 'generate_cert', 'uses' => 'IndexController@generateCertificate']);
            Route::post('/generateAllCertificate', ['as' => 'generate_all_cert', 'uses' => 'IndexController@generateCertificateForAllStudent']);
            Route::delete('/removeStudent', ['as' => 'remove_student', 'uses' => 'IndexController@removeStudent']);
            Route::post('/courseCompletion', ['as' => 'course_completion', 'uses' => 'IndexController@markCourseComplete']);
        });

        Route::group(['prefix' => 'add_course', 'as' => 'add_course.', 'namespace' => 'AddCourse'], function(){
            Route::get('/', ['as' => 'index', 'uses' => 'IndexController@index']);
            Route::post('/', ['as' => 'create', 'uses' => 'IndexController@create']);
            Route::delete('/delete', ['as' => 'delete', 'uses' => 'IndexController@delete']);
        });

        Route::group(['prefix' => 'staff', 'as' => 'staff.', 'namespace' => 'Staff'], function(){
            Route::get('/', ['as' => 'index', 'uses' => 'IndexController@index']);
            Route::get('/add_staff', ['as' => 'add_staff', 'uses' => 'IndexController@createStaffPage']);
            Route::delete('/delete_staff', ['as' => 'delete_staff', 'uses' => 'IndexController@removeStaff']);
            Route::post('/', ['as' => 'create', 'uses' => 'IndexController@create']);
            Route::get('/edit', ['as' => 'edit_staff', 'uses' => 'UpdateController@index']);
            Route::post('/update', ['as' => 'update_staff', 'uses' => 'UpdateController@update']);

        });

        Route::group(['prefix' => 'registered', 'as' => 'registered.', 'namespace' => 'RegisteredCourse'], function(){
            Route::get('/', ['as' => 'index', 'uses' => 'IndexController@index']);
            Route::post('/action',['as' => 'action', 'uses' => 'IndexController@action']);
        });

        Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

});
});
