<?php

namespace Banijya;

use Illuminate\Database\Eloquent\Model;
use Banijya\Traits\CanBeActivity;

class Comment extends Model
{
    use CanBeActivity;

    protected static $recordsEvents = [];

    protected $fillable = ['user_id', 'body', 'post_id'];

    /**
     * user should be able to comment
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * User can comment for a status
     *
     * @return mixed
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }


    /**
     * Save a comment to a post
     * @param   $post
     * @return  ret
     */
    public function attachTo($object)
    {
        $object->comments()->save($this);
        return $this;
    }
}
