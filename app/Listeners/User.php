<?php

namespace Banijya\Listeners;

use Banijya\Events\UserRegistered;
use Banijya\Events\CommentWasPosted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Auth\Guard;

class User
{

    protected $auth;


    function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * After user has registered do what you want to do here!
     * @param  UserRegistered $user
     * @return
     */
    public function register(UserRegistered $user)
    {

    }

    /**
     * Listens when the comment has been left on a status
     * @param  CommentWasPosted $commentPosted
     * @return Banijya\Comment
     */
    public function commentPosted(CommentWasPosted $commentPosted)
    {
        return $this
                ->auth
                ->user()
                ->recordActivity('left', $commentPosted->comment);
    }

    /**
     * Listen when the post was liked by auth user
     * @param  PostWasLiked $likedPost
     * @return Banijya\Like
     */
    public function likedPost(PostWasLiked $likedPost)
    {
        return $this
                ->auth
                ->user()
                ->recordActivity('liked', $likedPost->post);
    }
}
