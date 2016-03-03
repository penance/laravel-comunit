<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

// auth & generic
Route::group(['middleware' => 'web'], function () {
    // auth
    Route::auth();

    // default page
    Route::get('/',                 ['as' => 'home', 'uses' => 'HomeController@index']);
    Route::get('/home',             ['as' => 'home', 'uses' => 'HomeController@index']);

    // unauthorized view
    Route::get  ('/unauthorized',   ['as' => 'unauthorized',    'uses' => 'PagesController@unauthorized']);

});

// users - custom
Route::group(['middleware' => 'web'], function () {
    Route::get  ('/users',            ['as' => 'users',           'uses' => 'UserController@index']);
    Route::get  ('/user/edit/{id}',   ['as' => 'user.edit',       'uses' => 'UserController@edit']);
    Route::post ('/user/edit/{id}',   ['as' => 'user.edit.post',  'uses' => 'UserController@updateUser']);
    Route::get  ('/user/delete/{id}', ['as' => 'user.delete',     'uses' => 'UserController@delete']);
    Route::get  ('/user/updateAccessLevel/{userId}/{accessLevelId}',
        ['as' => 'user.updateAccessLevel', 'uses' => 'UserController@updateAccessLevel']);
});


// articles
Route::group(['middleware' => 'web'], function () {
    Route::resource('articles', 'ArticlesController');
});

// article comments
Route::group(['middleware' => 'webAuthenticated', 'prefix' => 'comments'] , function () {
    Route::get      ('/',         ['as' => 'comments.index',      'uses' => 'CommentsController@index']);
    Route::post     ('/{articleId}',        ['as' => 'comments.store',      'uses' => 'CommentsController@store']);
    Route::delete   ('/{comments}',         ['as' => 'comments.destroy',    'uses' => 'CommentsController@destroy']);
});


// conversations
Route::group(['middleware' => 'webAuthenticated', 'namespace' => 'Conversations', 'prefix' => 'conversations'], function (){
    Route::get      ('/',                   ['as' => 'conversations.index',     'uses' => 'ConversationsController@index']);
    Route::post     ('/',                   ['as' => 'conversations.store',     'uses' => 'ConversationsController@store']);
    Route::get      ('/create',             ['as' => 'conversations.create',    'uses' => 'ConversationsController@create']);
    Route::get      ('/{conversations}',    ['as' => 'conversations.show',      'uses' => 'ConversationsController@show']);
    Route::delete   ('/{conversations}',    ['as' => 'conversations.destroy',   'uses' => 'ConversationsController@destroy']);
});

// conversation messages
Route::group(['middleware' => 'webAuthenticated', 'namespace' => 'Conversations', 'prefix' => 'messages'], function () {
    Route::get      ('/{conversations}',    ['as' => 'messages.index',      'uses' => 'MessagesController@index']);
    Route::post     ('/{conversations}',    ['as' => 'messages.store',      'uses' => 'MessagesController@store']);
    Route::delete   ('/{conversations}',    ['as' => 'messages.destroy',    'uses' => 'MessagesController@destroy']);
});

// discussions
Route::group(['middleware' => 'webAuthenticated', 'namespace' => 'Discussions'], function () {
    Route::resource('discussions', 'DiscussionsController');
});
