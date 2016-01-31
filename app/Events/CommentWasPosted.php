<?php

namespace Banijya\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Banijya\User;
use Banijya\Comment;

class CommentWasPosted extends Event
{
    use SerializesModels;

    public $comment;

    function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }
}