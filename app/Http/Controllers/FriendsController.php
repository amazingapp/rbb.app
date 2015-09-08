<?php

namespace Banijya\Http\Controllers;

use Banijya\Http\Controllers\Controller;
use Banijya\Http\Requests;
use Banijya\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;


class FriendsController extends Controller
{

    public function index(Guard $auth)
    {
        $friendsRequests = $auth->user()->friendsRequests()->simplePaginate();
        return view('friends.index', compact('friendsRequests'));
    }

    /**
     * Accept Friend Request
     * @param   $id
     * @param    $auth
     * @return   redirect
     */
    public function accept($userId, Guard $auth)
    {
        $user = User::findOrFail($userId);

        // Check if current user has received friend request from that user
        if( ! $auth->user()->hasFriendRequestReceived($user) )
            return back()->withErrorMessage('Sorry there was a problem accepting the request.');

        // lets accept friend request
        $auth->user()->acceptFriendRequest($user);

        //redirect back with success message
        return back()->withSuccessMessage("You and {$user->name} are friends.");
    }

    /**
     * Decline a friends requests
     * @param   $userId [description]
     * @param    $auth
     * @return   Redirect
     */
    public function decline($userId, Guard $auth)
    {
        $user = User::findOrFail($userId);

        if( ! $auth->user()->isConnectedWith($user) )
             return back()->withErrorMessage('Sorry, We did not find any reason to unfriend that User.');

        $auth->user()->deleteFriend($user);

        return back()->withSuccessMessage("You and {$user->name} are no more friends.");
    }


    /**
     * Send a friend request to other users
     * @param   $userId
     * @param    $auth
     * @return   redirect
     */
    public function sendRequest($userId, Guard $auth)
    {
        $user = User::findOrFail($userId);

        if( $auth->user()->isFriendsWith($user) ) // if already friends no point on going further
            return redirect()->route('home')->withSuccessMessage('You are already friends.');

        if(
            $auth->user()->hasFriendRequestPending($user) || //check to see if current user has friend request pending from the user
            $user->hasFriendRequestPending($auth->user()) // check to see if current user is on pending list of another user
        )
        {
            return redirect()
                        ->route('home')
                        ->withInfoMessage('Friend Request already pending.');
        }

        $auth->user()->addFriend($user);

        return back()->withInfoMessage('Friend request sent.');
    }
}
