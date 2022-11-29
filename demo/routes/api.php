<?php

/*
|--------------------------------------------------------------------------
| User API Routes
|--------------------------------------------------------------------------
|
*/
Route::namespace('Api\User')->group(function () {
    Route::group(['middleware' => ['cors']], function() {
        Route::post('Mobileverify','UserController@Mobileverify');
        Route::post('verifyOtp','UserController@verifyOtp');
        Route::post('ReSendOtp','UserController@ReSendOtp');
    });

    /*------------- JWT TOKEN AUTHORIZED ROUTE-------------------*/
    Route::group(['middleware' => ['cors','jwt.verify']], function() {
        Route::post('logout','UserController@logout');
        Route::post('updateProfile','UserController@updateProfile')->middleware('activeUserCheck');
    });

    });

    /*
    |--------------------------------------------------------------------------
    | COMMON API Routes
    |--------------------------------------------------------------------------
    |
    */
    Route::namespace('Api')->group(function () {
        Route::group(['middleware' => ['cors','jwt.verify']], function() {
            Route::post('invitecontactlist','CommonController@invitecontactlist')->middleware('activeUserCheck');
        });
    });
