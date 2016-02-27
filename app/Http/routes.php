<?php
Route::macro('after', function ($callback) {
    $this->events->listen('router.filter:after:newrelic-patch', $callback);
});

Route::group(['middleware' => ['web']], function () {
    Route::get('logout',['as'=>'logout', 'uses' => 'SessionsController@destroy']);
    Route::get('terms',['as' => 'terms', 'uses' => 'PagesController@terms']);

    Route::group(['middleware' => 'guest'], function()
    {
        Route::get('/', ['middleware' => 'guest', 'as' => 'splash', 'uses' => 'HomeController@splash']);
        Route::get('login',['middleware' => 'guest', 'as'=>'login', 'uses' => 'SessionsController@create']);
        Route::post('login',['as'=>'login' ,'middleware' => 'csrf', 'uses' => 'SessionsController@store']);
        Route::get('register', ['middleware' => 'guest', 'as' =>'register', 'uses' => 'RegistrationController@create']);
        Route::post('register', ['as' =>'register','middleware' => 'csrf', 'uses' => "RegistrationController@store"]);
    });
    Route::group(['middleware' => 'auth'], function()
    {
        Route::get('friends/requests', ['as' => 'friends.request', 'uses' => 'FriendsController@index']);
        Route::get('friends', ['as' => 'friends.index', 'uses' => 'FriendsController@all']);
        Route::get('home', ['as' => 'home', 'uses' => 'HomeController@index']);
        Route::get('search', ['as' => 'search', 'uses' => 'SearchController@index']);
        //settings
        Route::get('settings/account', ['as'=>'settings.account', 'uses' => 'SettingsController@index']);
        Route::put('settings/profile', ['as' => 'settings.profile', 'uses' => 'SettingsController@updateProfile']);
        Route::put('settings/change_password', ['as' => 'settings.change_password', 'uses' => 'SettingsController@updatePassword']);
        Route::post('settings/picture', ['as' => 'settings.picture', 'uses' => 'SettingsController@updatePicture']);

        Route::get('settings/password', ['as' => 'user.password', 'uses' => 'SettingsController@password']); // should show user password section
        Route::get('settings/mobile', ['as' => 'user.mobile' , 'uses' => 'SettingsController@mobile']); // should show user mobile section
        Route::get('settings/blocked', ['as' => 'user.blocked', 'uses' => 'SettingsController@blocked']); // should show user's blocked preference
        Route::get('settings/privacy', ['as' => 'user.privacy', 'uses' => 'SettingsController@privacy']); //// should show user privacy concerned with notification etc
    });
    Route::group(['middleware' => ['csrf', 'auth']], function()
    {
        //friends
        Route::post('friends/{id}/accept', [ 'as' => 'friends.accept', 'uses' => 'FriendsController@accept']);
        Route::post('friends/{id}/decline', ['as' => 'friends.decline', 'uses' => 'FriendsController@decline']);
        Route::post('friends/{id}/send_request', ['as' => 'friends.send_request', 'uses' => 'FriendsController@sendRequest']);
        // posts & comments
        Route::post('posts/create',['as' => 'posts.create', 'uses' => 'PostsController@create']);
        Route::post('posts/{id}/comments',['as' => 'posts.comments', 'uses' => 'CommentsController@store']);
        Route::delete('posts/{post}', ['as' => 'posts.delete', 'uses' => 'PostsController@delete']);

    });


    Route::get('@{employeeid}',['as'=>'user.profile', 'uses' => 'UsersController@show']);
    Route::get('@{employeeid}/posts/{postid}', ['as' => 'users.posts', 'uses' => 'PostsController@show']);

    /** User Activity */
    Route::get('users',['as'=>'users', 'uses' => 'UsersController@index']);
    //Route::get('@{employeeid}/activity',['as'=>'user.activity', 'uses' => 'ActivitiesController@show']); // show should user's all posts if the user is not private
    Route::get('@{employeeid}/posts/{postsid}', ['as' => 'user.posts' , 'uses' => 'UsersController@posts']); // should show a single posts of a user with other replies

    /** posts and Comments */

    Route::post('posts/{id}/update',['as' => 'posts.update', 'uses' => 'PostsController@update']); //update a posts
    Route::get('posts/{id}/delete',['as'=>'posts.delete', 'uses' => 'PostsController@delete']); //delete a posts
    Route::delete('posts/{postid}/comments/{commentid}/delete',['as' => 'posts.comments.delete', 'uses' => 'CommentsController@delete']); // delete a comment from a posts
    Route::post('posts/{post}/like',['as' => 'posts.like', 'uses' => 'PostsController@like']); //like a posts

     Route::controllers([
        'password' => 'Auth\PasswordController',
     ]);
});