<?php

use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Facades\Auth;

/**************************************************

                 USER RELATED

 **************************************************/
#Function to get user role name
function getUserRoleName()
{
    // echo '123';
    // if(Auth::check()){
    //     echo'222';

    //     $roldId = Auth::user()->role_id;
    //     if($roldId !== 1 ) {
    //         return 'no user';
    //     }
    //     echo'222';
    //     // else if($roldId == 1)
    //     // {
    //     //     return 1;
    //     // }
    //     // else if($roldId == 1)
    //     // {
    //     //     return 2;
    //     // }
    //     // else if($roldId == 1)
    //     // {
    //     //     return 3;
    //     // }

    //  } 
    // else{
    //     echo'2333s';

    // }
    

    // else if((Auth::user()->role_id)==1)
    // {
    //     return 1;
    // }
    // else if((Auth::user()->role_id)==2)
    // {
    //     $a = 'superadmin';
    //     return $a;
    // }
    // else if((Auth::user()->role_id)==3)
    // {
    //     return 3;
    // }
    // else
    // {
    //     return 4;
    // }
    return array_flip(getConfig('role'))[Auth::user()->role_id];
}


# Check user role function
function checkRole($role)
{
    return (Auth::check())?Auth::user()->checkRole($role):false;
}


# Function to get user ID 
function getUserID()
{   
    return (($user = Auth::user())?$user->id : null);
}


/**************************************************

                GLOBAL FUNCTION

 ****
 **********************************************/

 #Function to get system config
 function getConfig($config)
{   
    return config("system.$config");
}

function customEncryption($key)
{
    $encrypt = new Encrypter(env('PASS_KEY'), 'AES-128-CBC');
    return $encrypt->encrypt($key);
}


//Custom decryption
function customDecryption($key, $id = null)
{
    try {
        $decrypt = new Encrypter(env('PASS_KEY'), 'AES-128-CBC');
        $decrypt = $decrypt->decrypt($key);
        if ($id)
            return explode("$id", $decrypt)[1];
        return $decrypt;
    } catch (\Exception $e) {
        abort(404);
    }
}

//Function to get $_GET value
function requestInput($key)
{
    return request()->input($key);
}

//Function to filter start date
function getFilterStartDate($date)
{
    $startDate = date($date);
    if (!$startDate)
        $startDate = date("1000-01-01 00:00:00");
    return $startDate;
}


//Function to filter end date
function getFilterEndDate($date)
{
    $endDate =  date('Y-m-d', strtotime('+1 day', strtotime($date)));
    if (!$date)
        $endDate = date("9999-12-31 23:59:59");
    return $endDate;
}


#  Function return success json response
function responseSuccess($data, $message)
{
    return response()->json([
        'status' => 'success',
        'message' => $message,
        'data' => $data
    ], 200);
}


#  Function return fail json response
function responseError($message, $data=null, $code = 422)
{
    return response()->json([
        'status' => 'error',
        'message' => $message,
        'data' => $data
    ], $code);
}

//Function to set meta
function setMeta($meta, $key, $value, $ignoreExistingKey = false)
{
    if (!$meta)
        $meta = (object) array();

    //Ignore existing key
    if ($ignoreExistingKey) {
        if (isset($meta->{$key}))
            return $meta;
    }


    $meta->{$key} = $value;
    return $meta;
}