<?php

    # Auth route 
    require base_path('routes/route_group/auth.php');        

    # Authenticated Route 
    Route::group(['middleware'=>['auth']],function(){
        # Logout - this one need to put out side 2fa middleware
        // Route::get('/logout', ['as' => 'logout', 'uses' => 'AuthorityController@logout']);   

        Route::group(['middleware'=>[]],function(){
            
            require base_path('routes/route_group/admin/account.php');       
            require base_path('routes/route_group/student/account.php');   

        });
        

    });
