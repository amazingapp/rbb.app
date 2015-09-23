<?php
Route::get('checkout', function()
{
    return view('checkout');
});
Route::get('api/coupons/{code}', function($code)
{
    return response()->json([
            'code' => 'CODE123',
            'discount' => 40,
            'description' => 'Cool, you got yourself a discount.'
        ],200);
});

Route::get('/', ['middleware' => 'guest', 'as' => 'splash', 'uses' => 'HomeController@splash']);
Route::get('home', ['middleware' => 'auth', 'as' => 'home', 'uses' => 'HomeController@index']);
Route::get('login',['as'=>'login', 'uses' => 'SessionsController@create']);
Route::get('logout',['as'=>'logout', 'uses' => 'SessionsController@destroy']);
Route::get('register', ['as' =>'register', 'uses' => 'RegistrationController@create']);

Route::get('friends/requests', ['as' => 'friends.request', 'uses' => 'FriendsController@index']);
Route::get('friends', ['as' => 'friends.index', 'uses' => 'FriendsController@all']);

$router->group(['middleware' => 'csrf'], function($router)
{
    //login
    Route::post('login',['as'=>'login', 'uses' => 'SessionsController@store']);
    //register
    Route::post('register', ['as' =>'register','middleware' => 'csrf', 'uses' => "RegistrationController@store"]);
    //friends
    Route::post('friends/{id}/accept', [ 'as' => 'friends.accept', 'uses' => 'FriendsController@accept']);
    Route::post('friends/{id}/decline', ['as' => 'friends.decline', 'uses' => 'FriendsController@decline']);
    Route::post('friends/{id}/send_request', ['as' => 'friends.send_request', 'uses' => 'FriendsController@sendRequest']);
    // posts & comments
    Route::post('posts/create',['as' => 'posts.create', 'uses' => 'PostsController@create']); //create a posts
    Route::post('posts/{id}/comments',['as' => 'posts.comments', 'uses' => 'CommentsController@store']); // leave a comment on a posts

});
Route::get('search', ['as' => 'search', 'uses' => 'SearchController@index']);
Route::get('@{employeeid}',['as'=>'user.profile', 'uses' => 'UsersController@show']);

Route::get('@{employeeid}/posts/{postid}', ['as' => 'users.posts', 'uses' => 'PostsController@show']);

Route::get('settings/account', ['as'=>'settings.account', 'uses' => 'SettingsController@index']);
Route::put('settings/profile', ['as' => 'settings.profile', 'uses' => 'SettingsController@updateProfile']);
Route::put('settings/change_password', ['as' => 'settings.change_password', 'uses' => 'SettingsController@updatePassword']);
Route::post('settings/aavatar', ['as' => 'settings.aavatar', 'uses' => 'SettingsController@updateAavatar']);



/** User Activity */
Route::get('users',['as'=>'users', 'uses' => 'UsersController@index']);
Route::get('@{employeeid}/activity',['as'=>'user.activity', 'uses' => 'ActivitiesController@show']); // show should user's all posts if the user is not private
Route::get('@{employeeid}/posts/{postsid}', ['as' => 'user.posts' , 'uses' => 'UsersController@posts']); // should show a single posts of a user with other replies

/** Notifications */
Route::get('notifications',['as'=>'notifications', 'uses' => 'NotificationsController@index']); // should show notification for a user, replies, mentions etc, anything that needs attention or anything that the user opted for in the settings //# get the notifications for authorized user, /notifications?tab=all,read,unread,archived=deleted
Route::post('notifications/archive',['as'=>'notifications.delete', 'uses' => 'NotificationsController@archive']); #Notification that should be deleted /archive?mark=deleted/read/unread
/** User Settings */
// Route::get('settings/profile', ['as'=>'user.editprofile', 'uses' => 'SettingsController@editprofile']);
// Route::get('settings/account', ['as' => 'user.account' , 'uses' => 'SettingsController@account']); // should show user account info
Route::get('settings/password', ['as' => 'user.password', 'uses' => 'SettingsController@password']); // should show user password section
Route::get('settings/mobile', ['as' => 'user.mobile' , 'uses' => 'SettingsController@mobile']); // should show user mobile section
Route::get('settings/blocked', ['as' => 'user.blocked', 'uses' => 'SettingsController@blocked']); // should show user's blocked preference
Route::get('settings/privacy', ['as' => 'user.privacy', 'uses' => 'SettingsController@privacy']); //// should show user privacy concerned with notification etc

/** posts and Comments */

Route::post('posts/{id}/update',['as' => 'posts.update', 'uses' => 'PostsController@update']); //update a posts
Route::get('posts/{id}/delete',['as'=>'posts.delete', 'uses' => 'PostsController@delete']); //delete a posts

Route::delete('posts/{postsid}/comments/{commentid}/delete',['as' => 'posts.comments.delete', 'uses' => 'CommentsController@delete']); // delete a comment from a posts

Route::group(['name' => 'backend'], function(){
    Route::get('users/register',['as'=>'users.register', 'uses' => 'RegistrationController@register']);
    Route::post('users/store',['as' => 'users.store', 'uses' => 'RegistrationController@store']);
});

/** Follow UnFollow  */
// Route::post('follows',['as' => 'follow.user', 'uses' => 'FollowsController@store']);
// Route::delete('follows/@{id}',['as' => 'unfollow.user', 'uses' => 'FollowsController@destroy']);

/** Messaging */
Route::group(['name' => 'Conversations'],function(){

        Route::get('conversations/{conversationId}',function( Guard $auth, $conversationId ){
            $user = $auth->user();
            $messages = ConversationRepository::messages( $conversationId, $user );
            $message = new MessageTransformer;
            return $response = $message->withPaginator($messages);
        });
        Route::post('conversations/create', function(){

            $existingUsers = [Auth::id(), Input::get('friend_id')]; # get two parties first
            $conversations = Auth::user()->conversations()->orWherePivot('user_id','=', Input::get('friend_id'))->get(); // check to see if they are already in a conversation
            $data = ['user_id' => Auth::id(), 'body' => Input::get('message')];

            if( $conversations->count() == 2) // meaning two users are already participating
            {
                # just defer to another class and then return the posts
                ConversationRepository::create( $conversations->first(), $data); // something like this
            }
            else // else we know they are participating for the firsttime so lets create a conversation and save message to it
            {
                $conversation = Auth::user()->conversations()->create( [ 'created_by'=> Auth::id() ] );

                $conversation->users()->sync([ Input::get('friend_id'), Auth::id() ]);

                $conversation->messages()->create($data);
            }
            return 'true'; // json sent message
        });

        Route::post('conversations/{conversationId}/delete', function($id){
            if( $conversation = Conversation::whereCreatedBy(Auth::id())->find($id) )
            {
                $conversation->delete();
                return 'Conversation Deleted';
            }
            return 'Could not delete the conversation.'; // json response
        });

       Route::get('conversations',function()
        {
            $conversations = Auth::user()->conversations()->with(['users' => function($query){
                $query->select(DB::raw('employee_id, id as user_id, avatar'));
            }])
            // ->latest('conversations.last_activity')
            ->paginate();
            return $conversation; // need to transofrm the data to valid json
        });

         Route::post('conversations/{conversationId}',function($id){
            #1 Find the conversation first
            $conversation = Conversation::find($id);
            #2 see if the current user is the part of the conversation_id
            if( $conversation->users()->where( 'users.id','=', Auth::id() )->first() )
            {
                $data = ['user_id' => Auth::id(), 'body' => Input::get('message')];
                $conversation->messages()->create($data);
                return Response::json(['status' => '201', 'data' => ['message' => 'Messsage Sent']], 201);
            }
            return Response::json(['error' => 'Message can not be sent.'], 403);
        });
});
/**
 * Ajax
 */
Route::group(['prefix' => 'ajax', 'namespace' => 'Ajax', 'name' => 'ajax' , 'middleware' => []], function(){
    Route::get('conversations/{conversationid}/new_messages', function($id){

            $haslatestMessage = Message::where('conversation_id',$id)
                                    ->where('user_id', '!=', Auth::id())
                                    ->whereNull('read_at')
                                    ->count();
            if( $haslatestMessage ){
                $conversation = Conversation::find($id);
                #2 see if the current user is the part of the conversation_id
                if( $conversation->users()->where( 'users.id','=', Auth::id() )->first() )
                {
                    $messages = $conversation->messages()->where('user_id','!=', Auth::id())->whereNull('read_at')->get();
                     $messages->each(function($m){
                            $m->read_at = Carbon\Carbon::now();
                            $m->save();
                     });
                    return Response::json(['data' => $messages, 'status' => 200], 200);
                }
                return Response::json(['status' => 403, 'message' => 'User is typing'], 403);
            }
        #1 validate if the current user is a part of the conversationId
        #2 see if there are any new messages for the user other than his own message
        #3 if there are new messages return a json data object
        #4 if there aren't then return data oject with no data or no_new_message message
    });
    Route::get('posts/{posts}/comments', ['as' => 'ajax.getComments', 'uses' => 'CommentsController@index']);
    Route::get('posts/{id}/comments', function(){
        return Response::json(['return' => 'hello world']);
    });
});

/**
 * Messages
 */

Route::get('messages', function(Guard $auth){
    if($hasMessages = $auth->user()
        ->messages()
        ->select(DB::raw('messages.user_id, messages.conversation_id'))
        ->latest('messages.created_at')
        ->first())
    {
        return Redirect::to("messages/{$hasMessages->conversation_id}");
    }

    return view('chats.index');
    // return view('chats.new_window');
});

Route::get('messages/{conversationid}', function($conversationid){
    \JavaScript::put([
                    'me' => Auth::user(),
            ]);
        return view('chats.index');
});

 Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
 ]);