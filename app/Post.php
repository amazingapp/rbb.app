<?php

namespace Banijya;
use Banijya\Traits\CanBeActivity;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    use CanBeActivity;

    protected static $recordsEvents = ['created', 'updated'];

    public $fillable = ['body', 'user_id'];


    /**
     * A Post belongs to a User
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * A status has many comments
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }

    /**
     * Count Comments
     * @return
     */
    public function commentsCount()
    {
      return $this->hasOne(Comment::class)
        ->selectRaw('post_id, count(*) as aggregate')
        ->groupBy('post_id');
    }

    /**
     * Count the Comments of a particular post
     */
    public function getCommentsCountAttribute()
    {
      // if relation is not loaded already, let's do it first
      if ( ! array_key_exists('commentsCount', $this->relations) )
      {
        $this->load('commentsCount');
      }

      $related = $this->getRelation('commentsCount');

      // then return the count directly
      return ($related) ? (int) $related->aggregate : 0;
    }

    /**
     * Likes
     * @return morphMany
     */
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function likesFor($user)
    {
        return $this->likes()->where('user_id','=',$user->id);
    }
}
