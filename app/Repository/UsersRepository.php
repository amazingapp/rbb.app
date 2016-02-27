<?php

namespace Banijya\Repository;
use DB;
use Banijya\User;

class UsersRepository
{
    /**
     * Get Feeds for Supplied user
     * @param  User   $user
     * @return Paginator
     */
    public function getFeedsFor(User $user)
    {
        $friendsIds = $this->getFriendsIds($user);
        return DB::table('posts')
                    ->select(
                        DB::raw('posts.body, posts.created_at,posts.id AS post_id,
                        images.caption AS image_caption, images.path AS image_path, images.thumbnail_path,
                        COUNT( DISTINCT( comments.id ) ) AS comment_count, COUNT( DISTINCT(likes.id ) ) AS like_count,
                        users.name AS user_name, users.employee_id')
                    )
                    ->join('users', 'users.id', '=', 'posts.user_id')
                    ->join('images', 'posts.user_id', '=', 'images.user_id')
                    ->leftJoin('comments', 'comments.post_id', '=', 'posts.id')
                    ->leftJoin('likes', function($join){
                        $join->on('likes.likeable_id', '=', 'posts.id')
                        ->where('likes.likeable_type',' = ','Banijya\Post');
                  })
                  ->whereIn('posts.user_id', $friendsIds)
                  ->groupBy('posts.id')
                  ->latest('posts.created_at')
                  ->simplePaginate();
    }

    /**
     * Get Friends ID along with current auth user id
     * @param  User   $user
     * @return  array
     */
    public function getFriendsIds(User $user)
    {
        $friendsIds = DB::table('users')->select(['users.id'])
                        ->join('friends',function($join){
                            $join->on('users.id','=','friends.user_id')
                            ->orOn('users.id','=', 'friends.friend_id');
                      })
                      ->where('friends.accepted', 1)
                      ->where(function($query) use ($user){
                          $query->where('friends.user_id', '=', $user->id)
                          ->orWhere('friends.friend_id','=',$user->id);
                      })
                      ->where('users.id','<>', $user->id)
                      ->lists('id');

        return array_merge($friendsIds, [$user->id]);

    }
}