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
    return view('top');
});

Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');
Route::get('login', 'Auth\LoginController@ShowLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('guest', 'Auth\LoginController@authenticate')->name('guest');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

Route::group(['prefix' =>'users', 'middleware' => 'auth'], function(){
    Route::get('show/{id}', 'UserController@show')->name('users.show');
    Route::get('edit/{id}', 'UserController@edit')->name('users.edit');
    Route::post('update/{id}', 'UserController@update')->name('users.update');
    Route::delete('delete/{id}', 'UserController@delete')->name('users.delete');    
});

Route::group(['prefix' => 'users/{id}'], function () {
    Route::post('like', 'ReactionController@store')->name('user.like');
    Route::delete('dislike', 'ReactionController@destroy')->name('user.dislike');
});

Route::group(['middleware' => 'auth'], function(){
    Route::get('home', 'HomeController@index')->name('home');
    Route::get('matching', 'MatchingController@index')->name('matching'); 
    Route::get('index', 'UserController@index')->name('users.index');
    Route::get('search', 'UserController@search');
    Route::get('posts', 'PostController@index')->name('posts.index');
    Route::post('posts/add', 'PostController@add')->name('posts.add');
    Route::get('posts/edit/{id}', 'PostController@edit')->name('posts.edit');
    Route::post('posts/update/{id}', 'PostController@update')->name('posts.update');
    Route::delete('posts/delete/{id}', 'PostController@delete')->name('posts.delete');
});

Route::group(['prefix' => 'chat', 'middleware' => 'auth'], function(){
    Route::post('show', 'ChatController@show')->name('chat.show');
    Route::post('chat', 'ChatController@chat')->name('chat.chat');
});




