<?php

namespace Banijya\Listeners;

use Banijya\Events\UserRegistered;
use Banijya\Events\CommentWasPosted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Auth;

class User
{
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
        $user = Auth::user();

        return $user->recordActivity('left', $commentPosted->comment);
    }
}
