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

Route::get('/', 'WallsController@index');

Auth::routes();

Route::get('/search', 'SearchController@users');

Route::get('/home', 'WallsController@index');

Route::resource('/users', 'UsersController', ['except' => ['index', 'create', 'store', 'destroy']]);

Route::get('/images/user-avatar/{id}/{size}', 'ImagesController@user_avatar');
Route::get('/images/user-gallery/{user_id}/{img_id}/{size}', 'ImagesController@user_gallery');

Route::resource('/friends', 'FriendsController', ['except' => ['edit', 'show', 'create']]);
Route::get('users/{user}/friends', 'FriendsController@index');
Route::post('/friends/{friend}', 'FriendsController@add');
Route::patch('/friends/{friend}', 'FriendsController@accept');
Route::delete('/friends/{friend}','FriendsController@destroy');

Route::get('/set','FriendsController@accept');

Route::resource('/posts', 'PostsController', ['except' => ['index', 'create']]);

Route::resource('/comments', 'CommentsController', ['except' => ['index', 'create']]);

Route::get('/wall', 'WallsController@index')->name('wall');

Route::post('/likes', 'LikesController@add');
Route::delete('/likes', 'LikesController@destroy');

Route::resource('/users/{user_id}/gallery', 'UsersGalleryController',['except' => ['edit', 'show', 'destroy']]);

Route::get('users/{user_id}/gallery/edit', 'UsersGalleryController@edit');
Route::delete('users/{user_id}/gallery', 'UsersGalleryController@destroy');

Route::get('/notifications', 'NotificationsController@index');
Route::patch('/notifications/{notification}', 'NotificationsController@update');

Route::get('events', 'EventsController@allEvents');
Route::get('events/{user}', 'EventsController@index');
Route::get('event/{id}/edit', 'EventsController@edit');
Route::patch('event/{event_id}/edit', 'EventsController@update');
Route::get('add-event', 'EventsController@create');
Route::post('add-event', 'EventsController@store');
Route::post('events/{event}/taking-part-event', 'EventsController@takingPartEvent');
Route::post('events/not-taking-part-event', 'EventsController@notTakingPartEvent');


// == OAuth Routes == /

//Google +
Route::get('auth/google',   ['as' => 'auth/google',   'uses' => 'Auth\LoginController@redirectToGoogle']);
Route::get('auth/google/callback',     ['as' => 'auth/google/callback',     'uses' => 'Auth\LoginController@handleGoogleCallback']);

//Facebook
Route::get('auth/github',   ['as' => 'auth/github',   'uses' => 'Auth\LoginController@redirectToGithub']);
Route::get('auth/github/callback',     ['as' => 'auth/github/callback',     'uses' => 'Auth\LoginController@handleGithubCallback']);

Route::get('/markAsRead',function(){
    auth()->user()->unreadNotifications->markAsRead();
});

