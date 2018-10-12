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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=>'/blog', 'namespace'=>'Api', 'as'=>'blog.'], function () {

    Route::group(['prefix'=>'/login', 'as'=>''], function (){
        Route::get('/', ['uses'=>'LoginController@index', 'as'=>'index']);
        Route::post('/', ['uses'=>'LoginController@store', 'as'=>'login']);
    });

    Route::group(['prefix'=>'/posts', 'as'=>'post.'], function () {
        Route::get('/',['uses'=>'PostController@index', 'as'=>'index']);
        Route::post('/', ['uses'=>'PostController@store', 'as'=>'create']);

        Route::get('/create', ['uses'=>'PostController@create', 'as'=>'create']);
        Route::post('/create', ['uses'=>'PostController@store', 'as'=>'post']);

        Route::get('/update/{id}', ['uses'=>'PostController@edit', 'as'=>'edit']);
        Route::post('/update/{id}', ['uses'=>'PostController@update', 'as'=>'update']);

        Route::get('/delete/{id}', ['uses'=>'PostController@destroy', 'as'=>'delete']);
    });

});
