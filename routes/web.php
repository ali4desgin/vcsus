<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get( '/about', 'FrontEnd\Content@about');
Route::get( '/privacy', 'FrontEnd\Content@privacy');

//'StudentLogged',
//Route::group(['middleware' => ['StudentRegistering']], function(){

    Route::match(['get','post'], '/', 'FrontEnd\Student\Login@index');
    Route::match(['get','post'], '/login', 'FrontEnd\Student\Login@login');


    Route::group(['prefix' => 'register'], function(){
        Route::match(['get','post'], '/start', 'FrontEnd\Student\Register@start');
        Route::match(['get','post'], '/verify', 'FrontEnd\Student\Register@verify');
        Route::match(['get','post'], '/last', 'FrontEnd\Student\Register@last');
        Route::match(['get','post'], '/final', 'FrontEnd\Student\Register@final');
    });

   
//});


Route::group(['middleware' => 'StudentNotLogged'], function(){

    Route::match(['get','post'], '/home', 'FrontEnd\Home\Home@index');
    Route::match(['get','post'], '/create-post', 'FrontEnd\Post\Proccessing@create');
    Route::match(['get','post'], '/follow/{following_id}', 'FrontEnd\Follow\Proccessing@follow');
    Route::match(['get','post'], '/unfollow/{following_id}', 'FrontEnd\Follow\Proccessing@unfollow');



    Route::match(['get','post'], '/editprofile', 'FrontEnd\Profile\Edit@index');



    Route::group(['prefix' => 'profile'], function(){
        Route::match(['get','post'], '/{student_id}', 'FrontEnd\Profile\Home@index');

    });
    


    // create posts in fourm  22 / 7
    Route::match(['get','post'], '/fourmpost', 'FrontEnd\Fourm\Fourmpost@create');
    Route::match(['get','post'], '/depfourmpost', 'FrontEnd\Fourm\Depfourmpost@create');
     Route::match(['get','post'], '/locfourmpost', 'FrontEnd\Fourm\Locfourmpost@create');
   


     // posts work 
     Route::match(['get','post'],'/post/delete/{post_id}', 'FrontEnd\Post\Proccessing@delete');
     Route::match(['get','post'],'/post/edit', 'FrontEnd\Post\Proccessing@edit');
     Route::match(['get','post'],'/post/{post_id}', 'FrontEnd\Post\Proccessing@view');
     Route::match(['get','post'],'/post/{post_id}/addcomment', 'FrontEnd\Post\Proccessing@addcomment');



     // LIBRARY  22 / 7
     Route::match(['get','post'],'/lib', 'FrontEnd\Lib\Lib@index');
     Route::match(['get','post'], '/uplod-file', 'FrontEnd\File\proce@uplod');


    Route::group(['prefix' => 'fourm'], function(){
        Route::match(['get','post'], '/genral/{fourm_id}', 'FrontEnd\Fourm\Genral@index');
        Route::match(['get','post'], '/location/{fourm_id}', 'FrontEnd\Fourm\Location@index');
        Route::match(['get','post'], '/department/{fourm_id}', 'FrontEnd\Fourm\Department@index');

       
   

    });



    Route::group(['prefix' => 'ajax'], function(){
        Route::match(['get','post'], '/search/posts', 'FrontEnd\Ajax\Search@posts');
        Route::match(['get','post'], '/get/student', 'FrontEnd\Ajax\Get@student');
    });

    Route::match(['get','post'], '/logout', 'FrontEnd\Student\Logout@logout');

});
